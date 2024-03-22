@extends('website.layouts.auth')
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Tạo tài khoản Superio miễn phí</h3>
        <!--Login Form-->
        <form action="{{ route('staff.postRegister') }}" method='post'>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @csrf
            <div class="form-group">
                <div class="btn-box row">
                    <div class="col-lg-6 col-md-12">
                        <a href="{{route('staff.register')}}" class="theme-btn btn-style-seven"><i class="la la-user"></i>{{ __('candidate') }}</a>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <a href="{{route('employee.register')}}" class="theme-btn btn-style-four"><i class="la la-briefcase"></i> {{ __('employee') }} </a>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>{{ __('name') }}<span> *</span></label>
                <input type="text" name="name" placeholder="{{ __('name') }}" value="{{ old('name') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>{{ __('email') }} <span> *</span></label>
                <input type="email" name="email" placeholder="{{ __('email') }}" value="{{ old('email') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
                <div class="mt-2">
                    <p>{{ __('enter_your_email_to_receive_notifications_from_the_employer') }}</p>
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('year_of_birth') }}</label>
                <input type="date" name="birthdate" value="{{ old('birthdate') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('birthdate') }}</p>
                @endif
            </div>


            <div class="form-group">
                <label>{{ __('phone') }}<span> *</span></label>
                <input type="number" name="phone" placeholder="{{ __('phone') }}" value="{{ old('phone') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('phone') }}</p>
                @endif
                <div class="mt-2">
                    <p>{{ __('enter_your_phone_number_to_receive_notifications_from_the_employer') }}</p>
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('password') }}<span> *</span></label>
                <input type="password" name="password" placeholder="{{ __('password') }}" value="{{ old('password') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>{{ __('repeat_password') }}<span> *</span></label>
                <input type="password" name="repeatpassword" placeholder="{{ __('repeat_password') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('repeatpassword') }}</p>
                @endif
            </div>

            <div class="form__check" style="margin-bottom: 50px;">
                <input id="accept_pp" type="checkbox" name="accept_pp">
                <label for="accept_pp">{{ __('agree_to_the_terms_and_privacy_policy') }} <span> *</span></label>
                @if ($errors->has('accept_pp'))
                <div class="error-message" style="color:red">{{ $errors->first('accept_pp') }}</div>
                @endif
            </div>

            <div class="form-group">
                <button class="theme-btn btn-style-one " type="submit" name="Register">{{ __('register') }}</button>
            </div>
        </form>
        <div class="bottom-box">
            <div class="text">{{ __('already_have_an_account') }}? <a href="{{ route('staff.login')}}">{{ __('login') }}</a></div>
            <div class="divider"><span>{{ __('or') }}</span></div>
            <div class="btn-box row">
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i>
                        {{ __('facebook_login') }}
                    </a>
                </div>
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i>
                        {{ __('gmail_login') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection