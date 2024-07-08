@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->
<style>
.with-border {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    font-weight: 700;
    padding-top: 15px;
}

.ls-widget .widget-content {
    position: relative;
    padding: 0px 0px 10px;
}

.ls-widget .widget-content p {
    margin-bottom: 15px;
}

.form-select-lg {
    font-size: 1rem;
}
</style>
<style>
.record-box {
    margin-bottom: 15px;
    padding: 10px;
    /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); */
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
    right: 10px;
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
    padding: 2px;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    margin-left: 12px;
}

.ls-widget .widget-content p {
    margin-bottom: 1px;
}

.col-2 {
    flex: 0 0 auto;
    width: 11.666667%;
}

/* .btn-contact-info {
    background-color: #CE3131;
    color: white;
    border: none;
    padding: 1px 10px;
    border-radius: 3px;
    display: inline-flex;
    align-items: center;
    margin-top: 10px;
} */
.disabled {
    background-color: #b9eae8 !important
}

.btn-contact-info i {
    margin-right: 5px;
}

.alert-info-contact {
    background-color: #FFF6E4;
    color: #212529;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.alert-info-contact i {
    margin-right: 10px;
}

.btn-contact-info {
    background-color: #30bab5;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    display: inline-flex;
    align-items: center;
    margin-top: 10px;
}

.btn-contact-info i {
    margin-right: 5px;
}
</style>
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h5>Thông tin hồ sơ</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box p-3">

                        <!-- <div class="profile-header p-3 bg-primary text-white">
                            <div class="media d-flex align-items-center">
                                <div class="avatar avatar-xxl mr-3">
                                    <img src="{{ asset('website-assets/images/default.jpg')}}" alt="Image"
                                        style="width: 150px; height: 150px;" class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body ml-3">
                                    <h2 style="margin-left: 20px !important;">{{ $item->user->name ?? ''}}</h2>
                                  
                                </div>
                            </div>
                        </div> -->


                        <div class="alert-info-contact">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Thông tin liên hệ sẽ được hiển thị sau khi bạn bấm vào<strong>"Xem thị thông tin liên
                                    hệ"</strong> (Sử
                                dụng
                                Point để xem)</p>
                        </div>
                        <div class="row record-box">
                            <div class="col-2">
                                <img class="img-fluid" src="{{asset('/website-assets/images/qrcode/qrcode1.png')}}"
                                    alt="Generic placeholder image" style="width: 107px;">
                            </div>
                            <div class="col-10">
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">{{ $item->user->name ?? ''}}</span>
                                        <div class="background-red">
                                            <i class="flaticon-money-1"></i> 10.0000P
                                        </div>
                                    </div>
                                    <p> {{ $item->career->name ?? '' }}</p>
                                    <!-- <p class="profile-item">Cập nhật:
                                            {{ isset($item->created_at) ? $item->created_at->format('d/m/Y') : '' }}
                                        </p> -->
                                    <button type="button" class="btn-contact-info" data-staff-id="{{ $item->user->id }}"
                                        data-employee-id="{{ Auth::user()->id }}" data-amount="10000"
                                        data-current-point="{{ Auth::user()->points }}"
                                        data-job-apply-id="{{ $cv_job_apply->id }}">
                                        Xem thông tin liên hệ
                                    </button>

                                    <button class="bookmark-btn" data-job-apply-id="{{ $cv_job_apply->id }}">
                                        <span class="flaticon-bookmark {{ $cv_job_apply->favorites ? 'bookmarked' : '' }}"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                           document.addEventListener('DOMContentLoaded', function () {
                                const bookmarkBtns = document.querySelectorAll('.bookmark-btn');

                                bookmarkBtns.forEach(btn => {
                                    btn.addEventListener('click', function () {
                                        const jobId = this.getAttribute('data-job-apply-id');
                                        console.log('Job ID:', jobId); // Kiểm tra ID có đúng không
                                        const isBookmarked = this.querySelector('span').classList.contains('bookmarked');

                                        fetch(`/employee/bookmark/${jobId}`, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.favorites) {
                                                this.querySelector('span').classList.add('bookmarked');
                                            } else {
                                                this.querySelector('span').classList.remove('bookmarked');
                                            }

                                            // Hiển thị thông báo SweetAlert2
                                            Swal.fire({
                                                title: 'Lưu CV!',
                                                text: isBookmarked ? 'Bỏ lưu thông tin CV thành công.' : 'Lưu thông tin CV thành công.',
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);

                                            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
                                            Swal.fire({
                                                title: 'Lỗi!',
                                                text: 'Có lỗi xảy ra. Vui lòng thử lại.',
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                        });
                                    });
                                });
                            });


                        </script>

                        <style>
                            .bookmarked {
                                color: red;
                                fill: red;
                            }

                        .bookmark-btn {
                            background-color: #EDF2FF;
                            border: none;
                            padding: 5px 10px;
                            border-radius: 6px;
                            display: inline-flex;
                            align-items: center;
                        }
                        </style>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                        <script>
                        function getAppliedJobIdFromUrl() {
                            let url = window.location.href;
                            let segments = url.split('/');
                            let id = segments.pop() || segments
                        .pop(); // Lấy phần tử cuối cùng, có thể là ID hoặc trường hợp không có ID
                            return id;
                        }
                        $(document).ready(function() {
                            $.ajax({
                                url: '{{ route('employee.check-contact-info') }}',
                                type: 'POST',
                                data: {
                                    check: true,
                                    applyId: getAppliedJobIdFromUrl(),
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var contactInfo = response.data;
                                        console.log(contactInfo,
                                            contactInfo.email,
                                            contactInfo.phone);
                                        // Cập nhật nội dung của các phần tử HTML
                                        $('#contactEmail').text(
                                            contactInfo.email
                                        ); // Cập nhật email
                                        $('#contactPhone').text(
                                            contactInfo.phone
                                        ); // Cập nhật số điện thoại
                                        $('.btn-contact-info').each(function() {
                                            $(this).addClass('disabled').attr('disabled',
                                                true);
                                        });
                                    }
                                }
                            });
                        });
                        $(document).ready(function() {
                            $('.btn-contact-info').click(function() {
                                var staffId = $(this).data('staff-id');
                                var employeeId = $(this).data('employee-id');
                                var amount = $(this).data('amount');
                                var currentPoints = $(this).data('current-point');
                                var applyId = $(this).data('job-apply-id');
                                // Hàm định dạng số theo kiểu phân tách hàng nghìn bằng dấu chấm
                                function formatNumber(number) {
                                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                                // Gửi request AJAX để gọi route và phương thức trong EmployeeController
                                Swal.fire({
                                    title: 'Xác nhận',
                                    html: "Số <strong>Point</strong> hiện tại của bạn là <strong>" +
                                        formatNumber(currentPoints) +
                                        "P</strong>. Mất <strong>" + formatNumber(amount) +
                                        "P</strong> để xem thông tin liên hệ?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Đồng ý',
                                    cancelButtonText: 'Hủy'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Gửi request AJAX để gọi route và phương thức trong EmployeeController
                                        $.ajax({
                                            url: '{{ route('employee.get-contact-info') }}',
                                            type: 'POST',
                                            data: {
                                                staff_id: staffId,
                                                employee_id: employeeId,
                                                amount: amount,
                                                applyId: applyId,
                                                check: false,
                                                _token: '{{ csrf_token() }}'
                                            },
                                            success: function(response) {
                                                if (response.success) {
                                                    var contactInfo = response.data;
                                                    console.log(contactInfo,
                                                        contactInfo.email,
                                                        contactInfo.phone);
                                                    $('#contactEmail').text(
                                                        contactInfo.email
                                                    ); // Cập nhật email
                                                    $('#contactPhone').text(
                                                        contactInfo.phone
                                                    ); // Cập nhật số điện thoại
                                                    window.location.reload();
                                                } else {
                                                    Swal.fire('Lỗi', response
                                                        .message, 'error'
                                                    ); // Hiển thị thông báo lỗi nếu có
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        });
                        </script>

                        <div class="widget-content">
                            <div class="profile-body p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="profile-group-info">
                                            <h5 class="profile-group-title with-border">Thông tin cá nhân</h5>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <p class="profile-item"><strong>Họ và tên :</strong>
                                                        {{ $item->user->name ?? '' }}</p>
                                                    <p class="profile-item"><strong>Giới tính :</strong>
                                                        {{ $item->gender ?? '' }}</p>
                                                    <p class="profile-item"><strong>Năm sinh :</strong>
                                                        {{ isset($item->birthdate) ? \Carbon\Carbon::parse($item->birthdate)->format('d/m/Y') : '' }}
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <!-- <p class="profile-item"><strong>Số điện thoại :</strong>
                                                        {{ $item->phone ?? '' }}</p>
                                                        <p class="profile-item"><strong>Email :</strong>
                                                        {{ $item->user->email ?? '' }}</p> -->
                                                    <p class="profile-item"><strong>Số điện thoại :</strong><span
                                                            id="contactPhone">
                                                            {{ $item->is_checked == 1 ? $item->phone ?? 'Thông tin không có sẵn' : 'Thông tin đang ẩn' }}
                                                        </span></p>
                                                    <p class="profile-item"><strong>Email :</strong> <span
                                                            id="contactEmail">
                                                            {{ $item->is_checked == 1 ? $item->user->email ?? 'Thông tin không có sẵn' : 'Thông tin đang ẩn' }}
                                                        </span></p>
                                                    <p class="profile-item"><strong>Địa chỉ :</strong>
                                                        {{ $userStaff->address ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-group-info">
                                            <h5 class="profile-group-title with-border">Thông tin công việc</h5>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <p class="profile-item"><strong>Ngành nghề:</strong>
                                                        {{ $item->career->name ?? '' }}</p>
                                                    <p class="profile-item"><strong>Hình thức làm việc:</strong>
                                                        {{ $item->formwork->name ?? ''}} gian</p>
                                                    <p class="profile-item"><strong>Cấp bậc mong muốn:</strong>
                                                        {{ $item->rank->name ?? '' }}</p>
                                                    <p class="profile-item"><strong>Ngày cập nhật:</strong>
                                                        {{ isset($item->created_at) ? $item->created_at->format('d/m/Y') : '' }}
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p class="profile-item"><strong>Nơi làm việc:</strong>
                                                        {{ $item->address ?? '' }}</p>
                                                    <p class="profile-item"><strong>Tỉnh/Thành phố:</strong>
                                                        {{ $item->city }}</p>
                                                    <p class="profile-item"><strong>Mã hồ sơ:</strong>
                                                        {{ $item->id ?? '' }}</p>
                                                    <p class="profile-item"><strong>Mức lương mong muốn:</strong>
                                                        {{ $item->wage->name ?? '' }}</p>
                                                    <!-- <p class="profile-item"><strong>Số năm kinh nghiệm:</strong> {{ $item->experience_years ?? '' }}</p> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-group-info">
                                            <h5 class="profile-group-title with-border">Học vấn / Bằng cấp</h5>
                                            <ul class="timeline">
                                                @if ($educations->isEmpty())
                                                <p>Không có dữ liệu</p>
                                                @else
                                                @foreach ($educations as $key => $education)
                                                <li class="lili">
                                                    <p><strong>{{ $key + 1 }}. </strong><strong> Trường :
                                                        </strong>{{ $education->school_course ?? '' }}
                                                    </p>
                                                    <p><strong>Chuyên ngành : </strong>{{ $education->major ?? ''}}</p>
                                                    <p><strong>Ngày tốt nghiệp :
                                                        </strong>{{ $education->graduation_date ?? ''}}</p>
                                                </li>
                                                @endforeach
                                                <div class="profile-group-info">
                                                    <p><i class="la flaticon-star"></i> <strong>Thành tích nổi bật :
                                                        </strong>{{ $item->outstanding_achievements ?? '' }}</p>
                                                    <p><i class="la flaticon-star"></i> <strong>Ngoại ngữ :
                                                        </strong>{{ $education->language ?? '' }}</p>
                                                </div>
                                                @endif
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="profile-group-info">
                                            <h5 class="profile-group-title with-border">Kinh nghiệm việc làm</h5>
                                            <ul class="timeline">
                                                @if ($userExperiences->isEmpty())
                                                <p>Không có dữ liệu</p>
                                                @else
                                                @foreach($userExperiences as $key => $experience)
                                                <li>
                                                    <p><strong>{{ $key + 1 }}. </strong><strong>Vị trí:</strong>
                                                        {{ $experience->position ?? '' }}</p>
                                                    <p><strong>Thời gian : </strong> {{ $experience->start_date ?? '' }}
                                                        -{{ $experience->end_date ?? '' }}</p>
                                                    <p> <strong>Công việc :
                                                        </strong>{{ $experience->job_description ?? '' }}
                                                    </p>
                                                </li>
                                                @endforeach
                                                <div class="profile-group-info">
                                                    <p><i class="la flaticon-star"></i> <strong>Mục tiêu nghề nghiệp :
                                                        </strong> {{ $experience->position ?? '' }}
                                                    </p>
                                                </div>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="profile-group-info">
                                        <h5 class="profile-group-title with-border">Kỹ năng chuyên môn</h5>
                                        <div class="profile-group-body">
                                            <ul class="profile-skills">
                                                @if ($userSkills->isEmpty())
                                                <p>Không có dữ liệu</p>
                                                @else
                                                @foreach($item->userSkills as $key => $skill)
                                                <p><strong>{{ $key + 1 }}. </strong><strong>Kĩ năng chuyên môn :
                                                    </strong>{{ $skill->special_skill ?? ''}}</p>
                                                <p><strong>Mô tả : </strong>{{ $skill->description ?? ''}}</p>
                                                @endforeach
                                                @endif
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