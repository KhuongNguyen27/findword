<?php

namespace Modules\Job\app\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Modules\Staff\app\Models\UserStaff;
use Modules\Staff\app\Models\UserCv;
use Modules\Job\app\Models\Job;
use Modules\Employee\app\Models\UserEmployee;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Career;
use Modules\Employee\app\Models\CareerJob;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $model = Job::class;
    protected $link_view = "job::jobs.";


    public function index(Request $request)
    {
        $query = $this->model::query();
        if ($request->pagination) {
            $paginate = $request->pagination;
        } else {
            $paginate = 3;
        }

        if($request->name){
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if($request->address_work){
            $query->where('work_address', 'LIKE', '%' . $request->address_work . '%');
        }
        if ($request->has('country')) {
            $query->where('country', 'LIKE', '%VietNam%');
        } else {
            $query->where('country', 'NOT LIKE', '%VietNam%')
                    ->orWhereNull('country');
        }
        if ($request->career_search) {
            $query->whereHas('careers', function ($query) use ($request) {
                foreach ($request->career_search as $index => $career) {
                    if ($index === 0) {
                        $query->where('career_id', $career);
                    } else {
                        $query->orWhere('career_id', $career);
                    }
                }
            });
        }
        
        $items = $query->where('status', 1)->orderBy('id', 'desc')->distinct()->get();
        
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $paginate;
        $offset = ($currentPage - 1) * $perPage;

        $paginatedItems = new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $careers = Career::all();
        $param = [
            'items' => $paginatedItems,
            'request' => $request,
            'careers'=> $careers
        ];
        return view($this->link_view . 'index', $param);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $user_id = Auth::id();
        // $job = Job::find($id);
        $job = Job::where('slug', $slug)->with('userEmployee')->firstOrFail();
        // $related_jobs = Job::where('')
        // $related_jobs = $job->careers()->where('career_id')->get();
        // dd($related_jobs);
        $params = [
            'job' => $job,
            'user_id' => $user_id,
        ];
        // dd($params);
        return view('job::jobs.show',$params);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function aplication($slug)
    {
        if (auth()->check()) {
            $job = Job::where('slug', $slug)->first();
            $userCvs = UserCv::where('user_id', auth()->user()->id)->get();
            $user_employee = UserEmployee::find($job->user_id);
            $params = [
                'userCvs' => $userCvs,
                'user_employee' => $user_employee,
                'job' =>$job
            ];
            return view('job::aplications.index', $params);
        } else {
            // Lưu URL trang hiện tại vào session trước khi chuyển hướng đến trang đăng nhập
            session(['previous_url' => url()->previous()]);
            // Người dùng chưa đăng nhập, thực hiện các hành động khác, ví dụ: chuyển hướng đến trang đăng nhập
            return redirect()->route('staff.login')->with('error', 'Bạn phải đăng nhập để ứng tuyển!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}