<div id="dashboard-section" class="lazy" data-lazy-function="initDashboard">
    <div class="container lazy" id="dashboard" data-lazy-function="initDashboardHomeJS">
        <div class="block-dashboard">
            <div class="block-dashboard__header">
                <h3>Thị trường việc làm hôm nay <span>16/03/2024</span></h3>
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
                            <div class="job-item active animated zoomIn">
                                <a class="job-item__link" target="_blank" href="#">
                                    <img class="job-item__logo"
                                        src="https://cdn-new.topcv.vn/unsafe/200x/https://static.topcv.vn/company_logos/cong-ty-tnhh-multi-tech-solution-63f742639ad01.jpg">
                                </a>
                                <div>
                                    <a class="job-item__link" target="_blank">
                                        <p class="job-item__title">Digital Marketing Leader</p>
                                    </a>
                                    <a class="job-item__link" target="_blank" href="#">
                                        <p class="job-item__company">CÔNG TY TNHH MULTI TECH SOLUTION</p>
                                    </a>
                                    <p class="job-item__location">Hồ Chí Minh</p>
                                </div>
                            </div>
                            <div class="job-item active animated zoomIn">
                                <a class="job-item__link" target="_blank" href="#">
                                    <img class="job-item__logo"
                                        src="https://cdn-new.topcv.vn/unsafe/200x/https://static.topcv.vn/company_logos/cong-ty-tnhh-multi-tech-solution-63f742639ad01.jpg">
                                </a>
                                <div>
                                    <a class="job-item__link" target="_blank">
                                        <p class="job-item__title">Digital Marketing Leader</p>
                                    </a>
                                    <a class="job-item__link" target="_blank" href="#">
                                        <p class="job-item__company">CÔNG TY TNHH MULTI TECH SOLUTION</p>
                                    </a>
                                    <p class="job-item__location">Hồ Chí Minh</p>
                                </div>
                            </div>
                            <div class="job-item active animated zoomIn">
                                <a class="job-item__link" target="_blank" href="#">
                                    <img class="job-item__logo"
                                        src="https://cdn-new.topcv.vn/unsafe/200x/https://static.topcv.vn/company_logos/cong-ty-tnhh-multi-tech-solution-63f742639ad01.jpg">
                                </a>
                                <div>
                                    <a class="job-item__link" target="_blank">
                                        <p class="job-item__title">Digital Marketing Leader</p>
                                    </a>
                                    <a class="job-item__link" target="_blank" href="#">
                                        <p class="job-item__company">CÔNG TY TNHH MULTI TECH SOLUTION</p>
                                    </a>
                                    <p class="job-item__location">Hồ Chí Minh</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-statistics-job">
                    <div class="block-work-market work-market">
                        <div class="item">
                            <p class=" quantity quantity_job_new_today">1.921</p>
                            <p class="title">Việc làm mới 24h gần nhất</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_job_recruitment">50.635</p>
                            <p class="title">Việc làm đang tuyển</p>
                        </div>
                        <div class="item">
                            <p class="quantity quantity_company_recruitment">15.224</p>
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