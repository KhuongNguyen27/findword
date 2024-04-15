<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Province;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Job;
use App\Models\JobJobTag;
use App\Models\JobTag;
use App\Models\JobPackage;

class CareerController extends Controller
{
    public function show($slug, Request $request){
        $item = Career::where('status', 1)->where('slug',$slug)->firstOrFail();
        $provinces = Province::all();
        $wages = Wage::where('status', 1)->orderBy('position')->get();
        $newWages = [];
        foreach($wages as $wage){
            $newWages[$wage->salaryMin. '-'. $wage->salaryMax] = $wage->name;
        }
        $ranks = Rank::where('status', 1)->orderBy('position')->get();
        $careers = Career::where('status', 1)->get();
        $request->merge(['career_id'=>$item->id]);
        $job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();

        $query = Job::where('status',1);

        $career_id = $item->id;
        $query->whereHas('careers',function($q) use($career_id){
            $q->where('career_id',$career_id);
        });

        $sort = $request->sort;
        switch ($sort) {
            case 'salary-desc':
                $query->orderBy('wage_id','DESC');
                break;
            case 'date-desc':
                $query->orderBy('created_at','DESC');
                break;
            case 'date-asc':
                $query->orderBy('created_at','ASC');
                break;
            default:
                $query->orderBy('created_at','DESC');
                break;
        }

        $jobs = $query->limit(20)->paginate(15);

        $job_job_tags = count($jobs) ? JobJobTag::whereIn('job_id',$jobs->pluck('id')->toArray())->pluck('id')->toArray() : null;
        $job_tags = $job_job_tags ? JobTag::whereIn('id',$job_job_tags)->get() : [];
        $params = [
            'title' => $item->name,
            'item' => $item,
            'jobs' => $jobs,
            'wages' => $newWages,
            'provinces' => $provinces,
            'ranks' => $ranks,
            'careers' => $careers,
            'job_tags' => $job_tags,
            'job_packages' => $job_packages,
            'route' => 'home',
        ];

        $view_path = 'website.jobs.sub-index';
        return view($view_path,$params);
    }
}
