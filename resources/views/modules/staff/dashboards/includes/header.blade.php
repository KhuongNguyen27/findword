@php
$currentRouteName = \Request::route()->getName();
@endphp
<header class="main-header">
    <div class="main-box">
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('website-assets/images/logo.svg')}}"
                            alt="" title=""></a></div>
            </div>
            @include('website.includes.header.main-menu')
        </div>
        <div class="outer-box">
            @if(Auth::check())
                <button class="menu-btn">
                    <span class="count">1</span>
                    <span class="icon la la-heart-o"></span>
                </button>

                <button class="menu-btn">
                    <span class="icon la la-bell"></span>
                </button>
                <!-- Dashboard Option -->
                <div class="dropdown dashboard-option">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span>Hi,{{ Auth::user()->name }}</span>
                        <!-- <img src="{{ asset(Auth::user()->image_fm) }}" alt="avatar" class="thumb"> -->
                    </a>
                    <ul class="dropdown-menu">
                        <li class="@if($currentRouteName == 'staff.home') active @endif"><a
                                href="{{ route('staff.home')}}"><i class="la la-box"></i>Bảng điều khiển</a></li>
                        <li
                            class="@if($currentRouteName == 'staff.profile.index' || $currentRouteName == 'staff.home1') active @endif">
                            <a href="{{ route('staff.profile.index')}}"> <i class="la la-user-alt"></i>Thông tin cá
                                nhân</a>
                        </li>
                        <li class="@if($currentRouteName == 'staff.cv.index') active @endif"><a
                                href="{{ route('staff.cv.index')}}"><i class="la la-box"></i>Danh sách hồ sơ</a></li>
                        <li class="@if($currentRouteName == 'staff.favorite') active @endif"><a
                                href="{{ route('staff.favorite')}}"><i class="la la-bookmark-o"></i>Việc làm đã lưu</a>
                        </li>
                        <li class="@if($currentRouteName == 'staff.job-applied') active @endif"><a
                                href="{{ route('staff.job-applied')}}"><i class="la la-briefcase"></i>Việc làm đã
                                nộp</a>
                        </li>
                        <!-- <li class="@if($currentRouteName == '#') active @endif"><a href="#"><i
                                    class="la la-file-invoice"></i>Công ty đang theo dõi</a></li> -->
                        <li class="@if($currentRouteName == 'auth.logout') active @endif"><a
                                href="{{ route('auth.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
                    </ul>
                </div>
                @else
                <div class="btn-box">
                    <a href="{{ route('staff.login') }}" class="theme-btn btn-style-three">Đăng nhập / Đăng ký</a>
                    <a href="{{ route('dashboards.index') }}" class="theme-btn btn-style-one">Tin tuyển dụng</a>
                </div>
                @endif
            </div>
        </div>
        @include('website.includes.header.mobile-menu')
</header>