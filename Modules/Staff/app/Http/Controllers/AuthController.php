<?php

namespace Modules\Staff\app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Modules\Auth\app\Http\Requests\StoreLoginRequest;
use Modules\Auth\app\Http\Requests\StoreRegisterRequest;
use Modules\Auth\app\Http\Requests\ForgotPasswordRequest;
use Modules\Auth\app\Http\Requests\ResetPasswordRequest;
use Modules\Auth\app\Models\PasswordResetToken;

use Mail;
use Illuminate\Support\Str;
use Modules\Staff\app\Models\StaffUser;
use Modules\Staff\app\Models\User;

use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('staff.home'); 
        } else {
            return view('staff::auth.login');
        }
    }

    public function postLogin(StoreLoginRequest $request)
    {
        $dataUser = $request->only('email', 'password');
        
        // Kiểm tra nếu người dùng đã đăng nhập thành công
        if (Auth::attempt($dataUser, $request->remember)) {
            // Lấy URL trang hiện tại và lưu vào session
            $previousUrl = session('previous_url');
            
            if ($previousUrl) {
                // Nếu có URL trước đó, chuyển hướng người dùng trở lại trang đó
                return redirect()->to($previousUrl);
            } else {
                // Nếu không có URL trước đó, chuyển hướng người dùng đến trang staff.home
                return redirect()->route('staff.home');
            }
        } else {
            // Nếu đăng nhập không thành công, chuyển hướng người dùng đến trang đăng nhập và hiển thị thông báo lỗi
            return redirect()->route('staff.login')->with('error', 'Account or password is incorrect');
        }
    }
    
    public function register($type = ''){
        if (Auth::check()) {
            return redirect()->route('staff.home'); 
        } else {
            return view('staff::auth.register');
        }
    }
    public function postRegister(StoreRegisterRequest $request)
    {
        // dd($request->all());

        try {

            // Create a new user in the users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'type' => 'staff',
                'status' => 1,
            ]);

            $user->userStaff()->create([
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
            ]);
            Notification::route('mail', [
                'nguyenhuukhuong27102000@gmail.com' => 'Khuongnguyen'
            ])->notify(new Notifications("register",$user->toArray()));
            $message = "Successfully registered";
            return redirect()->route('staff.login')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->back()->with('error','Registration failed');
        }
    }
}