@extends('website.layouts.auth')
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Quên mật khẩu</h3>
        <!--Login Form-->
        <form action="{{ route('auth.postForgot')}}" method="POST">
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
                <label>Email</label>
                <input type="email" name="email" placeholder="username@gmail.com">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" onclick="showLoading()">Submit <i
                        class="ti-arrow-right"></i></button>
                <div id="loadingSpinner" class="loading-spinner"></div>
            </div>
        </form>
    </div>
</div>

@endsection