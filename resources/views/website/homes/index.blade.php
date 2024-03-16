@extends('website.layouts.master')
@section('content')

<!-- Banner Section-->
<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<section class="banner-section">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column wow fadeInUp" data-wow-delay="1000ms">
                    <div class="title-box">
                        <h3>Tìm việc làm nhanh 24h, việc làm mới nhất trên toàn quốc.</h3>
                        <div class="text">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn doanh nghiệp uy tín tại Việt Nam</div>
                    </div>
                    <!-- Job Search Form -->
                    @include('website.homes.includes.job-search-form')
                    <!-- Job Search Form -->
                    <!-- Popular Search -->
                    <!-- <div class="popular-searches">
                        <span class="title">Tìm kiếm phổ biến : </span>
                        <a href="#">Designer</a>,
                        <a href="#">Developer</a>,
                        <a href="#">Web</a>,
                        <a href="#">IOS</a>,
                        <a href="#">PHP</a>,
                        <a href="#">Senior</a>,
                        <a href="#">Engineer</a>,
                    </div> -->
                    <!-- End Popular Search -->
                </div>
            </div>

            <!-- <div class="image-column col-lg-5 col-md-12">
                <div class="image-box">
                    <figure class="main-image wow fadeIn" data-wow-delay="500ms"><img
                            src="https://static.topcv.vn/v4/image/welcome/superior-tool/superior-tool-bg.png?v=1.0.1" alt="">
                    </figure>

                    <div class="info_block anm wow fadeIn" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
                        <div class="icon">
                            <img src="https://static.topcv.vn/v4/image/welcome/superior-tool/gross-net.png" alt="">
                        </div>
                        <p>Tính lương GROSS - NET</p>
                        <a href="">Khám phá ngay</a>
                    </div>

                    <div class="info_block_two anm wow fadeIn" data-wow-delay="2000ms" data-speed-x="1"
                        data-speed-y="1">
                        <p>10k+ Candidates</p>
                        <div class="image"><img src="{{ asset('website-assets/images/resource/multi-peoples.png') }}"
                                alt=""></div>
                    </div>

                    <div class="info_block_three anm wow fadeIn" data-wow-delay="1500ms" data-speed-x="4"
                        data-speed-y="4">
                        <span class="icon flaticon-briefcase"></span>
                        <p>Creative Agency</p>
                        <span class="sub-text">Startup</span>
                        <span class="right_icon fa fa-check"></span>
                    </div>

                    <div class="info_block_four anm wow fadeIn" data-wow-delay="2500ms" data-speed-x="3"
                        data-speed-y="3">
                        <span class="icon flaticon-file"></span>
                        <div class="inner">
                            <p>Upload Your CV</p>
                            <span class="sub-text">It only takes a few seconds</span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Banner Section-->

<!-- Job Categories -->
@include('website.homes.includes.job-categories')
<!-- End Job Categories -->

<!-- Job Section -->
<section class="job-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Việc làm mới nhất</h2>
            <div class="text">Biết giá trị của bạn và tìm công việc phù hợp với cuộc sống của bạn</div>
        </div>

        <div class="row wow fadeInUp">
            @foreach ($jobs as $job)
            <!-- Job Block -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                @include('job::includes.components.job-item', [
                'job' => $job,
                'job_info' => true,
                'job_other_info' => true,
                'bookmark' => true,
                ])
            </div>
            @endforeach
        </div>

        <div class="btn-box">
            <a href="#" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Tải thêm danh
                    sách</span></a>
        </div>
    </div>
</section>
<!-- End Job Section -->

<!-- Testimonial Section -->
<section class="testimonial-section">
    <div class="container-fluid">
        <!-- Sec Title -->
        <div class="sec-title text-center">
            <h2>Công ty tuyển dụng hàng đầu QT</h2>
            {{-- <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor</div> --}}
        </div>

        <div class="carousel-outer wow fadeInUp">

            <!-- Testimonial Carousel -->
            <div class="testimonial-carousel owl-carousel owl-theme">

                <!--Testimonial Block -->
                <div class="testimonial-block">
                    <div class="inner-box">
                        @foreach ($employees as $employee)
                        <div>
                            <h4 class="title">{{ $employee->name }}</h4>
                            <div class="text"><span class="icon flaticon-map-locator"></span> {{ $employee->address }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- End Testimonial Section -->


<section class="job-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Nhà tuyển dụng nổi bật</h2>
        </div>

        <div class="row wow fadeInUp">
            @foreach ($employees->take(4) as $employer)
            <!-- Job Block -->
            <div class="job-block col-lg-6 col-md-12 col-sm-12">
                <div class="inner-box">
                    <div class="content">
                        <span class="company-logo"><img src="{!! $employer->image_fm  !!}" alt=""></span>
                        <h4><a href="#">{{ $employer->name }}</a></h4>
                        <ul class="job-info">
                            <li><span class="icon flaticon-map-locator"></span> {{ $employer->address }}</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Job Section -->

<!-- End Job Section -->



<!-- News Section -->
<section class="news-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Việc làm theo ngành nghề</h2>
            {{-- <div class="text">Fresh job related news content posted each day.</div> --}}
        </div>

        <div class="row wow fadeInUp">
            <!-- News Block -->
            @foreach ( $items as $item)

            <div class="news-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image-box">
                        {{-- <figure class="image"><img src="{{ asset('website-assets/images/resource/news-1.jpg') }}"
                        alt="" /></figure> --}}
                    </div>
                    <div class="lower-content">
                        <h3><a href="#">{{ $item->name }}</a></h3>
                        <p class="text">{{ $item->description }}</p>
                        {{-- <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a> --}}
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>
<!-- End News Section -->
@endsection
