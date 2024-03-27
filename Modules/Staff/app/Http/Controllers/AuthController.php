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
use Exception;
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
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = UserStaff::where('email', $user->email)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('staff');
         
            }else{
                $newUser = UserStaff::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                    ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('staff');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
         
            $finduser = UserStaff::where('email', $user->email)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('staff');
         
            }else{
                $newUser = UserStaff::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> $user->id,
                    ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('staff');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

 
}


