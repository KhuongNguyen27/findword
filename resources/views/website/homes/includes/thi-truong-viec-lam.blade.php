<div id="dashboard-section" class="lazy d-none d-md-block" data-lazy-function="initDashboard">
    <div class="container lazy" id="dashboard" data-lazy-function="initDashboardHomeJS">
        <div class="block-dashboard">
            <div class="block-dashboard__header">
                <h3>{{ __('content.thi_truong_viec_lam_hom_nay') }} <span>{{ date('d/m/Y') }}</span></h3>
            </div>
            <div class="block-dashboard__content">
                <div class="block-newest-job">
                    <img class="block-newest-job__img"
                        src="{{ asset('website-assets/images/macos.png') }}?t={{ time() }}">
                    <div class="wrapper">
                        <p class="block-newest-job__title">{{ __('content.viec_lam_moi_nhat') }}</p>
                        <img class="block-newest-job__icon-top "
                            src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/welcome/dashboard/icon-top.png">
                        <div class id="sliderNewJobPublish">
                            @foreach ($lasest_jobs as $job)
                                <div class="job-item active animated zoomIn">
                                    <a class="job-item__link" target="_blank"
                                        href="{{ route('website.jobs.show', $job->slug) }}">
                                        @if ($job->userEmployee)
                                            <img class="job-item__logo" src="{{ $job->userEmployee->image_fm }}">
                                        @endif
                                    </a>
                                    <div>
                                        <a class="job-item__link" href="{{ route('website.jobs.show', $job->slug) }}"
                                            target="_blank">
                                            <p class="job-item__title">{{ $job->name }}</p>
                                        </a>
                                        @if ($job->userEmployee)
                                            <a class="job-item__link" target="_blank"
                                                href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}">
                                                <p class="job-item__company">{{ $job->userEmployee->name }}</p>
                                            </a>
                                        @endif
                                        <p class="job-item__location">{{ $job->work_address }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="block-statistics-job">
                    <div class="block-work-market work-market">
                        <div class="item">
                            <p class=" quantity quantity_job_new_today">{{ $quantity_job_new_today + 586 }}</p>
                            <p class="title">{{ __('content.viec_lam_moi_24h') }}</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_job_recruitment">{{ $quantity_job_recruitment + 2000 }}</p>
                            <p class="title">{{ __('content.viec_lam_dang_tuyen') }}</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_company_recruitment">{{ $quantity_company_recruitment + 1000 }}
                            </p>
                            <p class="title">{{ __('content.cong_ty_dang_tuyen') }}</p>
                        </div>
                    </div>
                    <div class="block-chart">
                        <div class="item-chart">
                            <div class="header">
                                <div class="title">
                                    <div class="icon"> <i class="fa-solid fa-arrow-trend-up"></i> </div> <span
                                        class="caption">{{ __('content.tang_truong_co_hoi_viec_lam') }}</span>
                                </div>
                            </div>
                            <img class="img-responsive loading-chart lazy mt-2" style="display:none"
                                data-src="https://static.topcv.vn/v4/image/welcome/section-header/loading-chart.svg" />
                            <div class="box-chart" style="display:block!important">
                                <div style="height: 220px"> <canvas id="myChartJobOpportunityGrowthDashboard"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="item-chart">
                            <div class="header">
                                <div class="title">
                                    <div class="icon"> <i class="fa-solid fa-arrow-trend-up"></i> </div> <span
                                        class="caption">{{ __('content.nhu_cau_tuyen_dung_theo') }}</span>
                                </div>
                                <!-- <div class="box-select"> <select name="demand-job-select"
                                            id="demand-job-select-dashboard" class="form-control select2 text-white">
                                            <option value="2" class="text-black"> Ngành nghề </option>
                                            <option value="4" class="text-black"> Mức lương </option>
                                        </select> </div> -->
                            </div> <img class="img-responsive loading-chart lazy" style="display:none"
                                data-src="https://static.topcv.vn/v4/image/welcome/section-header/loading-chart.svg" />
                            <div class="box-chart" style="display:block!important">
                                <div style="height: 220px"> <canvas id="myChartDemandJobDashboard"></canvas> </div>
                                <div id="htmlLegendDemandJobDashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('website-assets/css/dashboard.css') }}" rel="stylesheet">
