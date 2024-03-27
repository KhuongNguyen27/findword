<section class="ls-section pt-5 pb-5 list-feature-jobs" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-8">
                <div class="ls-outer">
                    <div class="ls-switcher theme-card-header">
                        <div class="sec-title mb-3 mt-0">
                            <h2 class="">Việc làm hấp dẫn</h2>
                        </div>
                        <div class="box-header__tool">
                            <span class="see-more">
                                <a href="{{ route('jobs.vnjobs') }}" class="mb-3 mt-3">
                                    <span class="btn-title text-uppercase">Xem tất cả</span>
                                </a>
                            </span>
                            <span class="btn-attractive-jobs-pre btn-slick-arrow slick-arrow">
                                <i class="fa fa-solid fa-chevron-left"></i>
                            </span>
                            <span class="btn-attractive-jobs-next btn-slick-arrow slick-arrow">
                                <i class="fa fa-solid fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                    <div class="theme-card-body">
                        <div class="swiper attractiveJobsSwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="row">
                                        @foreach ($jobs['job_vip'] as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'bookmark' => true,
                                            'simple' => true,
                                            ])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        @foreach ($jobs['job_gap'] as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'bookmark' => true,
                                            'simple' => true,
                                            ])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        @foreach ($jobs['job_uu_tien'] as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'bookmark' => true,
                                            'simple' => true,
                                            ])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        @foreach ($jobs['job_hot'] as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'bookmark' => true,
                                            'simple' => true,
                                            ])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row">
                                        @foreach ($jobs['job_thuong'] as $job)
                                        <!-- Job Block -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                            'job' => $job,
                                            'job_info' => true,
                                            'bookmark' => true,
                                            'simple' => true,
                                            ])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="attractive-banner mt-1">
                    <div class="hero-banner mt-4">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ asset('website-assets/images/banner/346x577-1.png') }}" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('website-assets/images/banner/346x577-2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>