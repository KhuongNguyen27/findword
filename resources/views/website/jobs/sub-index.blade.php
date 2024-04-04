@extends('website.layouts.master')
@section('title') {{ $title }} @endsection
@section('content')
<section class="sub-banner-section pb-0" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="banner">
            <div class="row">
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box">
                            <h3 class="title">{{ $title }}</h3>
                            <div class="description">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn
                                doanh nghiệp
                                uy tín tại Việt Nam</div>
                        </div>
                        <!-- Job Search Form -->
                        @include('website.homes.includes.job-search-form')
                        <!-- Job Search Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Section-->

<!-- Job Section -->
<section class="ls-section pt-0 pb-5" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="jobs-wrapper bg-white">
            <div class="row">
                <div class="content-column col-lg-12">
                    <div class="ls-outer">
                        <div class="ls-switcher">

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        @foreach ($jobs as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'job_other_info' => true,
                                            'bookmark' => true,
                                            'simple' => false,
                                            'company_name' => true,
                                            ])
                                        </div>
                                        <!-- Job Block -->
                                        @endforeach
                                    </div>
                                    <div class="col-lg-4">
                                        @include('website.includes.global.attractive-banner')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ls-pagination">
                            {{ $jobs->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Job Section -->
<!-- End News Section -->
@endsection