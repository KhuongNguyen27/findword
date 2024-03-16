@extends('website.layouts.master')
@section('content')

<style>
.page-title {
    margin-top: 100px;
}

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

.mau-cv {
    margin-bottom: 1%;
    margin-top: 5%;
    text-align: center;
}

.row-1 {
    margin-bottom: 20%;
}

.row-2 {
    margin-bottom: 20%;
}

.mau-1 {
    background-attachment: fixed;
}

span {
    display: block;
}

.widget-title {
    padding-bottom: 2%;
}
</style>
<section class="page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1>Hồ sơ xin việc</h1>
            <ul class="page-breadcrumb">
                <li><a href="">Trang chủ</a></li>
                <li>Hồ sơ xin việc</li>
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
                                <input type="text" name="listing-search" placeholder="Chức danh, từ khóa hoặc công ty">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Column -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>
                    <!-- Block Block -->
                    <div class="company-block-three">
                        <div class="widget-title">
                            <div class="btn-group" role="group" aria-label="">
                                <button type="button" class="btn btn-light">
                                    <a href="{{ route('staff.profile.index') }}">Hồ sơ cá nhân</a>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <a href="{{ route('cvs.index') }}?type=maucv">Mẫu CV</a>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <a href="{{ route('cvs.index') }}?type=huongdanvietcv">Hướng dẫn viết
                                        CV</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-outer">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- applicants Widget -->
                            <div class="applicants-widget ls-widget">
                                <div class="widget-content" style="padding:0px!important">
                                    <!-- Candidate block three -->
                                    @foreach ($items as $item)
                                    <div class="candidate-block-three">
                                        <div class="inner-box">
                                            <div class="content d-flex align-items-center">
                                                <figure class="image"><img src="{!! asset($item->image_fm) !!}" alt="">
                                                </figure>
                                                <div class="justify-content-start mt-2">
                                                    <h4 class="name"><a href="#">{{ $item->cv_file }}</a>
                                                    </h4>
                                                    <ul class="candidate-info">
                                                        <!-- <li><span class="icon flaticon-map-locator"></span> London, UK</li> -->
                                                        <li><span
                                                                class="icon flaticon-clock-3"></span>{{ $item->created_at->format('d/m/Y') }}
                                                        </li>
                                                        <li class="designation">
                                                            {{ $item->desired_position }}
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="option-box">
                                                <div class="option-box">
                                                    <div class="dropdown resume-action">
                                                        <button class="dropdown-toggle theme-btn btn-style-three"
                                                            role="button" data-toggle="dropdown"
                                                            aria-expanded="false">Thao tác <i
                                                                class="fa fa-angle-down"></i></button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route('cvs.show', $item->id) }}">
                                                                    <span class="la la-eye"></span> Xem chi
                                                                    tiết
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('cvs.edit', $item->id) }}">
                                                                    <span class="la la-pencil"></span> Tạo bản sao
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <li>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection