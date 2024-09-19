@extends('website.layouts.master')
@section('title')
{{ $title }}
@endsection
@section('content')
<style>
    .box-work-market {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .box-work-market__item {
        align-items: center;
        display: inline-flex;
        gap: 8px;
        padding: 4px 8px;
    }

    .box-work-market__item .item-label {
        color: #263a4d;
        font-size: 16px;
        font-weight: 400;
        letter-spacing: .12px;
        line-height: 16px;
    }

    .box-work-market__item .item-number.number-job-new-today {
        color: #28c1bc;
    }

    .box-work-market__item:not(:first-child):before {
        color: #7f878f;
        content: "•";
        margin-right: 8px;
    }

</style>
@php
$currentDateTime = \Carbon\Carbon::now()->subMinutes(5)->format('H:i d/m/Y');
@endphp
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
                    @include('website.homes.includes.chi-so') 

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
