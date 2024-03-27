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
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Modules\Staff\app\Models\UserStaff;

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
        $remember = $request->remember ? true : false ;
        if (Auth::attempt($dataUser, $remember)) {
            return redirect()->route('staff.home');
        } else {
            return redirect()->route('staff.login')->with('error', __('account_or_password_is_incorrect'));
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
        try {
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
            $message = "Đăng ký thành công";
            return redirect()->route('staff.login')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->back()->with('error','Registration failed');
        }
    }




    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Xử lý đăng nhập hoặc đăng ký người dùng
        $authUser = $this->findOrCreateUser($user, 'facebook');

        // Đăng nhập người dùng
        Auth::login($authUser, true);

        // Redirect tới trang sau khi đăng nhập thành công
        return redirect()->intended('staff/auth/login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Xử lý đăng nhập hoặc đăng ký người dùng
        $authUser = $this->findOrCreateUser($user, 'google');

        // Đăng nhập người dùng
        Auth::login($authUser, true);

        // Redirect tới trang sau khi đăng nhập thành công
        return redirect()->intended('staff/auth/login');
    }

    protected function findOrCreateUser($user, $provider) 
    {
        $authUser = UserStaff::where('facebook_id',$user->id)->orWhere('google_id',$user->id)->first();
        if(!$authUser){
            $authUser = UserStaff::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'facebook_id'=> $provider === 'facebook' ? $user->id :null,
                'google_id'=> $provider === 'google' ? $user->id : null,
            ]);
        }
        return $authUser;
    }
}


