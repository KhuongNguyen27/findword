<!-- Main Header-->
<header class="main-header">
    <div class="main-box">
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('website-assets/images/logo.svg')}}"
                            alt="" title=""></a></div>
            </div>
            @include('job::includes.header.main-menu')
        </div>
        <div class="outer-box">
            <!-- Add Listing -->
            <!-- <a href="{{ route('cv-manager.index')}}" class="upload-cv">Tải lên CV của bạn</a> -->
            <!-- Login/Register -->
            @if(Auth::check())
            <div class="user-greeting">
                <h5>Hi,{{ Auth::user()->name }}</h5>
            </div>
            <!-- <a href="{{ route('dashboards.index') }}" class="theme-btn btn-style-one">Tin tuyển dụng</a> -->
            @else
            <div class="btn-box">
                <a href="{{ route('staff.login') }}" class="theme-btn btn-style-three">Đăng nhập / Đăng ký</a>
                <a href="" class="theme-btn btn-style-one">Tin tuyển dụng</a>
            </div>
            @endif

        </div>
    </div>
    @include('job::includes.header.mobile-menu')
</header>
<!--End Main Header -->