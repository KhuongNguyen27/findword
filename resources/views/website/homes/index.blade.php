@extends('website.layouts.master')
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
@include('website.homes.includes.job-items')
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
<script src="{{ asset('website-assets/chart/chart.js')}}"></script>
<!-- <script src="{{ asset('website-assets/js/chart-demand-job-home-page.js')}}"></script> -->
<script src="{{ asset('website-assets/chart/chart-demand-job-dashboard.js')}}"></script>
<script src="{{ asset('website-assets/chart/chart-job-opportunity-growth-dashboard.js')}}"></script>
<script>
$(document).ready(function() {
    let indexSectionTitle = 1;
    const arraySectionTitle = [
        "Định hướng nghề nghiệp",
        "Việc làm mới",
        "Công ty phù hợp",
        "Phúc lợi tốt",
        "Mức lương cao",
        "Thông tin thị trường",
        "CV mới",
    ];

    setInterval(() => {
        $("#section-header .section-title").fadeOut(200, function() {
            $(this).html(arraySectionTitle[indexSectionTitle]).fadeIn();
        });

        indexSectionTitle++;
        if (indexSectionTitle >= arraySectionTitle.length) {
            indexSectionTitle = 0;
        }
    }, 2000);

    setTimeout(() => {
        $('#section-header #frm-search-job select.select2').each((i, el) => {
            let option = {
                dropdownParent: $(el).parent(),
            }
            const arrNotSeacrh = ['salary-advanced', 'exp-advanced'];

            if (arrNotSeacrh.includes($(el).attr('id'))) {
                option['minimumResultsForSearch'] = -1
            }
            $(el).select2(option).data('select2').$dropdown.addClass(
                "dropdown-box-search-home-page");
        });

        $('#section-header #demand-job-select').each((i, el) => {
            $(el).select2({
                dropdownParent: $(el).parent(),
            }).data('select2').$dropdown.addClass("dropdown-demand-job-home-page");
        });
    }, 0);

    requestAnimationFrame(() => {
        window.ChartDemandJobHomePage.init([], 'myChartDemandJobHomePage');
    });


    loadChart()
    loadWorkMarket()

    $('#section-header #demand-job-select').change(function() {
        loadChart()
        if ($('#demand-job-select-dashboard')) {
            $('#demand-job-select-dashboard').val($('#section-header #demand-job-select').val())
                .trigger('change')
        }

    })

    function loadChart() {
        $.ajax({
            url: "https://www.topcv.vn/get-recruitment-demand",
            data: {
                type: $('#section-header #demand-job-select').val()
            },
            type: 'get',
            success: function(response) {
                if (response.status == 'success') {
                    $('#section-header .loading-chart').css("display", "none")
                    $('#section-header .box-chart').css("display", "block")
                    setTimeout(() => {
                        requestAnimationFrame(() => {
                            window.ChartDemandJobHomePage.update(response.data)
                        })
                    }, 100);
                } else {
                    console.log('failed!');
                }
            },
            error: function(error) {
                console.log('failed!');
            }
        });
    }

    function loadWorkMarket() {
        var dataWorkMarket = getDataWorkMarketLocalStorage();

        if (dataWorkMarket != null) {
            fillDataWorkMarket(dataWorkMarket);
        }

        $.ajax({
            url: "https://www.topcv.vn/get-work-market",
            type: 'get',
            success: function(response) {
                if (response.status == 'success') {
                    const data = response.data;
                    data.timestamp = new Date().getTime()
                    localStorage.setItem("data_work_market_home_page", JSON.stringify(data))
                    if (dataWorkMarket == null) {
                        fillDataWorkMarket(data);
                    }
                } else {
                    console.log('failed!');
                }
            },
            error: function(error) {
                console.log('failed!');
            }
        });
    }

    function fillDataWorkMarket(data) {
        for (let index in data) {
            $("#section-header .box-demand-job_work-market [name=" + index + "]").html(data[
                index])
        }

        $('#section-header .box-demand-job_work-market .quantity').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1500,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now).toLocaleString(
                        'vi-VN'));
                }
            });
        });

        if (data.quantity_job_recruitment >= data
            .quantity_job_recruitment_yesterday) {
            $("#section-header .box-demand-job_work-market .job-hiring .status")
                .addClass("up")
        } else {
            $("#section-header .box-demand-job_work-market .job-hiring .status")
                .addClass("down")
        }
    }

    function getDataWorkMarketLocalStorage() {
        var dataWorkMarket = localStorage.getItem("data_work_market_home_page");

        if (dataWorkMarket) {
            dataWorkMarket = JSON.parse(dataWorkMarket)
            var checkTime = checkTimeDistance(dataWorkMarket.timestamp, new Date().getTime(), 5)
            if (!checkTime) {
                return dataWorkMarket;
            }
            return null;
        }
        return null;
    }

    function checkTimeDistance(time1, time2, distance) {
        const diff = Math.abs(time1 - time2);
        const distanceInMillis = distance * 60000;
        return diff >= distanceInMillis;
    }

    $("#section-header .box-load-more").click(function() {
        $('html, body').animate({
            scrollTop: $("#dashboard").offset().top - 100
        }, 1000);
    });
})
</script>
<script>

</script>
@endsection