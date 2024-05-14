<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Country;
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
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{

		$degrees = Level::where('status', Level::ACTIVE)->orderBy('position')->get();
		$formworks = FormWork::where('status', FormWork::ACTIVE)->orderBy('position')->get();
		$job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
		$careers = Career::where('status', 1)->orderBy('position')->get();
		$job_packages = JobPackage::where('status', 1)->get();
		$countries = Country::all();
		$wages = Wage::where('status', 1)->orderBy('position')->get();
		$newWages = [];
		foreach ($wages as $wage) {
			$newWages[$wage->salaryMin . '-' . $wage->salaryMax] = $wage->name;
		}
		$job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();
		$ranks = Rank::where('status', 1)->orderBy('position')->get();
		$normal_provinces = Province::whereNotIn('name', [1, 50, 32])->orderBy('name')->get();
		$provinces = Province::whereIn('id', [1, 50, 32])
			->orderByRaw("FIELD(id,1,50,32)")
			->get()->concat($normal_provinces);

		// Việc làm hấp dẫn
		$hot_jobs = Job::select('jobs.*')->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
			->where('jobs.salarymax', '>=', 10000000)
			->orWhere('jobs.salaryMax','');
			// ->where('jobs.wage_id', '>=', 2)
			if($request->name){
				$hot_jobs->where('jobs.name', 'LIKE', '%'.$request->name.'%');
			}
			if($request->province_id){
				$hot_jobs->where('province_id', $request->province_id);
			}
			if( $request->rank_id ){
				$hot_jobs->where('rank_id', $request->rank_id);
			}
			if( $request->degree_id ){
				$hot_jobs->where('degree_id', $request->degree_id);
			}
			if( $request->formwork_id ){
				$hot_jobs->where('formwork_id', $request->formwork_id);
			}
			if( $request->wage_id ){
				$wage_id = $request->wage_id;//'10-15'
				$wage = explode('-', $wage_id);
				if($wage[0] == 0){
					$hot_jobs->where('salaryMin','<=', $wage[1]);
				}
				elseif($wage[1] == 0){
					$hot_jobs->where('salaryMin','>=', $wage[0]);
				}
				else{
					$hot_jobs->whereBetween('salaryMin',[ $wage[0], $wage[1] ]);
				}
			}
			$hot_jobs->orderByRaw("CASE
					WHEN job_packages.slug = 'tin-hot-vip' THEN 1
					WHEN job_packages.slug = 'tin-gap-vip' THEN 2
					WHEN job_packages.slug = 'tin-vip' THEN 3
					WHEN job_packages.slug = 'tin-gap' THEN 4
					WHEN job_packages.slug = 'tin-hot' THEN 5
					WHEN job_packages.slug = 'tin-thuong' THEN 6
					ELSE 7
				END")
			->orderBy('jobs.id', 'DESC')->limit(20);
			$hot_jobs = $hot_jobs->get()->chunk(10);

		// Việc làm trong nước hôm nay
		$startDate = Carbon::now()->subHours(72);
		$endDate = Carbon::now();
		$vip_jobs = Job::select('jobs.*')
			->where('jobs.status', 1)
			// ->whereBetween('jobs.created_at', [$startDate, $endDate])
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
			// ->join('user_account', 'jobs.user_id', '=', 'user_account.user_id')
			// ->where('user_account.account_id',\Modules\Account\app\Models\Account::VIP)
			if($request->name){
				$vip_jobs->where('jobs.name', 'LIKE', '%'.$request->name.'%');
			}
			if($request->province_id){
				$vip_jobs->where('province_id', $request->province_id);
			}
			if( $request->rank_id ){
				$vip_jobs->where('rank_id', $request->rank_id);
			}
			if( $request->degree_id ){
				$vip_jobs->where('degree_id', $request->degree_id);
			}
			if( $request->formwork_id ){
				$vip_jobs->where('formwork_id', $request->formwork_id);
			}
			if( $request->wage_id ){
				$wage_id = $request->wage_id;//'10-15'
				$wage = explode('-', $wage_id);
				if($wage[0] == 0){
					$vip_jobs->where('salaryMin','<=', $wage[1]);
				}
				elseif($wage[1] == 0){
					$vip_jobs->where('salaryMin','>=', $wage[0]);
				}
				else{
					$vip_jobs->whereBetween('salaryMin',[ $wage[0], $wage[1] ]);
				}
			}
			$vip_jobs->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                ELSE 7
            END")
			->orderBy('jobs.id', 'DESC')->limit(10)->get();
			$vip_jobs = $vip_jobs->get()->chunk(10);

		// Top công ty hàng đầu
		$employees = UserEmployee::where('is_top', 1)->limit(12)->get();

		// Thị trường việc làm
		// 3 việc làm mới nhất
		$lasest_jobs = Job::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
		// Việc làm mới nhất trong 24h
		$quantity_job_new_today = date('d') + 300;
		// Việc làm đang tuyển
		$quantity_job_recruitment = date('d') + 200;
		// Công ty đang tuyển
		$quantity_company_recruitment = date('d') + 100;


		// Biểu đồ 
		// Tăng trưởng cơ hội việc làm
		$tang_truong_labels = [];
		$currentDate = new \DateTime();
		$interval = new \DateInterval('P30D');
		$startDate = $currentDate->sub($interval);
		$daysList = [];
		for ($i = 0; $i < 30; $i++) {
			$date = $startDate->format('d/m/Y');
			$daysList[] = $date;
			$startDate->modify('+1 day');
		}
		$tang_truong_labels = [];
		$tang_truong_values = [];
		if (cache()->get('tang_truong_labels') && cache()->get('tang_truong_values')) {
			$tang_truong_labels = cache()->get('tang_truong_labels');
			$tang_truong_values = cache()->get('tang_truong_values');
		} else {
			foreach ($daysList as $day) {
				$tang_truong_labels[] = $day;
				$tang_truong_values[] = date('d', strtotime($day)) * rand(100, 500);
			}
			cache()->put('tang_truong_labels', $tang_truong_labels, 86400);
			cache()->put('tang_truong_labels', $tang_truong_labels, 86400);
		}


		// Nhu cau tuyen dung
		if (cache()->get('nhu_cau_values') && cache()->get('nhu_cau_labels')) {
			$nhu_cau_labels = cache()->get('nhu_cau_labels');
			$nhu_cau_values = cache()->get('nhu_cau_values');
		} else {
			$chart_careers = Career::where('status', 1)->orderBy('position')->limit(5)->pluck('name')->toArray();
			$nhu_cau_labels = $chart_careers;
			$nhu_cau_values = [];
			foreach ($chart_careers as $key => $chart_career) {
				$nhu_cau_values[] = $key * rand(100, 500);
			}
			cache()->put('nhu_cau_values', $nhu_cau_values, 86400);
			cache()->put('nhu_cau_labels', $nhu_cau_labels, 86400);
		}

		$currentRoute = Route::current()->getName();
		// dd($currentRoute);
		$params = [
			'route' => $currentRoute,
			'careers' => $careers,
			'job_categories' => $job_categories,
			'ranks' => $ranks,
			'hot_jobs' => $hot_jobs,
			'vip_jobs' => $vip_jobs,
			'wages' => $newWages,
			'provinces' => $provinces,
			'employees' => $employees,
			'quantity_company_recruitment' => $quantity_company_recruitment,
			'quantity_job_new_today' => $quantity_job_new_today,
			'quantity_job_recruitment' => $quantity_job_recruitment,
			'lasest_jobs' => $lasest_jobs,
			'degrees' => $degrees,
			'formworks' => $formworks,
			'tang_truong_labels' => $tang_truong_labels,
			'tang_truong_values' => $tang_truong_values,
			'nhu_cau_labels' => $nhu_cau_labels,
			'nhu_cau_values' => $nhu_cau_values,
			'job_packages' => $job_packages,
			'countries' => $countries,
			'title' => 'Việc làm trong nước hôm nay'
		];
		return view('website.homes.index', $params);
	}
	public function homejobs(Request $request, $job_type = '')
	{
		$degrees = Level::where('status', Level::ACTIVE)->orderBy('position')->get();
		$formworks = FormWork::where('status', FormWork::ACTIVE)->orderBy('position')->get();
		$job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
		$careers = Career::where('status', 1)->orderBy('position')->get();
		$job_packages = JobPackage::where('status', 1)->get();
		$countries = Country::all();
		$wages = Wage::where('status', 1)->orderBy('position')->get();
		$query = Job::select('jobs.*')->where('jobs.status', 1);

		if($request->name){
            $query->where('jobs.name', 'LIKE', '%'.$request->name.'%');
        }
		if($request->province_id){
			$query->where('province_id', $request->province_id);
		}
		if( $request->wage_id ){
            $wage_id = $request->wage_id;//'10-15'
            $wage = explode('-', $wage_id);
            if($wage[0] == 0){
                $query->where('salaryMin','<=', $wage[1]);
            }
            elseif($wage[1] == 0){
                $query->where('salaryMin','>=', $wage[0]);
            }
            else{
                $query->whereBetween('salaryMin',[ $wage[0], $wage[1] ]);
            }
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
		$newWages = [];
		foreach ($wages as $wage) {
			$newWages[$wage->salaryMin . '-' . $wage->salaryMax] = $wage->name;
		}
		$job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();
		$ranks = Rank::where('status', 1)->orderBy('position')->get();
		$normal_provinces = Province::whereNotIn('name', [1, 50, 32])->orderBy('name')->get();
		$provinces = Province::whereIn('id', [1, 50, 32])
			->orderByRaw("FIELD(id,1,50,32)")
			->get()->concat($normal_provinces);
		switch ($job_type) {
			case 'viec-lam-hom-nay':
				$title = 'Việc làm hôm nay';
				// Việc làm  hôm nay
				$startDate = Carbon::now()->subHours(72);
				$endDate = Carbon::now();
				// $query->whereBetween('jobs.created_at', [$startDate, $endDate]);
				$today_jobs = Job::select('jobs.*')
					->where('jobs.status', 1)
					// ->whereBetween('jobs.created_at', [$startDate, $endDate])
					->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
					// ->join('user_account', 'jobs.user_id', '=', 'user_account.user_id')
					// ->where('user_account.account_id',\Modules\Account\app\Models\Account::VIP)
					if($request->province_id){
						$today_jobs->where('province_id', $request->province_id);
					}
					$today_jobs->orderByRaw("CASE
                WHEN job_packages.slug = 'tin-hot-vip' THEN 1
                WHEN job_packages.slug = 'tin-gap-vip' THEN 2
                WHEN job_packages.slug = 'tin-vip' THEN 3
                WHEN job_packages.slug = 'tin-gap' THEN 4
                WHEN job_packages.slug = 'tin-hot' THEN 5
                WHEN job_packages.slug = 'tin-thuong' THEN 6
                ELSE 7
           		 END")
					->orderBy('jobs.id', 'DESC')
					->limit(12);
					
					$today_jobs=$today_jobs->get()->chunk(9);
					break;
		}

		$view_path = 'website.homes.index';
		if ($job_type) {
			$view_path = 'website.homes.home-sub-index';
		}
		$jobs = $query->paginate(25);
		$currentRoute = Route::current()->getName();
		// dd($currentRoute);
		$params =
			[
				'route' => $currentRoute,
				'jobs' => $jobs,
				'careers' => $careers,
				'job_categories' => $job_categories,
				'ranks' => $ranks,
				'today_jobs' => $today_jobs,
				'wages' => $newWages,
				'provinces' => $provinces,
				'degrees' => $degrees,
				'formworks' => $formworks,
				'job_packages' => $job_packages,
				'countries' => $countries,
				'title' => $title,
				'job_type' => $job_type,
				'special_employee_jobs'=>$this->_special_employee_jobs(),
			];
		return view($view_path, $params);
	}

	public function attractive(Request $request)
	{
		$degrees = Level::where('status', Level::ACTIVE)->orderBy('position')->get();
		$formworks = FormWork::where('status', FormWork::ACTIVE)->orderBy('position')->get();
		$job_categories = Career::where('status', 1)->orderBy('position')->get()->chunk(9);
		$careers = Career::where('status', 1)->orderBy('position')->get();
		$job_packages = JobPackage::where('status', 1)->get();
		$countries = Country::all();
		$wages = Wage::where('status', 1)->orderBy('position')->get();
		$query = Job::select('jobs.*')->where('jobs.status', 1);

		$newWages = [];
		foreach ($wages as $wage) {
			$newWages[$wage->salaryMin . '-' . $wage->salaryMax] = $wage->name;
		}
		$job_packages = JobPackage::whereIn('slug', ['tin-gap', 'tin-hot'])->get();
		$ranks = Rank::where('status', 1)->orderBy('position')->get();
		$normal_provinces = Province::whereNotIn('name', [1, 50, 32])->orderBy('name')->get();
		$provinces = Province::whereIn('id', [1, 50, 32])
			->orderByRaw("FIELD(id,1,50,32)")
			->get()->concat($normal_provinces);
		$title = 'Việc làm hấp dẫn';
		$hot_jobs = $query
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
			->where('jobs.salaryMax', '>=', 10000000)
			->orWhere('jobs.salaryMax','')
			->orderByRaw("CASE
			WHEN job_packages.slug = 'tin-hot-vip' THEN 1
			WHEN job_packages.slug = 'tin-gap-vip' THEN 2
			WHEN job_packages.slug = 'tin-vip' THEN 3
			WHEN job_packages.slug = 'tin-gap' THEN 4
			WHEN job_packages.slug = 'tin-hot' THEN 5
			WHEN job_packages.slug = 'tin-thuong' THEN 6
			ELSE 7
			END")
			->orderBy('jobs.id', 'DESC')->paginate(20);
		$currentRoute = Route::current()->getName();
		$params =
			[
				'route' => $currentRoute,
				'jobs' => $hot_jobs,
				'title' => $title,
				'query' => $query,
				'careers' => $careers,
				'job_categories' => $job_categories,
				'ranks' => $ranks,
				'wages' => $newWages,
				'provinces' => $provinces,
				'degrees' => $degrees,
				'formworks' => $formworks,
				'job_packages' => $job_packages,
				'countries' => $countries,
				'special_employee_jobs'=>$this->_special_employee_jobs(),


			];
		return view('website.homes.home-sub-index', $params);
	}
	private function _special_employee_jobs(){
        $employee_id = 373180;
        $employee = UserEmployee::where('user_id',$employee_id)->first();
        $jobs = Job::where('user_id',$employee_id)
        ->where('status',1)
        ->limit(10)->get();
        return [
            'employee' => $employee,
            'jobs' => $jobs,
        ];
    }
}