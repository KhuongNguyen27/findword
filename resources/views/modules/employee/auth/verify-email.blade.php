@extends('website.layouts.auth')
@section('content')
<style>
    .login-form .form-group .theme-btn {
    display: block;
    width: 100%;
    margin-bottom: 4%;
}
</style>
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Nhập mã từ email của bạn</h3>
        <!--Login Form-->
        <form action="{{ route('employee.confirm')}}?email={{$email}}" method="POST">
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
                <label>Hãy cho chúng tôi biết email này thuộc về bạn. Hãy nhập mã trong email
                    được gửi đến <span class="fwb">{{$email}}</span></label>
                <input type="text" name="code" placeholder="Nhập mã xác thực">
            </div>
            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" onclick="showLoading()">Kiểm tra <i
                        class="ti-arrow-right"></i></button>
                <div id="loadingSpinner" class="loading-spinner"></div>
            </div>
        </form>
        <form action="{{ route('employee.resend')}}?email={{$email}}" method="POST">
            @csrf
            <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" onclick="showLoading()">Gửi lại mã xác
                    thực</button>
                <div id="loadingSpinner" class="loading-spinner"></div>
            </div>
        </form>
    </div>
</div>


@endsection