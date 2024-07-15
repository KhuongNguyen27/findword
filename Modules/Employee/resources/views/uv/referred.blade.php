@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->
<style>
.record-box {
    margin-bottom: 15px;
    padding: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    background-color: #fff;
    position: relative;
    /* Đặt position để định vị nút */
}

i.fas.fa-map-marker-alt {
    margin-left: 80px;
}

i.fas.fa-calendar-alt {
    margin-left: 80px;
}

i.fas.fa-dollar-sign {
    margin-left: 80px;
}

.btn-view-profile {
    background-color: #0D6EFD;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    display: inline-flex;
    align-items: center;
    position: absolute;
    /* Đặt position để định vị nút */
    right: 0px;
    /* Cách mép phải 10px */
    top: 50%;
    /* Đặt ở giữa theo chiều dọc */
    transform: translateY(-50%);
    /* Căn giữa theo chiều dọc */
}

.btn-view-profile i {
    margin-right: 5px;
}

.background-red {
    background-color: #CE3131;
    color: white;
    padding: 1px;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    margin-left: 12px;
    font-size: 13px;
}


.ls-widget .widget-content p {
    margin-bottom: 1px;
}

.col-2 {
    flex: 0 0 auto;
    width: 11.666667%;
}

a.mr-2 {
    color: #363636;
    text-decoration: none;
    transition: color 0.3s ease;
    text-transform: uppercase;
}

.background-re {
    color: #389e0d;
    background: #f6ffed;
    border: 1px solid #b7eb8f;
    padding: 1px 6px;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    margin-left: 12px;
    font-size: 13px;
}


a.mr-2:hover {
    color: #0056b3;
}

.career-link {
    color: #757575;
    text-decoration: none;
    text-transform: uppercase;
}

.career-link:hover {
    color: #0056b3;
}

.viewed-status {
    opacity: 0.6;
    margin-left: auto;
    font-style: italic;
}
</style>
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>QUẢN LÝ DANH SÁCH ỨNG VIÊN</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box">
                        <div class="widget-title d-flex justify-content-between">
                            <h4>Ứng viên đề xuất</h4>
                        </div>
                        <div class="widget-content">
                            @foreach ($items as $item)
                            <div class="row record-box">
                                <div class="col-2">
                                    <img class="img-fluid"
                                        src="{{ asset('/website-assets/images/qrcode/qrcode1.png') }}"
                                        alt="Generic placeholder image" style="width: 100px;">
                                </div>
                                <div class="col-10">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <a class="mr-2" href="{{ route('employee.cv.show', $item->id) }}">
                                                {{ $item->desired_position ?? ''}} - {{ $item->user->name }}
                                            </a>
                                            <div class="background-red">
                                                <i class="flaticon-money-1"></i> 10.0000P
                                            </div>
                                            <div class="background-re">
                                                Giới thiệu
                                            </div>
                                            <p class="viewed-status">Nộp đơn</p>
                                        </div>
                                        <p>
                                            <a href="" class="career-link">

                                                {{ $item->career->name ?? ''}}
                                            </a>
                                        </p>
                                        <p>
                                            <i class="fas fa-briefcase"></i> {{ $item->experience_years ?? ''}} năm
                                            <i class="fas fa-map-marker-alt"></i> {{ $item->province->name ??'' }}
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ date('d/m/Y',strtotime($item->created_at)) }}
                                            {!! $item->wage ? '<i class="fas fa-dollar-sign"></i> ' .
                                            number_format($item->wage->salaryMin, 0, ',', '.') . ' - ' .
                                            number_format($item->wage->salaryMax, 0, ',', '.') . ' VNĐ' : '' !!}
                                            <a class="btn-view-profile"
                                                href="{{ route('employee.cv.showCv', $item->id) }}">
                                                <i class="fas fa-eye"></i> Xem hồ sơ
                                            </a>
                                        </p>
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
</section>
<!-- End Dashboard -->
@endsection