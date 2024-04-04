<?php
$startDate = strtotime($job->start_day); // Chuyển ngày bắt đầu thành dạng timestamp
$endDate = strtotime($job->end_day); // Chuyển ngày kết thúc thành dạng timestamp
$remainingDays = ($endDate - $startDate) / (60 * 60 * 24); // Tính số ngày còn lại
$updated_at = $job->updated_at->diffForHumans();
?>
<div class="job-block col-job-info job-jobpackage job-jobpackage-{{ $job->jobpackage_id }}">
    <div class="inner-box">
        <div class="content">
            <span class="tag-job-flash">
                @if( $job->job_package->image_fm )
                <img src="{{ $job->job_package->image_fm }}" alt="">
                @endif
            </span>
            <span class="company-logo">
                <img src="{{ $job->userEmployee->image_fm }}">
            </span>
            <h4 class="job-title quickview-job text_ellipsis" title="{{ $job->name }}">
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
                    <span class="salary bg-warning"><a class="text-dark" href="{{ route('staff.login') }}">Xem mức lương</a></span>
                    @endif
                </li>
                <li><span class="address">{{ $job->work_address }}</span></li>
                @if (@$job_other_info)
                <li><span class="address">Cập nhật <?= $updated_at; ?></span></li>
                <li><span class="address">Còn <?php echo $remainingDays;?> ngày để ứng tuyển</span></li>
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