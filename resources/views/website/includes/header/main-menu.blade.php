@php
$currentRouteName = \Request::route()->getName();
@endphp
<style>
/* CSS to hide mobile-only links on larger screens */
@media (min-width: 768px) {
    .mobile-only {
        display: none;
    }
}
</style>
<nav class="nav main-menu">
    <ul class="navigation" id="navbar">

        @guest
           <li class="mobile-only"><strong>{{ __('header.danh_cho_ung_vien') }}</strong></li>
        <li class="mobile-only"><a href="{{ route('staff.login') }}">{{ __('header.dang_nhap') }}</a></li>
        <li class="mobile-only"><a href="{{ route('staff.register') }}">{{ __('header.dang_ki_tai_khoan_moi') }}</a></li>
        @endguest



        <li class="dropdown">
            <a class="@if ($currentRouteName == 'jobs.vnjobs') active @endif" href="{{ route('jobs.vnjobs') }}">{{ __('header.viec_lam_trong_nuoc') }}</a>
            <ul>
                <li><a href="{{ route('jobs.vnjobs', 'today') }}">{{ __('header.viec_lam_hom_nay') }}</a></li>
                <li><a href="{{ route('jobs.vnjobs', 'hot') }}">{{ __('header.viec_lam_hot') }}</a></li>
                <li><a href="{{ route('jobs.vnjobs', 'urgent') }}">{{ __('header.tuyen_gap') }}</a></li>
            </ul>
        </li>



        <li class="dropdown">
            <a class="@if ($currentRouteName == 'jobs.nnjobs') active @endif" href="{{ route('jobs.nnjobs') }}">Việc làm ngoài nước</a>
            <ul>
               <li><a href="{{ route('jobs.nnjobs', 'today') }}">{{ __('header.viec_lam_hom_nay') }}</a></li>
                <li><a href="{{ route('jobs.nnjobs', 'hot') }}">{{ __('header.viec_lam_hot') }}</a></li>
                <li><a href="{{ route('jobs.nnjobs', 'urgent') }}">{{ __('header.tuyen_gap') }}</a></li>
            </ul>
        </li>

        <li><a class="@if ($currentRouteName == 'employees.index') active @endif"
                href="{{ route('employees.index') }}">{{ __('header.cong_ty') }}</a></li>

        <li class="dropdown">
            <a class="@if ($currentRouteName == 'cvs.index') active @endif" href="javascript:;">{{ __('header.ho_so_cv') }}</a>
            <ul>
                <li><a href="{{ route('staff.profile.index') }}">{{ __('header.ho_so_ca_nhan') }}</a></li>
                <li><a href="{{ route('staff.job-applied') }}">{{ __('header.viec_lam_da_nop') }}</a></li>
                <li><a href="{{ route('cvs.index') }}">{{ __('header.mau_cv') }}</a></li>
            </ul>
        </li>
        @if (Auth::check() && (Auth::user()->type == "employee"))
          <li><a class="@if ($currentRouteName == 'website.account.index') active @endif" href="{{ route('website.account.index') }}">{{ __('header.bang_gia') }}</a></li>
        <li><a class="@if ($currentRouteName == 'website.jobpackage.index') active @endif" href="{{ route('website.jobpackage.index') }}">{{ __('header.dac_quyen_tin') }}</a></li>
        @endif

        <!-- Dành cho nhà tuyển dụng -->
        @guest
        <li class="mobile-only"><strong>{{ __('header.danh_cho_ntd') }}</strong></li>
        <li class="mobile-only"><a href="{{ route('employee.login') }}">{{ __('header.dang_tuyen') }}</a></li>
        @endguest
        <!-- Only for Mobile View -->

        <!-- <li class="mm-add-listing">
            <a href="add-listing.html" class="theme-btn btn-style-one">Job Post</a>
            <span>
                <span class="contact-info">
                    <span class="phone-num"><span>Call us</span><a href="tel:1234567890">123 456 7890</a></span>
                    <span class="address">329 Queensberry Street, North Melbourne VIC <br>3051, Australia.</span>
                    <a href="mailto:support@superio.com" class="email">support@superio.com</a>
                </span>
                <span class="social-links">
                    <a href="#"><span class="fab fa-facebook-f"></span></a>
                    <a href="#"><span class="fab fa-twitter"></span></a>
                    <a href="#"><span class="fab fa-instagram"></span></a>
                    <a href="#"><span class="fab fa-linkedin-in"></span></a>
                </span>
            </span>
        </li> -->
    </ul>
</nav>