<!-- Top Companies -->
<section class="top-companies">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Top Công ty hàng đầu</h2>
            <!-- <div class="text">Some of the companies we've helped recruit excellent applicants over the years.</div> -->
        </div>

        <div class="carousel-outer wow fadeInUp">
            <div class="companies-carousel owl-carousel owl-theme default-dots">
                @foreach ($employees as $employee)
                <!-- Company Block -->
                <div class="company-block">
                    <div class="inner-box">
                        <figure class="image"><img src="https://static.topcv.vn/company_logos/cong-ty-co-phan-dong-tam-5a124d52ca87c_rs.jpg" alt=""></figure>
                        <h4 class="name">Công ty Cổ phần Đồng Tâm</h4>
                        <!-- <div class="location"><i class="flaticon-map-locator"></i> London, UK</div> -->
                        <!-- <a href="#" class="theme-btn btn-style-three">15 Open Position</a> -->
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- End Top Companies -->