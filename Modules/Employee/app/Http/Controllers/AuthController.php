<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Modules\Employee\app\Http\Requests\StoreLoginRequest;
use Modules\Employee\app\Http\Requests\StoreRegisterRequest;
use Modules\Auth\app\Http\Requests\ForgotPasswordRequest;
use Modules\Auth\app\Http\Requests\ResetPasswordRequest;
use Modules\Auth\app\Models\PasswordResetToken;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\Employee\app\Models\User;
use Modules\Employee\app\Models\UserEmployee;

use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Session;

use App\Traits\UploadFileTrait;

class AuthController extends Controller
{
    use UploadFileTrait;
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('employee.profile.index');
        } else {
            return view('employee::auth.login');
        }
    }

    public function postLogin(StoreLoginRequest $request)
    {
        try {
            $dataUser = $request->only('email', 'password');
            $user = User::where('email',$dataUser['email'])->first();
            $remember = $request->remember ? true : false;
            if (Auth::attempt($dataUser, $remember)) {
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                return redirect()->route('employee.home'); 
            } else {
                return redirect()->route('employee.login')->with('error',  __('account_or_password_is_incorrect'));
            }
        } catch (\Exception $e) {
            Log::error('Bug send email : '.$e->getMessage());
            return redirect()->route('employee.home'); 
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('employee.login');
    }
    public function register(){
        if (Auth::check()) {
            return redirect()->route('employee.profile.index');
        } else {
            return view('employee::auth.register');
        }
    }
    public function postRegister(StoreRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = "employee";
            $user->status = 1;
            $user->tax_code = $request->tax_code;
            $user->password = bcrypt($request->password);
            // dd($request->email);
            $user->save();
            
            $imagePath = '';
            if( $request->hasFile('image') ){
                $imagePath = self::uploadFile( $request->file('image') ,'employees');
            }

            $request->cp_slug = $request->cp_slug ? $request->cp_slug : $request->cp_name;
            $slug = $maybe_slug = Str::slug($request->cp_slug);
            $next = 2;
            while (UserEmployee::where('slug', $slug)->first()) {
                $slug = "{$maybe_slug}-{$next}";
                $next++;
            }
            $user->userEmployee()->create([
                'name' => $request->cp_name,
                'website' => $request->website,
                'phone' => $request->phone,
                'slug' => $slug,
                'address' => $request->address,
                'image' => $imagePath
            ]);
            $message = "Đăng ký thành công!";
            DB::commit(); // Hoàn thành giao dịch
            Notification::route('mail', [
                env('ADMIN_EMAIL') => env('ADMIN_NAME')
            ])->notify(new Notifications("register",$user->toArray()));
            return redirect()->route('employee.login')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            Log::error('Bug occurred: ' . $e->getMessage());
            return view('employee::auth.register')->with('error', 'Đăng ký bị lỗi!');
        }
    }

    
}