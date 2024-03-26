<?php

namespace Modules\AdminHome\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Models\User;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        //employee
            $total_employeer_create_today = User::where('type','employee')->whereDate('created_at',$today)->count();
            $total_employeer = User::where('type','employee')->count();
            // Số lượng tài khoản NTD tồn tại trong website
            $total_employee_in_website = 0;
            //số lượt NTD truy cập website
            $total_employee_access_website = 0;
            //số lượng tin đăng tuyển dụng
            $total_jobs = 0;

        //staff
            $total_staff = User::where('type','staff')->count();
            // Số lượng tài khoản UV tồn tại trong website
            $total_staff_in_website = 0;
            //Số lượt tài khoản UV truy cập website
            $total_staff_access_website = 0;
            $total_staff_create_today = User::where('type','staff')->whereDate('created_at',$today)->count();
            
        //query tổng:
            //Số lần xem bài tin tuyển dụng
            $total_view_jobs = 0;
            // số lượng tin tuyển dụng có lượt nộp hồ sơ
            $total_job_has_aplicaton = 0;
            //Tỉ lệ giữ chân tài khoản NTD 
            $retention_rate_employee = 0;
            //Tỉ lệ giữ chân tài khoản UV
            $retention_rate_staff = 0;
            //Tỉ lệ rời bỏ của NTD
            $churn_rate_employee = 0;
            //Tỉ lệ rời bỏ của UV
            $churn_rate_staff = 0;
            //Tỉ lệ Tin tuyển dụng có hồ sơ ứng tuyển
            $retention_rate_jobs_has_cv_aplication = 0;
            //Tir lệ Nguồn truy cập website
            $retention_rate_access_source_website = 0;
        $param = [
            'total_employeer_create_today' => $total_employeer_create_today,
            'total_employeer' => $total_employeer,
            'total_staff' => $total_staff,
            'total_staff_create_today' => $total_staff_create_today,
            'total_employee_in_website' => $total_employee_in_website,
            'total_employee_access_website' => $total_employee_access_website,
            'total_jobs' => $total_jobs,
            'total_staff_in_website' => $total_staff_in_website,
            'total_staff_access_website' => $total_staff_access_website,
            'total_view_jobs' => $total_view_jobs,
            'total_job_has_aplicaton' => $total_job_has_aplicaton,
            'retention_rate_employee' => $retention_rate_employee,
            'retention_rate_staff' => $retention_rate_staff,
            'churn_rate_employee' => $churn_rate_employee,
            'churn_rate_staff' => $churn_rate_staff,
            'retention_rate_jobs_has_cv_aplication' => $retention_rate_jobs_has_cv_aplication,
            'retention_rate_access_source_website' => $retention_rate_access_source_website
        ];
        return view('adminhome::index',$param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminhome::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('adminhome::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminhome::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}



