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
                    <form action="{{ route('employee.index') }}">
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
                                <!-- <p>Bán kính xung quanh điểm đến đã chọn</p>
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
                                </div> -->
                            </div>
                            <button type="submit" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Tìm
                                    kiếm</span></button>
                        </div>
                    </form>
                    <!-- Call To Action -->
                    <!-- <div class="call-to-action-four">
                            <h5>Recruiting?</h5>
                            <p>Advertise your jobs to millions of monthly users and search 15.8 million CVs in our database.
                            </p>
                            <a href="#" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Start
                                    Recruiting
                                    Now</span></a>
                            <div class="image" style="background-image: url(images/resource/ads-bg-4.png);"></div>
                        </div> -->
                    <!-- End Call To Action -->
                </div>
            </div>
            <!-- Content Column -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">

                <style>
                .com {
                    text-align: center;
                    margin-bottom: 5%;
                    font-size: 10%;
                }

                .cover-wraper {
                    height: 150%;
                }

                .widget-title .btn-group .btn {
                    border-bottom: 5px solid transparent;
                    /* Thiết lập viền dưới là độ rộng 2px và trong suốt */
                }

                .widget-title .btn-group .btn:hover {
                    border-bottom: 2px solid blue;
                    /* Thiết lập màu viền dưới khi di chuột qua nút */
                }
                </style>


                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <div class="btn-group" role="group" aria-label="">
                                        <button type="button" class="btn btn-light">
                                            <a href="{{ route('employee.index') }}?type=danhsachcongty">Danh sách công
                                                ty</a>
                                        </button>
                                        <button type="button" class="btn btn-light">
                                            <a href="{{ route('employee.index') }}?type=topcongty">Top công ty</a>
                                        </button>
                                    </div>
                                </div>

                                {{-- <div class="widget-content">

                                        <div class="tabs-box">

                                            <div class="featured-companies">
                                            <div class="container">
                                                <div class="row">

                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="box-company item-hover">
                                                                <div class="company-banner">
                                                                    <a
                                                                        href="https://www.topcv.vn/cong-ty/cong-ty-co-phan-ha-tang-vien-thong-cmc-telecom/9827.html">
                                                                        <div class="cover-wraper">
                                                                            <img src="https://static.topcv.vn/company_covers/Zn7MZvydb3VlJrpboggi.jpg"
                                                                                alt="Công ty cổ phần Hạ tầng Viễn thông CMC Telecom"
                                                                                class="img-fluid">
                                                                        </div>
                                                                    </a>
                                                                  
                                                                </div>
                                                                <div class="company-info">
                                                                    <h3>
                                                                        <a href="https://www.topcv.vn/cong-ty/cong-ty-co-phan-ha-tang-vien-thong-cmc-telecom/9827.html"
                                                                            class="company-name" target="_blank">Công ty cổ
                                                                            phần Hạ tầng
                                                                            Viễn thông CMC Telecom</a>
                                                                    </h3>
                                                                    <div class="company-description">
                                                                        <p>" * GIỚI THIỆU CÔNG TY
                                                                            CMC Telecom là một trong 8 công ty thành
                                                       
                                                                            hữu hạ tầng truyền..."</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="box-company item-hover">
                                                                <div class="company-banner">
                                                                    <a
                                                                        href="https://www.topcv.vn/cong-ty/cong-ty-tai-chinh-tnhh-mot-thanh-vien-home-credit-viet-nam/12541.html">
                                                                        <div class="cover-wraper">
                                                                            <img src="https://static.topcv.vn/company_covers/cong-ty-tai-chinh-tnhh-mot-thanh-vien-home-credit-viet-nam-f0d2d151be00214d0ae4b4f6ecf326ab-5ef59ddae3e69.jpg"
                                                                                alt="Công Ty Tài Chính TNHH Một Thành Viên Home Credit Việt Nam"
                                                                                class="img-fluid">
                                                                        </div>
                                                                    </a>
                                                                
                                                                </div>
                                                                <div class="company-info">
                                                                    <h3>
                                                                        <a href="https://www.topcv.vn/cong-ty/cong-ty-tai-chinh-tnhh-mot-thanh-vien-home-credit-viet-nam/12541.html"
                                                                            class="company-name" target="_blank">Công Ty
                                                                            Tài Chính TNHH
                                                                            Một Thành Viên Home Credit Việt Nam</a>
                                                                    </h3>
                                                                    <div class="company-description">
                                                                        <p>" Home Credit Việt Nam là công ty thuộc
                                                                            tập đoàn tài chính hàng đầu Châu Âu –
          
                                                                            trả góp, mua hàng điện máy, xe máy, cho
                                                                            vay tiền..."</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="box-company item-hover">
                                                                <div class="company-banner">
                                                                    <a
                                                                        href="https://www.topcv.vn/cong-ty/cong-ty-co-phan-giao-duc-dao-tao-imap-viet-nam/20324.html">
                                                                        <div class="cover-wraper">
                                                                            <img src="https://static.topcv.vn/company_covers/cong-ty-co-phan-giao-duc-amp-dao-tao-imap-viet-nam-00e5c5f8d6dcba97c61d6f9f309d1896-5f6abe680ae0d.jpg"
                                                                                alt="Công ty Cổ phần Giáo dục &amp; Đào tạo IMAP Việt Nam"
                                                                                class="img-fluid">
                                                                        </div>
                                                                    </a>
                                                                  
                                                                </div>
                                                                <div class="company-info">
                                                                    <h3>
                                                                        <a href="https://www.topcv.vn/cong-ty/cong-ty-co-phan-giao-duc-dao-tao-imap-viet-nam/20324.html"
                                                                            class="company-name" target="_blank">Công ty
                                                                            Cổ phần Giáo
                                                                            dục &amp; Đào tạo IMAP Việt Nam</a>
                                                                    </h3>
                                                                    <div class="company-description">
                                                                        <p>" Công ty CP Giáo dục và Đào tạo IMAP
                                                                            Việt Nam với hệ thống các thương hiệu
                                                                            Anh ngữ Ms Hoa (Tiền thân Ms Hoa TOEIC)
                                                                            Ms Hoa Giao tiếp, IELTS Fighter, Aland
                                                                          
                                                                            Bình Dương, Đồng Nai và..."</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div> --}}
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
                                    <span class="company-logo"><img src="{{ asset($image) }}" alt=""></span>
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