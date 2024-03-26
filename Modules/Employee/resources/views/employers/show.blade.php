@extends('website.layouts.master')
@section('content')
<section class="job-detail-section">
    <div class="company-cover">
        <div class="auto-container">
            <div class="company-cover-inner">
                <div class="cover-wrapper">
                    <img draggable="false" src="https://static.topcv.vn/company_covers/Zn7MZvydb3VlJrpboggi.jpg" alt=""
                        class="img-responsive cover-img" width="100%">
                </div>
                <div class="company-logo">
                    <div class="company-image-logo">
                        <img draggable="false"
                            src="https://cdn-new.topcv.vn/unsafe/140x/https://static.topcv.vn/company_logos/cong-ty-co-phan-ha-tang-vien-thong-cmc-telecom-5af4f4a61b6e4_rs.jpg"
                            alt="Công ty cổ phần Hạ tầng Viễn thông CMC Telecom" class="img-responsive">
                    </div>
                </div>
                <div class="company-detail-overview">
                    <div class="box-detail">
                        <h1 data-toggle="tooltip" title="" class="company-detail-name text-highlight"
                            data-original-title="Công ty cổ phần Hạ tầng Viễn thông CMC Telecom">Công ty cổ phần Hạ tầng
                            Viễn thông CMC Telecom</h1>
                        <div class="company-subdetail">
                            <div class="company-subdetail-label">
                                <label class="v1000">v1000</label>
                            </div>
                            <div data-toggle="tooltip" title=""
                                class="company-subdetail-info website  have-label-before "
                                data-original-title="https://cmctelecom.vn">
                                <span class="company-subdetail-info-icon">
                                    <i class="fa-solid fa-globe"></i>
                                </span>
                                <a class="company-subdetail-info-text" href="https://cmctelecom.vn"
                                    target="_blank">https://cmctelecom.vn</a>
                            </div>
                            <div class="company-subdetail-info">
                                <span class="company-subdetail-info-icon">
                                    <i class="fa-solid fa-buildings"></i>
                                </span>
                                <span class="company-subdetail-info-text">500-1000 nhân viên</span>
                            </div>
                            <div class="company-subdetail-info">
                                <span class="company-subdetail-info-icon">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="company-subdetail-info-text">1437 người theo dõi</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-follow">
                        <a href="javascript:showLoginPopup(null, null);" class="btn btn-follow">
                            <span><i class="fa-regular fa-plus"></i></span>
                            Theo dõi công ty
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="upper-box">
        <div class="auto-container">
            <!-- Job Block -->
            <div class="job-block-seven">
                <div class="inner-box">
                    <div class="content">
                        <span class="company-logo">
                            <img src="{{ $userEmployee->image_fm}}" alt=""></span>
                        <h4>{{ $userEmployee->name}}</h4>
                        <ul class="job-info">
                            <li><span class="icon flaticon-map-locator"></span>{{ $userEmployee->address }}</li>
                            <li><span class="icon flaticon-telephone-1"></span> {{ $userEmployee->phone }}</li>
                            <li><span class="icon flaticon-mail"></span> {{ $userEmployee->user->email }}</li>
                        </ul>
                        <ul class="job-other-info">
                            <li class="time">Việc làm mở – {{ $count_jobs }}</li>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <!-- <a href="#" class="theme-btn btn-style-one">Nộp Hồ sơ Ứng Tuyển</a> -->
                        <!-- <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">

                    <div class="section-introduce">
                        <h4 class="card-title">Giới thiệu về công ty</h4>
                        <div class="card-body">
                            <div class="text">
                                {{ $userEmployee->about ?? 'Chưa có giới thiệu' }}
                            </div>
                        </div>
                    </div>

                    <div class="section-introduce">
                        <h4 class="card-title">Tuyển dụng</h4>
                        <div class="card-body">
                            <div class="related-jobs">
                                @foreach($jobs as $job)
                                @include('job::includes.components.job-item',[
                                'job' => $job,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'company_name' => true,
                                ])
                                @endforeach
                                <div class="ls-show-more">
                                    <div class="card-footer">
                                        {{ $jobs->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="section-introduce">
                            <h4 class="card-title">Thông tin liên hệ</h4>
                            <div class="card-body">
                                <ul class="company-info mt-0">
                                    <li><span class="icon"><i class="fa fa-solid fa-phone"></i></span>
                                        <span>{{ $userEmployee->phone }}</span>
                                    </li>
                                    <li><span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                                        <span>{{ $userEmployee->user->email }}</span>
                                    </li>
                                    <li><span class="icon"><i class="fa fa-solid fa-globe"></i></span>
                                        <span>{{ $userEmployee->website }}</span>
                                    </li>
                                    <li><span class="icon"><i class="fa fa-solid fa-location-arrow"></i></span>
                                        <span>{{ $userEmployee->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-introduce">
                            <h4 class="card-title">Xem bản đồ</h4>
                            <div class="card-body">
                                <iframe width="100%" height="297" frameborder="0" style="border:0"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCVgO8KzHQ8iKcfqXgrMnUIGlD-piWiPpo&amp;q=Tang+2,toa+nha+FPT,Pho+Duy+Tan,Cau+Giay,Ha+Noi&amp;zoom=15&amp;language=vi"
                                    allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('header')
<link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/company/detail.min.b7fffc86741bf76c.css">
@endsection