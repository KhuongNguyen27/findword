<?php

namespace Modules\AdminUser\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\AdminUser\app\Http\Requests\StoreAdminUserRequest;
use Modules\AdminUser\app\Http\Requests\LoginAdminUserRequest;

class AdminAuthController extends Controller
{
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('admin.home');
        }
        return view('adminuser::auth.login');
    }

    public function postLogin(LoginAdminUserRequest $request)
    {

        Auth::logout();
        try {
            $data = $request->except('_method', '_token');
            if (Auth::attempt($data)) {
                $request->session()->regenerate();

                // Kiểm tra quyền truy cập của người dùng
                $user = Auth::user();

                if ($user->hasPermission('home_viewAny')) {
                    return redirect()->route('admin.home');
                } elseif ($user->hasPermission('user_viewAny')) {
                    return redirect()->route('adminuser.index',['type'=>'staff']);
                } elseif ($user->hasPermission('user_viewAnyPost')) {
                    return redirect()->route('adminpost.index', ['type' => 'Post']);
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Tài khoản của bạn không có quyền truy cập vào bất kỳ trang nào.');
                }
            }
            return redirect()->route('login')->with('error', 'Vui lòng kiểm tra lại toàn khoản mật khẩu');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('admin.home');
    }

    public function register() {}

    public function postRegister(Request $request) {}

    public function postForgotPass(Request $request) {}

    public function resetPass() {}

    public function postResetPass(Request $request) {}
}
