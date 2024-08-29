<?php

namespace Modules\Staff\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;

use App\Models\CodeEmail;
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
use App\Models\Visitor;
use Carbon\Carbon;
use App\Notifications\Notifications;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Modules\Staff\app\Models\UserStaff;

use App\Traits\SEOTrait;


class AuthController extends Controller
{
	use SEOTrait;

    public function login()
    {   
        $keywords = config('seo.keywords');
        $title = 'Đăng nhập';
        $description = 'Đăng nhập tìm việc siêu nhanh';
        $canonical = config('seo.canonical').'staff/login';
		$og_url = config('seo.canonical').'staff/login';
        $this->setSEO(
						$title,
						$description,
						$canonical,
						$keywords,
						$og_url
					);

        if (Auth::check()) {
            return redirect()->route('staff.home');
        } else {
            return view('staff::auth.login');
        }
    }
    public function verification($email)
    {
        return view('staff::auth.verify-email', compact('email'));

    }
    public function postLogin(StoreLoginRequest $request)
    {
        $dataUser = $request->only('email', 'password');
        $remember = $request->remember ? true : false;
        $code = CodeEmail::where('email', $request->email)->first();
        if ($code && !CodeEmail::where('email', $request->email)->first()->status) {
            return redirect()->route('staff.verification', ['email' => $request->email])->with('error', __('Vui lòng nhập mã xác thực'));
        }
        if (Auth::attempt($dataUser, $remember)) {
            $user = Auth::user();
            $user->last_login = Carbon::now();
            $user->save();
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

            $name = $user->name;
            // dd($name);
            $code = mt_rand(100000, 999999);
            CodeEmail::create([
                'email' => $request->email,
                'code' => $code,
                'status' => false,
            ]);

            // Gửi email xác thực
            Mail::to($request->email)->send(new EmailVerification($code, $name));


            Notification::route('mail', [
                env('ADMIN_EMAIL') => env('ADMIN_NAME')
            ])->notify(new Notifications("register", $user->toArray()));
            $message = "Đăng ký thành công";
            DB::commit();
            return redirect()->route('staff.verification', $user->email)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bug occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đăng ký không thành công');
        }
    }

    public function confirm(Request $request)
    {
        try {
            // Tìm mã xác thực trong bảng code_email
            $codeRecord = CodeEmail::where('email', $request->email)->first();

            if (!$codeRecord) {
                return redirect()->back()->with('error', 'Không tìm thấy mã xác thực cho email này.');
            }

            // Kiểm tra thời gian kể từ lần gửi cuối cùng
            $lastSentAt = $codeRecord->last_sent_at;
            if ($lastSentAt && Carbon::now()->diffInSeconds($lastSentAt) > 60) {
                return redirect()->back()->with('error', 'Mã xác thực đã hết hạn. Vui lòng yêu cầu gửi lại mã.');
            }

            // Kiểm tra xem mã xác thực nhập vào có khớp với mã trong bảng không
            if ($codeRecord->code == $request->code) {
                // Cập nhật trạng thái của mã xác thực
                $codeRecord->status = true;
                $codeRecord->save();

                return redirect()->route('staff.login')->with('success', 'Xác thực email thành công. Bạn có thể đăng nhập ngay bây giờ.');
            } else {
                return redirect()->back()->with('error', 'Mã xác thực không đúng.');
            }
        } catch (\Exception $e) {
            Log::error('Xác thực email không thành công: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình xác thực email.');
        }
    }


    public function resend(Request $request)
    {
        try {
            $email = $request->email;
            $codeRecord = CodeEmail::where('email', $email)->first();

            if (!$codeRecord) {
                return redirect()->back()->with('error', 'Không tìm thấy mã xác thực cho email này.');
            }

            // Kiểm tra thời gian kể từ lần gửi cuối cùng
            $lastSentAt = $codeRecord->last_sent_at;
            if ($lastSentAt && Carbon::now()->diffInSeconds($lastSentAt) < 60) {
                return redirect()->back()->with('error', 'Bạn cần chờ ít nhất 1 phút trước khi yêu cầu gửi lại mã xác thực.');
            }

            // Tìm người dùng từ email
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng với địa chỉ email này.');
            }
            $name = $user->name;
            // Gửi lại mã xác thực mới
            $newCode = mt_rand(100000, 999999);
            $codeRecord->code = $newCode;
            $codeRecord->status = false;
            $codeRecord->last_sent_at = Carbon::now();
            $codeRecord->save();

            // Gửi lại email xác thực mới
            Mail::to($email)->send(new EmailVerification($newCode, $name));

            return redirect()->back()->with('success', 'Đã gửi lại mã xác thực thành công.');
        } catch (\Exception $e) {
            Log::error('Gửi lại mã xác thực không thành công: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình gửi lại mã xác thực.');
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
                    ['email' => $socialUser->email],
                    [
                        'name' => $socialUser->name,
                        'facebook_id' => $socialUser->id,
                    ]
                );
                $user_staff = UserStaff::create(
                    ['user_id' => $newUser->id],
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
        // dd(123);
        DB::beginTransaction();
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = User::where('email', $socialUser->email)->first();
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
                        'position' => 0,
                        'google_id' => $socialUser->id,
                    ]
                );
                $user_staff = UserStaff::create(
                    ['user_id' => $newUser->id,]
                );
                Auth::login($newUser);
                DB::commit();
                return redirect()->intended('staff');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Google Callback Error: ' . $e->getMessage());
            return redirect()->route('staff.login')->with(['error' => 'Có lỗi xảy ra khi đăng nhập bằng Google.']);
        }
    }

}