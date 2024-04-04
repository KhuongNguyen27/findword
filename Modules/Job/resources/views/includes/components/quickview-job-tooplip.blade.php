<div class="box-job-quick-view-tooltip">
    <div class="box-header">
        <div class="d-flex block-title">
            <div class="company-logo">
                <img src="{{ asset($job->userEmployee->image_fm) }}" alt="Company Logo">
            </div>

            <div class="job-title-block">
                <h2 class="title">
                    {{ $job->name }}
                </h2>
                @if (isset($company_name) || true)
                    <a href="{{ route('employee.show', ['id' => $job->userEmployee->slug]) }}" class="company-name">
                        {{ $job->userEmployee->name }}
                    </a>
                @endif
                @if (auth()->check())
                    <label class="salary">{{ $job->wage->name ?? '' }}</label>
                @else
                    <label class="salary bg-warning"><a class="text-dark" href="{{ route('staff.login') }}">Đăng nhập để
                            xem</a></label>
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
                @if($job->experience > 0)
                    <span>{{ $job->experience }} năm kinh nghiệm</span>
                @else
                    <span>Không yêu cầu kinh nghiệm</span>
                @endif
            </div>
                <?php
                $startDate = strtotime($job->start_day); // Chuyển ngày bắt đầu thành dạng timestamp
                $endDate = strtotime($job->end_day); // Chuyển ngày kết thúc thành dạng timestamp
                $remainingDays = ($endDate - $startDate) / (60 * 60 * 24); // Tính số ngày còn lại
                ?>
                <div class="deadline block-info_item">
                    <i class="fa fa-clock"></i>
                    <input type="date" value="{{ $job->start_day }}" name="start_day">
                    <input type="date" value="{{ $job->end_day }}" name="end_day">
                    <span id="remaining_days">Còn <?php echo $remainingDays;?> ngày để ứng tuyển</span>
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
                {!! $job->requirements ?? '-' !!}
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a class="btn btn-apply btn-apply-now-quick-view"
            href="{{ route('website.jobs.aplication', ['id' => $job->slug]) }}">Ứng tuyển</a>
        <a class="btn btn-view-detail-quick-view" href="{{ route('website.jobs.show', $job->slug) }}">Xem chi tiết</a>
    </div>

    
</div>
