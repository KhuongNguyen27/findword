@extends('website.layouts.auth')
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Reset password</h3>
        <!--Login Form-->
        <form action="{{ route('auth.postReset',$data['token']) }}" method="POST">
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
                <label>Mật khẩu mới : </label><span style="color:gray"> (*)</span>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    placeholder="Mật khẩu mới">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Nhập lại mật khẩu : </label><span style="color:gray"> (*)</span>
                <input type="password" name="repeatpassword" value="{{ old('password') }}"
                    placeholder="Nhập lại mật khẩu">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('repeatpassword') }}</p>
                @endif
            </div>

            <!-- <div class="form-group">
                <div class="field-outer">
                    <div class="text">Don't have an account? <a href="{{ route('auth.register')}}">Signup</a></div>
                </div> 
            </div> -->
            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit">Đặt lại mật khẩu</button>
            </div>
        </form>
    </div>
</div>
<!--End Login Form -->
@endsection