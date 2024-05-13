@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
'page_title' => 'Thông tin hồ sơ',
'actions' => [
//'export' => route($route_prefix.'export'),
]
])
<style>
.with-border {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    font-weight: 700;
}
</style>
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <h6 class="profile-group-title with-border">Thông tin cá nhân</h6>
            <div class="row">
                <div class="col-12 col-md-1">
                    <img src="{{ asset('website-assets/images/default.jpg')}}" alt="Image"
                        style="width: 72px; height: 72px;" class="avatar-img rounded-circle">
                </div>
                <div class="col-12 col-md-4">
                    <p class="profile-item"><strong>Họ và tên :</strong> {{ $item->user->name ?? '' }}</p>
                    <p class="profile-item"><strong>Giới tính :</strong> {{ $item->gender ?? '' }}</p>
                    <p class="profile-item"><strong>Năm sinh :</strong> {{ $item->birthdate ?? '' }}</p>
                </div>
                <div class="col-12 col-md-4">
                    <p class="profile-item"><strong>Số điện thoại :</strong> {{ $item->phone ?? '' }}</p>
                    <p class="profile-item"><strong>Địa chỉ :</strong> {{ $item->address ?? '' }}</p>
                    <p class="profile-item"><strong>Mã hồ sơ :</strong> {{ $item->id ?? '' }}</p>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <h6 class="profile-group-title with-border">Thông tin hồ sơ</h6>
            <div class="row">
                <div class="col-12 col-md-6">
                    <p class="profile-item"><strong>Mã hồ sơ :</strong> {{ $item->id ?? '' }}</p>
                    <p class="profile-item"><strong>Tên CV :</strong> {{ $item->cv_file ?? '' }}</p>
                    <p class="profile-item"><strong>Ngành nghề :</strong> {{ $item->career->name ?? '' }}</p>
                    <p class="profile-item"><strong>Hình thức làm việc :</strong> {{ $item->formWork->name ?? ''}}</p>
                    <p class="profile-item"><strong>Cấp bậc mong muốn :</strong> {{ $item->rank->name ?? '' }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <p class="profile-item"><strong>Ngày cập nhật :</strong> {{ $item->created_at ?? '' }}</p>
                    <p class="profile-item"><strong>Nơi làm việc :</strong> {{ $item->address ?? '' }}</p>
                    <p class="profile-item"><strong>Tỉnh/Thành phố :</strong> {{ $item->city }}</p>
                    <p class="profile-item"><strong>Mức lương mong muốn :</strong> {{ $item->wage->name ?? ''}}</p>
                    <p class="profile-item"><strong>Thành tích nổi bật :
                        </strong>{{ $item->outstanding_achievements ?? ''}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="row">
                <div class="col-12">
                    <div class="profile-group-info">
                        <h6 class="profile-group-title with-border">Kinh nghiệm việc làm</h6>
                        <ul class="timeline">
                            @foreach($userExperiences as $experience)
                            <li>
                                <p><strong>Vị trí:</strong> {{ $experience->position ?? '' }}</p>
                                <p><strong>Thời gian : </strong> {{ $experience->start_date ?? ''}}
                                    -{{ $experience->end_date ?? '' }}</p>
                                <p> <strong>Công việc : </strong>{{ $experience->job_description ?? ''}}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="row">
                <div class="col-12">
                    <div class="profile-group-info">
                        <h6 class="profile-group-title with-border">Học vấn bằng cấp</h6>
                        <ul class="timeline">
                            @foreach ($userEducations as $education)
                            <li>
                                <p><strong>Trường : </strong>{{ $education->school_course ?? '' }}</p>
                                <p><strong>Chuyên ngành : </strong>{{ $education->major ?? ''}}</p>
                                <p><strong>ngày tốt nghiệp : </strong>{{ $education->graduation_date ?? ''}}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="row">
                <div class="col-12">
                    <div class="profile-group-info">
                        <h6 class="profile-group-title with-border">Kĩ năng chuyển môn</h6>
                        <ul class="timeline">
                            @foreach($userSkills as $skill)
                            <li>
                                <p><strong>Kĩ năng chuyên môn : </strong>{{ $skill->special_skill ?? ''}}</p>
                                <p><strong>Mô tả : </strong>{{ $skill->description ?? ''}}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection