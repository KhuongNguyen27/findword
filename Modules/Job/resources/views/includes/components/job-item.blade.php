<?php
$startDate = time(); // Chuyển ngày bắt đầu thành dạng timestamp
$endDate = strtotime($job->deadline); // Chuyển ngày kết thúc thành dạng timestamp
$remainingDays = ($endDate - $startDate) / (60 * 60 * 24); // Tính số ngày còn lại
$remainingDays = round($remainingDays);
$updated_at = $job->updated_at ? $job->updated_at->diffForHumans() : '';

$small_logo_border_color = @$job->job_package->job_small_logo_border_color;
$small_logo_border_color_style = $small_logo_border_color ? 'border-color: ' . $small_logo_border_color . ' !important;' : '';
$small_title_color = @$job->job_package->job_small_title_color;
$small_title_color_style = $small_title_color ? 'color: ' . $small_title_color . ' !important;' : '';
$small_box_border_color = @$job->job_package->job_small_box_border_color;
$small_box_border_color_style = $small_box_border_color ? 'color: ' . $small_box_border_color . ' !important;' : '';

$detail_header_bg = @$job->job_package->job_detail_header_bg;
$detail_company_bg = @$job->job_package->job_detail_company_bg;

$job->work_address = str_replace(', Vietnam', '', $job->work_address);
$job->work_address = str_replace(', Việt Nam', '', $job->work_address);
$work_address = explode(',', $job->work_address);
$job->work_address = end($work_address);
// $job->work_address = end( explode(',',$job->work_address) );

if( $job->province ){
    $job->province->name = str_replace('Tỉnh','',$job->province->name);
    $job->province->name = str_replace('Thành phố','',$job->province->name);
}
?>
<?php if($job->userEmployee):?>
<div class="job-block col-job-info job-jobpackage job-jobpackage-{{ $job->jobpackage_id }}">
    <div class="inner-box" style="{{ $small_box_border_color_style }}">
        <div class="content">
            <span class="tag-job-flash">
                @if ( @$job->job_package->image_fm)
                    <img src="{{ $job->job_package->image_fm }}" alt="">
                @endif
            </span>
            <span class="company-logo" style="{{ $small_logo_border_color_style }}">
                <img src="{{ $job->userEmployee->image_fm }}">
            </span>
            <h4 class="job-title quickview-job text_ellipsis" title="{{ $job->name }}">
                <a style="{{ $small_title_color_style }}"
                    href="{{ route('website.jobs.show', $job->slug) }}">{{ $job->name }}</a>
            </h4>
            @if (isset($company_name))
                <a href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}"
                    class="text-silver company company_name">
                    <span class="text_ellipsis">{{ $job->userEmployee->name }}</span>
                </a>
            @endif
            @if ($job_info)
                <ul class="job-info mb-0">
                    <li>
                        @if (auth()->check())
                            <span class="salary">
                            {{ $job->salary_fm }}
                            </span>
                        @else
                            <span class="salary bg-warning"><a class="text-dark" href="{{ route('staff.login') }}">Xem
                                    mức lương</a></span>
                        @endif
                    </li>
                    <li><span class="address">{{ $job->province->name }}</span></li>
                    @if (@$job_other_info)
                        <li><span class="salary job-updated">Cập nhật <?= $updated_at ?></span></li>
                        <li><span class="salary job-remain">Còn <?php echo $remainingDays; ?> ngày để ứng tuyển</span></li>
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
<?php endif;?>