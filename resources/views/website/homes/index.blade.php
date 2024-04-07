@extends('website.layouts.master')
@section('title') {{ env('APP_NAME') }} @endsection
@section('content')

<!-- Banner Section-->
<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<section class="banner-section pb-5">
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
                    <!-- Job Search Form -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Banner Section-->


<!-- Job Section -->
@include('website.homes.includes.job-items',[
'sec_title' => 'Việc làm tốt nhất',
'chunk_jobs' => $vip_jobs,
'item_class' => 'col-lg-4 col-md-12 col-sm-12',
'sec_link' => route('jobs.vnjobs','tot-nhat')
])
<!-- End Job Section -->

@include('website.includes.global.ad-banners')

<!-- top-companies -->
@include('website.homes.includes.top-companies')
<!-- End Testimonial Section -->

@include('website.includes.global.attractive-jobs')

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
function createJob(items) {
    var data = [];
    var labels = [];
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        data.push(item.count);
        labels.push(item.date);
    }
    return {
        labels: labels,
        data: data
    };
}
function createCareer(items) {
    var data = [];
    var labels = [];
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        data.push(item.jobs_count);
        labels.push(item.name);
    }
    return {
        labels: labels,
        data: data
    };
}

var data_careers = {!!$statistical_career_jobs_json!!};
var data_jobs = {!!$statistical_jobs_json!!};
var chart_career = createCareer(data_careers);
var chart_job = createJob(data_jobs);

const ctx = document.getElementById('myChartJobOpportunityGrowthDashboard');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: chart_job.labels,
        datasets: [{
            data: chart_job.data,
            backgroundColor: '#4ec3bf',
            borderColor: 'rgba(255, 99, 132, 1)',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
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
        labels: chart_career.labels,
        datasets: [{
            data: chart_career.data,
            borderWidth: 1,
            // backgroundColor: '#4ec3bf',
            borderColor: 'rgba(255, 99, 132, 1)',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
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
@endsection