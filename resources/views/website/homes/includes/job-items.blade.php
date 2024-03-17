<section class="job-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Việc làm mới nhất</h2>
            <!-- <div class="text">Biết giá trị của bạn và tìm công việc phù hợp với cuộc sống của bạn</div> -->
        </div>

        <div class="row wow fadeInUp">
            @foreach ($jobs as $job)
            <!-- Job Block -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                @include('job::includes.components.job-item', [
                    'job' => $job,
                    'job_info' => true,
                    'job_other_info' => true,
                    'bookmark' => true,
                    'simple' => true,
                ])
            </div>
            @endforeach
        </div>

        <div class="btn-box">
            <a href="{{ route('website.home') }}" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Tải thêm danhsách</span></a>
        </div>
    </div>
</section>