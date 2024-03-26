<section class="job-section ls-section list-feature-jobs pt-5 pb-5" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="ls-outer theme-card">
            <div class="ls-switcher theme-card-header">
                <div class="sec-title mb-3 mt-3">
                    <h2 class="">Việc làm tốt nhất</h2>
                </div>
                <div class="box-header__tool">
                    <span class="see-more">
                        <a href="{{ route('jobs.vnjobs') }}" class="mb-3 mt-3">
                            <span class="btn-title text-uppercase">Xem tất cả</span>
                        </a>
                    </span>
                    <span class="btn-feature-jobs-pre btn-slick-arrow slick-arrow">
                        <i class="fa fa-solid fa-chevron-left"></i>
                    </span>
                    <span class="btn-feature-jobs-next btn-slick-arrow slick-arrow">
                        <i class="fa fa-solid fa-chevron-right"></i>
                    </span>
                </div>
            </div>
            <!-- Jobs here -->
            <div class="theme-card-body">
                <div class="swiper featureJobsSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($jobs['job_vip'] as $job)
                                <!-- Job Block -->
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    @include('job::includes.components.job-item', [
                                    'job' => $job,
                                    'job_info' => true,
                                    'bookmark' => true,
                                    'simple' => true,
                                    'company_name' => true,
                                    ])
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($jobs['job_gap'] as $job)
                                <!-- Job Block -->
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    @include('job::includes.components.job-item', [
                                    'job' => $job,
                                    'job_info' => true,
                                    'bookmark' => true,
                                    'simple' => true,
                                    'company_name' => true,
                                    ])
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($jobs['job_uu_tien'] as $job)
                                <!-- Job Block -->
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    @include('job::includes.components.job-item', [
                                    'job' => $job,
                                    'job_info' => true,
                                    'bookmark' => true,
                                    'simple' => true,
                                    'company_name' => true,
                                    ])
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($jobs['job_hot'] as $job)
                                <!-- Job Block -->
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    @include('job::includes.components.job-item', [
                                    'job' => $job,
                                    'job_info' => true,
                                    'bookmark' => true,
                                    'simple' => true,
                                    'company_name' => true,
                                    ])
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($jobs['job_thuong'] as $job)
                                <!-- Job Block -->
                                <div class="col-lg-4 col-md-12 col-sm-12">
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
</section>