<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Province;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Job;

class CareerController extends Controller
{
    public function show($slug, Request $request){
        $item = Career::where('status', 1)->where('slug',$slug)->firstOrFail();
        $provinces = Province::all();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $careers = Career::where('status', 1)->get();
        $request->merge(['career_id'=>$item->id]);
        $query = Job::where('status',1)->orderBy('id','DESC');
        $jobs = $query->limit(20)->paginate(15);
        $params = [
            'title' => $item->name,
            'item' => $item,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'ranks' => $ranks,
            'careers' => $careers,
            'route' => 'home',
        ];

        $view_path = 'website.jobs.sub-index';
        return view($view_path,$params);
    }
}
