@extends('website.layouts.master')
@section('title') {{ env('APP_NAME') }} @endsection
@section('header') {!! SEO::generate() !!} @endsection
@section('content')

<!-- Banner Section-->
<style>
    span.flaticon-bookmark.active {
        color: red;

    }

    .owl-carousel .owl-stage {
        margin-left: 0px;
    }

    .modal-body iframe {
        border-radius: 10px;
        min-height: 416px;
        width: 100%;
    }

    .modal-footer .icon img {
        width: 128.199px !important;
    }

    .modal-footer {
        align-items: inherit;
        border-top: none;
        display: flex;
        gap: 17px;
        justify-content: flex-start;
        padding: 10px 0 16px;
    }

    .find-out {
        align-items: center;
        display: flex;
        justify-content: space-between;
        padding: 0 20px 16px;
    }

    .checkbox-dont-show__input {
        color: var(--neutral-600, #868d94);
        cursor: pointer;
        display: block;
        font-family: Inter;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: .14px;
        line-height: 22px;
        margin-bottom: 0;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .checkbox-dont-show {
        display: block;
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 0;
        font-weight: 700;
    }

    span.hight-light {
        color: #6bcdcd;
        font-weight: 600;
    }

    p.hight-light.comunication-content__footer {
        color: #6bcdcd;
        font-weight: 600;
    }

    a.btn.btn-find-out {
        background: #6bcdcd;
        color: #ffffff;
        padding: 7px 41px;
    }

    .checkbox-dont-show__input {
        display: flex;
        align-items: center;
        font-size: 1em;
        /* Điều chỉnh kích thước chữ nếu cần */
    }

    .checkbox-dont-show__input input[type="checkbox"] {
        width: 21px;
        /* Kích thước chiều rộng của checkbox */
        height: 21px;
        /* Kích thước chiều cao của checkbox */
        margin-right: 10px;
        /* Khoảng cách giữa checkbox và nhãn */
    }

    .checkbox-dont-show__input .checkmark {
        display: none;
        /* Ẩn phần tử checkmark nếu không cần */
    }

    button.close {
        align-items: center;
        aspect-ratio: 1/1;
        background: #f1f1f1;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        opacity: .6;
        width: 32px;
    }

</style>
<section class="banner-section pb-5 custom-banner-section-mobile">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column" data-wow-delay="1000ms">
                    <div class="title-box">
                        <h3>Tìm việc làm nhanh 24h, việc làm mới nhất trên toàn quốc.</h3>
                        <div class="text">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn doanh nghiệp
                            uy tín tại Việt Nam</div>
                    </div>
                    <!-- Job Search Form -->
                    @include('website.homes.includes.job-search-form',['route_index' => route("jobs.homejobs", ['job_type'=> 'tat-ca-viec-lam'])])
                    @include('website.homes.includes.hero-banner')
                    <!-- Job Search Form -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End job-item Section-->

<style>
.screen-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999; /* Đảm bảo lớp phủ luôn nằm trên cùng */
    pointer-events: none; /* Không cản trở việc tương tác với các phần tử khác */
}

.screen-overlay .overlay {
    position: absolute;
    top: 70px; /* Khoảng cách bằng chiều cao của header */
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('website-assets/images/background/vn4.webp') }}');
    background-size: cover; /* Đặt hình nền để phủ toàn bộ màn hình */
      background-position: center; /* Căn giữa hình ảnh */
    background-repeat: no-repeat;
    opacity: 0.01; /* Tăng độ rõ của hình nền */
    z-index: 9998; /* Đặt thấp hơn một chút so với lớp bao quanh */
    pointer-events: none; /* Không cản trở việc tương tác với các phần tử khác */
}

/* Thiết kế cho mobile */
@media (max-width: 768px) {
    .screen-overlay .overlay {
        top: 70px; /* Đẩy xuống tương ứng với chiều cao header */
        height: calc(100% - 70px); /* Trừ đi chiều cao của header */
        background-image: url('{{ asset('website-assets/images/background/vnmobile.jpg') }}'); /* Thay đổi hình nền cho thiết bị di động */
        background-size: cover; /* Đảm bảo phủ toàn bộ màn hình */
        background-position: center center; /* Căn giữa hình ảnh */
        background-repeat: no-repeat; /* Tránh lặp lại hình ảnh */
        opacity: 0.01;
    }
}

@media (max-width: 480px) {
    .screen-overlay .overlay {
        top: 70px; /* Đẩy xuống tương ứng với chiều cao header */
        height: calc(100% - 70px); /* Trừ đi chiều cao của header */
        background-image: url('{{ asset('website-assets/images/background/vnmobile.jpg') }}'); /* Thay đổi hình nền cho thiết bị di động nhỏ hơn */
        background-size: cover; /* Đảm bảo phủ toàn bộ màn hình */
        background-position: center center; /* Căn giữa hình ảnh */
        background-repeat: no-repeat; /* Tránh lặp lại hình ảnh */
        opacity: 0.01;
    }
}


/* Điều chỉnh modal cho mobile */
@media (max-width: 768px) {
    .modal-dialog {
        max-width: 100%;
        margin: 0;
    }

    .modal-content {
        padding: 10px;
    }

    .modal-header {
        padding: 10px;
    }

    .modal-title {
        font-size: 16px;
        line-height: 1.2;
    }

    .modal-body {
        padding: 10px;
    }

    .modal-footer {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    .comunication-content {
        text-align: left; /* Căn nội dung về bên trái */
    }

    .comunication-content__text {
        text-align: left; /* Căn đều sang trái */
    }

    .comunication-content__text p {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .comunication-content__footer {
        font-size: 14px;
    }

    .find-out {
        padding: 10px;
        text-align: center;
    }

    .btn-find-out {
        font-size: 14px;
        padding: 8px 16px;
    }

    .checkbox-dont-show__input {
        font-size: 14px;
    }
}
/* Điều chỉnh modal */



</style>
<!-- Job Section -->
<div class="screen-overlay">
                <div class="overlay"></div>
            </div>
@include('website.homes.includes.job-items', [
'sec_title' => 'Việc làm hôm nay',
'chunk_jobs' => $vip_jobs,
'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'sec_link' => route('jobs.homejobs', 'viec-lam-hom-nay'),
])
<!-- End Job Section -->

@include('website.includes.global.ad-banners')

@include('website.homes.includes.job-items',[
'sec_title' => 'Việc làm tuyển gấp',
'chunk_jobs' => $tuyen_gap,
'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'sec_link' => route('jobs.homejobs','urgent')
])

<!-- top-companies -->
@include('website.homes.includes.top-companies')
<!-- End Testimonial Section -->

@include('website.includes.global.home-attractive-jobs')


@include('website.homes.includes.job-items',[
'sec_title' => 'Việc làm HOT nhất',
'chunk_jobs' => $hot,
'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'sec_link' => route('jobs.homejobs','hot')
])
@include('website.homes.includes.thi-truong-viec-lam')

<!-- Job Categories -->
@include('website.homes.includes.job-categories')
<!-- End Job Categories -->






<!-- End News Section -->
@endsection

@section('footer')
<!-- <script src="{{ asset('website-assets/chart/chart.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="{{ asset('website-assets/js/chart-demand-job-home-page.js')}}"></script> -->
<script>
    $("#section-header .box-load-more").click(function() {
        $('html, body').animate({
            scrollTop: $("#dashboard").offset().top - 100
        }, 1000);
    });

</script>
<script>
    var tang_truong_labels = < ? php echo json_encode($tang_truong_labels); ? > ;
    var tang_truong_values = < ? php echo json_encode($tang_truong_values); ? > ;
    var nhu_cau_labels = < ? php echo json_encode($nhu_cau_labels); ? > ;
    var nhu_cau_values = < ? php echo json_encode($nhu_cau_values); ? > ;

    const ctx = document.getElementById('myChartJobOpportunityGrowthDashboard');
    new Chart(ctx, {
        type: 'line'
        , data: {
            labels: tang_truong_labels
            , datasets: [{
                data: tang_truong_values
                , backgroundColor: '#ffffff'
                , borderColor: '#ffffff'
            , }]
        }
        , options: {
            scales: {
                y: {
                    ticks: {
                        color: 'white'
                    , }
                , }
                , x: {
                    ticks: {
                        color: 'white'
                    , }
                , }
            }
            , plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    const ctx1 = document.getElementById('myChartDemandJobDashboard');
    new Chart(ctx1, {
        type: 'bar'
        , data: {
            labels: nhu_cau_labels
            , datasets: [{
                data: nhu_cau_values
                , borderWidth: 1
                , borderColor: '#ffffff'
            , }]
        }
        , options: {
            legend: {
                labels: {
                    fontColor: "blue"
                    , fontSize: 18
                }
            }
            , scales: {
                y: {
                    ticks: {
                        color: 'white'
                    , }
                , }
                , x: {
                    ticks: {
                        color: 'white'
                    , }
                , }
            }
            , plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

</script>
@if($popup && $popup->is_active)

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                   {{ $popup->title }}

                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body">
               <iframe width="560" height="315" src="{{ $popup->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <div class="icon">
                   <img 
                    src="{{ $popup->image ? asset('storage/' . $popup->image) : asset('website-assets/images/favicon.png') }}" 
                    alt="Popup Image" 
                    class="lazy entered loaded"
                    data-ll-status="loaded">
                </div>
                <div class="comunication-content">
                    <div class="comunication-content__text">
                          {!! $popup->content !!}
                    </div>
                </div>
            </div>
            <div class="find-out">
                <div class="form-check checkbox-dont-show">
                    <label class="checkbox-dont-show__input">
                        <input type="checkbox" id="dont-show_popup_brand_community">
                        Không hiển thị lại
                        <span class="checkmark"></span>
                    </label>
                </div>
                <a href="#" target="__blank" class="btn btn-find-out">
                    Tìm hiểu thêm
                </a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
@push('js')
<script src="{{ asset('website-assets/js/popup.js') }}"></script>
@endpush
