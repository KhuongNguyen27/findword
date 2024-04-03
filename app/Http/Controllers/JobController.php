<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;
use App\Models\User;
use App\Models\JobPackage;
use App\Models\Level;
use App\Models\FormWork;

use Illuminate\Support\Str;
class JobController extends Controller
{
    // Trong nước
    public function vnjobs(Request $request, $job_type = ''){
        $model = new Job;
        if( isset( $_REQUEST['getData'] ) ){
            $url = 'http://185.230.64.141/jobs.json';
            $json = file_get_contents($url);
            $data = json_decode($json);
            foreach( $data->data->listJob as $job ){
                $checkCompany = User::where('name',$job->company->name)->first();
                if(!$checkCompany){
                    $checkCompany = new User;
                    $checkCompany->name = $job->company->name;
                    $checkCompany->email = time() * rand(1,1000).'@gmail.com';
                    $checkCompany->password = '$2y$12$pK.bA6rgjGcT5OlmIS3CC.7Gj5IjgRJAzdkytkO.hVgQvEMVZiznm';
                    $checkCompany->type = 'employee';
                    $checkCompany->status = 1;
                    $checkCompany->save();

                    $userEmployee = UserEmployee::where('name',$job->company->name)->first();
                    if(!$userEmployee){
                        $userEmployee = new UserEmployee();
                        $userEmployee->name = $job->company->name;
                        $userEmployee->image = $job->company->logo_url;
                        $userEmployee->user_id = $checkCompany->id;
                        $userEmployee->slug = Str::slug($job->company->name);
                        $userEmployee->save();
                    }
                }
                // Save job
                $checkJob = Job::where('name',$job->title)->first();
                if(!$checkJob){
                   $newjob = new Job();
                   $newjob->user_id = $checkCompany->id;                     
                   $newjob->name = $job->title;
                   $newjob->slug = Str::slug($job->title);                 
                   $newjob->career_id  = rand(1,10);
                   $newjob->wage_id    = rand(1,5);
                   $newjob->work_address    = $job->short_cities;
                   $newjob->status    = 1;
                   $newjob->province_id    = 1;
                   $newjob->deadline    = date('Y-m-d',strtotime($job->deadline));
                   $newjob->save();
                }
            }
            echo 'Done';
            die();
        }
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $normal_provinces = Province::whereNotIn('id',[31,1,50,32])->get();
        $provinces = Province::whereIn('id',[31,1,50,32])->orderByRaw("FIELD(id, 31, 1, 50, 32)")->get()->merge($normal_provinces);
        $degrees = Level::where('status',Level::ACTIVE)->get();
        $formworks = FormWork::where('status',FormWork::ACTIVE)->get();
        // Việc làm mới nhất trong nước
        $query = Job::where('status',1)->orderBy('id','DESC');
        $query->where('country', 'VN');
        if( $request->career_id ){
            $query->whereHas('careers', function ($query) use($request) {
                $query->where('career_id', $request->career_id);
            });
        }
        if( $request->wage_id ){
            $query->where('wage_id', $request->wage_id);
        }
        if( $request->rank_id ){
            $query->where('rank_id', $request->rank_id);
        }
        if( $request->degree_id ){
            $query->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $query->where('formwork_id', $request->formwork_id);
        }
        if( $request->province_id ){
            if( $request->province_id == 'quoc_te' ){
                return redirect()->route('jobs.nnjobs',$request->all());
            }
            $query->where('province_id', $request->province_id);
        }
        switch ($job_type) {
            case 'hot':
                $query->where('jobpackage_id',JobPackage::HOT);
                $title = 'Việc làm trong nước hot nhất';
                break;
            case 'today':
                $query->where('jobpackage_id',JobPackage::HOT);
                $title = 'Việc làm trong nước hôm nay';
                break;
            case 'urgent':
                $query->where('jobpackage_id',JobPackage::GAP);
                $title = 'Việc làm trong nước tuyển gấp';
                break;
            default:
                $title = 'Việc làm trong nước';
                break;
        }
        $jobs = $query->paginate(12);

        // Việc làm hấp dẫn trong nước
        $hot_jobs = Job::where('status',1)->where('country', 'VN')->where('jobpackage_id',JobPackage::HOT)
        ->orderBy('id','DESC')->limit(20)->get()->chunk(10);

        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'route' => 'jobs.vnjobs',
            'ranks' => $ranks,
            'jobs' => $jobs,
            'hot_jobs' => $hot_jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => $title,
            'degrees' => $degrees,
            'formworks' => $formworks,
        ];
        return view('website.jobs.index',$params);
    }
    // Ngoài nước
    public function nnjobs (Request $request){
        $model = new Job;
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $degrees = Level::where('status',Level::ACTIVE)->get();
        $formworks = FormWork::where('status',FormWork::ACTIVE)->get();
        $provinces = Province::all();
        // Việc làm mới nhất trong nước
        $query = Job::where('status',1)->orderBy('id','DESC');
        $query->where('country','!=', 'VN');
        if( $request->career_id ){
            $query->whereHas('careers', function ($query) use($request) {
                $query->where('career_id', $request->career_id);
            });
        }
        if( $request->wage_id ){
            $query->where('wage_id', $request->wage_id);
        }
        if( $request->rank_id ){
            $query->where('rank_id', $request->rank_id);
        }
        if( $request->province_id ){
            $query->where('province_id', $request->province_id);
        }
        if( $request->degree_id ){
            $query->where('degree_id', $request->degree_id);
        }
        if( $request->formwork_id ){
            $query->where('formwork_id', $request->formwork_id);
        }
        $jobs = $query->paginate(12);

        // Việc làm hấp dẫn trong nước
        $hot_jobs = Job::where('status',1)->where('country','!=', 'VN')->where('jobpackage_id',JobPackage::HOT)
        ->orderBy('id','DESC')->limit(20)->get()->chunk(10);
        $employees = UserEmployee::get();
        $params = [
            'country' => 'NN',
            'route' => 'jobs.nnjobs',
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'hot_jobs' => $hot_jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'degrees' => $degrees,
            'formworks' => $formworks,
            'title' => 'Việc làm ngoài nước',
        ];
        return view('website.jobs.index',$params);
    }
   
}