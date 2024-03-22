@extends('website.layouts.master')
@section('content')

<!-- Banner Section-->
<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<section class="banner-section pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column" >
                    <div class="title-box">
                        <h3>{{ $title }}</h3>
                        <div class="text">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn doanh nghiệp
                            uy tín tại Việt Nam</div>
                    </div>
                    <!-- Job Search Form -->
                    @include('website.homes.includes.job-search-form')
                    <!-- Job Search Form -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner Section-->

<!-- Job Section -->
<section class="ls-section pt-5 pb-5" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Việc làm mới nhất</h2>
        </div>
        <div class="row">
            <div class="content-column col-lg-12">
                <div class="ls-outer">
                    <div class="ls-switcher">

                    </div>
                    <div class="row">
                        @foreach ($jobs as $job)
                        <!-- Job Block -->
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            @include('job::includes.components.job-item', [
                                'job' => $job,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'simple' => true,
                            ])
                        </div>
                        <!-- Job Block -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Job Section -->

<!-- Top Companies -->
<section class="top-companies pt-5 pb-5">
    <div class="auto-container">
        <div class="carousel-outer wow fadeInUp">
            <div class="companies-carousel owl-carousel owl-theme default-dots">
                <div class="company-block-item">
                    <figure class="image"><img src="https://static.topcv.vn/img/Sa%CC%89n%20pha%CC%82%CC%89m_%20di%CC%A3ch%20vu%CC%A3%201.png" alt=""></figure>
                </div>
                <div class="company-block-item">
                    <figure class="image"><img src="https://static.topcv.vn/img/Banner_Center%20(1).png" alt=""></figure>
                </div>
                <div class="company-block-item">
                    <figure class="image"><img src="https://static.topcv.vn/img/Apollo%20(2)%20(1).png" alt=""></figure>
                </div>
                <div class="company-block-item">
                    <figure class="image"><img src="https://static.topcv.vn/img/Gia%CC%81%20tri%CC%A3.png" alt=""></figure>
                </div>
                <div class="company-block-item">
                    <figure class="image"><img src="https://static.topcv.vn/img/Banner_Center%20(1).png" alt=""></figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Companies -->

<section class="ls-section pt-5 pb-5" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-9">
                <div class="ls-outer">
                    <div class="ls-switcher">

                    </div>
                    <div class="sec-title mb-4">
                        <h2>Việc làm hấp dẫn</h2>
                    </div>
                    <div class="row">
                        @foreach ($jobs as $job)
                        <!-- Job Block -->
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            @include('job::includes.components.job-item', [
                                'job' => $job,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'simple' => true,
                            ])
                        </div>
                        <!-- Job Block -->
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <img src="https://static.topcv.vn/img/Banner%20R1.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- End News Section -->
@endsection