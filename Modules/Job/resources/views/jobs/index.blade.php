@extends('job::layouts.master')
@section('title')
Tất cả các công việc
@endsection
@section('content')
<style>
.page-title {
    margin-top: 100px;
}
</style>
<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1>Tất cả các công việc</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li><a href="{{ route('employee.index') }}">Nhà tuyển dụng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- Listing Section -->
<section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>

        <div class="row">

            <!-- Filter Search -->
            @include('job::includes.components.filters')

            <!-- Content Column -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>

                    <!-- ls Switcher -->
                    <div class="ls-switcher">
                        <div class="showing-result">
                            <!-- <div class="text">Showing <strong>41-60</strong> of <strong>944</strong> jobs</div> -->
                        </div>
                        <form action="" method="get">
                            <div class="sort-by">
                                <select class="chosen-select" name="searchTypeWork" onchange="this.form.submit()">
                                    <option selected disabled>----Search Type Work----</option>
                                    <option value="1" @selected($request->searchTypeWork == '1')>1</option>
                                    <option value="Type 1" @selected($request->searchTypeWork == 'Type 1')>Type 1
                                    </option>
                                    <option value="0" @selected($request->searchTypeWork == '0')>0</option>
                                </select>
                                <select class="chosen-select" name="pagination" onchange="this.form.submit()">
                                    <option selected disabled>----Pagination----</option>
                                    <option value="10" @selected($request->pagination == '10')>Show 10</option>
                                    <option value="20" @selected($request->pagination == '20')>Show 20</option>
                                    <option value="30" @selected($request->pagination == '30')>Show 30</option>
                                    <option value="40" @selected($request->pagination == '40')>Show 40</option>
                                    <option value="50" @selected($request->pagination == '50')>Show 50</option>
                                    <option value="60" @selected($request->pagination == '60')>Show 60</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- Job Block -->
                    @foreach($items as $item)
                    <div class="job-block">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="{{ asset($item->image_fm) }}" alt=""></span>
                                <h4><a href="{{ route('website.jobs.show', $item->id) }}">{{$item->name}}</a></h4>
                                <div>
                                    {{$item->description}}
                                </div>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Ngành nghề (Career)</li>
                                    <li><span class="icon flaticon-map-locator"></span>{{$item->work_address}}</li>
                                    <li><span class="icon flaticon-clock-3"></span>{{ $item->time_create }}</li>
                                    <li><span class="icon flaticon-money"></span>{{$item->wage_fm}} đ</li>
                                </ul>
                                <ul class="job-other-info">
                                    <li class="time">Thời gian làm việc (Type_work)</li>
                                    <li class="privacy">Private</li>
                                    <li class="required">Urgent</li>
                                </ul>
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Listing Show More -->
                    @include('job::includes.components.pagination')
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Listing Page Section -->

@endsection
@section('footer')
<script>
$(document).ready(function() {
    $('.job_favorite').on('click', function(e) {
        var btnWhitlist = $(this)
        e.preventDefault();

        var url = $(this).data('href');

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (response.type == 'add') {
                        btnWhitlist.find('span').addClass('active');
                    } else {
                        btnWhitlist.find('span').removeClass('active');
                    }
                }
            },
            error: function() {}
        });
    });
});
</script>
@endsection