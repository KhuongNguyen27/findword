@extends('website.layouts.master')
@section('title') {{ env('APP_NAME') }} @endsection
@section('content')

    <!-- Banner Section-->
    <style>
        span.flaticon-bookmark.active {
            color: red;

        }
        .owl-carousel .owl-stage {
            margin-left: 0px;
        }
        .modal-body iframe{
            border-radius: 10px;
            min-height: 416px;
            width: 100%;
        }
        .modal-footer .icon img{
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
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .14px;
            line-height: 22px;
            margin-bottom: 0;
            padding-left: 34px;
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .checkbox-dont-show {
            display: block;
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
                        @include('website.homes.includes.job-search-form')
                        @include('website.homes.includes.hero-banner')
                        <!-- Job Search Form -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Banner Section-->


    <!-- Job Section -->
@include('website.homes.includes.job-items',[
        'sec_title' => 'Việc làm hôm nay',
        'chunk_jobs' => $vip_jobs,
        'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'sec_link' => route('jobs.homejobs','viec-lam-hom-nay')
    ])
    <!-- End Job Section -->

    @include('website.includes.global.ad-banners')

    <!-- top-companies -->
    @include('website.homes.includes.top-companies')
    <!-- End Testimonial Section -->

    @include('website.includes.global.home-attractive-jobs')

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
        var tang_truong_labels = <?php echo json_encode($tang_truong_labels); ?>;
        var tang_truong_values = <?php echo json_encode($tang_truong_values); ?>;
        var nhu_cau_labels = <?php echo json_encode($nhu_cau_labels); ?>;
        var nhu_cau_values = <?php echo json_encode($nhu_cau_values); ?>;

        const ctx = document.getElementById('myChartJobOpportunityGrowthDashboard');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: tang_truong_labels,
                datasets: [{
                    data: tang_truong_values,
                    backgroundColor: '#ffffff',
                    borderColor: '#ffffff',
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            color: 'white',
                        },
                    },
                    x: {
                        ticks: {
                            color: 'white',
                        },
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        const ctx1 = document.getElementById('myChartDemandJobDashboard');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: nhu_cau_labels,
                datasets: [{
                    data: nhu_cau_values,
                    borderWidth: 1,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                legend: {
                    labels: {
                        fontColor: "blue",
                        fontSize: 18
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: 'white',
                        },
                    },
                    x: {
                        ticks: {
                            color: 'white',
                        },
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        TopCV - Tiếp lợi thế, nối thành công
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="video-brand-communication "
                        src="https://www.youtube.com/embed/5y9EYHhAwPs?autoplay=1&amp;mute=1" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen="">
                    </iframe>
                </div>
                <div class="modal-footer">
                    <div class="icon">
                        <img data-src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/welcome/section-header/toppy-hr-tech.png"
                            class="lazy entered loaded" alt="toppy-hr-tech" data-ll-status="loaded"
                            src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/welcome/section-header/toppy-hr-tech.png">
                    </div>
                    <div class="comunication-content">
                        <div class="comunication-content__text">
                            <p>
                                Trong sự nghiệp, chọn đúng việc, đi đúng hướng là một <span class="hight-light">lợi
                                    thế</span>
                            </p>
                            <p>
                                Định vị bản thân chính xác là một <span class="hight-light">lợi thế</span>
                            </p>
                            <p>
                                Kết nối bền chặt cùng đồng nghiệp cũng là một <span class="hight-light">lợi thế</span>
                            </p>
                            <p>
                                TopCV hiểu rõ, <span class="hight-light">lợi thế</span> nằm trong tay bạn!
                            </p>
                        </div>
                        <p class="hight-light comunication-content__footer">
                            Với Hệ sinh thái HR Tech, TopCV luôn đồng hành để bạn thành công trong sự nghiệp
                        </p>
                    </div>
                </div>
                <div class="find-out">
                    <div class="form-check checkbox-dont-show">
                        <label class="checkbox-dont-show__input">
                            Không hiển thị lại
                            <input type="checkbox" id="dont-show_popup_brand_community">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <a href="https://blog.topcv.vn/topcv-tiep-loi-the-noi-thanh-cong/" target="__blank"
                        class="btn btn-find-out">
                        Tìm hiểu thêm
                    </a>
                </div>
            </div>
  </div>
</div>
@endsection
