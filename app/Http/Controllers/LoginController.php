<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Laravel\Socialite\Facades\Socialite;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    
    class LoginController extends Controller
    {
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
            return redirect()->intended('/dashboard');
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
            return redirect()->intended('/dashboard');
        }
    
        protected function findOrCreateUser($user, $provider)
        {
            // Tìm hoặc tạo người dùng mới từ dữ liệu được trả về từ Facebook hoặc Google
            $authUser = User::where('provider_id', $user->id)->first();
    
            if (!$authUser) {
                $authUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider' => $provider,
                    'provider_id' => $user->id
                ]);
            }
    
            return $authUser;
        }
    }
    
}
