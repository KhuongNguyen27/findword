<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;
use App\Models\JobPackage;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_categories = Career::where('status', 1)->get()->chunk(9);
        $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $normal_provinces = Province::whereNotIn('id',[31,1,50,32])->get();
        $provinces = Province::whereIn('id', [31, 1, 50, 32])
        ->orderByRaw("FIELD(id, 31, 1, 50, 32)")
        ->get()->concat($normal_provinces);
    
      
       

       
        // Việc làm hấp dẫn
        $hot_jobs = Job::where('status',1)->where('jobpackage_id',JobPackage::HOT)->orderBy('id','DESC')->limit(20)->get()->chunk(10);
        // Việc làm tốt nhất
        $vip_jobs = Job::where('status',1)->where('jobpackage_id',JobPackage::VIP)->orderBy('id','DESC')->limit(12)->get()->chunk(6);
        // Thị trường việc làm
        $lasest_jobs = Job::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $quantity_job_new_today = Job::where('status',1)->where("created_at",">=",Carbon::now()->subDay())->where("created_at","<=",Carbon::now())->count();
        $quantity_job_recruitment = Job::where('status',1)->count();
        $quantity_company_recruitment = UserEmployee::count();

        $employees = UserEmployee::where('is_top',1)->limit(12)->get();
        $params = [
            'route' => 'jobs.vnjobs',
            'careers' => $careers,
            'job_categories' => $job_categories,
            'ranks' => $ranks,
            'hot_jobs' => $hot_jobs,
            'vip_jobs' => $vip_jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
            'quantity_company_recruitment' => $quantity_company_recruitment,
            'quantity_job_new_today' => $quantity_job_new_today,
            'quantity_job_recruitment' => $quantity_job_recruitment,
            'lasest_jobs' => $lasest_jobs,
        ];
        return view('website.homes.index',$params);
    }
}