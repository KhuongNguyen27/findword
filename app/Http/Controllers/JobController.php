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
use Illuminate\Support\Str;
class JobController extends Controller
{
    // Trong nước
    public function vnjobs(Request $request){
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
        $provinces = Province::all();
        // dd($items);
        $query = Job::query()->whereStatus(1);
        if($request->province_id){
            $query->whereProvince_id($request->province_id);
        }
        if($request->rank_id){
            $query->whereRank_id($request->rank_id);
        }
        if($request->wage_id){
            $query->whereWage_id($request->wage_id);
        }
        if($request->career_id){
            $query->whereCareer_id($request->career_id);
        }
        $jobs = $query->paginate(12);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm trong nước',
        ];
        return view('website.jobs.index',$params);
    }
    
    public function vnjobs_hot(){
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        // dd($items);
        $jobs = Job::where('status', 1)->paginate(12);
        // dd($jobs);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm trong nước hot nhất',
        ];
        return view('website.jobs.index',$params);
    }
    public function vnjobs_urgent (){
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        // dd($items);
        $jobs = Job::where('status', 1)->paginate(12);
        // dd($jobs);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm trong nước tuyển gấp',
        ];
        return view('website.jobs.index',$params);
    }

    // Ngoài nước
    public function nnjobs (){
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        // dd($items);
        $jobs = Job::where('status', 1)->paginate(12);
        // dd($jobs);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm ngoài nước',
        ];
        return view('website.jobs.index',$params);
    }
    
    public function nnjobs_hot(){
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        // dd($items);
        $jobs = Job::where('status', 1)->paginate(12);
        // dd($jobs);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm ngoài nước hot nhất',
        ];
        return view('website.jobs.index',$params);
    }
    public function nnjobs_urgent (){
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        // dd($items);
        $jobs = Job::where('status', 1)->paginate(12);
        // dd($jobs);
        $employees = UserEmployee::get();
        $params = [
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'title' => 'Việc làm ngoài nước tuyển gấp',
        ];
        return view('website.jobs.index',$params);
    }
}