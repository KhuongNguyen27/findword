<?php

namespace Modules\Employee\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\CodeEmail;
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
use Carbon\Carbon;
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
            $user = User::where('email', $dataUser['email'])->first();
            $remember = $request->remember ? true : false;
            $code = CodeEmail::where('email', $request->email)->first();
            if ($code && !CodeEmail::where('email', $request->email)->first()->status) {
                return redirect()->route('employee.verification', ['email' => $request->email])->with('error', __('Vui lòng nhập mã xác thực'));
            }
            if (Auth::attempt($dataUser, $remember)) {
                $user = Auth::user();
                $user->last_login = Carbon::now();
                $user->save();
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                return redirect()->route('employee.home');
            } else {
                return redirect()->route('employee.login')->with('error', __('account_or_password_is_incorrect'));
            }
        } catch (\Exception $e) {
            Log::error('Bug send email : ' . $e->getMessage());
            return redirect()->route('employee.home');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('employee.login');
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('employee.profile.index');
        } else {
            return view('employee::auth.register');
        }
    }
    public function postRegister(StoreRegisterRequest $request)
    {
        // dd($request->all());
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
            if ($request->hasFile('image')) {
                $imagePath = self::uploadFile($request->file('image'), 'employees');
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

            $name = $request->cp_name;

            $code = mt_rand(100000, 999999);
            CodeEmail::create([
                'email' => $request->email,
                'code' => $code,
                'status' => false,
            ]);

            // Gửi email xác thực
            Mail::to($request->email)->send(new EmailVerification($code, $name));


            $message = "Đăng ký thành công!";
            DB::commit(); // Hoàn thành giao dịch
            Notification::route('mail', [
                env('ADMIN_EMAIL') => env('ADMIN_NAME')
            ])->notify(new Notifications("register", $user->toArray()));
            return redirect()->route('employee.verification', $user->email)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback(); // Hoàn tác giao dịch nếu có lỗi
            Log::error('Bug occurred: ' . $e->getMessage());
            return view('employee::auth.register')->with('error', 'Đăng ký bị lỗi!');
        }
    }
    public function verification($email)
    {
        return view('employee::auth.verify-email', compact('email'));

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

                return redirect()->route('employee.login')->with('success', 'Xác thực email thành công. Bạn có thể đăng nhập ngay bây giờ.');
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

            // Lấy tên công ty từ cơ sở dữ liệu
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng với địa chỉ email này.');
            }
            $name = $user->userEmployee->name; // Lấy tên công ty từ userEmployee
            // dd($name);
            
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
}