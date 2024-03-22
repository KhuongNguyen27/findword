<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<div class="job-block col-job-info">
    <div class="inner-box">
        <div class="content">
            <span class="company-logo"><img src="{{ asset($job->getImage($job->user_id)) }}" alt=""></span>
            <h4 class="job-title quickview-job text_ellipsis">
                <a href="{{ route('website.jobs.show', $job->slug) }}">{{ $job->name }}</a>
            </h4>
            @if (@$company_name)
            <a href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}"
                class="text-silver company text_ellipsis company_name">{{ $job->userEmployee->name }}</a>
            @endif
            @if ($job_info)
            <ul class="job-info">
                <li><span class="salary">{{ $job->wage->name ?? '' }}</span></li>
                <li><span class="address">{{ $job->work_address }}</span></li>
                @if ($job_info)
                <li><span class="address">Cập nhật 1 giờ trước</span></li>
                <li><span class="address">Còn 40 ngày để ứng tuyển</span></li>
                @endif
            </ul>
            @endif
            @if ($bookmark)
            <a href="javascript:;" class="bookmark-btn"
                data-href="{{ route('staff.job-favorite', ['id' => $job->id]) }}">
                @if (in_array($job->id, $cr_user_favorites))
                <span class="flaticon-bookmark active"></span>
                @else
                <span class="flaticon-bookmark"></span>
                @endif
            </a>
            @endif

        </div>
    </div>
</div>