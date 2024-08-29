@extends('website.layouts.auth')
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h1>{{ __('login') }}</h1>
        <!--Login Form-->
        <form action="{{ route('staff.postLogin')}}" method="POST">
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
                    {{ __('email') }}
                    <span class="label-required" > *</span>
                </label>
                <input type="email" name="email" placeholder="abc@gmail.com" value="{{ old('email') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>
                    {{ __('password') }}
                    <span class="label-required" > *</span>
                </label>
                <input id="password-field" type="password" name="password" value="" placeholder="{{ __('password') }}"
                    value="{{ old('Password') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group">
                <div class="field-outer">
                    <div class="input-group checkboxes square">
                        <input type="checkbox" name="remember" value="1" id="remember">
                        <label for="remember" class="remember"><span class="custom-checkbox"></span>{{ __('remember_me') }}</label>
                    </div>
                    <a href="{{ route('auth.forgot')}}" class="pwd">{{ __('forgot_password') }}?</a>
                </div>
            </div>

            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" name="log-in">{{ __('login') }}</button>
            </div>
        </form>

        <div class="bottom-box">
            <div class="text">{{ __('do_not_have_an_account') }}? <a class="" href="{{ route('staff.register')}}">{{ __('register') }}</a></div>
            <div class="divider"><span>{{ __('or') }}</span></div>
            <div class="btn-box row d-flex justify-content-center">
                {{-- <div class="col-lg-6 col-md-6">
                    <a href="{{ route('login.facebook') }}" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i>
                        {{ __('facebook_login') }}
                    </a>
                </div> --}}
                <div class="col-lg-12 col-md-12">
                    <a href="{{ route('login.google') }}" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i>
                        {{ __('gmail_login') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Login Form -->
@endsection
