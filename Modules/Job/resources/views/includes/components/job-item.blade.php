<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<div class="job-block col-job-info">
    <div class="inner-box">
        <div class="content">
            <span class="company-logo"><img src="{!! asset($job->getImage()) !!}">
            </span>
            <h4 class="job-title quick  view-job text_ellipsis" title="{{ $job->name }}">
                <a href="{{ route('website.jobs.show', $job->slug) }}">{{ $job->name }}</a>
            </h4>
            @if (isset($company_name))
            <a href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}"
                class="text-silver company text_ellipsis company_name">{{ $job->userEmployee->name }}</a>
            @endif
            @if ($job_info)
            <ul class="job-info mb-0">
                <li>
                    @if( auth()->check() )
                    <span class="salary">{{ $job->wage->name ?? '' }}</span>
                    @else
                    <span class="salary bg-warning"><a class="text-dark" href="{{ route('staff.login') }}">Đăng nhập để
                            xem</a></span>
                    @endif
                </li>
                <li><span class="address">{{ $job->work_address }}</span></li>
                @if (@$job_other_info)
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
            <div class="quickview-job-hide"></div>
            <div class="quickview-job-content" style="display:none;">
                <div class="box-job-quick-view-tooltip">
                    @include('job::includes.components.quickview-job-tooplip')
                </div>
            </div>
        </div>
    </div>
</div>