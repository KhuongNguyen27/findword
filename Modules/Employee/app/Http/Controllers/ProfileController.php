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
use Illuminate\Support\Facades\Storage;

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

        // Kiểm tra trường status của người dùng
        return view('employee::profile.dashboard', compact(['count_jobs', 'count_CVapply']));
    }

    public function index()
    {
        $user = Auth::user();
        $user_employee = UserEmployee::where('user_id', $user->id)->first();
        $accounts = $user->accounts;
        $ckeditorFeatures = $accounts->flatMap(function($account) {
            return json_decode($account->ckeditor_features, true);
        });
        $param = [
            'ckeditorFeatures' => $ckeditorFeatures,
        ];
        // dd($user_employee);
        return view('employee::profile.index', compact(['user_employee', 'user','param']));
    }







    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileEmployeeRequest $request, $id): RedirectResponse
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            // Lấy đối tượng người dùng hiện tại
            $user = User::findOrFail($id);
            $user->name = $request->user_name;
            $user->email = $request->email;

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
            $userEmployee->is_hidden_phone = $request->has('is_hidden_phone');
            $userEmployee->is_hidden_email = $request->has('is_hidden_email');

            $request->slug = $request->slug ? $request->slug : $request->name;
            $slug = $maybe_slug = Str::slug($request->slug);
            $next = 2;
            while (UserEmployee::where('slug', $slug)->where('user_id', '!=', $userEmployee->user_id)->first()) {
                $slug = "{$maybe_slug}-{$next}";
                $next++;
            }
            $userEmployee->slug = $slug;

            // Xử lý upload nhiều hình ảnh giấy phép kinh doanh
        if ($request->hasFile('image_business_license')) {
            $images = $request->file('image_business_license');
            $imagePaths = [];
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $imagePaths[] = self::uploadFile($image, 'business_licenses');
                }
            }
            if ($userEmployee->image_business_license) {
                $array_bg = json_decode($userEmployee->image_business_license);
                $result = array_merge($array_bg, $imagePaths);
                $imagePaths = $result;
            }
            $userEmployee->image_business_license = json_encode($imagePaths); // Lưu đường dẫn ảnh dưới dạng chuỗi JSON
        }

        // Xử lý upload các tệp tin khác
            $imagePath = '';
            if( $request->hasFile('image') ){
                $imagePath = self::uploadFile( $request->file('image') ,'employees');
                $userEmployee->image = $imagePath;
            }
            $backgroundPath = '';
            if ( $request->hasFile('background') ) {
                $backgroundPath = self::uploadFile( $request->file('background') ,'backgrounds');
                $userEmployee->background = $backgroundPath;
            }else
            {
                $backgroundPath = 'website/images/logo.svg';
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

    public function deleteImage(Request $request)
    {
        $imagePath = $request->input('imageSrc');

        // Tìm và xóa ảnh từ hệ thống tập tin
        if (Storage::exists(public_path($imagePath))) {
            Storage::exists(public_path($imagePath));
        }

        // Cập nhật cơ sở dữ liệu để loại bỏ đường dẫn ảnh
        // Giả sử bạn lưu đường dẫn ảnh trong một cột image_business_license của bảng employees
        $user_employee = Auth::user()->userEmployee; // Lấy thông tin employee của người dùng hiện tại

        $images = json_decode($user_employee->image_business_license, true);
        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);
        }
        $user_employee->image_business_license = json_encode(array_values($images));
        $user_employee->save();

        return response()->json(['success' => true]);
    }
}