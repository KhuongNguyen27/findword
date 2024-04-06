<nav class="nav main-menu">
    <ul class="navigation" id="navbar">
        <li class="dropdown">
            <span>Việc làm</span>
            <ul>
                <li><a href="#">Việc làm mới nhất</a></li>
                <li><a href="#">Việc làm hot nhất</a></li>
            </ul>
        </li>

        <li><a href="{{ route('home') }}">Công việc</a></li>
        <li><a href="{{ route('employee.index') }}">Nhà tuyển dụng</a></li>
        <li><a href="{{ route('prices.index') }}">Bảng giá</a></li>
        <li><a href="{{ route('contacts.index') }}">Liên hệ</a></li>


        <!-- Only for Mobile View -->
        <li class="mm-add-listing">
            <a href="add-listing.html" class="theme-btn btn-style-one">Job Post</a>
            <span>
                <span class="contact-info">
                    <span class="phone-num"><span>Call us</span><a href="tel:1234567890">123 456 7890</a></span>
                    <span class="address">329 Queensberry Street, North Melbourne VIC <br>3051, Australia.</span>
                    <a href="mailto:support@{{ env('APP_NAME') }}.com" class="email">support@{{ env('APP_NAME') }}.com</a>
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