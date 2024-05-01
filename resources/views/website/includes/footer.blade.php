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
                                <p>Fanpage: <a href="https://www.facebook.com/timviecsieunhanhOfficial">timviecsieunhanhOfficial</a></p>
                    </div>
                </div>

                <div class="big-column col-xl-8 col-lg-9 col-md-12">
                    <div class="row">
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">
                                    Dành cho ứng viên</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Duyệt công việc</a></li>
                                        <li><a href="#">Duyệt danh mục</a></li>
                                        <li><a href="#">Trang tổng quan về ứng viên</a></li>
                                        <li><a href="#">Thông báo công việc</a></li>
                                        <li><a href="#">Đánh dấu của tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">
                                    Nhà tuyển dụng</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Duyệt ứng viên</a></li>
                                        <li><a href="#">Trang cho nhà tuyển dụng</a></li>
                                        <li><a href="#">Thêm công việc</a></li>
                                        <li><a href="#">Gói công việc</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
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
                        </div>


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Tài nguyên hữu ích</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Sơ đồ trang web</a></li>
                                        <li><a href="#">Điều khoản sử dụng</a></li>
                                        <li><a href="#">Trung tâm bảo mật</a></li>
                                        <li><a href="#">Trung tâm bảo vệ</a></li>
                                        <li><a href="#">Trung tâm trợ năng</a></li>
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
                <div class="copyright-text">© 2024 <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>. All Right Reserved.
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
