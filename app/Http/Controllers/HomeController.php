<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Job;
use App\Models\Wage;
use App\Models\Rank;
use App\Models\Province;
use App\Models\UserEmployee;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = new Job;
        $items = $careers = Career::where('status', 1)->get();
        $wages = Wage::where('status', 1)->get();
        $ranks = Rank::where('status', 1)->get();
        $provinces = Province::all();
        $jobs = $model->getJobforJobPackageAndTime();
        $employees = UserEmployee::where('is_top',1)->limit(12)->get();
        $params = [
            'items' => $items,
            'route' => 'home',
            'careers' => $careers,
            'ranks' => $ranks,
            'jobs' => $jobs,
            'wages' => $wages,
            'provinces' => $provinces,
            'employees' => $employees,
        ];
        return view('website.homes.index',$params);
    }
}