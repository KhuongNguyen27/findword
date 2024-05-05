<section class="job-section ls-section list-feature-jobs pt-3 pb-3 custom-job-section-mobile" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="ls-outer theme-card">
            <div class="ls-switcher theme-card-header">
                <div class="sec-title mb-3 mt-3">
                    <h2 class="">{{ $title }}</h2>
                </div>
                <div class="box-header__tool">
                    <span class="see-more">
                        <a href="{{ $sec_link }}" class="mb-3 mt-3">
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
                    @foreach ($chunk_jobs as $chunk_job)
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($chunk_job as $job_item)
                                <!-- Job Block -->
                                <div class="{{ $item_class }}">
                                    @include('job::includes.components.job-item', [
                                    'job' => $job_item,
                                    'job_info' => true,
                                    'bookmark' => true,
                                    'simple' => true,
                                    'company_name' => true,
                                    ])
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>