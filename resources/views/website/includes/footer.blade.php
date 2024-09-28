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
                        <p>{{ __('footer.company_name') }}</p>
                        <!-- <p>Người đại diện theo pháp luật: NGUYỄN VĂN CHOI</p> -->
                            <p class="address">{{ __('footer.address') }}</p>
                        <p class="phone-num"><i class="fas fa-phone"></i><a href="tel:02343888333">{{ __('footer.phone_number') }}</a></p>

                        <p class="email-e"><i class="fas fa-envelope email-icon"></i><a
                                href="mailto:info@timviecsieunhanh.vn" class="email">{{ __('footer.email') }}
                            </a>
                        </p>
                        <p class="fanpages-f"> <i class="fab fa-facebook-square page-icon"></i><a
                                href="https://www.facebook.com/timviecsieunhanhOfficial"
                                class="fanpages">{{ __('footer.facebook') }}</a></p>

                        <p>{{ __('footer.company_registration') }}</p>
                        <p>{{ __('footer.employment_license') }}</p>
                </div>
                </div>

                <div class="big-column col-xl-8 col-lg-9 col-md-12">
                    <div class="row">


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">{{ __('footer.about_us') }}</h4>
                                <div class="widget-content">
                                       <ul class="list">
                                        <li><a href="{{route('pages.show','gioi-thieu')}}">{{ __('footer.intro') }}</a></li>
                                        <li><a href="{{route('pages.show','lien-he')}}">{{ __('footer.contact') }}</a></li>
                                        <li><a href="{{route('pages.show','goc-tin-tuc')}}">{{ __('footer.news') }}</a></li>
                                        <li><a href="{{route('pages.show','chinh-sach-bao-mat')}}">{{ __('footer.privacy_policy') }}</a></li>
                                        <li><a href="{{route('pages.show','dieu-khoan-su-dung')}}">{{ __('footer.terms_of_use') }}</a></li>
                                        <li><a href="{{route('htmlpages.quy-che-hoat-dong')}}">{{ __('footer.operation_regulations') }}</a></li>
                                        <li><a href="{{route('pages.show','giai-quyet-khieu-nai')}}">{{ __('footer.complaints_resolution') }}</a></li>
                                    </ul>
                                    <a href='http://online.gov.vn/Home/WebDetails/115657'><img alt='' title='' src='{{asset('/website-assets/images/logoCCDV.png')}}' ></a>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                  <h4 class="widget-title">{{ __('footer.domestic_jobs') }}</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                         <li><a href="{{ route('jobs.vnjobs','today') }}">{{ __('footer.today_jobs') }}</a></li>
                                        <li><a href="{{ route('jobs.vnjobs','hot') }}">{{ __('footer.hot_jobs') }}</a></li>
                                        <li><a href="{{ route('jobs.vnjobs','urgent') }}">{{ __('footer.urgent_jobs') }}</a></li>
                                        <!-- <li><a href="{{route('pages.show','dieu-khoan-su-dung')}}">Điều khoản sử
                                                dụng</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                 <h4 class="widget-title">{{ __('footer.overseas_jobs') }}</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                       <li><a href="{{ route('jobs.nnjobs','today') }}">{{ __('footer.today_jobs') }}</a></li>
                                        <li><a href="{{ route('jobs.nnjobs','hot') }}">{{ __('footer.hot_jobs') }}</a></li>
                                        <li><a href="{{ route('jobs.nnjobs','urgent') }}">{{ __('footer.urgent_jobs') }}</a></li>
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
                                <h4 class="widget-title">{{ __('footer.profile_cv') }}</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                       <li><a href="{{ route('staff.profile.index') }}">{{ __('footer.personal_profile') }}</a></li>
                                        <li><a href="{{ route('staff.job-applied') }}">{{ __('footer.applied_jobs') }}</a></li>
                                        <li><a href="{{ route('cvs.index') }}">{{ __('footer.cv_templates') }}</a></li>
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
                                <div class="copyright-text">© 2024 <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>. {{ __('footer.all_rights_reserved') }}</div>
                <!-- <h4 style="color: #696969">website đang thử nghiệm....
                </h4> -->
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
                    <a target="_blank" href="https://zalo.me/0817198779">
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
                    <a href="tel:02343888333">
                        <img alt="Phone"
                            src="https://anhhuyvt.rrtech247.com/wp-content/plugins/button-contact-vr/img/phone.png">
                    </a>
                </div>
            </div>
        </div>
        <!-- end phone -->
    </div><!-- end v3 class gom-all-in-one -->
</div>