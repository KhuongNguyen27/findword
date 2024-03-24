<div class="box-job-quick-view-tooltip">
    <div class="box-header">
        <div class="d-flex block-title">
            <div class="company-logo">
                <img src="https://cdn-new.topcv.vn/unsafe/200x/https://static.topcv.vn/company_logos/1c3aa6f39db515931564bfe6f6e86255-65f2c4b29642e.jpg"
                    alt="">
            </div>
            <div class="job-title-block">
                <h2 class="title">
                    {{ $job->name }}
                </h2>
                <a href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}"
                    class="company-name">
                    {{ $job->userEmployee->name }}
                </a>
                @if( auth()->check() )
                    <label class="salary">{{ $job->wage->name ?? '' }}</label>
                @else
                    <label class="salary bg-warning"><a class="text-dark" href="{{ route('staff.login') }}">Đăng nhập để xem</a></label>
                @endif
            </div>
        </div>
        <div class="d-flex block-info">
            <div class="location block-info_item">
                <i class="fa fa-location-dot"></i>
                <span>{{ $job->work_address }}</span>
            </div>
            <div class="exp block-info_item">
                <i class="fa-solid fa-business-time"></i>
                <span>1 năm</span>
            </div>
            <div class="deadline block-info_item">
                <i class="fa fa-clock"></i>
                <span>Còn 22 ngày</span>
            </div>
        </div>
    </div>
    <div class="box-header-scroll">
        <div class="job-title-block">
            <h2 class="title">
            {{ $job->name }}
            </h2>
        </div>
    </div>
    <div class="box-scroll" style="height: 260px;">
        <div class="box-job-info">
            <h3 class="box-job-info_title job-description">Mô tả công việc</h3>
            <div class="content-tab">
            {!! $job->description ?? '-' !!}
            </div>
            <h3 class="box-job-info_title job-requirement">Yêu cầu ứng viên</h3>
            <div class="content-tab">
            {!! $job->requirements ?? '-'!!}
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a class="btn btn-apply btn-apply-now-quick-view" href="{{ route('website.jobs.aplication', ['id' => $job->slug]) }}">Ứng tuyển</a>
        <a class="btn btn-view-detail-quick-view"  href="{{ route('website.jobs.show', $job->slug) }}">Xem chi tiết</a>
    </div>

</div>