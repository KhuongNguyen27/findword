@extends('website.layouts.master')
@section('content')
<style>
.page-title {
    margin-top: 100px;
}

.upper-box {
    margin-top: 100px;
}
</style>
<section class="job-detail-section">
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
                        <a href="#" class="theme-btn btn-style-one">Nộp Hồ sơ Ứng Tuyển</a>
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
                                    <li><span class="icon"><i class="fa fa-solid fa-phone"></i></span> <span>{{ $userEmployee->phone }}</span></li>
                                    <li><span class="icon"><i class="fa fa-solid fa-envelope"></i></span> <span>{{ $userEmployee->user->email }}</span></li>
                                    <li><span class="icon"><i class="fa fa-solid fa-globe"></i></span> <span>{{ $userEmployee->website }}</span></li>
                                    <li><span class="icon"><i class="fa fa-solid fa-location-arrow"></i></span> <span>{{ $userEmployee->address }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-introduce">
                            <h4 class="card-title">Xem bản đồ</h4>
                            <div class="card-body">
                            <iframe width="100%" height="297" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCVgO8KzHQ8iKcfqXgrMnUIGlD-piWiPpo&amp;q=Tang+2,toa+nha+FPT,Pho+Duy+Tan,Cau+Giay,Ha+Noi&amp;zoom=15&amp;language=vi" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection