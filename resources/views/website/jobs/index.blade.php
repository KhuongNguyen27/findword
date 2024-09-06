@extends('website.layouts.master')
@section('title')
{{ $title }}
@endsection
@section('content')
<section class="banner-section pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="title-box">
                        <h1>{{ $title }}</h1>
                        <div class="text">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn doanh nghiệp
                            uy tín tại Việt Nam</div>
                    </div>
                    <!-- Job Search Form -->
                    @if($route == 'jobs.vnjobs')
                    @include('website.homes.includes.job-search-form',['route_index' => route("jobs.vnjobs", ['job_type'=> 'tat-ca'])])
                    @else
                    @include('website.homes.includes.job-search-form',['route_index' => route("jobs.nnjobs", ['job_type'=> 'tat-ca'])])
                    @endif
                    @include('website.homes.includes.hero-banner')
                    <!-- Job Search Form -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner Section-->


<!-- Job Section -->
@include('website.homes.includes.job-items', [
'sec_title' => $title,
'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'chunk_jobs' => $jobs,
'sec_link' => route($route, 'moi-nhat'),
])
<!-- End Job Section -->

@include('website.includes.global.ad-banners')

@include('website.includes.global.attractive-jobs')


<!-- End News Section -->
@endsection
