<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Employee\app\Models\UserEmployee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Http\Requests\UpdateProfileEmployeeRequest;
use Illuminate\Support\Str;
use Modules\Employee\app\Http\Requests\ChangepasswordRequest;
use Modules\Employee\app\Models\Job;
use Modules\Staff\app\Models\UserCv;
use Modules\Employee\app\Models\UserJobApply;

use App\Traits\UploadFileTrait;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UploadFileTrait;
    public function dashboard()
    {
        $count_jobs = Job::where('user_id', auth()->user()->id)->count();
        $count_CVapply = UserJobApply::where('user_id', auth()->user()->id)->count();
        return view('employee::profile.dashboard', compact(['count_jobs', 'count_CVapply']));
    }

    public function index()
    {
        $user = Auth::user();
        $user_employee = UserEmployee::where('user_id', $user->id)->first();
        return view('employee::profile.index', compact(['user_employee', 'user']));
    }







    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileEmployeeRequest $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            // Lấy đối tượng người dùng hiện tại
            $user = User::findOrFail($id);
            // $user->name = $request->user_name;
            // $user->email = $request->email;

            // Kiểm tra và cập nhật mật khẩu nếu được cung cấp
            if ($request->password != '') {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // Cập nhật thông tin người đăng nhập liên quan (UserEmployee)
            $userEmployee = UserEmployee::where('user_id', $user->id)->first();
            if (!$userEmployee) {
                $userEmployee = new UserEmployee();
                $userEmployee->user_id = $user->id;
            }
            $userEmployee->name = $request->name;
            $userEmployee->phone = $request->phone;
            $userEmployee->address = $request->address;
            $userEmployee->website = $request->website;
            $userEmployee->about = $request->about;

            $request->slug = $request->slug ? $request->slug : $request->name;
            $slug = $maybe_slug = Str::slug($request->slug);
            $next = 2;
            while (UserEmployee::where('slug', $slug)->where('user_id', '!=', $userEmployee->user_id)->first()) {
                $slug = "{$maybe_slug}-{$next}";
                $next++;
            }
            $userEmployee->slug = $slug;

            $imagePath = '';
            if( $request->hasFile('image') ){
                $imagePath = self::uploadFile( $request->file('image') ,'employees');
                $userEmployee->image = $imagePath;
            }
            if ( $request->hasFile('background') ) {
                $backgroundPath = self::uploadFile( $request->file('image') ,'backgrounds');
                $userEmployee->background = $backgroundPath;
            }
            $userEmployee->save();

            DB::commit(); // Hoàn thành giao dịch

            $message = "Cập nhật thành công!";
            return redirect()->route('employee.profile.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            Log::error('Lỗi xảy ra: ' . $e->getMessage());
            return redirect()->route('employee.profile.index')->with('error', 'Cập Nhật bị lỗi!');
        }
    }
    public function editpassword()
    {
        $user= Auth::user();
        return view('employee::change-password.edit',compact(['user']));
    }
    public function changePassword( ChangepasswordRequest $request, $userId){
       
        $user = User::findOrFail($userId);
        // dd($user);
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with(['error' => 'Mật khẩu hiện tại không chính xác.']);
        }
        $user->password = Hash::make($request->newpassword);
        $user->save();
        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}