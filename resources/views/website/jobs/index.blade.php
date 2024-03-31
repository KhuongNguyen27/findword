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
                    <div class="inner-column">
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
                                        'bookmark' => true,
                                        'simple' => true,
                                    ])
                                </div>
                                <!-- Job Block -->
                            @endforeach
                        </div>
                        <div class="ls-pagination">
                            {{ $jobs->appends(request()->input())->links() }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Job Section -->

    @include('website.includes.global.ad-banners')

    @include('website.includes.global.attractive-jobs')

    <!-- End News Section -->
@endsection
