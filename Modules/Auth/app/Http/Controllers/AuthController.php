<?php

namespace Modules\Auth\app\Http\Controllers;

use Modules\Staff\app\Models\StaffUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;

use Modules\Auth\app\Http\Requests\StoreLoginRequest;
use Modules\Auth\app\Http\Requests\StoreRegisterRequest;
use Modules\Auth\app\Http\Requests\ForgotPasswordRequest;
use Modules\Auth\app\Http\Requests\ResetPasswordRequest;
use Modules\Auth\app\Models\PasswordResetToken;

use Mail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view('auth::login');
    }
    public function postLogin(StoreLoginRequest $request)
    {
        Auth::logout();
        $dataUser = $request->only('email', 'password');
        $previousUrl = Session::get('previous_url');
        unset($_SESSION['previousUrl']);
        // xóa session cũ đi 
        if (Auth::attempt($dataUser, $request->remember)) {
            return redirect()->route('home');
        } else {
            return redirect($previousUrl)->with('error', 'Account or password is incorrect');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function register($type = '')
    {
        if (url()->previous() !== route('auth.register')) {
            Session::put('previous_url', url()->previous());
        }
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth::register');
        }
    }
    public function postRegister(StoreRegisterRequest $request)
    {
        try {

            // Create a new user in the users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $previousUrl = Session::get('previous_url');
            unset($_SESSION['previousUrl']);
            $message = "Successfully registered";
            return redirect($previousUrl)->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return view('auth::register')->with('error', 'Registration failed');
        }
    }
    function forgot(Request $request)
    {
        if (url()->previous() !== route('auth.forgot')) {
            Session::put('previous_url', url()->previous());
        }
        return view('auth::forgot');
    }
    public function postForgot(ForgotPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Tài khoản không tìm thấy');
            }
            if( $user->google_id ){
                return redirect()->back()->with('error', 'Tài khoản này được Đăng nhập bằng Gmail. Không thể lấy lại mật khẩu.');
            }
            $token = strtoupper(Str::random(10));
            $existingToken = PasswordResetToken::where('email', $user->email)->first();
            if ($existingToken) {
                $existingToken->update(['token' => $token]);
            } else {
                PasswordResetToken::create([
                    'email' => $user->email,
                    'token' => $token,
                ]);
            }
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ];
            Notification::route('mail', [
                $user->email => $user->name,
            ])->notify(new Notifications("forgotpassword", $data));
            $previousUrl = Session::get('previous_url');
            unset($_SESSION['previousUrl']);
            return redirect($previousUrl)->with('success', 'Vui lòng kiểm tra email để lấy lại mật khẩu');
        } catch (\Exception $e) {
            $previousUrl = Session::get('previous_url');
            unset($_SESSION['previousUrl']);
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect($previousUrl)->with('error', 'Lấy lại mật khẩu thất bại !!');
        }
    }
    public function getReset($token)
    {
        $tokenRecord = PasswordResetToken::where('token', $token)->first();

        if ($tokenRecord) {
            $data = [
                'token' => $token,
            ];

            return view('auth::resetpassword', compact('data'));
        } else {
            return redirect($previousUrl)->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại');
        }
    }
    public function postReset(ResetPasswordRequest $request)
    {
        $tokenRecord = PasswordResetToken::where('token', $request->token)->first();
        if ($tokenRecord) {
            $user = User::where('email', $tokenRecord->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();

            $tokenRecord->delete(); // Remove the used token
            $previousUrl = Session::get('previous_url');
            unset($_SESSION['previousUrl']);
            return redirect($previousUrl)->with('success', 'Đặt lại mật khẩu thành công.');
        } else {
            return redirect($previousUrl)->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}