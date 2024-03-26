<?php

namespace Modules\Employee\app\Http\Controllers;
use Modules\Employee\app\Models\User;
use Modules\Employee\app\Models\UserEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Models\Job;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userEmployees = UserEmployee::whereHas('user', function ($query) {
            $query->where('status', UserEmployee::ACTIVE);
        })->paginate(2);
        $user = new User();
        $image = $user->getImage($userEmployees[0]->user_id);
        $params = [
            'userEmployees' => $userEmployees,
            'image' => $image,
        ];
        return view('employee::employers.index',$params);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $userEmployee = UserEmployee::where('slug',$slug)->firstOrFail();
            $jobs = Job::where('user_id',$userEmployee->user_id)->paginate(5);
            $count_jobs = Job::where('user_id',$userEmployee->user_id)->count();
            $user = new User();
            $image = $user->getImage($userEmployee->user_id);
            $params = [
                'count_jobs' => $count_jobs,
                'userEmployee' => $userEmployee,
                'jobs' => $jobs,
                'image' => $image
            ];
            return view('employee::employers.show', $params);
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route( 'home' )->with('error', __('sys.item_not_found'));
        }
    }
}
