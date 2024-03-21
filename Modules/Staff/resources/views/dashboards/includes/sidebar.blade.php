@php
    $currentRouteName = \Request::route()->getName();
@endphp
<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop"></div>
<!-- User Sidebar -->
<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="@if ($currentRouteName == 'staff.home') active @endif"><a href="{{ route('staff.home') }}"><i
                        class="la la-box"></i>{{ __('dashboard') }}</a></li>
            <li class="@if ($currentRouteName == 'staff.profile.index' || $currentRouteName == 'staff.home1') active @endif">
                <a href="{{ route('staff.profile.index') }}"> <i class="la la-user-alt"></i>Thông tin cá nhân
                </a>
            </li>
            <li class="@if ($currentRouteName == 'staff.cv.index') active @endif"><a href="{{ route('staff.cv.index') }}"><i
                        class="la la-box"></i>{{ __('profile_list') }}</a></li>
            <li class="@if ($currentRouteName == 'staff.favorite') active @endif"><a href="{{ route('staff.favorite') }}"><i
                        class="la la-bookmark-o"></i>{{ __('save_job') }}</a></li>
            <li class="@if ($currentRouteName == 'staff.job-applied') active @endif"><a href="{{ route('staff.job-applied') }}"><i
                        class="la la-briefcase"></i>{{ __('submit_job') }}</a></li>
            <li class="@if ($currentRouteName == 'staff.profile.editpassword') active @endif"><a href="{{ route('staff.profile.editpassword') }}"><i
                        class="la la-briefcase"></i>{{ __('change_password') }}</a></li>
            {{-- <li><a href="{{ route('staff.profile.editpassword') }}"><i class="la la-box"></i>Đổi mật khẩu</a></li> --}}

            <li class="@if ($currentRouteName == 'auth.logout') active @endif"><a href="{{ route('auth.logout') }}"><i
                        class="la la-sign-out"></i>{{ __('logout') }}</a></li>
        </ul>
    </div>
</div>
<!-- End User Sidebar -->
