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
use App\Models\User;

use App\Notifications\Notifications;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\DB;
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
        $remember = $request->remember ? true : false;
        if (Auth::attempt($dataUser, $remember)) {
            return redirect()->route('staff.home');
        } else {
            return redirect()->route('staff.login')->with('error', __('account_or_password_is_incorrect'));
        }
    }

    public function register($type = '')
    {
        if (Auth::check()) {
            return redirect()->route('staff.home');
        } else {
            return view('staff::auth.register');
        }
    }
    public function postRegister(StoreRegisterRequest $request)
    {
        DB::beginTransaction();
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
            ])->notify(new Notifications("register", $user->toArray()));
            $message = "Đăng ký thành công";
            DB::commit();
            return redirect()->route('staff.login')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đăng ký không thành công');
        }
    }




    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        DB::beginTransaction();
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $user = User::where('email', $socialUser->email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->intended('staff');
            } else {
                $newUser = User::firtsOrCreate(
                    ['email' => $socialUser->email], [
                    'name' => $socialUser->name,
                    'facebook_id' => $socialUser->id,
                ]);
                $user_staff = UserStaff::create(
                    ['user_id'=> $newUser->id],
                );
                Auth::login($newUser);
                DB::commit();
                return redirect()->intended('staff');
            }
        } catch (Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        DB::beginTransaction();
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $socialUser->id)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->intended('staff');
            } else {
                $newUser = User::firstOrCreate(
                    ['email' => $socialUser->email], 
                    [
                        'name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'password' => bcrypt('123456'),
                        'type' => 'staff',
                        'status' => 1,
                    ]);
                $user_staff = UserStaff::create(
                    ['user_id'=> $newUser->id,]
                );
                Auth::login($newUser);
                DB::commit();
                return redirect()->intended('staff');
            }
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
        }
    }
}



