@extends('website.layouts.auth')
@section('title') Đăng nhập nhà tuyển dụng @endphp @endsection

@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3 class="text-center">Đăng Nhập Nhà Tuyển Dụng</h3>
        <!--Login Form-->
        <form action="{{ route('employee.postLogin')}}" method="POST">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @csrf
            <div class="form-group">
                <label>
                    {{__('email')}}
                    <span class="required">*</span>
                </label>
                <input type="email" name="email" placeholder="abc@gmail.com" value="{{ old('email') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>
                    {{__('password')}}
                    <span class="required">*</span>
                </label>
                <input id="password-field" type="password" name="password" value="" placeholder=" {{__('enter_password')}} "
                    value="{{ old('Password') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group">
                <div class="field-outer">
                    <div class="input-group checkboxes square">
                        <input type="checkbox" name="remember" value="1" id="remember">
                        <label for="remember" class="remember"><span class="custom-checkbox"></span> {{__('remember_me')}} </label>
                    </div>
                    <a href="{{ route('auth.forgot')}}" class="pwd">{{__('reset_password')}} ?</a>
                </div>
            </div>

            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" name="log-in"> {{__('login')}} </button>
            </div>
        </form>

        <div class="bottom-box">
            <div class="text">{{__('sign_up_for_an_account')}}? <a href="{{ route('employee.register')}}"> {{__('register')}} </a></div>
            {{-- <div class="divider"><span>or</span></div>
            <div class="btn-box row">
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Log In
                        via Facebook</a>
                </div>
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Log In via
                        Gmail</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--End Login Form -->
@endsection