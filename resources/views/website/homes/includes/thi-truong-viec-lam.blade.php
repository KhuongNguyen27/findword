<div id="dashboard-section"  class="lazy d-none d-md-block" data-lazy-function="initDashboard">
    <div class="container lazy" id="dashboard" data-lazy-function="initDashboardHomeJS">
        <div class="block-dashboard">
            <div class="block-dashboard__header">
                <h3>Thị trường việc làm hôm nay <span><?= date('d/m/Y')?></span></h3>
            </div>
            <div class="block-dashboard__content">
                <div class="block-newest-job">
                    <img class="block-newest-job__img"
                        src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/welcome/dashboard/dashboard-item.png">
                    <div class="wrapper">
                        <p class="block-newest-job__title">Việc làm mới nhất</p>
                        <img class="block-newest-job__icon-top "
                            src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/welcome/dashboard/icon-top.png">
                        <div class id="sliderNewJobPublish">
                            @foreach( $lasest_jobs as $job )
                            <div class="job-item active animated zoomIn">
                                <a class="job-item__link" target="_blank" href="{{ route('website.jobs.show', $job->slug) }}">
                                    <img class="job-item__logo" src="{{ $job->userEmployee->image_fm }}">
                                </a>
                                <div>
                                    <a class="job-item__link" href="{{ route('website.jobs.show', $job->slug) }}" target="_blank">
                                        <p class="job-item__title">{{ $job->name }}</p>
                                    </a>
                                    <a class="job-item__link" target="_blank" href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}">
                                        <p class="job-item__company">{{ $job->userEmployee->name }}</p>
                                    </a>
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
                            <p class=" quantity quantity_job_new_today">{{ $quantity_job_new_today }}</p>
                            <p class="title">Việc làm mới 24h gần nhất</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_job_recruitment">{{ $quantity_job_recruitment }}</p>
                            <p class="title">Việc làm đang tuyển</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_company_recruitment">{{ $quantity_company_recruitment }}</p>
                            <p class="title">Công ty đang tuyển</p>
                        </div>
                    </div>
                    <div class="block-chart">
                        <div class="item-chart">
                            <div class="header">
                                <div class="title">
                                    <div class="icon"> <i class="fa-solid fa-arrow-trend-up"></i> </div> <span
                                        class="caption"> Tăng trưởng cơ hội việc làm </span>
                                </div>
                            </div> <img class="img-responsive loading-chart lazy"
                                data-src="https://static.topcv.vn/v4/image/welcome/section-header/loading-chart.svg" />
                            <div class="box-chart">
                                <div style="height: 220px"> <canvas id="myChartJobOpportunityGrowthDashboard"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="item-chart">
                            <div class="header">
                                <div class="title">
                                    <div class="icon"> <i class="fa-solid fa-arrow-trend-up"></i> </div> <span
                                        class="caption"> Nhu cầu tuyển dụng theo </span>
                                </div>
                                <div class="box-select"> <select name="demand-job-select"
                                        id="demand-job-select-dashboard" class="form-control select2">
                                        <option value="2"> Ngành nghề </option>
                                        <option value="4"> Mức lương </option>
                                    </select> </div>
                            </div> <img class="img-responsive loading-chart lazy"
                                data-src="https://static.topcv.vn/v4/image/welcome/section-header/loading-chart.svg" />
                            <div class="box-chart">
                                <div style="height: 170px"> <canvas id="myChartDemandJobDashboard"></canvas> </div>
                                <div id="htmlLegendDemandJobDashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('website-assets/css/dashboard.css')}}" rel="stylesheet">