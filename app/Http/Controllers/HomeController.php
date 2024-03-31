<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;
use App\Models\JobPackage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $normal_provinces = Province::whereNotIn('id',[31,1,50,32])->orderBy()->get();
        $provinces = Province::whereIn('id',[31,1,50,32])->get()->merge($normal_provinces);
       
        // Việc làm hấp dẫn
        $hot_jobs = Job::where('jobpackage_id',JobPackage::HOT)->orderBy('id','DESC')->limit(20)->get()->chunk(10);
        // Việc làm tốt nhất
        $vip_jobs = Job::where('jobpackage_id',JobPackage::VIP)->orderBy('id','DESC')->limit(12)->get()->chunk(6);

        $employees = UserEmployee::where('is_top',1)->limit(12)->get();
        $params = [
            'items' => $items,
            'route' => 'jobs.vnjobs',
            'careers' => $careers,
            'ranks' => $ranks,
            'hot_jobs' => $hot_jobs,
            'vip_jobs' => $vip_jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
        ];
        return view('website.homes.index',$params);
    }
}