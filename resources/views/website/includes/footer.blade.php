@include('website.includes.global.news')

<!-- Main Footer -->
<footer class="main-footer pt-5 pb-5">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section wow fadeInUp">
            <div class="row">
                <div class="big-column col-xl-4 col-lg-3 col-md-12">
                    <div class="footer-column about-widget">
                        <div class="logo"><a href="{{ route('home') }}" class="fw-bold fs-4 text-black"><img
                                    style="width:600px;margin-left:-10%" height="50"
                                    src="{{ asset('website-assets/images/logo-footer.png')}}" alt="" title=""></a></div>
                        <p class="phone-num"><span>
                                Gọi cho chúng tôi </span><a href="thebeehost@support.com">0817 198 779</a></p>
                        <p class="address">CM2-03A Eco Garden, Thủy Vân, Thừa Thiên Huế<br><a
                                href="mailto:info@timviecsieunhanh.vn" class="email">info@timviecsieunhanh.vn</a></p>
                        <p>Fanpage: <a
                                href="https://www.facebook.com/timviecsieunhanhOfficial">timviecsieunhanhOfficial</a>
                        </p>
                    </div>
                </div>

                <div class="big-column col-xl-8 col-lg-9 col-md-12">
                    <div class="row">


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Tìm việc siêu nhanh</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{route('pages.show','gioi-thieu')}}">Giới thiệu</a></li>
                                        <li><a href="{{route('pages.show','lien-he')}}">Liên hệ</a></li>
                                        <li><a href="{{route('pages.show','goc-tin-tuc')}}">Góc tin tức</a></li>
                                        <li><a href="{{route('pages.show','chinh-sach-bao-mat')}}">Chính sách bảo mật</a></li>
                                        <li><a href="{{route('pages.show','dieu-khoan-su-dung-ung-vien')}}">Điều khoản sử dụng ứng viên</a></li>
                                        <li><a href="{{route('pages.show','dieu-khoan-su-dung-nha-tuyen-dung')}}">Điều khoản sử dụng nhà tuyển dụng</a></li>
                                        <li><a href="{{route('pages.show','quy-che-hoat-dong')}}">Quy chế hoạt động</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">
                                    Việc làm trong nước</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('jobs.vnjobs','today') }}">Việc làm hôm nay</a></li>
                                        <li><a href="{{ route('jobs.vnjobs','hot') }}">Việc làm hót nhất</a></li>
                                        <li><a href="{{ route('jobs.vnjobs','urgent') }}">Việc làm tuyển gấp</a></li>
                                        <!-- <li><a href="{{route('pages.show','dieu-khoan-su-dung')}}">Điều khoản sử
                                                dụng</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">
                                    Việc làm ngoài nước</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('jobs.nnjobs','today') }}">Việc làm hôm nay</a></li>
                                        <li><a href="{{ route('jobs.nnjobs','hot') }}">Việc làm hót nhất</a></li>
                                        <li><a href="{{ route('jobs.nnjobs','urgent') }}">Việc làm tuyển gấp</a></li>
                                        <!-- <li><a href="{{route('pages.show','dieu-khoan-su-dung')}}">Điều khoản sử
                                                dụng</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Về chúng tôi</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Trang việc làm</a></li>
                                        <li><a href="#">Trang việc làm thay thế</a></li>
                                        <li><a href="#">Trang tiếp tục</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Hồ sơ & CV</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('staff.profile.index') }}">Hồ sơ cá nhân</a></li>
                                        <li><a href="{{ route('staff.job-applied') }}">Việc làm đã nộp</a></li>
                                        <li><a href="{{ route('cvs.index') }}">Mẫu CV</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="outer-box">
                <div class="copyright-text">© 2024 <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>. All Right
                    Reserved.
                    <br><span style="font-size:12px;"> {{__('Website_is_undergoing_upgrades_and_development')}} </span>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
</footer>
<!-- End Main Footer -->
<div id="button-contact-vr" class="">
    <div id="gom-all-in-one">
        <!-- v3 -->
        <!-- zalo -->
        <div id="zalo-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a target="_blank" href="https://zalo.me/0589595143">
                        <img alt="Zalo"
                            src="https://anhhuyvt.rrtech247.com/wp-content/plugins/button-contact-vr/img/zalo.png">
                    </a>
                </div>
            </div>
        </div>
        <!-- end zalo -->
        <!-- Phone -->
        <div id="phone-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:0965358381">
                        <img alt="Phone"
                            src="https://anhhuyvt.rrtech247.com/wp-content/plugins/button-contact-vr/img/phone.png">
                    </a>
                </div>
            </div>
        </div>
        <!-- end phone -->
    </div><!-- end v3 class gom-all-in-one -->
</div>