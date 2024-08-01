<?php

namespace Modules\AdminHome\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Setting;

use Illuminate\Support\Facades\DB;
use Modules\AdminUser\app\Models\AdminUser;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Transaction\app\Models\Transaction;

class AdminHomeController extends Controller
{
    protected $model = AdminUser::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_access = Setting::where('key', 'user_access')->first();
        $countRegisterToday = $this->model::countRegisterToday();
        $countStaffAndEmployee = $this->model::countStaffAndEmployee();
        $userCountAccess = $this->model::getCountAccess();
        $objectCountJob = Job::select(DB::raw('sum(views) as sum_views'), DB::raw('count(*) as count_job'))->first();
        $countJobApply = UserJobApply::count();
        $userCountAccessLastMonth = $this->model::getAccessLastMonth();
        $ratioHoldEmployee = (float) number_format($userCountAccessLastMonth->count_employee / $countStaffAndEmployee->count_employee * 100, 3);
        $ratioHoldStaff = (float) number_format($userCountAccessLastMonth->count_staff / $countStaffAndEmployee->count_staff * 100, 3);
        $ratioJobApply = $countJobApply / $objectCountJob->count_job * 100;
        $now = new DateTime();

        $now->modify('first day of this month');

        $firstDayOfMonth = $now->format('Y-m-d');
        $total_users = AdminUser::count();
        $guest_count = Setting::where('key', 'user_access')->sum('value');
        $total_access = $userCountAccess->count_employee + $userCountAccess->count_staff + (int) $guest_count;
        $retention_rate_access_source_website = (float) number_format(($total_access / $total_users) * 100, 3);       
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
            'retention_rate_access_source_website' => $retention_rate_access_source_website,
            'total_access' => $total_access,
        ];
        return view('adminhome::index', $param);
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
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $dataChart = $request->dataChart;
        switch ($dataChart) {
            case 'tai-khoan-NTD-truy-cap-website':
                $query = new AdminUser();
                $query = $query->select(
                    [
                        DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                $query = $query->whereNotNull('last_login');
                break;
            case 'tai-khoan-UV-truy-cap-website':
                $query = new AdminUser();
                $query = $query->select(
                    [
                        DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                $query = $query->whereNotNull('last_login');
                break;
            case 'NTD-truy-cap-website':
                $query = new AdminUser();
                $query = $query->select(
                    [
                        DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                $query = $query->whereNotNull('last_login');
                break;
            case 'UV-truy-cap-website':
                $query = new AdminUser();
                $query = $query->select(
                    [
                        DB::raw('COUNT(CASE WHEN type = "user" THEN 1 ELSE NULL END) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                $query = $query->whereNotNull('last_login');
                break;


            case 'tin-dang-tuyen-dung':
                $query = new Job();
                $query = $query->select(
                    [
                        DB::raw('COUNT(*) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                break;

                case 'so-lan-xem-tin-tuyen-dung':
                    $query = Job::select(
                        [
                            DB::raw('SUM(views) AS total_amount'),
                            DB::raw('DATE(created_at) AS date'),
                        ]
                    )->groupBy(DB::raw('DATE(created_at)'));
                    break;
                

            case 'tin-co-luot-nop-ho-so':
                $query = new UserJobApply();
                $query = $query->select(
                    [
                        DB::raw('COUNT(DISTINCT job_id) AS total_amount'),
                        DB::raw('date(created_at) as date'),
                    ]
                );
                break;


            // case 'ti-le-giu-chan-tai-khoan-NTD':
            //     $query = new AdminUser();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(CASE WHEN type = "employee" AND last_login IS NOT NULL THEN 1 ELSE NULL END) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


            // case 'ti-le-giu-chan-tai-khoan-UV':
            //     $query = new AdminUser();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(CASE WHEN type = "staff" AND last_login IS NOT NULL THEN 1 ELSE NULL END) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


            // case 'ti-le-roi-bo-NTD':
            //     $query = new AdminUser();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(CASE WHEN type = "employee" AND last_login IS NULL THEN 1 ELSE NULL END) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


            // case 'ti-le-roi-bo-UV':
            //     $query = new AdminUser();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(CASE WHEN type = "staff" AND last_login IS NULL THEN 1 ELSE NULL END) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


            // case 'ti-le-tin-co-ho-so-ung-tuyen':
            //     $query = new UserJobApply();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(CASE WHEN status = "applied" THEN 1 ELSE NULL END) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


            // case 'ti-le-nguon-truy-cap-website':
            //     $query = new Setting();
            //     $query = $query->select(
            //         [
            //             DB::raw('COUNT(*) AS total_amount'),
            //             DB::raw('date(created_at) as date'),
            //         ]
            //     );
            //     break;


                case 'so-luong-khach-truy-cap-website':
                    $settings = 
                    Setting::select(
                        [
                            DB::raw('value AS total_amount'),
                            DB::raw('date(created_at) as date'),
                        ]
                    )->where('key', 'user_access')->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->groupBy('date')
                    ->get();
                    $query = new AdminUser();
                    $query = $query->select(
                        [
                            DB::raw('COUNT(*) AS total_amount'),
                            DB::raw('date(created_at) as date'),
                        ]
                    );
                    $transactions = $query->whereIn('type', ['employee', 'staff']) // Chọn các loại là employee và staff
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->groupBy('date')
                        ->get();
                    $labels = [];
                    $total_amounts = [];
                    $currentDate = new DateTime($startDate);
                    $endDate = new DateTime($endDate);
                    while ($currentDate <= $endDate) {
                        $dateStr = $currentDate->format('Y-m-d');
                        $labels[] = $dateStr;
                        $totalUserLogin = $transactions->where('date', $currentDate->format('Y-m-d'))->sum('total_amount');
                        $total_guest = $settings->where('date', $currentDate->format('Y-m-d'))->sum('total_amount');
                        $total_amounts[] = (int)$totalUserLogin + (int)  $total_guest;
                        $currentDate->modify('+1 day');
                    }
        
                    $response = [
                        'labels' => $labels,
                        'total_amounts' => $total_amounts,
                    ];
        
                    return response()->json($response);
                    case 'NTD-dang-ky-moi-hom-nay':
                        $query = AdminUser::select(
                            [
                                DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS total_amount'),
                                DB::raw('date(created_at) as date'),
                            ]
                        )
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->groupBy('date');
                        break;
                    
                    case 'UV-dang-ky-moi-hom-nay':
                        $query = AdminUser::select(
                            [
                                DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS total_amount'),
                                DB::raw('date(created_at) as date'),
                            ]
                        )
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->groupBy('date');
                        break;
                    


                case 'tong-so-NTD':
                    $users = AdminUser::select(
                        [
                            DB::raw('COUNT(*) AS daily_total'), 
                            DB::raw('date(created_at) as date'),
                        ]
                    )
                        ->where('type', 'employee')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->groupBy('date')
                        ->get();
                
                    $labels = [];
                    $total_amounts = [];
                
                    $startDate = new DateTime($startDate);
                    $endDate = new DateTime($endDate);
                
                    while ($startDate <= $endDate) {
                        $labels[] = $startDate->format('Y-m-d');
                        $daily_total = $users->where('date', $startDate->format('Y-m-d'))->sum('daily_total');
                        $total_amounts[] = $daily_total; // Chỉ lưu số lượng hàng ngày
                        $startDate->modify('+1 day');
                    }
                
                    $response = [
                        'labels' => $labels,
                        'total_amounts' => $total_amounts,
                    ];
                
                    return response()->json($response);
                
                case 'tong-so-UV':
                    $users = AdminUser::select(
                        [
                            DB::raw('COUNT(*) AS daily_total'), 
                            DB::raw('date(created_at) as date'),
                        ]
                    )
                        ->where('type', 'staff')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->groupBy('date')
                        ->get();
                
                    $labels = [];
                    $total_amounts = [];
                
                    $startDate = new DateTime($startDate);
                    $endDate = new DateTime($endDate);
                
                    while ($startDate <= $endDate) {
                        $labels[] = $startDate->format('Y-m-d');
                        $daily_total = $users->where('date', $startDate->format('Y-m-d'))->sum('daily_total');
                        $total_amounts[] = $daily_total; // Chỉ lưu số lượng hàng ngày
                        $startDate->modify('+1 day');
                    }
                
                    $response = [
                        'labels' => $labels,
                        'total_amounts' => $total_amounts,
                    ];
                
                    return response()->json($response);
                



            default:
                $labels = [];
                $total_amounts = [];
                $transactions = Transaction::select(
                    DB::raw('date(created_at) as date'),
                    DB::raw('sum(amount) as total_amount')
                )->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->groupBy('date')
                    ->get();


                break;
        }

        $transactions = $query->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->groupBy('date')
            ->get();


        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);

        while ($startDate <= $endDate) {
            $labels[] = $startDate->format('Y-m-d');
            $total_amounts[] = $transactions->where('date', $startDate->format('Y-m-d'))->sum('total_amount');
            $startDate->modify('+1 day');
        }

        $response = [
            'labels' => $labels,
            'total_amounts' => $total_amounts,
        ];


        return response()->json($response);
    }

    public function autoloadAjax()
    {
        $user_access = Setting::where('key', 'user_access')->first();
        $countRegisterToday = $this->model::countRegisterToday();
        $countStaffAndEmployee = $this->model::countStaffAndEmployee();
        $userCountAccess = $this->model::getCountAccess();
        $objectCountJob = Job::select(DB::raw('sum(views) as sum_views'), DB::raw('count(*) as count_job'))->first();
        $countJobApply = UserJobApply::count();
        $userCountAccessLastMonth = $this->model::getAccessLastMonth();
        $ratioHoldEmployee = (float) number_format($userCountAccessLastMonth->count_employee / $countStaffAndEmployee->count_employee * 100, 3);
        $ratioHoldStaff = (float) number_format($userCountAccessLastMonth->count_staff / $countStaffAndEmployee->count_staff * 100, 3);
        $ratioJobApply = $countJobApply / $objectCountJob->count_job * 100;
        $now = new DateTime();

        $now->modify('first day of this month');

        $firstDayOfMonth = $now->format('Y-m-d');

        $total_users = AdminUser::count();
        $guest_count = Setting::where('key', 'user_access')->sum('value');
        $total_access = $userCountAccess->count_employee + $userCountAccess->count_staff + (int) $guest_count;
        $retention_rate_access_source_website = (float) number_format(($total_access / $total_users) * 100, 3);
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
            'retention_rate_access_source_website' => $retention_rate_access_source_website,
            'total_access' => $total_access,
        ];
        return response()->json($param);
    }
}