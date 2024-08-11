<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Job;
use App\Models\Setting;
use App\Models\UserEmployee;
use App\Services\JobService;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{

		// Kiểm tra và cập nhật session truy cập
		$this->updateAccessTime($request);

		// query: job
		$query_vip_jobs = Job::select('jobs.*')
			->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
		$query_vip_jobs =  JobService::searchHome($query_vip_jobs, $request);

		$data_vip_jobs = JobService::switchCase($query_vip_jobs, 'viec-lam-hom-nay');
		$vip_jobs = $data_vip_jobs['query'];
		$vip_jobs = $vip_jobs->limit(30)->get()->chunk(15);

		// query: job
		$query_hot = Job::select('jobs.*')
			->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
		$query_hot =  JobService::searchHome($query_hot, $request);
		// viec lam hot
		$data_hot = JobService::switchCase($query_hot, 'hot');
		$hot = $data_hot['query'];
		$hot = $hot->limit(30)->get()->chunk(15);

		$query_tuyen_gap = Job::select('jobs.*')
			->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
		$query_tuyen_gap =  JobService::searchHome($query_tuyen_gap, $request);
		// viec lam tuyen gap
		$tuyen_gap = JobService::switchCase($query_tuyen_gap, 'urgent');
		$tuyen_gap = $tuyen_gap['query'];
		$tuyen_gap = $tuyen_gap->limit(30)->get()->chunk(15);

		// query: job
		$hot_jobs = Job::select('jobs.*')
			->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
		$hot_jobs =  JobService::searchHome($hot_jobs, $request);

		// Việc làm hấp dẫn
		$hot_jobs = $hot_jobs->where(function ($query) {
			$query->where('jobs.salaryMax', '>=', 8000000)
				->orWhere('jobs.salaryMax', '');
		})
			->orderBy('jobs.approved_at', 'DESC')
			->orderBy('jobs.id', 'DESC')->limit(20);
		$hot_jobs = $hot_jobs->get()->chunk(10);
		// viec lam hom nay





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



		$params = [
			'route' => $currentRoute,
			'hot' => $hot,
			'tuyen_gap' => $tuyen_gap,
			'vip_jobs' => $vip_jobs,
			'hot_jobs' => $hot_jobs,
			'vip_jobs' => $vip_jobs,
			'employees' => $employees,
			'quantity_company_recruitment' => $quantity_company_recruitment,
			'quantity_job_new_today' => $quantity_job_new_today,
			'quantity_job_recruitment' => $quantity_job_recruitment,
			'lasest_jobs' => $lasest_jobs,
			'tang_truong_labels' => $tang_truong_labels,
			'tang_truong_values' => $tang_truong_values,
			'nhu_cau_labels' => $nhu_cau_labels,
			'nhu_cau_values' => $nhu_cau_values,
			'title' => 'Việc làm trong nước hôm nay',

		];
		return view('website.homes.index', $params);
	}


	public function homejobs(Request $request, $job_type = '')
	{
		$query = Job::select('jobs.*')->where('jobs.status', 1);
		$query->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id');
		$query->join('job_province', 'jobs.id', '=', 'job_province.job_id');
		$query = JobService::searchHome($query, $request);
		$data = JobService::switchCase($query, $job_type);
		$query = $data['query'];
		$title = $data['title'];

		$view_path = 'website.homes.index';
		if ($job_type) {
			$view_path = 'website.homes.home-sub-index';
		}
		$jobs = $query->paginate(50);
		$currentRoute = Route::current()->getName();
		// dd($currentRoute);
		$params =
			[
				'route' => $currentRoute,
				'jobs' => $jobs,
				'title' => $title,
				'job_type' => $job_type,
				'special_employee_jobs' => $this->_special_employee_jobs(),
			];
		return view($view_path, $params);
	}



	public function attractive(Request $request)
	{
		$title = 'Việc làm hấp dẫn';
		$query = Job::select('jobs.*')
			->where('jobs.status', 1)
			->join('job_packages', 'jobs.jobpackage_id', '=', 'job_packages.id')
			->where(function ($q) {
				$q->where('jobs.salaryMax', '>=', 8000000)
					->orWhere('jobs.salaryMax', '');
			});

		$query = JobService::searchHome($query, $request);
		$hot_jobs = $query->orderBy('jobs.approved_at', 'DESC')  // Sắp xếp theo thời gian duyệt tin
			->orderBy('jobs.id', 'DESC')  // Sắp xếp theo ID công việc
			->paginate(50);  // Phân trang với 25 công việc mỗi trang

		$currentRoute = Route::current()->getName();
		$params =
			[
				'route' => $currentRoute,
				'jobs' => $hot_jobs,
				'title' => $title,
				'query' => $query,
				'special_employee_jobs' => $this->_special_employee_jobs(),


			];
		return view('website.homes.home-sub-index', $params);
	}
	private function _special_employee_jobs()
	{
		$employee_id = 373180;
		$employee = UserEmployee::where('user_id', $employee_id)->first();
		$jobs = Job::where('user_id', $employee_id)
			->where('status', 1)
			->limit(10)->get();
		return [
			'employee' => $employee,
			'jobs' => $jobs,
		];
	}

	private function updateAccessTime(Request $request)
	{
		$access_time = $request->session()->get('access_time');
		if (!$access_time) {
			$request->session()->put(['access_time' => time()]);
			$request->session()->save();
			$settings = Setting::where('key', 'user_access')->whereDate('created_at', date('Y-m-d'))->first();
			if (!$settings) {
				$settings = new Setting();
				$settings->key = 'user_access';
				$settings->value = 1;
				$settings->save();
			} else {
				$settings->value = $settings->value + 1;
				$settings->save();
			}
		}
	}
}
