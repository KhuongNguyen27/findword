<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin CV</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .conininer {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .centered-text {
            text-align: center;
            margin-bottom: 0;
        }

        .with-border {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            font-weight: 700;
        }

        .profile-item {
            margin-bottom: 10px;
        }

        h3.centered-text.profile-item {
            margin-top: 0px;
        }

        h3.profile-group-title.with-border {
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <div>
                    <h3 class="centered-text">{{ $item->user->name ?? '' }}</h3>
                    <h3 class="centered-text profile-item">{{ $item->career->name ?? '' }}</h3>
                </div>
                <div class="product-table">
                    <h3 class="profile-group-title with-border">Thông tin cá nhân</h3>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <p class="profile-item"><strong>Họ và tên :</strong> {{ $item->user->name ?? '' }}</p>
                            <p class="profile-item"><strong>Giới tính :</strong> {{ $item->gender ?? '' }}</p>
                            <p class="profile-item"><strong>Năm sinh :</strong>
                                {{ isset($item->birthdate) ? \Carbon\Carbon::parse($item->birthdate)->format('d/m/Y') : '' }}
                            </p>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="profile-item"><strong>Số điện thoại :</strong> {{ $item->phone ?? '' }}</p>
                            <p class="profile-item"><strong>Địa chỉ :</strong> {{ $userStaff->address ?? '' }}</p>
                            <p class="profile-item"><strong>Mã hồ sơ :</strong> {{ $item->id ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="product-table">
                    <h3 class="profile-group-title with-border">Thông tin hồ sơ</h3>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p class="profile-item"><strong>Mã hồ sơ :</strong> {{ $item->id ?? '' }}</p>
                            <p class="profile-item"><strong>Tên CV :</strong> {{ $item->cv_file ?? '' }}</p>
                            <p class="profile-item"><strong>Ngành nghề :</strong> {{ $item->career->name ?? '' }}</p>
                            <p class="profile-item"><strong>Hình thức làm việc :</strong>
                                {{ $item->formWork->name ?? '' }}</p>
                            <p class="profile-item"><strong>Cấp bậc mong muốn :</strong> {{ $item->rank->name ?? '' }}
                            </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="profile-item"><strong>Ngày cập nhật :</strong>
                                {{ isset($item->created_at) ? $item->created_at->format('d/m/Y') : '' }}</p>
                            <p class="profile-item"><strong>Nơi làm việc :</strong> {{ $item->address ?? '' }}</p>
                            <p class="profile-item"><strong>Tỉnh/Thành phố :</strong> {{ $item->city }}</p>
                            <p class="profile-item"><strong>Mức lương mong muốn :</strong> {{ $item->wage->name ?? '' }}
                            </p>
                            <p class="profile-item"><strong>Thành tích nổi bật :</strong>
                                {{ $item->outstanding_achievements ?? '' }}</p>
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
                                <h3 class="profile-group-title with-border">Kinh nghiệm việc làm</h3>
                                <ul class="timeline">
                                    @if($userExperiences->isEmpty())
                                        <p>Không có dữ liệu</p>
                                    @else
                                        @foreach($userExperiences as $experience)
                                            <li>
                                                <p><strong>Vị trí:</strong> {{ $experience->position ?? '' }}</p>
                                                <p><strong>Thời gian :</strong> {{ $experience->start_date ?? '' }} -
                                                    {{ $experience->end_date ?? '' }}
                                                </p>
                                                <p><strong>Công việc :</strong> {{ $experience->job_description ?? '' }}</p>
                                            </li>
                                        @endforeach
                                    @endif
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
                                <h3 class="profile-group-title with-border">Học vấn bằng cấp</h3>
                                <ul class="timeline">
                                    @if($educations->isEmpty())
                                        <p>Không có dữ liệu</p>
                                    @else
                                        @foreach ($educations as $education)
                                            <li>
                                                <p><strong>Trường :</strong> {{ $education->school_course ?? '' }}</p>
                                                <p><strong>Chuyên ngành :</strong> {{ $education->major ?? '' }}</p>
                                                <p><strong>Ngày tốt nghiệp :</strong> {{ $education->graduation_date ?? '' }}
                                                </p>
                                            </li>
                                        @endforeach
                                    @endif
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
                                <h3 class="profile-group-title with-border">Kĩ năng chuyển môn</h3>
                                <ul class="timeline">
                                    @if($userSkills->isEmpty())
                                        <p>Không có dữ liệu</p>
                                    @else
                                        @foreach($userSkills as $skill)
                                            <li>
                                                <p><strong>Kĩ năng chuyên môn :</strong> {{ $skill->special_skill ?? '' }}</p>
                                                <p><strong>Mô tả :</strong> {{ $skill->description ?? '' }}</p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>