<?php

namespace Modules\AdminUser\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('admin.home');
        }
        return view('adminuser::auth.login');
    }

    public function postLogin(Request $request)
    {
        Auth::logout();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        try
        {
            if (Auth::attempt($credentials)) {
                
                $request->session()->regenerate();
                return redirect()->route('admin.home');
            }
            return redirect()->route('login')->with('error', 'Vui lòng kiểm tra lại toàn khoản mật khẩu');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('admin.home');
    }

    public function register()
    {
    }

    public function postRegister(Request $request)
    {
    }

    public function postForgotPass(Request $request)
    {
    }

    public function resetPass()
    {
    }

    public function postResetPass(Request $request)
    {
    }
    
}