@extends('website.layouts.master')
@section('content')
<section class="banner-section pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="title-box">
                        <h3>{{ $item->name }}</h3>
                        <div class="text">{{ $item->description }}</div>
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

<section class="ls-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12">
                <div class="ls-outer">
                    <div class="ls-switcher">

                    </div>
                    <div class="row">
                        @foreach ($items as $job)
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection