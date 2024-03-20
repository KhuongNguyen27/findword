@extends('website.layouts.master')
@section('content')
    <style>
        .page-title {
            margin-top: 100px;
        }

        .main-header {
            background-color: white !important;
        }

        .job-block-seven {
            padding-top: 10px;
        }

        .btn-box {
            text-align: center;
        }

        .wide-button {
            width: 20%;
        }

        .multiline {
            padding-bottom: 10%;
        }
    </style>
    <!--Page Title-->
    <section class="job-detail-section">
        <!-- Upper Box -->
        <div class="upper-box">
            <div class="auto-container">
                <!-- Job Block -->
                <div class="job-block-seven">
                    <span class="company-logo"><img src="{{ asset($job->getImage($job->user_id)) }}" alt=""></span>
                    <div class="justify-content-start">
                        <h4 class="d-flex justify-content-start mt-5"><a href="#">{{ $job->name }}</a></h4>
                    </div>
                    <div class="post-job-steps">
                        <div class="step">
                            <span class="icon flaticon-money"></span>
                            <div class="mt-2">
                                <h6>Mức lương</h6>
                                {{-- <h5>{{ $job->wage->name ?? '' }} đ</h5> --}}
                                <?php if (auth()->check()): ?>
                                <h5>{{ $job->wage->name ?? '' }} đ</h5>
                                <?php else: ?>
                                <a href="{{ route('staff.login') }}">Vui lòng đăng nhập để xêm mức lương</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="step">
                            <span class="icon flaticon-map-locator"></span>
                            <div class="mt-2">
                                <h6>Địa điểm</h6>
                                <h5>{{ $job->work_address }}</h5>
                            </div>
                        </div>
                        <div class="step">
                            <span class="icon flaticon-briefcase "></span>
                            <div class="mt-2">
                                <h6>Kinh nghiệm</h6>
                                <h5>{{ $job->experience }} năm</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="job-detail-outer">
            <div class="auto-container">
                <div class="row">
                    <h2>Chi tiết tin tuyển dụng</h2>
                    <div class="content-column col-lg-8 col-md-12 col-sm-12 mt-2">
                        <div class="job-detail">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h4>Mô Tả Công Việc</h4>
                            <p>
                                {{ $job->description }}
                            </p>
                            <h4>Yêu Cầu Công việc</h4>
                            <p>
                                {{ $job->requirements }}
                            </p>
                            <a href="{{ route('website.jobs.aplication', ['id' => $job->slug]) }}"
                                class="theme-btn btn-style-one wide-button w-100 mt-3"><i class="fas fa-paper-plane"></i>
                                &nbsp;<span> Nộp
                                    hồ sơ ứng tuyển</span></a>
                        </div>
                        <div class="mt-4">
                            <h2>Việc làm Cùng công ty</h2>
                            <div class="mt-2">
                                <div class="job-detail">
                                    <div class="row">
                                        @foreach ($job_employ as $job)
                                            <!-- Job Block -->
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                @include('job::includes.components.job-item', [
                                                    'job' => $job,
                                                    'job_info' => true,
                                                    'job_other_info' => true,
                                                    'bookmark' => true,
                                                    'simple' => true,
                                                ])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h2>Việc làm liên quan</h2>
                            <div class="content-column col-lg-12 col-md-12 col-sm-12 mt-2">
                                <div class="job-detail">
                                    <div class="row">
                                        @foreach ($job_relate_to as $job)
                                            <!-- Job Block -->
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                @include('job::includes.components.job-item', [
                                                    'job' => $job,
                                                    'job_info' => true,
                                                    'job_other_info' => true,
                                                    'bookmark' => true,
                                                    'simple' => true,
                                                ])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Options -->
                        {{-- <div class="other-options">
                        <div class="social-share">
                            <h5>Share this job</h5>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                        </div>
                    </div> --}}

                        <!-- Related Jobs -->
                        {{-- <div class="related-jobs">
                        <div class="title-box">
                            <h3>Công việc liên quan</h3>
                            <div class="text">2020 jobs live - 293 added today.</div>
                        </div>
                    </div> --}}
                    </div>

                    <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                        <aside class="sidebar">
                            <div class="sidebar-widget">
                                <!-- Job Overview -->
                                <h4 class="widget-title">Xem Chi Tiết Công Việc</h4>
                                <div class="widget-content">
                                    <ul class="job-overview">
                                        <li>
                                            <i class="icon icon-calendar"></i>
                                            <h5>Hình thức làm việc:</h5>
                                            <span>{{ $job->formWork->name ?? '' }}</span>
                                        </li>
                                        <li>
                                            <i class="icon icon-calendar"></i>
                                            <h5>Thời gian đăng tải:</h5>
                                            <span>{{ $job->time_create }}</span>
                                        </li>
                                        <li>
                                            <i class="icon icon-expiry"></i>
                                            <h5>Hạn nộp hồ sơ:</h5>
                                            <span>{{ $job->deadline }}</span>
                                        </li>
                                        <li>
                                            <i class="icon icon-location"></i>
                                            <h5>Địa chỉ làm việc:</h5>
                                            <span>{{ $job->work_address }}</span>
                                        </li>
                                        {{-- <li>
                                            <i class="icon icon-user-2"></i>
                                            <h5>:</h5>
                                            <span>Designer</span>
                                        </li>
                                        <li>
                                            <i class="icon icon-clock"></i>
                                            <h5>Hours:</h5>
                                            <span>50h / week</span>
                                        </li>
                                        <li>
                                            <i class="icon icon-rate"></i>
                                            <h5>Rate:</h5>
                                            <span>$15 - $25 / hour</span>
                                        </li> --}}
                                        <li>
                                            <i class="icon icon-salary"></i>
                                            <h5>Lương:</h5>
                                            <span>{{ $job->wage->name ?? '' }} VNĐ</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Map Widget -->


                                <!-- Job Skills -->
                                {{-- <h4 class="widget-title">Job Skills</h4>
                                <div class="widget-content">
                                    <ul class="job-skills">
                                        <li><a href="#">app</a></li>
                                        <li><a href="#">administrative</a></li>
                                        <li><a href="#">android</a></li>
                                        <li><a href="#">wordpress</a></li>
                                        <li><a href="#">design</a></li>
                                        <li><a href="#">react</a></li>
                                    </ul>
                                </div> --}}
                            </div>

                            <div class="sidebar-widget company-widget">
                                <div class="widget-content">
                                    <div class="company-title">
                                        <div class="company-logo"><img src="images/resource/company-7.png" alt="">
                                        </div>
                                        <h5 class="company-name">Thông tin nhà tuyển dụng</h5>
                                        <a href="{{ route('employee.show', $job->user->userEmployee->slug) }}"
                                            class="profile-link">Xem hồ sơ nhà tuyển dụng</a>
                                    </div>

                                    <ul class="company-info">
                                        <li>Tên Công ty: <span>{{ $job->user->userEmployee->name }}</span></li>
                                        <li>Số Điện Thoại: <span>{{ $job->user->userEmployee->phone }}</span></li>
                                        <li>Địa Chỉ: <span>{{ $job->user->userEmployee->address }}</span></li>
                                        <li>Email: <span>{{ $job->user->email }}</span></li>
                                        <li>Website: <span>{{ $job->user->userEmployee->website }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Listing Page Section -->
@endsection
