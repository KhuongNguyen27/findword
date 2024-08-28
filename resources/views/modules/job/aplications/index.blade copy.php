@extends('website.layouts.master')
@section('content')
<style>
.page-title {
    margin-top: 100px;
}

.main-header {
    background-color: white !important;
}

.content {
    padding-top: 10px;
}
</style>
<!--Page Title-->

<section class="job-detail-section">
    <!-- Upper Box -->
    <div class="upper-box">
        <div class="auto-container">
            <!-- Job Block -->
            <div class="job-block-seven">
                <div class="inner-box">
                    <div class="content">

                        <span class="company-logo"><img src="{{ asset($job->getImage($job->user_id)) }}" alt=""></span>
                        <h4><a href="#">{{ $job->name }}</a></h4>
                        <ul class="job-info">
                            <li><span class="icon flaticon-briefcase"></span> {{ $job->career->name ?? '' }}</li>
                            <li><span class="icon flaticon-map-locator"></span>{{ $job->work_address }}</li>
                            <li><span class="icon flaticon-clock-3"></span>{{ $job->time_create }}</li>
                            <li><span class="icon flaticon-money"></span>{{ $job->wage->name ?? '' }} đ</li>
                        </ul>
                        <ul class="job-other-info">
                            <li class="time">Thời gian làm việc ({{ $job->formWork->name ?? '' }})</li>
                            {{-- <li class="privacy">Private</li>
                                <li class="required">Urgent</li> --}}
                        </ul>
                    </div>

                    <div class="btn-box">
                        <a href="{{ route('website.jobs.show', $job->slug) }}" style="background-color: red !important;"
                            class="theme-btn btn-style-one danger"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z" />
                            </svg> Trở về </a>
                        {{-- <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="job-detail">

                    </div>
                    <div style="display: grid;
                        justify-content: end;">
                        <div class="container centered-container">
                            <a href="{{ route('staff.cv.create') }}" class="btn btn-primary"> + Thêm mới hồ sơ </a>
                        </div>
                    </div>
                    <form action="{{ route('cv.store') }}" method="post" id="frmSelectCV">
                        @csrf
                        @if ($errors->any())
                        <p style="color:red">
                            {{ $errors->first('cv_id') }}</p>
                        @endif
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <div class="table-responsive">
                            <table class="table table-bordered my-3">
                                <tbody>
                                    <tr>
                                        <th class="text-center">Chọn</th>
                                        <th>Hồ sơ</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                    @foreach ($userCvs as $userCv)
                                    <tr>
                                        <td class="text-center">
                                            <input type="radio" name="cv_id" value="{{ $userCv->id }}"
                                                id="rdo-{{ $userCv->id }}">
                                            <input type="hidden" name="user_id" value="{{ $userCv->user_id }}">

                                        </td>
                                        <td>
                                            <label for="rdo-{{ $userCv->id }}">{{ $userCv->cv_file }}</label>
                                        </td>
                                        <td class="text-center">{{ $userCv->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('staff.cv.show', ['cv' => $userCv->id]) }}" onclick="return openResumeModel('{{ $userCv->id }}')"
                                                class="btn btn-sm btn-primary my-2 my-sm-0">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.cv.edit', ['cv' => $userCv->id]) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container centered-container">
                            <button id="btnSelectCV" type="submit" class="btn btn-primary"> Ứng tuyển ngay </button>
                        </div>
                    </form>

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


                        <div class="sidebar-widget company-widget">
                            <div class="widget-content">
                                <div class="company-title">
                                    <div class="company-logo"><img src="images/resource/company-7.png" alt="">
                                    </div>
                                    <h5 class="company-name">Thông tin nhà tuyển dụng</h5>
                                    <a href="{{ route('employee.show', ['id' => $user_employee->slug]) }}"
                                        class="profile-link">Xem hồ sơ nhà tuyển dụng</a>
                                </div>

                                <ul class="company-info">
                                    <li>Tên Công ty: <span>{{ $user_employee->name }}</span></li>
                                    <li>Số Điện Thoại: <span>{{ $user_employee->phone }}</span></li>
                                    <li>Địa Chỉ: <span>{{ $user_employee->address }}</span></li>
                                    <li>Email: <span>email công ty</span></li>
                                    <li>Website: <span>{{ $user_employee->website }}</span></li>
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