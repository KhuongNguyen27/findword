@extends('website.layouts.auth')
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>Tạo tài khoản Superio miễn phí</h3>
        <!--Login Form-->
        <form action="{{ route('staff.postRegister') }}" method="post">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @csrf
            <div class="form-group">
                <div class="btn-box row">
                    <div class="col-lg-6 col-md-12">
                        <a href="{{route('staff.register')}}" class="theme-btn btn-style-seven"><i class="la la-user"></i> Ứng viên </a>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <a href="{{route('employee.register')}}" class="theme-btn btn-style-four"><i class="la la-briefcase"></i> Nhà tuyển dụng </a>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Tên <span class="label-required">*</span></label>
                <input type="text" name="name" placeholder="Tên" value="{{ old('name') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Email <span class="label-required">*</span></label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('email') }}</p>
                @endif
                <div class="mt-2">
                    <p>Nhập email để nhận thông báo từ nhà tuyển dụng</p>
                </div>
            </div>

            <div class="form-group">
                <label>Ngày sinh <span class="label-required">*</span></label>
                <input type="date" name="birthdate" value="{{ old('birthdate') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('birthdate') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>SĐT <span class="label-required">*</span></label>
                <input type="text" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('phone') }}</p>
                @endif
                <div class="mt-2">
                    <p>Nhập số điện thoại để nhận thông báo từ nhà tuyển dụng</p>
                </div>
            </div>

            <div class="form-group">
                <label>Mật khẩu <span class="label-required">*</span></label>
                <input type="password" name="password" placeholder="Mật khẩu" value="{{ old('password') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu <span class="label-required">*</span></label>
                <input type="password" name="repeatpassword" placeholder="Xác nhận mật khẩu">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('repeatpassword') }}</p>
                @endif
            </div>

            <div class="form__check" style="margin-bottom: 50px;">
                <input id="accept_pp" type="checkbox" name="accept_pp">
                <label for="accept_pp">Chấp nhận các điều khoản và chính sách bảo mật <span class="label-required">*</span></label>
                @if ($errors->has('accept_pp'))
                <div class="error-message" style="color:red">{{ $errors->first('accept_pp') }}</div>
                @endif
            </div>

            <div class="form-group">
                <button class="theme-btn btn-style-one " type="submit" name="Register">Đăng ký</button>
            </div>
        </form>
        <div class="bottom-box">
            <div class="text">Đã có tài khoản? <a href="{{ route('staff.login')}}">Đăng nhập</a></div>
            <!-- <div class="divider"><span>Hoặc</span></div>
            <div class="btn-box row">
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Đăng
                        nhập qua Facebook</a>
                </div>
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Đăng nhập qua
                        Gmail</a>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
