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
use App\Models\Level;
use App\Models\FormWork;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $degrees = Level::where('status',Level::ACTIVE)->orderBy('position')->get();
        $formworks = FormWork::where('status',FormWork::ACTIVE)->orderBy('position')->get();
        $job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
        $careers = Career::where('status', 1)->orderBy('position')->get();
        $job_packages = JobPackage::where('status', 1)->get();
        $wages = [
            'duoi_10tr'=> 'Dưới 10 triệu',
            '10-15'=>'10 - 15 triệu',
            '15-20'=>'15 - 20 triệu',
            '20-25'=>'20 - 25 triệu',
            '25-30'=>'25 - 30 triệu',
            '30-50'=>'30 - 50 triệu',
            'tren_50'=>'Trên 50 triệu',
            'thoa_thuan'=>'Thỏa thuận'
        ];
         $ranks = Rank::where('status', 1)->orderBy('position')->get();
        $normal_provinces = Province::whereNotIn('id',[1,50,32])->get();
        $provinces = Province::whereIn('id', [ 1, 50, 32])
        ->orderByRaw("FIELD(id,1,50,32)")
        ->get()->concat($normal_provinces);
    
        // Việc làm hấp dẫn
        $hot_jobs = Job::select('jobs.*')->where('jobs.status',1)
        ->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
        ->where('jobs.wage_id','>=',2)
        ->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                ELSE 7
            END")
        ->orderBy('jobs.id','DESC')->limit(20)->get()->chunk(10);
        // Việc làm tốt nhất
        $vip_jobs = Job::select('jobs.*')
        ->where('jobs.status',1)
        ->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
        // ->join('user_account', 'jobs.user_id', '=', 'user_account.user_id')
        // ->where('user_account.account_id',\Modules\Account\app\Models\Account::VIP)
        ->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                ELSE 7
            END")
        ->orderBy('jobs.id','DESC')
        ->limit(12)
        ->get()
        ->chunk(9);


        // Thị trường việc làm
        $lasest_jobs = Job::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $quantity_job_new_today = Job::where('created_at', '>=', Carbon::now()->subDay())
        ->count() + 1000;
        $quantity_job_recruitment = Job::where('status',1)->count();
        $quantity_company_recruitment = Job::with('userEmployee')->get()->pluck('userEmployee')->unique()->count();
        $employees = UserEmployee::where('is_top',1)->limit(12)->get();
 
        // Biểu đồ 
        $statistical_career_jobs = Career::withCount('jobs')->get();
        $statistical_jobs = Job::selectRaw('COUNT(*) as count, DATE(created_at) as date')
        ->groupBy('date')
        ->get();
        $statistical_career_jobs_json = json_encode($statistical_career_jobs);
        $statistical_jobs_json = json_encode($statistical_jobs);
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
            'degrees' => $degrees,
            'formworks' => $formworks,
            'statistical_career_jobs_json' => $statistical_career_jobs_json,
            'statistical_jobs_json' => $statistical_jobs_json,
            'job_packages' => $job_packages,
        ];
        return view('website.homes.index',$params);
    }
}