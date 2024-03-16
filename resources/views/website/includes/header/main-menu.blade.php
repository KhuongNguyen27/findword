<nav class="nav main-menu">
    <ul class="navigation" id="navbar">
        <li class="dropdown">
            <a href="{{ route('website.home') }}?country=VietNam">Việc làm trong nước</a>
            <ul>
                <li><a href="#">Việc làm hôm nay</a></li>
                <li><a href="#">Việc làm hot nhất</a></li>
                <li><a href="#">Tuyển gấp</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="{{ route('website.home') }}">Việc làm ngoài nước</a>
            <ul>
                <li><a href="#">Việc làm hôm nay</a></li>
                <li><a href="#">Việc làm hot nhất</a></li>
                <li><a href="#">Tuyển gấp</a></li>

            </ul>
        </li>

        <li><a href="{{ route('employee.index') }}">Công ty</a></li>

        <li class="dropdown">
            <a href="javascript:;">Hồ sơ & CV</a>
            <ul>
                <li><a href="{{ route('staff.profile.index') }}">Hồ sơ cá nhân</a></li>
                <li><a href="#">Mẫu CV Hot</a></li>
                <li><a href="#">Mẫu CV theo ngành nghề</a></li>
            </ul>
        </li>
        @if (Auth::check() && (Auth::user()->type == "employee"))
        <li><a href="{{ route('prices.index') }}">Bảng giá</a></li>
        @endif






        <!-- Only for Mobile View -->
        <li class="mm-add-listing">
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
        </li>
    </ul>
</nav>