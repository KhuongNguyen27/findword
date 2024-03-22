@php
$currentRouteName = \Request::route()->getName();
@endphp
<header class="main-header">
    <div class="main-box">
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo">
                    <a href="{{ route('home') }}" class="fw-bold fs-4 text-black">
                        <img style="width:80px!important" height="50" src="{{ asset('website-assets/images/logo.png')}}">
                        <span>{{ __('hue_find_work') }}</span>
                    </a>
                </div>
            </div>
            @include('website.includes.header.main-menu')
        </div>
        <div class="outer-box">
            @if(Auth::check())
                @if(Auth::user()->type == "employee")
                <button class="menu-btn">
                    <span class="icon flaticon-money-1"></span>
                    <span class="fs-4" style="color:#202124">{{ number_format(Auth::user()->points, 0, '', '.') ?? 0 }}P</span>
                </button>
                @endif
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
                    <span>{{ __('hello') }}, {{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->type == 'staff')
                    <li class="@if($currentRouteName == 'staff.home') active @endif"><a
                            href="{{ route('staff.home')}}"><i class="la la-box"></i>{{ __('dashboard') }}</a></li>
                    <li
                        class="@if($currentRouteName == 'staff.profile.index' || $currentRouteName == 'staff.home1') active @endif">
                        <a href="{{ route('staff.profile.index')}}"> <i class="la la-user-alt"></i>
                            {{ __('personal_information') }}
                        </a>
                    </li>
                    <li class="@if($currentRouteName == 'staff.cv.index') active @endif"><a
                            href="{{ route('staff.cv.index')}}"><i class="la la-box"></i>{{ __('profile_list') }}</a></li>
                    <li class="@if($currentRouteName == 'staff.favorite') active @endif"><a
                            href="{{ route('staff.favorite')}}"><i class="la la-bookmark-o"></i>{{ __('save_job') }}</a>
                    </li>
                    <li class="@if($currentRouteName == 'staff.job-applied') active @endif">
                        <a href="{{ route('staff.job-applied')}}"><i class="la la-briefcase"></i>
                           {{ __('submit_job') }}
                        </a>
                    </li>
                    <li class="@if($currentRouteName == '#') active @endif">
                        <a href="#"><i class="la la-file-invoice"></i>
                            {{ __('company_is_tracking') }}
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->type == 'employee')
                    <li class="@if($currentRouteName == 'employee.home') active @endif"><a
                            href="{{ route('employee.home')}}"><i class="la la-box"></i>{{ __('dashboard') }}</a>
                    <li>
                    <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>{{ __('profile') }}</a></li>
                    <li><a href="{{ route('employee.job.create')}}"><i class="la la-paper-plane"></i>{{ __('post') }}</a></li>
                    <li><a href="{{ route('employee.job.index')}}"><i class="la la-briefcase"></i>
                            {{ __('work_manager') }}
                        </a>
                    </li>
                    <li><a href="{{ route('employee.cv.index')}}"><i class="la la-box"></i>{{ __('cv_manager') }}</a></li>
                    <li><a href="{{ route('employee.transaction.index')}}"><i class="la la-box"></i>
                            {{ __('transaction_manager') }}
                        </a>
                    </li>
                    @endif
                    <li class="@if($currentRouteName == 'auth.logout') active @endif"><a
                            href="{{ route('auth.logout')}}"><i class="la la-sign-out"></i>{{ __('logout') }}</a></li>
                </ul>
            </div>
            @else
            <div class="btn-box">
                <a href="{{ route('staff.login') }}" class="theme-btn btn-style-three">{{ __('login') }} / {{ __('register') }}</a>
                <a href="{{ route('employee.login') }}" class="theme-btn btn-style-one">{{ __('employee') }}</a>
            </div>
            @endif
        </div>
    </div>
    @include('website.includes.header.mobile-menu')
</header>