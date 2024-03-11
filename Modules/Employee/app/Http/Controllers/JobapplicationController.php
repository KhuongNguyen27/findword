<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Employee\app\Models\Job;
use Modules\Staff\app\Models\UserCv;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Http\Requests\CvapplyRequest;
use Modules\Staff\app\Models\UserExperience;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Models\UserSkill;

use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;

class JobapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserJobApply::where('user_id', auth()->user()->id);

        if($request->name){
            $query->whereHas('cv',function($query) use($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }
        if($request->status != ''){
            $query->where('status', $request->status);
        }
        
        $cv_aplly = $query->paginate(5);

        $cv_apllys_count = $query->count();
        $count_cv_appled = $query->where('status', 1)->count();
        $count_not_apply = UserJobApply::where('user_id', auth()->user()->id)->where('status', 0)->count();
        $param_count = [
            'cv_apllys_count' => $cv_apllys_count,
            'count_cv_appled' => $count_cv_appled,
            'count_not_applly' => $count_not_apply
        ];
        return view('employee::cv-apply.index',compact('cv_apllys','param_count'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CvapplyRequest $request)
    {
        try {
            $job = Job::find($request->job_id);
            $cv_apply = new UserJobApply();
            
            $cv_apply->cv_id = $request->cv_id;
            $cv_apply->user_id = $job->user_id;
            $cv_apply->job_id  = $job->id;
            $cv_apply->status = UserJobApply::INACTIVE;
            
            $cv_apply->save();
            dd($cv_apply);
            $message = "Nộp hồ sơ thành công!";
            $cv_infor['name_applied'] = $cv_apply->user->name;
            $cv_infor['email_applied'] = $cv_apply->user->email;
            $cv_infor['job'] = $cv_apply->job->name;
            $cv_infor['name'] = $cv_apply->job->user->name;
            $cv_infor['email'] = $cv_apply->job->user->email;
            Notification::route('mail', [
                $cv_infor['email'] => $cv_infor['name']
            ])->notify(new Notifications("applied-job",$cv_infor));
            return redirect()->route('website.jobs.show',$job->slug)->with('success', $message);
        } catch (\Exception $e) {
            // DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            $job = Job::find($request->job_id);
            Log::error('Lỗi xảy ra: ' . $e->getMessage());
            return redirect()->route('website.jobs.show',$job->slug)->with('error', 'Nộp hồ sơ thất bại!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            
            $cv_job_apply = UserJobApply::findOrFail($id);
            if (auth()->user()->id == $cv_job_apply->user_id)
                {
                    $item = UserCv::findOrFail($cv_job_apply->cv->id);
                    $educations = UserEducation::where('cv_id', $cv_job_apply->cv->id)->get();
                    $userExperiences = UserExperience::where('cv_id',$cv_job_apply->cv->id)->get();
                    $userSkills = UserSkill::where('cv_id',$cv_job_apply->cv->id)->get();
                    // dd($educations);
                    
                    $params = [
                        'item' => $item,
                        'educations' => $educations,
                        'userExperiences' => $userExperiences,
                        'userSkills' => $userSkills,
                        'cv_job_apply' => $cv_job_apply
                    ];
        
                    return view('employee::cv-apply.show',$params);
                }else{
                    return redirect()->route( 'employee.cv.index' )->with('error', 'bạn không có quyền truy cập link này!');
                }
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route( 'employee.cv.index' )->with('error', __('sys.item_not_found'));
        }
    
        
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $cv_apply = UserJobApply::findOrFail($request->id);
           
            $cv_apply->status = $request->status;

            $cv_apply->save();

            $message = "Cập Nhật thành công!";
            if ($cv_apply->status == "1") {
                $cv_infor['name'] = $cv_apply->user->name;
                $cv_infor['email'] = $cv_apply->user->email;
                $cv_infor['job'] = $cv_apply->job->name;
                Notification::route('mail', [
                    $cv_infor['email'] => $cv_infor['name']
                ])->notify(new Notifications("updated-job",$cv_infor));
            }
            return redirect()->route('employee.cv.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            Log::error('Lỗi xảy ra: ' . $e->getMessage());
            return redirect()->route('employee.cv.show')->with('error', 'Cập Nhật bị lỗi!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $cv = UserJobApply::find($request->id);
            $cv->forceDelete();
            $message = "Xóa thành công!";
            return redirect()->route('employee.cv.index')->with('success', $message);
        } catch (QueryException $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->route('employee.cv.index')->with('error', 'Xóa thất bại!');
        }
    }
}