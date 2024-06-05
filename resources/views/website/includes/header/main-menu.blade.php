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
        <li class="mobile-only"><strong>Dành cho ứng viên</strong></li>
        <li class="mobile-only"><a href="{{ route('staff.login') }}">Đăng nhập</a></li>
        <li class="mobile-only"><a href="{{ route('staff.register') }}">Đăng kí tài khoản mới</a></li>
        @endguest



        <li class="dropdown">
            <a class="@if ($currentRouteName == 'jobs.vnjobs') active @endif" href="{{ route('jobs.vnjobs') }}">Việc làm
                trong nước</a>
            <ul>
                <li><a href="{{ route('jobs.vnjobs', 'today') }}">Việc làm Hôm nay</a></li>
                <li><a href="{{ route('jobs.vnjobs', 'hot') }}">Việc làm Hot nhất</a></li>
                <li><a href="{{ route('jobs.vnjobs', 'urgent') }}">Tuyển gấp</a></li>
            </ul>
        </li>



        <li class="dropdown">
            <a class="@if ($currentRouteName == 'jobs.nnjobs') active @endif" href="{{ route('jobs.nnjobs') }}">Việc làm
                ngoài nước</a>
            <ul>
                <li><a href="{{ route('jobs.nnjobs', 'today') }}">Việc làm Hôm nay</a></li>
                <li><a href="{{ route('jobs.nnjobs', 'hot') }}">Việc làm Hot nhất</a></li>
                <li><a href="{{ route('jobs.nnjobs', 'urgent') }}">Tuyển gấp</a></li>
            </ul>
        </li>

        <li><a class="@if ($currentRouteName == 'employees.index') active @endif"
                href="{{ route('employees.index') }}">Công ty</a></li>

        <li class="dropdown">
            <a class="@if ($currentRouteName == 'cvs.index') active @endif" href="javascript:;">Hồ sơ & CV</a>
            <ul>
                <li><a href="{{ route('staff.profile.index') }}">Hồ sơ cá nhân</a></li>
                <li><a href="{{ route('staff.job-applied') }}">Việc làm đã nộp</a></li>
                <li><a href="{{ route('cvs.index') }}">Mẫu CV</a></li>
            </ul>
        </li>
        @if (Auth::check() && (Auth::user()->type == "employee"))
        <li><a class="@if ($currentRouteName == 'website.account.index') active @endif"
                href="{{ route('website.account.index') }}">Bảng giá</a></li>
        <li><a class="@if ($currentRouteName == 'website.account.index') active @endif"
                href="{{route('pages.show', 'dac-quyen-tin')}}">Đặc quyền Tin</a></li>
        @endif

        <!-- Dành cho nhà tuyển dụng -->
        @guest
        <li class="mobile-only"><strong>Dành cho nhà tuyển dụng</strong></li>
        <li class="mobile-only"><a href="{{ route('employee.login') }}">Đăng tuyển</a></li>
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