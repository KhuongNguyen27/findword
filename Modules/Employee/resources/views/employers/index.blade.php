@extends('website.layouts.master')
@section('content')
    <style>
        .page-title {
            margin-top: 100px;
        }
    </style>

    <section class="page-title">
        <div class="auto-container">
            <div class="title-outer">
                <h1>Công Ty</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('employee.index') }}">Trang chủ</a></li>
                    <li>Công Ty</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="ls-section">
        <div class="auto-container">
            <div class="filters-backdrop"></div>

            <div class="row">

                <!-- Filters Column -->
                <div class="filters-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column pd-right">
                        <div class="filters-outer">
                            <button type="button" class="theme-btn close-filters">X</button>

                            <!-- Filter Block -->
                            <div class="filter-block">
                                <h4>Tìm kiếm theo từ khóa</h4>
                                <div class="form-group">
                                    <input type="text" name="listing-search"
                                        placeholder="Chức danh, từ khóa hoặc công ty">
                                    <span class="icon flaticon-search-3"></span>
                                </div>
                            </div>

                            <!-- Filter Block -->
                            <div class="filter-block">
                                <h4>Vị trí</h4>
                                <div class="form-group">
                                    <input type="text" name="listing-search" placeholder="Thành phố hoặc mã bưu điện">
                                    <span class="icon flaticon-map-locator"></span>
                                </div>
                                <p>Bán kính xung quanh điểm đến đã chọn</p>
                                <div class="range-slider-one">
                                    <div
                                        class="area-range-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"
                                            style="left: 0%; width: 50%;"></div><span tabindex="0"
                                            class="ui-slider-handle ui-corner-all ui-state-default"
                                            style="left: 0%;"></span><span tabindex="0"
                                            class="ui-slider-handle ui-corner-all ui-state-default"
                                            style="left: 50%;"></span>
                                    </div>
                                    <div class="input-outer">
                                        <div class="amount-outer"><span class="area-amount">50</span>km</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Call To Action -->
                        <div class="call-to-action-four">
                            <h5>Recruiting?</h5>
                            <p>Advertise your jobs to millions of monthly users and search 15.8 million CVs in our database.
                            </p>
                            <a href="#" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Start
                                    Recruiting
                                    Now</span></a>
                            <div class="image" style="background-image: url(images/resource/ads-bg-4.png);"></div>
                        </div>
                        <!-- End Call To Action -->
                    </div>
                </div>
                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">

                    <style>
                        .btn-group a:focus,
                        .btn-group a:active {
                            text-decoration: underline;
                            font-size: 1.5em;
                        }

                        .com {
                            text-align: center;
                            margin-bottom: 5%;
                            font-size: 10%;
                        }
                        .cover-wraper{
                            height: 150%;
                        }
                    </style>


                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Ls widget -->
                            <div class="ls-widget">
                                <div class="tabs-box">
                                    <div class="widget-title">

                                        <div class="btn-group" role="group" aria-label="">
                                            <button type="button" class="btn btn">
                                                <a href="{{ route('employee.index') }}?type=danhsachcongty">Danh sách công
                                                    ty</a>
                                            </button>
                                            <button type="button" class="btn btn">
                                                <a href="{{ route('employee.index') }}?type=topcongty">Top công ty</a>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="widget-content">

                                        <div class="tabs-box">
                                            <div class="com">
                                                <h4>Danh sách các công ty nổi bật</h4>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <div class="box-company item-hover">
                                                    <div class="company-banner">
                                                        <a
                                                            href="#">
                                                            <div class="cover-wraper">
                                                                <img src="https://static.topcv.vn/company_covers/fpt-information-system-c4ab77dac324c88c3c31e9e8445eb9af-6548a811985a0.jpg"
                                                                    alt="FPT Information System" class="img-fluid">
                                                            </div>
                                                        </a>
                                                        <div class="company-logo">
                                                            <a href="#">
                                                                <img class="img-fluid"
                                                                    src="https://static.topcv.vn/company_logos/fpt-information-system-0568949376dcab14abfb13e3e271447f-6548a75395c0b.jpg"
                                                                    alt="FPT Information System">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="company-info">
                                                        <h3>
                                                            <a href="https://www.topcv.vn/cong-ty/fpt-information-system/157622.html"
                                                                class="company-name" target="_blank">FPT Information
                                                                System</a>
                                                        </h3>
                                                        <div class="company-description">
                                                            <p>" Trong suốt 29 năm phát triển, Công ty Hệ thống Thông tin
                                                                FPT (FPT Information System - FPT IS) là nhà tích hợp hệ
                                                                thống, cung cấp giải pháp hàng đầu Việt Nam và khu vực. Sở
                                                                hữu năng lực công nghệ được thừa nhận bởi các khách hàng và
                                                                đối tác toàn cầu, FPT IS mang đến những dịch vụ và giải pháp
                                                                phục vụ các lĩnh vực trọng..."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tabs-content">
                                                <!--Tab-->
                                                <div class="tab active-tab" id="totals">
                                                    <div class="row">
                                                        <!-- Candidate block three -->
                                                        <div class="candidate-block-three col-lg-6 col-md-6  col-sm-16">
                                                            <div class="inner-box">
                                                                <div class="content">
                                                                    <figure class="image"><img
                                                                            src="images/resource/candidate-1.png"
                                                                            alt=""></figure>
                                                                    <h4 class="name"><a href="#">Darlene
                                                                            Robertson</a></h4>
                                                                    <ul class="candidate-info">
                                                                        <li class="designation">UI Designer</li>
                                                                        <li><span class="icon flaticon-map-locator"></span>
                                                                            London, UK</li>
                                                                        <li><span class="icon flaticon-money"></span> $99 /
                                                                            hour</li>
                                                                    </ul>
                                                                    <ul class="post-tags">
                                                                        <li><a href="#">App</a></li>
                                                                        <li><a href="#">Design</a></li>
                                                                        <li><a href="#">Digital</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="option-box">
                                                                    <ul class="option-list">
                                                                        <li><button data-text="View Aplication"><span
                                                                                    class="la la-eye"></span></button></li>
                                                                        <li><button data-text="Approve Aplication"><span
                                                                                    class="la la-check"></span></button>
                                                                        </li>
                                                                        <li><button data-text="Reject Aplication"><span
                                                                                    class="la la-times-circle"></span></button>
                                                                        </li>
                                                                        <li><button data-text="Delete Aplication"><span
                                                                                    class="la la-trash"></span></button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Candidate block three -->
                                                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                            <div class="inner-box">
                                                                <div class="content">
                                                                    <figure class="image"><img
                                                                            src="images/resource/candidate-2.png"
                                                                            alt=""></figure>
                                                                    <h4 class="name"><a href="#">Wade Warren</a>
                                                                    </h4>
                                                                    <ul class="candidate-info">
                                                                        <li class="designation">UI Designer</li>
                                                                        <li><span class="icon flaticon-map-locator"></span>
                                                                            London, UK</li>
                                                                        <li><span class="icon flaticon-money"></span> $99 /
                                                                            hour</li>
                                                                    </ul>
                                                                    <ul class="post-tags">
                                                                        <li><a href="#">App</a></li>
                                                                        <li><a href="#">Design</a></li>
                                                                        <li><a href="#">Digital</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="option-box">
                                                                    <ul class="option-list">
                                                                        <li><button data-text="View Aplication"><span
                                                                                    class="la la-eye"></span></button></li>
                                                                        <li><button data-text="Approve Aplication"><span
                                                                                    class="la la-check"></span></button>
                                                                        </li>
                                                                        <li><button data-text="Reject Aplication"><span
                                                                                    class="la la-times-circle"></span></button>
                                                                        </li>
                                                                        <li><button data-text="Delete Aplication"><span
                                                                                    class="la la-trash"></span></button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>






                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="ls-outer">
                        <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>
                        @foreach ($userEmployees as $userEmployee)
                            <!-- Block Block -->
                            <div class="company-block-three">
                                <div class="inner-box">
                                    <div class="content">
                                        <div class="content-inner">
                                            <span class="company-logo"><img src="{{ asset('/storage/images/' . $image) }}"
                                                    alt=""></span>
                                            <h4><a
                                                    href="{{ route('employee.show', ['id' => $userEmployee->slug]) }}">{{ $userEmployee->name }}</a>
                                            </h4>
                                            <ul class="job-info">
                                                <li><span class="icon flaticon-map-locator"></span>
                                                    {{ $userEmployee->address }}</li>
                                                <!-- <li><span class="icon flaticon-briefcase"></span> {{ $userEmployee->address }}</li> -->
                                            </ul>
                                        </div>
                                        <ul class="job-other-info">
                                            <li class="privacy">Đặc sắc</li>
                                            <li class="time">Việc làm mở – 2</li>
                                        </ul>
                                    </div>
                                    <!-- <div class="text">Netflix is the world's leading streaming entertainment service with over
                                                                195 million paid memberships in over 190 countries enjoying TV series, documentaries and
                                                                feature films across a wide variety...</div> -->
                                    <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                </div>
                            </div>
                        @endforeach
                        <!-- Listing Show More -->
                        <div class="ls-show-more">
                            <div class="card-footer">
                                {{ $userEmployees->appends(request()->query())->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
