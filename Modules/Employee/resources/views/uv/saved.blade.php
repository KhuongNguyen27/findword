@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->
<style>
    button.bookmark-btn {
        margin-left: 115px;
    }

    .bookmark-btn {
        background-color: #EDF2FF;
        border: none;
        padding: 5px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        margin-left: 6px;
    }


    .bookmark-btn .fa-heart {
        color: #FF0000;
        font-size: 24px;
        /* Điều chỉnh kích thước theo nhu cầu */
        transition: color 0.3s;
    }

    .bookmark-btn .fas.fa-heart.bookmarked {
        color: #FF0000;
        /* Màu sắc của trái tim khi được đánh dấu */
    }

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

    .btn-view {
        /* background-color: #0D6EFD; */

        position: absolute;
        /* Đặt position để định vị nút */
        right: 65px;
        /* Cách mép phải 10px */
        top: 50%;
        /* Đặt ở giữa theo chiều dọc */

        /* Căn giữa theo chiều dọc */
    }

    .btn-view i {
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

    .bookmarked {
        color: red;
        fill: red;
    }

    .viewed-btn {
        color: #28c1bc !important;
    }

    .viewed-btn {
        background-color: #EDF2FF;
        border: none;
        padding: 5px 8px 5px 13px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
    }

    a.mr-2 {
        color: #363636;
        text-decoration: none;
        transition: color 0.3s ease;
        text-transform: uppercase;
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

    i.fas.fa-check {
        color: #3687D8;
    }

    i.fas.fa-times {
        color: #CD3131;
    }

    i.fas.fa-envelope {
        color: #08ad16;
    }

    .kq i.fas.fa-envelope {
        color: white;
    }

    i.fas.fa-info-circle {
        color: #08AD16;
    }

    .kq {
        background-color: #08b116;
        color: white;
        border: none;
        padding: 4px 25px;
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

    .kq i {
        margin-right: 5px;
    }

    .viewed-btn {
        background-color: #EDF2FF;
        border: none;
        padding: 5px 8px 5px 13px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
    }

    .btn-view {
        /* background-color: #0D6EFD; */

        position: absolute;
        /* Đặt position để định vị nút */
        right: 65px;
        /* Cách mép phải 10px */
        top: 50%;
        /* Đặt ở giữa theo chiều dọc */

        /* Căn giữa theo chiều dọc */
    }

    .btn-view i {
        margin-right: 5px;
    }

    .no-data {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
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
                            <h4>Ứng viên đã lưu</h4>
                        </div>
                        <div class="widget-content">
                            @if(!$items->isEmpty())
                            @foreach ($items as $item)
                            <div class="row record-box">
                                <div class="col-2">
                                    <img class="img-fluid" src="{{ asset('/website-assets/images/qrcode/qrcode1.png') }}" alt="Generic placeholder image" style="width: 100px;">
                                </div>
                                <div class="col-10">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <a class="mr-2" href="{{ route('employee.cv.showCv', $item->cv->id) }}">
                                                {{ $item->cv->desired_position ?? ''}} - {{ $item->cv->user->name }}
                                            </a>
                                            <div class="background-red">
                                                <i class="flaticon-money-1"></i> 10.0000P
                                            </div>
                                            <!-- <p class="viewed-status">Đã xem hồ sơ</p> -->
                                            @include('employee::uv.includes.text-status')

                                        </div>
                                        <p>
                                            <a href="" class="career-link">

                                                {{ $item->cv->career->name ?? ''}}
                                            </a>
                                        </p>
                                        <p>
                                            <i class="fas fa-briefcase"></i> {{ $item->cv->experience_years }} năm
                                            <i class="fas fa-map-marker-alt"></i> {{ $item->cv->province->name }}
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ date('d/m/Y', strtotime($item->created_at)) }}
                                            {!! $item->cv->wage ? '<i class="fas fa-dollar-sign"></i> ' .
                                            number_format($item->cv->wage->salaryMin, 0, ',', '.') . ' - ' .
                                            number_format($item->cv->wage->salaryMax, 0, ',', '.') . ' VNĐ' : '' !!}
                                            <button class="bookmark-btn" data-cv-id="{{ $item->cv->id }}" data-route="{{ route('employee.bookmark.toggle',$item->cv->id) }}">
                                                <span class="fa-heart {{ $item && $item->favorites ? 'fas bookmarked' : 'far' }}"></span>
                                            </button>
                                            <script>
                                                // Đợi khi tài liệu đã sẵn sàng
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Kích hoạt Tooltip
                                                    $('[data-toggle="tooltip"]').tooltip();
                                                });

                                            </script>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h6 class="no-data">Không có dữ liệu</h6>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('.bookmark-btn').click(function() {
                var cvId = $(this).data('cv-id');
                var route = $(this).data('route');
                var btn = $(this);
                $.ajax({
                    url: route
                    , type: 'POST'
                    , data: {
                        cvId: cvId
                        , _token: '{{ csrf_token() }}'
                    , }
                    , success: function(response) {
                        
                        if (response.success) {
                            var icon = btn.find('.fa-heart');
                            if (response.favorites) {
                                icon.removeClass('far').addClass('fas bookmarked');
                            } else {
                                icon.removeClass('fas bookmarked').addClass('far');
                            }
                        }

                        var message = response.success ? response.message :
                            'Có lỗi xảy ra. Vui lòng thử lại.';
                        var icon = response.success ? 'success' : 'error';
                        Swal.fire({
                            title: 'Lưu CV!'
                            , text: message
                            , icon: icon
                            , confirmButtonText: 'OK'
                        });
                    }
                    , error: function(error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Lỗi!'
                            , text: 'Có lỗi xảy ra. Vui lòng thử lại.'
                            , icon: 'error'
                            , confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            // Hiển thị thông báo thành công nếu có
            let successMessage = "{{ session('success') }}";
            if (successMessage) {
                Swal.fire({
                    title: 'Thành công!'
                    , text: successMessage
                    , icon: 'success'
                    , confirmButtonText: 'OK'
                });
            }
            $('.viewed-btn').click(function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    Swal.fire({
                        title: 'Xác nhận'
                        , text: 'Bạn có chắc chắn muốn thực hiện hành động này?'
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonText: 'Có'
                        , cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                }
            });
        });

    </script>
</section>
<!-- End Dashboard -->
@endsection
