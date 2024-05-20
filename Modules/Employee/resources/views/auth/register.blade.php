@extends('website.layouts.auth')
@section('title') Đăng ký nhà tuyển dụng @endsection
@section('content')
<!-- Login Form -->
<div class="login-form default-form">
    <div class="form-inner">
        <h3>{{ __('create_a_free_recruiting_account') }}</h3>
        <!--Login Form-->
        <form action="{{ route('employee.postRegister') }}" method='post' enctype="multipart/form-data">
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>{{ __('name') }}<span class="label-required"> *</span></label>
                        <input type="text" name="name" placeholder="{{ __('name') }}" value="{{ old('name') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('email') }}<span class="label-required"> *</span></label>
                        <input type="text" name="email" placeholder="{{ __('email') }}" value="{{ old('email') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('phone') }}<span class="label-required"> *</span></label>
                        <input type="number" name="phone" placeholder="{{ __('phone') }}" value="{{ old('phone') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('password') }}<span> *</span></label>
                        <input type="password" name="password" placeholder="{{ __('password') }}"
                            value="{{ old('password') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('repeat_password') }}<span class="label-required"> *</span></label>
                        <input type="password" name="repeatpassword" placeholder="{{ __('repeat_password') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('repeatpassword') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>{{ __('company_name') }}<span class="label-required"> *</span></label>
                        <input type="text" name="cp_name" id="cp_name" placeholder="{{ __('company_name') }}"
                            value="{{ old('cp_name') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('cp_name') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('company_website') }}<span class="label-required"> *</span></label>
                        <input type="text" name="website" placeholder="{{ __('company_website') }}"
                            value="{{ old('website') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('website') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('company_phone') }}<span class="label-required"> *</span></label>
                        <input type="number" name="text" placeholder="{{ __('company_phone') }}"
                            value="{{ old('phone') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>{{ __('company_address') }}<span class="label-required"> *</span></label>
                        <input type="text" name="address" placeholder="{{ __('company_address') }}"
                            value="{{ old('address') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('address') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>{{ __('company_taxcode') }}<span class="label-required"> *</span></label>
                        <input type="number" name="tax_code" placeholder="{{ __('company_taxcode') }}"
                            value="{{ old('tax_code') }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('tax_code') }}</p>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>{{ __('company_logo') }}<span class="label-required"> *</span></label>
                        <input type="file" name="image" class="form-control" id="inputGroupFile02" placeholder="ađấ">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form__check" style="margin-bottom: 50px;">
                <input id="accept_pp" type="checkbox" name="accept_pp" onchange="showPopup()">
                <label for="accept_pp">
                    Chấp nhận các
                    <a href="{{route('pages.show', 'dieu-khoan-su-dung-nha-tuyen-dung')}}" class="red-link"
                        target="_blank">điều khoản dịch
                        vụ</a>
                    và
                    <a href="{{route('pages.show', 'chinh-sach-bao-mat')}}" class="red-link" target="_blank">chính sách
                        bảo mật</a>
                    <span class="label-required">*</span>
                </label>
                @if ($errors->has('accept_pp'))
                <div class="error-message" style="color:red">{{ $errors->first('accept_pp') }}</div>
                @else
                <div id="popup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <p style="color: red">
                            {{ __('please_read_carefully_and_accept_the_terms_of_service_and_privacy_policy') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
            <div class="">
                <button class="theme-btn btn-style-one " type="submit" name="Register">{{ __('register') }}</button>
            </div>
        </form>
        <div class="bottom-box">
            <div class="text">{{ __('company_already_registered') }}? <a
                    href="{{ route('employee.login') }}">{{ __('login') }} {{ __('here') }}</a></div>
            {{-- <div class="divider"><span>Hoặc</span></div>
            <div class="btn-box row">
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Đăng
                        nhập qua Facebook</a>
                </div>
                <div class="col-lg-6 col-md-12">
                    <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Đăng nhập qua
                        Gmail</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<script>
function showPopup() {
    var accept_pp_checkbox = document.getElementById('accept_pp');
    var popup = document.getElementById('popup');
    popup.style.display = accept_pp_checkbox.checked ? 'none' : 'block';
}
</script>
@endsection