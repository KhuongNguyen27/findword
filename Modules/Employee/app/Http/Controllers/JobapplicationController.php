<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailEmployeeCV;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Employee\app\Models\EmployeeCv;
use Modules\Employee\app\Models\UserJobApply;
use Modules\Employee\app\Models\Job;
use Modules\Staff\app\Models\UserCv;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Http\Requests\CvapplyRequest;
use Modules\Staff\app\Models\UserExperience;
use Modules\Staff\app\Models\UserEducation;
use Modules\Staff\app\Models\UserSkill;
use Modules\Staff\app\Models\UserStaff;
use Illuminate\Support\Facades\Mail;

use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobapplicationController extends Controller
{
    protected $model = UserJobApply::class;
    public function index(Request $request)
    {
        $query = UserJobApply::with('job')->whereHas('job', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });
        
        if ($request->name) {
            $query->whereHas('cv', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }
        if ($request->status != '') {
            $query->where('status', $request->status);
        }
        $cv_apllys = $query->paginate(5);
        $cv_apllys_count = $query->count();
        $count_cv_appled = $query->where('status', 1)->count();
        $count_not_apply = UserJobApply::where('user_id', auth()->user()->id)->where('status', 0)->count();
        $param_count = [
            'cv_apllys_count' => $cv_apllys_count,
            'count_cv_appled' => $count_cv_appled,
            'count_not_applly' => $count_not_apply
        ];
        return view('employee::cv-apply.index', compact('cv_apllys', 'param_count'));
    }
    public function store(CvapplyRequest $request)
    {
        try {
            $job = Job::find($request->job_id);
            $cv_apply = new UserJobApply();

            $cv_apply->cv_id = $request->cv_id;
            $cv_apply->user_id = Auth::id();
            $cv_apply->job_id  = $job->id;
            $cv_apply->status = UserJobApply::INACTIVE;

            $cv_apply->save();
            $message = "Nộp hồ sơ thành công!";
            $cv_infor['name_applied'] = $cv_apply->user->name;
            $cv_infor['email_applied'] = $cv_apply->user->email;
            $cv_infor['job'] = $cv_apply->job->name;
            $cv_infor['name'] = $cv_apply->job->user->name;
            $cv_infor['email'] = $cv_apply->job->user->email;
            Notification::route('mail', [
                $cv_infor['email'] => $cv_infor['name']
            ])->notify(new Notifications("applied-job", $cv_infor));
            return redirect()->route('website.jobs.show', $job->slug)->with('success', $message);
        } catch (\Exception $e) {
            // DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            $job = Job::find($request->job_id);
            Log::error('Lỗi xảy ra: ' . $e->getMessage());
            return redirect()->route('website.jobs.show', $job->slug)->with('error', 'Nộp hồ sơ thất bại!');
        }
    }
   


//     public function show($id)
// {
//     try {
//         $cv_job_apply = UserJobApply::find($id);
        
//         if ($cv_job_apply) {
//             // Trường hợp CV đã được apply
//             if (auth()->user()->id == $cv_job_apply->job->user_id) {
//                 if ($cv_job_apply->is_read == $this->model::INACTIVE) {
//                     $cv_infor['name'] = $cv_job_apply->user->name;
//                     $cv_infor['email'] = $cv_job_apply->user->email;
//                     $cv_infor['job'] = $cv_job_apply->job->name;
//                     Notification::route('mail', [
//                         $cv_infor['email'] => $cv_infor['name']
//                     ])->notify(new Notifications("read-cv", $cv_infor));
//                     $cv_job_apply->is_read = $this->model::ACTIVE;
//                     $cv_job_apply->save();
//                 }
//                 $item = UserCv::findOrFail($cv_job_apply->cv->id);
//                 $userStaff = UserStaff::where('user_id', $item->user_id)->first();
//                 $educations = UserEducation::where('cv_id', $cv_job_apply->cv->id)->get();
//                 $userExperiences = UserExperience::where('cv_id', $cv_job_apply->cv->id)->get();
//                 $userSkills = UserSkill::where('cv_id', $cv_job_apply->cv->id)->get();
//                 if($item->file_path && file_exists($item->file_path)){
//                     header("Content-type:application/pdf");
//                     echo file_get_contents( asset($item->file_path) );
//                     die();
//                 }

//                 $params = [
//                     'item' => $item,
//                     'educations' => $educations,
//                     'userExperiences' => $userExperiences,
//                     'userSkills' => $userSkills,
//                     'cv_job_apply' => $cv_job_apply,
//                     'userStaff' => $userStaff
//                 ];
//                 return view('employee::cv-apply.show', $params);
//             } else {
//                 return redirect()->route('employee.cv.index')->with('error', 'bạn không có quyền truy cập link này!');
//             }
//         } else {
//             // Trường hợp CV chưa được apply
//             $item = UserCv::findOrFail($id);
//             $userStaff = UserStaff::where('user_id', $item->user_id)->first();
//             $educations = UserEducation::where('cv_id', $item->id)->get();
//             $userExperiences = UserExperience::where('cv_id', $item->id)->get();
//             $userSkills = UserSkill::where('cv_id', $item->id)->get();
//             if($item->file_path && file_exists($item->file_path)){
//                 header("Content-type:application/pdf");
//                 echo file_get_contents( asset($item->file_path) );
//                 die();
//             }

//             $params = [
//                 'item' => $item,
//                 'educations' => $educations,
//                 'userExperiences' => $userExperiences,
//                 'userSkills' => $userSkills,
//                 'cv_job_apply' => null,
//                 'userStaff' => $userStaff
//             ];
//             return view('employee::cv-apply.show', $params);
//         }
//     } catch (ModelNotFoundException $e) {
//         Log::error('Item not found: ' . $e->getMessage());
//         return redirect()->route('employee.cv.index')->with('error', __('sys.item_not_found'));
//     }
// }


    public function show($id)
    {
        // dd(123);
        try {
            $cv_job_apply = UserJobApply::findOrFail($id);
            if (auth()->user()->id == $cv_job_apply->job->user_id) {
                if ($cv_job_apply->is_read == $this->model::INACTIVE) {
                    $cv_infor['name'] = $cv_job_apply->user->name;
                    $cv_infor['email'] = $cv_job_apply->user->email;
                    $cv_infor['job'] = $cv_job_apply->job->name;
                    Notification::route('mail', [
                        $cv_infor['email'] => $cv_infor['name']
                    ])->notify(new Notifications("read-cv", $cv_infor));
                    $cv_job_apply->is_read = $this->model::ACTIVE;
                    $cv_job_apply->save();
                }
                $item = UserCv::findOrFail($cv_job_apply->cv->id);
                $userStaff = UserStaff::where('user_id', $item->user_id)->first();
                $educations = UserEducation::where('cv_id', $cv_job_apply->cv->id)->get();
                $userExperiences = UserExperience::where('cv_id', $cv_job_apply->cv->id)->get();
                $userSkills = UserSkill::where('cv_id', $cv_job_apply->cv->id)->get();
                if($item->file_path && file_exists($item->file_path)){
                    header("Content-type:application/pdf");
                    echo file_get_contents( asset($item->file_path) );
                    die();
                }

                $params = [
                    'item' => $item,
                    'educations' => $educations,
                    'userExperiences' => $userExperiences,
                    'userSkills' => $userSkills,
                    'cv_job_apply' => $cv_job_apply,
                    'userStaff' => $userStaff
                ];
            // dd($params);
                return view('employee::cv-apply.show', $params);
            } else {
                return redirect()->route('employee.cv.index')->with('error', 'bạn không có quyền truy cập link này!');
            }
        } catch (ModelNotFoundException $e) {
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route('employee.cv.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function showCv($id)
    {
        try {
            $cv = UserCv::findOrFail($id);
            $employeeCv = EmployeeCv::firstOrCreate(
                [
                    'cv_id' => $id,
                    'user_id' => auth()->user()->id
                ],
                [
                    'is_read' => $this->model::INACTIVE, // giá trị mặc định cho is_read
                    'is_checked' => 0,
                    'favorites' => 0
                ]
            );
    
            // Kiểm tra nếu giá trị của is_read bằng INACTIVE
            if ($employeeCv->is_read == $this->model::INACTIVE) {
                // Cập nhật giá trị của cột is_read lên ACTIVE
                $employeeCv->is_read = $this->model::ACTIVE;
                $employeeCv->save();
    
                // Chuẩn bị thông tin cho thông báo
                $cv_infor['name'] = $cv->user->name;
                $cv_infor['email'] = $cv->user->email;
                $cv_infor['job'] = "job_name"; // Thay bằng tên công việc tương ứng
    
                // Gửi thông báo qua email
                Notification::route('mail', [
                    $cv_infor['email'] => $cv_infor['name']
                ])->notify(new Notifications("read-cv", $cv_infor));
            }
    
            // Tìm thông tin liên quan đến CV
            $userStaff = UserStaff::where('user_id', $cv->user_id)->first();
            $educations = UserEducation::where('cv_id', $cv->id)->get();
            $userExperiences = UserExperience::where('cv_id', $cv->id)->get();
            $userSkills = UserSkill::where('cv_id', $cv->id)->get();
    
            // Nếu file CV tồn tại và có đường dẫn, hiển thị file PDF
            if ($cv->file_path && file_exists($cv->file_path)) {
                header("Content-type:application/pdf");
                echo file_get_contents(asset($cv->file_path));
                die();
            }
    
            // Thiết lập tham số để truyền vào view
            $params = [
                'item' => $cv,
                'educations' => $educations,
                'userExperiences' => $userExperiences,
                'userSkills' => $userSkills,
                'userStaff' => $userStaff,
                'employeeCv' => $employeeCv,
            ];
    
            // Trả về view với các tham số
            return view('employee::cv-referred.show', $params);
        } catch (ModelNotFoundException $e) {
            // Ghi log và chuyển hướng nếu không tìm thấy CV
            Log::error('Item not found: ' . $e->getMessage());
            return redirect()->route('employee.referred')->with('error', __('sys.item_not_found'));
        }
    }
    
    
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $cv_apply = UserJobApply::findOrFail($request->id);

            $cv_apply->status = $request->status;

            $cv_apply->save();

            $message = "Cập Nhật thành công!";
            $cv_infor['name'] = $cv_apply->user->name;
            $cv_infor['email'] = $cv_apply->user->email;
            $cv_infor['job'] = $cv_apply->job->name;
            if ($cv_apply->status == $this->model::ACTIVE) {
                Notification::route('mail', [
                    $cv_infor['email'] => $cv_infor['name']
                ])->notify(new Notifications("updated-job", $cv_infor));
            }
            if ($cv_apply->status == $this->model::INACTIVE) {
                Notification::route('mail', [
                    $cv_infor['email'] => $cv_infor['name']
                ])->notify(new Notifications("refuse-job", $cv_infor));
            }
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            Log::error('Lỗi xảy ra: ' . $e->getMessage());
            return redirect()->route('employee.cv.show',$id)->with('error', 'Cập Nhật bị lỗi!');
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $cv = UserJobApply::find($request->id);
            $cv->forceDelete();
            $message = "Xóa thành công!";
            return redirect()->back()->with('success', $message);
        } catch (QueryException $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa thất bại!');
        }
    }
    public function sendEmail ($id)
    {
        return view('employee::cv-apply.send-email');
    }


    public function applied()
    {
        // Lấy tất cả các job mà user hiện tại đã ứng tuyển
        $user_id = Auth::id();
        $items = UserJobApply::with(['job', 'job.province', 'cv.wage', 'cv.career'])
        ->whereHas('job', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();
        // Tính số lượng ứng viên đã nộp đơn
    $appliedCount = $items->count();
    return view('employee::uv.applied', compact('items', 'appliedCount'));
    }

    public function referred()
    {
        
        $items = UserCv::all();
        // dd($items);
        // Tính số lượng CV đã tạo
        $referredCount = $items->count();
    
        return view('employee::uv.referred', compact('items', 'referredCount'));
    }
    
    // public function referred()
    // {
    //     // Lấy danh sách các tin tuyển dụng của nhà tuyển dụng hiện tại
    //     $jobs = Job::where('user_id', Auth::id())->get();
    //     // dd($jobs);
    //     // Dùng mảng để lưu trữ các CV được đề xuất
    //     $items = collect();
    //     $wageIds = [];
    //     foreach ($jobs as $job) {
    //         if ($job->wage_id !== null) {
    //             $wageIds[] = $job->wage_id;
    //         }
    //     }
    //     $uniqueWageIds = array_unique($wageIds);
    //     $items = UserCv::whereIn('wage_id', $uniqueWageIds)
    //                         ->get();
    //     // dd($items);
    //     // Trả về view với danh sách các CV được đề xuất
    //     return view('employee::uv.referred', compact('items'));
    // }

    private function getRandomRecommendationCount()
    {
        $dayOfWeek = date('w'); // Lấy ngày trong tuần (0: Chủ nhật, 1-6: Thứ 2 đến Thứ 7)
        $daysSincePosting = min($dayOfWeek, 6) + 1; // Ngày kể từ khi lên tin tuyển dụng (1-7 ngày)
        
        if ($daysSincePosting == 1) {
            return rand(10, 20); // Ngày đầu: từ 10 đến 20 hồ sơ
        } elseif ($daysSincePosting == 2) {
            return rand(10, 15); // Ngày thứ 2: từ 10 đến 15 hồ sơ
        } elseif ($daysSincePosting == 3) {
            return rand(5, 10); // Ngày thứ 3: từ 5 đến 10 hồ sơ
        } else {
            return rand(3, 5); // Ngày từ thứ 4 đến thứ 10: từ 3 đến 5 hồ sơ
        }
    }
    

    // public function viewed()
    // {
    //     // Lấy tất cả các job mà user hiện tại đã xem
    //     $user_id = Auth::id();
    //     $items = UserJobApply::with(['job', 'job.province', 'cv.wage', 'cv.career'])
    //         ->whereHas('job', function ($query) use ($user_id) {
    //             $query->where('user_id', $user_id);
    //         })
    //         ->where('is_read', UserJobApply::ACTIVE) // Giả sử 'is_read' được sử dụng để xác định công việc đã xem
    //         ->get();
    //         $viewedCount = $items->count();
    //         // dd($viewedCount);

    //     return view('employee::uv.viewed', compact('items','viewedCount'));
    // }
    public function viewed()
    {
        // Lấy tất cả các CV mà user hiện tại đã xem
        $user_id = Auth::id();
        $items = EmployeeCv::with(['cv.wage', 'cv.career'])
            ->where('user_id', $user_id)
            ->where('is_read', 1) 
            ->get();
            // dd($items);
        $viewedCount = $items->count();
    
        return view('employee::uv.viewed', compact('items', 'viewedCount'));
    }
    

    public function saved()
    {
        // Lấy tất cả các job mà user hiện tại đã lưu
        $user_id = Auth::id();
        $items = EmployeeCv::with(['cv.wage', 'cv.career'])
        ->where('user_id', $user_id)
        ->where('favorites', true)
        ->get();
        $savedCount = $items->count();
        // dd($items);
        return view('employee::uv.saved', compact('items','savedCount'));
    }
    

    // public function toggleFavorite($id)
    // {
    //     $userJobApply = UserJobApply::findOrFail($id);
    //     $userJobApply->favorites = !$userJobApply->favorites;
    //     $userJobApply->save();
    //     return response()->json(['favorites' => $userJobApply->favorites]);
    // }

    public function toggleFavorite($id)
    {
        try {
            // Tìm thông tin CV dựa vào $id
            $cv = UserCv::findOrFail($id);

            // Tạo hoặc cập nhật bản ghi trong bảng employee_cv
            $employeeCv = EmployeeCv::firstOrCreate(
                [
                    'cv_id' => $id,
                    'user_id' => Auth::id()
                ],
                [
                    'is_read' => 0,
                    'is_checked' => 0,
                    'favorites' => 0
                ]
            );
            $employeeCv->favorites = $employeeCv->favorites ? 0 : 1;
            $employeeCv->save();
            return response()->json([
                'success' => true,
                'favorites' => $employeeCv->favorites, // Trả về trạng thái favorites sau khi thay đổi
                'message' => $employeeCv->favorites ? 'Đã lưu thông tin CV.' : 'Đã bỏ lưu thông tin CV.'
            ]);
            // return response()->json(['favorites' => $employeeCv->favorites]);
        } catch (ModelNotFoundException $e) {
            // Xử lý khi không tìm thấy CV
            return response()->json(['error' => 'CV not found'], 404);
        }
    }



    public function handleAction($id, $action)
    {
        $cv = UserCv::find($id);
    
        if (!$cv) {
            return redirect()->back()->with('error', 'CV không tồn tại.');
        }
    
        // Kiểm tra action và gửi email tương ứng
        switch ($action) {
            case 'hire':
                Mail::to($cv->user->email)->send(new SendEmailEmployeeCV($cv, 'hire'));
                break;
            case 'reject':
                Mail::to($cv->user->email)->send(new SendEmailEmployeeCV($cv, 'reject'));
                break;
            case 'send_email':
                Mail::to($cv->user->email)->send(new SendEmailEmployeeCV($cv, 'send_email'));
                break;
            default:
                return redirect()->back()->with('error', 'Hành động không hợp lệ.');
        }
    
        return redirect()->back()->with('success', 'Email đã được gửi.');
    }
    // protected function processHireAction($cvId)
    // {
    //     // Ví dụ: Cập nhật trạng thái của CV khi tuyển dụng
    //     $cv = EmployeeCv::findOrFail($cvId);
    //     $cv->is_hired = true;
    //     $cv->save();

    //     // Ví dụ: Gửi email thông báo khi tuyển dụng
    //     Mail::to($cv->user->email)->send(new SendEmailEmployeeCV($cv, 'hire'));
    // }

    // protected function processRejectAction($cvId)
    // {
    //     // Ví dụ: Cập nhật trạng thái của CV khi không tuyển dụng
    //     $cv = EmployeeCv::findOrFail($cvId);
    //     $cv->is_rejected = true;
    //     $cv->save();
    // }

    // protected function processSendEmailAction($cvId)
    // {
    //     // Ví dụ: Gửi email thông báo cho CV
    //     $cv = EmployeeCv::findOrFail($cvId);
    //     Mail::to($cv->user->email)->send(new SendEmailEmployeeCV($cv, 'send_email'));
    // }
}