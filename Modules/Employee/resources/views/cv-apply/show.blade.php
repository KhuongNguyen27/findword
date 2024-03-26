@extends('employee::layouts.master')
@section('content')
<style>
.media-body h2 {
    font-size: min(max(16px, 4vw), 22px);
    font-weight: bold;
}

.media-body p {
    font-size: 1rem;
    font-weight: bold;
    color: white;
}

.timeline-panel {
    margin-bottom: 30px;
}

.profile-header.p-3.bg-primary.text-white {
    --bs-bg-opacity: 1;
    background-color: #1967d2 !important;
}

.profile-contact {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.btn-profile-contact {
    font-size: 18px;
    font-weight: bold;
    background-color: #f8fafd !important;
    margin-bottom: 10px;
}

.btn-border.btn-primary {
    color: #1572E8 !important;
    border: 1px solid #1572E8 !important;
}

.btn-round {
    border-radius: 100px !important;
}

.profile-group-title {
    font-size: 1.25rem;
    color: #1572E8;
    font-weight: bold;
    border-bottom: 2px solid #f8fafd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.profile-item span {
    margin-bottom: 10px;
    font-weight: bold;
}

.ls-widget .widget-content p {
    position: relative;
    font-size: 18px;
    line-height: 26px;
    color: #5c6770;
    font-weight: 400;
    margin-bottom: 26px;
}

.timeline {
    list-style: none;
    padding: 20px 0 20px;
    position: relative;
}

.timeline>li:not(.timeline-inverted) {
    padding-right: 90px;
}

.timeline>li {
    margin-bottom: 20px;
    position: relative;
}



.timeline>li>.timeline-panel {
    width: 50%;
    float: left;
    border: 1px solid #eeeeee;
    background: #ffffff;
    border-radius: 3px;
    padding: 20px;
    position: relative;
    -webkit-box-shadow: 0px 1px 20px 1px rgba(69, 65, 78, 0.06);
    -moz-box-shadow: 0px 1px 20px 1px rgba(69, 65, 78, 0.06);
    box-shadow: 0px 1px 20px 1px rgba(69, 65, 78, 0.06);
}

.timeline {
    list-style: none;
    padding: 20px 0 20px;
    position: relative;
}

.timeline-title {
    font-size: 17px;
    margin-top: 0;
    color: inherit;
    font-weight: 400;
}

.timeline-heading i {
    font-size: 22px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
}

.media-body.ml-auto {
    margin-left: auto !important;
}
</style>
<!-- Dashboard -->
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Thông tin hồ sơ</h3>
            <!-- <div class="text">Ready to jump back in?</div> -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box">
                        <!-- <div class="widget-title">
                            <h4>Thông tin công việc</h4>
                            <a href="{{ route('staff.cv.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div> -->
                        <div class="profile-header p-3 bg-primary text-white">
                            <div class="media d-flex align-items-center">
                                <div class="avatar avatar-xxl mr-3">
                                    <img src="{{ asset('website-assets/images/default.jpg')}}" alt="Image"
                                        style="width: 150px; height: 150px;" class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body ml-3">
                                    <h2 style="margin-left: 20px !important;">{{ auth()->user()->name }}</h2>
                                    <p style="margin-left: 20px !important;"> {{ $item->desired_position ?? '' }}</p>
                                </div>
                                <div class="media-body ml-auto" style="margin-right: 100px;">
                                    <a href="{{ route('employee.cv.sendemail',$item->id) }}" class="btn btn-primary">Gửi
                                        Email</a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-contact py-3"><button
                                class="btn btn-primary btn-border btn-round btn-profile-contact" title="Sinh nhật">
                                <span class="btn-label"> <i class="las la-calendar"></i></span>
                                {{ $item->birthdate ?? '' }}
                            </button> <button class="btn btn-primary btn-border btn-round btn-profile-contact"
                                title="Giới tính"> <span class="btn-label"> <i class="las la-users"></i> </span>
                                {{ $item->gender ?? ''}}
                            </button>
                            <!-- <button class="btn btn-primary btn-border btn-round btn-profile-contact"
                                title="Tình trạng hôn nhân"> <span class="btn-label"> <i class="la flaticon-user-4"></i>
                                </span>  {{ $item->gender }} 
                            </button>  -->
                            <button class="btn btn-primary btn-border btn-round btn-profile-contact" title="Email">
                                <span class="btn-label"> <i class="las la-envelope"></i> </span>
                                <span>{{ $item->email ?? '' }}</span> </button> <button
                                class="btn btn-primary btn-border btn-round btn-profile-contact" title="Địa chỉ"> <span
                                    class="btn-label"> <i class="las la-phone"></i> </span>
                                <span>{{ $item->phone ?? '' }}</span>
                            </button> <button class="btn btn-primary btn-border btn-round btn-profile-contact"
                                title="Địa chỉ"> <span class="btn-label"> <i class="la flaticon-placeholder"></i>
                                </span> <span>{{ $item->address ?? '' }}</span> </button>
                        </div>
                        <div class="widget-content">
                            <div class="profile-body p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Thông tin công việc</h3>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <p class="profile-item"><span>Ngành
                                                            nghề:</span>{{ $item->career->name ?? '' }}</p>
                                                    <p class="profile-item"><span>Hình thức làm việc:</span>
                                                        {{ $item->formwork->name ?? ''}}
                                                        gian</p>
                                                    <p class="profile-item"><span>Cấp bậc mong muốn:</span>
                                                        {{ $item->rank->name ?? '' }}
                                                    </p>
                                                    <p class="profile-item"><span>Ngày cập nhật:</span>
                                                        {{ $item->created_at ?? '' }}</p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p class="profile-item"><span>Nơi làm việc:</span>
                                                        {{ $item->address ?? '' }}
                                                    </p>
                                                    <p class="profile-item"><span>Tỉnh/Thành phố:</span>
                                                        {{ $item->city }}</p>
                                                    <p class="profile-item"><span>Mã hồ sơ:</span> {{ $item->id ?? '' }}
                                                    </p>
                                                    <p class="profile-item"><span>Mức lương mong muốn:</span>
                                                        {{ $item->wage->name ?? ''}}</p>
                                                    <!-- <p class="profile-item"><span>Số năm kinh nghiệm:</span>
                                                        {{ $item->experience_years ?? '' }}</p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Thành tích nổi bật</h3>
                                            <p>{{ $item->outstanding_achievements ?? '' }}</p>
                                        </div>
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Học vấn / Bằng cấp</h3>
                                            <ul class="timeline">
                                                @foreach ($item->userEducations as $education)
                                                <li>
                                                    <div class="timeline-badge warning">
                                                    </div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title">
                                                                {{ $education->school_course ?? '' }}
                                                            </h4>
                                                            <p><small class="text-muted"> <i
                                                                        class="la flaticon-star"></i>
                                                                    {{ $education->major ?? ''}} </small></p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p>{{ $education->graduation_date ?? ''}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Kinh nghiệm việc làm</h3>
                                            <ul class="timeline">
                                                @foreach($userExperiences as $experience)
                                                <li>
                                                    <div class="timeline-badge info"><i class="flaticon-message"></i>
                                                    </div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title">{{ $experience->company ?? '' }}
                                                            </h4>
                                                            <p><small class="text-muted"> <i
                                                                        class="flaticon-message"></i>
                                                                    {{ $experience->position ?? ''}} </small></p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p>{{ $experience->start_date ?? ''}} -
                                                                {{ $experience->end_date ?? '' }}</p>
                                                            <p>{{ $experience->job_description ?? ''}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Mục tiêu nghề nghiệp</h3>
                                            <div class="profile-group-body" style="margin-bottom: 30px;">
                                                {{ $item->career_objective ?? ''}}
                                            </div>
                                        </div>
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Ngoại ngữ</h3>
                                            <div class="profile-group-body">
                                                <p class="d-flex justify-content-between"><span
                                                        class="font-weight-bold"> {{ $education->language ?? '' }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="profile-group-info">
                                            <h3 class="profile-group-title">Kỹ năng chuyên môn</h3>
                                            <div class="profile-group-body">
                                                <ul class="profile-skills">
                                                    @foreach($item->userSkills as $skill)
                                                    <li>
                                                        <h5>{{ $skill->special_skill ?? ''}}</h5>
                                                        <p>{{ $skill->description ?? ''}}</p>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <form action="{{route('employee.cv.update',$cv_job_apply->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-select form-select-lg mb-3" name="status"
                                                aria-label=".form-select-lg example">
                                                <option @selected($cv_job_apply->status == $cv_job_apply::ACTIVE)
                                                    value="{{ $cv_job_apply::ACTIVE }}">Duyệt</option>
                                                <option @selected($cv_job_apply->status == $cv_job_apply::INACTIVE)
                                                    value="{{ $cv_job_apply::INACTIVE }}">Không duyệt
                                                </option>
                                                <option @selected($cv_job_apply->status == $cv_job_apply::DRAFT)
                                                    value="{{ $cv_job_apply::DRAFT }}">Chờ duyệt
                                                </option>
                                            </select>
                                            <div class="form-group col-lg-12 col-md-12 text-right">
                                                <button class="theme-btn btn-style-one">Cập Nhật</button>
                                                <a style="background-color: red !important;"
                                                    href="{{route('employee.cv.index')}}"
                                                    class="theme-btn btn-style-one danger">Trở về</a>
                                            </div>
                                        </form>
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
<!-- End Dashboard -->
@endsection