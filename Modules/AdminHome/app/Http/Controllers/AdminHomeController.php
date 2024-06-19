<?php

namespace Modules\AdminHome\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\AdminUser\app\Models\AdminUser;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Transaction\app\Models\Transaction;

class AdminHomeController extends Controller
{
    protected $model        = AdminUser::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countRegisterToday = $this->model::countRegisterToday();
        $countStaffAndEmployee = $this->model::countStaffAndEmployee();
        $userCountAccess = $this->model::getCountAccess();
        $objectCountJob  = Job::select(DB::raw('sum(views) as sum_views'),DB::raw('count(*) as count_job'))->first();
        $countJobApply   = UserJobApply::count();
        $userCountAccessLastMonth = $this->model::getAccessLastMonth();
        $ratioHoldEmployee = (float) number_format($userCountAccessLastMonth->count_employee / $countStaffAndEmployee->count_employee *100,3);
        $ratioHoldStaff = (float) number_format($userCountAccessLastMonth->count_staff / $countStaffAndEmployee->count_staff *100, 3);
        $ratioJobApply = $countJobApply / $objectCountJob->count_job * 100;
        $now = new DateTime();

        $now->modify('first day of this month');

        $firstDayOfMonth = $now->format('Y-m-d');
        $retention_rate_access_source_website = 0;
        $param = [
            'countRegisterToday' => $countRegisterToday,
            'countStaffAndEmployee' => $countStaffAndEmployee,
            'userCountAccess' => $userCountAccess,
            'countJobApply' => $countJobApply,
            'ratioHoldStaff' => $ratioHoldStaff,
            'ratioHoldEmployee' => $ratioHoldEmployee,
            'objectCountJob' => $objectCountJob,
            'ratioJobApply' => $ratioJobApply,
            'firstDayOfMonth' => $firstDayOfMonth,
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

    public function chartAjax(Request $request)
    {
        $startDate     = $request->startDate;
        $endDate       = $request->endDate;
        $labels        = [];
        $total_amounts = [];
        $transactions  = new Transaction();
        $transactions  = $transactions->select(
            DB::raw('date(created_at) as date'),
            DB::raw('sum(amount) as total_amount'),
        )->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate);
        $transactions = $transactions->groupBy('date');
        $transactions = $transactions->get();
        $startDate              = new DateTime($startDate);
        $endDate                = new DateTime($endDate);
        while ($startDate <= $endDate) {
            $labels[]           = $startDate->format('Y-m-d');
            $total_amounts[] = $transactions->where('date',  $startDate->format('Y-m-d'))->sum('total_amount');
            $startDate->modify('+1 day');
        }
        $response              = [
            'labels' => $labels,
            'total_amounts' => $total_amounts,
        ];

        return response()->json($response);
    }
}



