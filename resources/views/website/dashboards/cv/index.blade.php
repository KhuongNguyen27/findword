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
                        <div class="inner-box">
                            <div class="content">
                                <div class="content-inner">
                                </div>
                            </div>
                            {{-- <div class="cv">
                                    <div class="row row-1">
                                        <div class="mau-cv">
                                            <h4>mau cv</h4>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-1">
                                                <p>mau 1</p>
                                                <span class="span-1">aaaaaaaaaaa</span>
                                                <img class="img-1" src="data:image/jpeg;base64,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" alt="anh a" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-2">
                                                mau 2
                                                <span class="span-2">bbbbbbb</span>
                                                <img class="img-2" src="data:image/jpeg;base64,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" alt="anh-2" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-3">
                                                mau 3
                                                <span>ccccc</span>
                                                <img class="img-3" src="data:image/jpeg;base64,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" alt="anh-3" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-2">
                                        <div class="col-md-4">
                                            <div class="mau-4">
                                                mau 4
                                                <span>ddddd</span>
                                                <img class="img-4" src="https://www.google.com/imgres?imgurl=https%3A%2F%2Fsmilemedia.vn%2Fwp-content%2Fuploads%2F2022%2F09%2Fchup-hinh-the-dep-e1664379729855.jpg&tbnid=pCZZag1CnsZvyM&vet=12ahUKEwje8eeD8PCEAxVvW_UHHea5BpgQMygGegQIARBd..i&imgrefurl=https%3A%2F%2Fsmilemedia.vn%2Fcach-chup-anh-the-dep%2F&docid=r4AY912pSAmj1M&w=600&h=688&q=anh%20th%E1%BA%BB%20%C4%91%E1%BA%B9p&ved=2ahUKEwje8eeD8PCEAxVvW_UHHea5BpgQMygGegQIARBd" alt="anh-4" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-5">
                                                mau 5
                                                <span>eeeeeeee</span>
                                                <img class="img-5" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTl2FHMEwreAokjzZFhkgEQB8-DXE8dI-uDg&usqp=CAU" alt="anh-5" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-6">
                                                mau 6
                                                <span>ffffffffff</span>
                                                <img class="img-6" src="" alt="anh-6" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-3">
                                        <div class="col-md-4">
                                            <div class="mau-7">
                                                mau 7
                                                <span>ggggggggg</span>
                                                <img class="img-7" src="data:image/jpeg;base64,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" alt="anh-7" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-8">
                                                mau 8
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mau-9">
                                                mau 9
                                                <span>llllllllll</span>
                                                <img class="img-9" src="data:image/jpeg;base64,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" alt="anh-9" >
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            <div class="dashboard-outer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- applicants Widget -->
                                        <div class="applicants-widget ls-widget">
                                            <div class="widget-content">
                                                <!-- Candidate block three -->
                                                @foreach ($items as $item)
                                                <div class="candidate-block-three">
                                                    <div class="inner-box">
                                                        <div class="content d-flex align-items-center">
                                                            <figure class="image"><img
                                                                    src="{{ asset($item->image_fm) }}" alt="">
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
                                                                    <button
                                                                        class="dropdown-toggle theme-btn btn-style-three"
                                                                        role="button" data-toggle="dropdown"
                                                                        aria-expanded="false">Action <i
                                                                            class="fa fa-angle-down"></i></button>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('staff.cv.show', $item->id) }}">
                                                                                <span class="la la-eye"></span> Xem chi
                                                                                tiết
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('staff.cv.edit', $item->id) }}">
                                                                                <span class="la la-pencil"></span> Cập
                                                                                nhật
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
            </div>
        </div>
    </div>
</section>
@endsection