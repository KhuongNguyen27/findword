@extends('website.layouts.master')
@section('content')
@php
$job_detail_header_bg = @$job->job_package->job_detail_header_bg;
$job_detail_company_bg = @$job->job_package->job_detail_company_bg;
$job_detail_header_bg = $job_detail_header_bg ? $job_detail_header_bg . ' !important' : '';
$job_detail_company_bg = $job_detail_company_bg ? $job_detail_company_bg . ' !important' : '';
@endphp

<style>
    .job-detail__company--link a {
        color: #0d6efd !important;
    }

    .job-detail__box--right.job-detail__company {
        margin-bottom: 30px;
    }

    .job-detail__box--right.job-detail__company {
        height: 230px;
    }

</style>
<section class="job-real-detail-section job-detail-section pt-5 job-package-{{ @$job->job_package->slug }}">
    <div class="job-detail-outer">
        <div class="auto-container">
            <!-- Job Block -->
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="job-block-outer" style="background-color: {{ $job_detail_header_bg }};">
                        <div class="job-block-seven style-two">
                            <div class="inner-box">
                                <div class="content">
                                    <h1 class="job-detail-title">
                                        <a href="{{ route('website.jobs.show', $job->slug) }}">@php
                                            use Illuminate\Support\Str;
                                            $jobName = Str::limit($job->name, 70);
                                            @endphp
                                            {{ $jobName }}</a>
                                    </h1>
                                    <div class="job-detail__info--sections">
                                        <div class="job-detail__info--section">
                                            <div class="job-detail__info--section-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21.92 16.75C21.59 19.41 19.41 21.59 16.75 21.92C15.14 22.12 13.64 21.68 12.47 20.82C11.8 20.33 11.96 19.29 12.76 19.05C15.77 18.14 18.14 15.76 19.06 12.75C19.3 11.96 20.34 11.8 20.83 12.46C21.68 13.64 22.12 15.14 21.92 16.75Z" fill="white"></path>
                                                    <path d="M9.99 2C5.58 2 2 5.58 2 9.99C2 14.4 5.58 17.98 9.99 17.98C14.4 17.98 17.98 14.4 17.98 9.99C17.97 5.58 14.4 2 9.99 2ZM9.05 8.87L11.46 9.71C12.33 10.02 12.75 10.63 12.75 11.57C12.75 12.65 11.89 13.54 10.84 13.54H10.75V13.59C10.75 14 10.41 14.34 10 14.34C9.59 14.34 9.25 14 9.25 13.59V13.53C8.14 13.48 7.25 12.55 7.25 11.39C7.25 10.98 7.59 10.64 8 10.64C8.41 10.64 8.75 10.98 8.75 11.39C8.75 11.75 9.01 12.04 9.33 12.04H10.83C11.06 12.04 11.24 11.83 11.24 11.57C11.24 11.22 11.18 11.2 10.95 11.12L8.54 10.28C7.68 9.98 7.25 9.37 7.25 8.42C7.25 7.34 8.11 6.45 9.16 6.45H9.25V6.41C9.25 6 9.59 5.66 10 5.66C10.41 5.66 10.75 6 10.75 6.41V6.47C11.86 6.52 12.75 7.45 12.75 8.61C12.75 9.02 12.41 9.36 12 9.36C11.59 9.36 11.25 9.02 11.25 8.61C11.25 8.25 10.99 7.96 10.67 7.96H9.17C8.94 7.96 8.76 8.17 8.76 8.43C8.75 8.77 8.81 8.79 9.05 8.87Z" fill="white"></path>
                                                </svg>
                                            </div>
                                            <div class="job-detail__info--section-content">
                                                <div class="job-detail__info--section-content-title">Mức lương</div>
                                                <div class="job-detail__info--section-content-value">
                                                    @if (auth()->check())
                                                    {{ $job->salary_fm }}
                                                    @else
                                                    <a href="{{ route('staff.login') }}">Đăng nhập để xem</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-detail__info--section" id="job-detail-info-experience">
                                            <div class="job-detail__info--section-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.39 15.67L13.35 12H10.64L6.59998 15.67C5.46998 16.69 5.09998 18.26 5.64998 19.68C6.19998 21.09 7.53998 22 9.04998 22H14.94C16.46 22 17.79 21.09 18.34 19.68C18.89 18.26 18.52 16.69 17.39 15.67ZM13.82 18.14H10.18C9.79998 18.14 9.49998 17.83 9.49998 17.46C9.49998 17.09 9.80998 16.78 10.18 16.78H13.82C14.2 16.78 14.5 17.09 14.5 17.46C14.5 17.83 14.19 18.14 13.82 18.14Z" fill="white"></path>
                                                    <path d="M18.35 4.32C17.8 2.91 16.46 2 14.95 2H9.04998C7.53998 2 6.19998 2.91 5.64998 4.32C5.10998 5.74 5.47998 7.31 6.60998 8.33L10.65 12H13.36L17.4 8.33C18.52 7.31 18.89 5.74 18.35 4.32ZM13.82 7.23H10.18C9.79998 7.23 9.49998 6.92 9.49998 6.55C9.49998 6.18 9.80998 5.87 10.18 5.87H13.82C14.2 5.87 14.5 6.18 14.5 6.55C14.5 6.92 14.19 7.23 13.82 7.23Z" fill="white"></path>
                                                </svg>
                                            </div>
                                            <div class="job-detail__info--section-content">
                                                <div class="job-detail__info--section-content-title">Kinh nghiệm</div>
                                                <div class="job-detail__info--section-content-value">
                                                    {{ $job->experience ? $job->experience . ' năm' : 'Không yêu cầu' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="job-detail__info--flex mt-3">
                                        <!-- <div class="quantity-applied-user disabled">
                                                        <div class="quantity-applied-user__icon">
                                                            <i class="fa fa-solid fa-lock"></i>
                                                        </div>
                                                        <div class="quantity-applied-user__text">
                                                            Số lượt ứng tuyển: -
                                                        </div>
                                                    </div> -->
                                        <div class="job-detail__info--deadline">
                                            <span class="job-detail__info--deadline--icon">
                                                <i class="fa fa-solid fa-clock"></i>
                                            </span>
                                            Hạn nộp hồ sơ:
                                            {{ $job->deadline ? date('d/m/Y', strtotime($job->deadline)) : '-' }}
                                        </div>
                                        <div class="job-detail__info--deadline">
                                            <span class="job-detail__info--deadline--icon">
                                                <i class="fa fa-solid fa-map"></i>
                                            </span>
                                            {{ $job->work_address }}
                                        </div>
                                    </div>

                                    <div class="job-detail__info--actions box-apply-current mt-3">
                                        <a href="{{ route('website.jobs.aplication', ['id' => $job->slug]) }}" class="job-detail__info--actions-button button-primary btn-apply-job">
                                            <span class="button-icon">
                                                <i class="fa fa-light fa-paper-plane"></i>
                                            </span>
                                            Ứng tuyển ngay
                                        </a>
                                        <a class="job-detail__info--actions-button button-white do-bookmark" data-href="{{ route('staff.job-favorite', ['id' => $job->id]) }}">
                                            <span class="button-icon {{ in_array($job->id, $cr_user_favorites) ? 'active' : '' }}">
                                                <i class="fa fa-regular fa-heart"></i>
                                            </span>
                                            Yêu thích
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job-detail">
                        <h4 class="job-sub-title">Chi tiết tuyển dụng </h4>
                        <div class="text">
                            {!! $job->description ?? '-' !!}
                        </div>
                        <h4 class="job-sub-title">Yêu cầu</h4>
                        <div class="text">
                            {!! $job->requirements ?? '-' !!}
                        </div>
                        @if ($job->more_information)
                        <div class="job-sub-title">{{ __('more_information') }}</div>
                        <div class="text">
                            {!! $job->more_information !!}
                        </div>
                        @endif
                    </div>

                  

                    <div class="job-detail">
                        <h4 class="job-sub-title">Việc làm cùng công ty</h4>
                        <div class="row">
                            @foreach ($job_employ as $job)
                            <!-- Job Block -->
                            @if($job && $job->status == 1)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @include('job::includes.components.job-item', [
                                'job' => $job,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'simple' => true,
                                ])
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="job-detail">
                        <h4 class="job-sub-title">Việc làm liên quan</h4>
                        <div class="row">
                            @foreach ($job_relate_to as $job_relate)
                            <!-- Job Block -->
                            @if($job_relate)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @include('job::includes.components.job-item', [
                                'job' => $job_relate,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'simple' => true,
                                ])
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">

                        <!-- Company info -->
                        <div class="job-detail__box--right job-detail__company" style="background-color: {{ $job_detail_company_bg }};">
                            <div class="job-detail__company--information">
                                <div class="job-detail__company--information-item company-name">
                                    <a rel="nofollow" class="company-logo" href="{{ route('employee.show', $job->userEmployee->slug) }}" target="_blank" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ $job->userEmployee->name }}">

                                        <img src="{{ $job->userEmployee->image_fm }}" alt="{{ $job->userEmployee->name }}" class="img-responsive">
                                    </a>
                                    <h2 class="company-name-label">
                                        <a rel="nofollow" class="name" href="{{ route('employee.show', $job->userEmployee->slug) }}" target="_blank" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ $job->userEmployee->name }}">{{ $job->userEmployee->name }}</a>
                                        <div class="company-subdetail-label">
                                            {{ $job->userEmployee->website }}
                                        </div>
                                    </h2>
                                </div>
                                <div class="job-detail__company--information-item company-address">
                                    <div class="company-title mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M13.7467 5.63334C13.0467 2.55334 10.36 1.16667 8 1.16667C8 1.16667 8 1.16667 7.99334 1.16667C5.64 1.16667 2.94667 2.54667 2.24667 5.62667C1.46667 9.06667 3.57334 11.98 5.48 13.8133C6.18667 14.4933 7.09334 14.8333 8 14.8333C8.90667 14.8333 9.81334 14.4933 10.5133 13.8133C12.42 11.98 14.5267 9.07334 13.7467 5.63334ZM8 8.97334C6.84 8.97334 5.9 8.03334 5.9 6.87334C5.9 5.71334 6.84 4.77334 8 4.77334C9.16 4.77334 10.1 5.71334 10.1 6.87334C10.1 8.03334 9.16 8.97334 8 8.97334Z" fill="#7F878F"></path>
                                        </svg>
                                        Địa điểm:
                                    </div>
                                    <div class="company-value" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ $job->userEmployee->address }}">
                                        {{ $job->userEmployee->address }}
                                    </div>
                                </div>
                            </div>
                            <div class="job-detail__company--link">
                                <a rel="nofollow" href="{{ route('employee.show', $job->userEmployee->slug) }}" target="_blank">Xem trang công ty</a>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </div>
                        </div>

                        <!-- Thông tin chi tiết -->
                        <div class="mt-3 job-detail__box--right job-detail__body-right--item job-detail__body-right--box-general">
                            <h2 class="box-title">Thông tin chung</h2>
                            <div class="box-general-content">
                                <div class="button-view-job-fitness" id="button-view-job-fitness">
                                    <div class="button-view-job-fitness__header">
                                        <div class="button-view-job-fitness__header--title">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.71429 1.71429C5.71429 0.767857 6.48214 0 7.42857 0H8.57143C9.51786 0 10.2857 0.767857 10.2857 1.71429V14.2857C10.2857 15.2321 9.51786 16 8.57143 16H7.42857C6.48214 16 5.71429 15.2321 5.71429 14.2857V1.71429ZM0 8.57143C0 7.625 0.767857 6.85714 1.71429 6.85714H2.85714C3.80357 6.85714 4.57143 7.625 4.57143 8.57143V14.2857C4.57143 15.2321 3.80357 16 2.85714 16H1.71429C0.767857 16 0 15.2321 0 14.2857V8.57143ZM13.1429 2.28571H14.2857C15.2321 2.28571 16 3.05357 16 4V14.2857C16 15.2321 15.2321 16 14.2857 16H13.1429C12.1964 16 11.4286 15.2321 11.4286 14.2857V4C11.4286 3.05357 12.1964 2.28571 13.1429 2.28571Z" fill="#00B14F"></path>
                                            </svg>
                                            Phân tích mức độ phù hợp
                                        </div>
                                        <div class="button-view-job-fitness__header--badge">
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.00054 9.99999C4.86887 10.0007 4.74014 9.96113 4.63154 9.88668C4.52294 9.81224 4.43965 9.70642 4.39279 9.58337L3.35541 6.88575C3.3344 6.83139 3.30226 6.78202 3.26105 6.74082C3.21984 6.69961 3.17047 6.66747 3.11611 6.64645L0.417716 5.60829C0.294798 5.56111 0.189074 5.47777 0.114498 5.36927C0.0399225 5.26077 0 5.1322 0 5.00054C0 4.86888 0.0399225 4.74032 0.114498 4.63182C0.189074 4.52331 0.294798 4.43997 0.417716 4.3928L3.11533 3.35541C3.16969 3.3344 3.21906 3.30226 3.26027 3.26105C3.30148 3.21984 3.33362 3.17048 3.35463 3.11612L4.39279 0.417716C4.43997 0.294798 4.52331 0.189074 4.63181 0.114498C4.74031 0.0399224 4.86888 0 5.00054 0C5.1322 0 5.26076 0.0399224 5.36927 0.114498C5.47777 0.189074 5.56111 0.294798 5.60828 0.417716L6.64567 3.11533C6.66668 3.16969 6.69882 3.21906 6.74003 3.26027C6.78124 3.30148 6.8306 3.33362 6.88496 3.35463L9.56695 4.38655C9.69488 4.43396 9.80508 4.51965 9.88256 4.63194C9.96005 4.74422 10.001 4.87766 9.99998 5.01408C9.99799 5.14345 9.95722 5.26925 9.88295 5.37518C9.80867 5.48112 9.7043 5.56233 9.58336 5.60829L6.88574 6.64567C6.83138 6.66668 6.78202 6.69883 6.74081 6.74003C6.6996 6.78124 6.66746 6.83061 6.64645 6.88497L5.60828 9.58337C5.56143 9.70642 5.47813 9.81224 5.36953 9.88668C5.26094 9.96113 5.1322 10.0007 5.00054 9.99999Z" fill="#966D05"></path>
                                            </svg>
                                            New
                                        </div>
                                    </div>
                                    <div class="button-view-job-fitness__button">
                                        Xem ngay
                                    </div>
                                </div>
                                @if ($job->level)
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.81 5.49V6.23L14.27 4.18C12.93 3.41 11.06 3.41 9.73 4.18L6.19 6.24V5.49C6.19 3.24 7.42 2 9.67 2H14.33C16.58 2 17.81 3.24 17.81 5.49Z" fill="white"></path>
                                            <path d="M17.84 7.96999L17.7 7.89999L16.34 7.11999L13.52 5.48999C12.66 4.98999 11.34 4.98999 10.48 5.48999L7.66 7.10999L6.3 7.90999L6.12 7.99999C4.37 9.17999 4.25 9.39999 4.25 11.29V15.81C4.25 17.7 4.37 17.92 6.16 19.13L10.48 21.62C10.91 21.88 11.45 21.99 12 21.99C12.54 21.99 13.09 21.87 13.52 21.62L17.88 19.1C19.64 17.92 19.75 17.71 19.75 15.81V11.29C19.75 9.39999 19.63 9.17999 17.84 7.96999ZM14.79 13.5L14.18 14.25C14.08 14.36 14.01 14.57 14.02 14.72L14.08 15.68C14.12 16.27 13.7 16.57 13.15 16.36L12.26 16C12.12 15.95 11.89 15.95 11.75 16L10.86 16.35C10.31 16.57 9.89 16.26 9.93 15.67L9.99 14.71C10 14.56 9.93 14.35 9.83 14.24L9.21 13.5C8.83 13.05 9 12.55 9.57 12.4L10.5 12.16C10.65 12.12 10.82 11.98 10.9 11.86L11.42 11.06C11.74 10.56 12.25 10.56 12.58 11.06L13.1 11.86C13.18 11.99 13.36 12.12 13.5 12.16L14.43 12.4C15 12.55 15.17 13.05 14.79 13.5Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Cấp bậc</div>
                                        <div class="box-general-group-info-value">{{ $job->rank->name }}</div>
                                    </div>
                                </div>
                                @endif
                                @if ($job->wage)
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M9 2C6.38 2 4.25 4.13 4.25 6.75C4.25 9.32 6.26 11.4 8.88 11.49C8.96 11.48 9.04 11.48 9.1 11.49C9.12 11.49 9.13 11.49 9.15 11.49C9.16 11.49 9.16 11.49 9.17 11.49C11.73 11.4 13.74 9.32 13.75 6.75C13.75 4.13 11.62 2 9 2Z" fill="white"></path>
                                            <path d="M14.08 14.15C11.29 12.29 6.74002 12.29 3.93002 14.15C2.66002 15 1.96002 16.15 1.96002 17.38C1.96002 18.61 2.66002 19.75 3.92002 20.59C5.32002 21.53 7.16002 22 9.00002 22C10.84 22 12.68 21.53 14.08 20.59C15.34 19.74 16.04 18.6 16.04 17.36C16.03 16.13 15.34 14.99 14.08 14.15Z" fill="white"></path>
                                            <path d="M19.99 7.34001C20.15 9.28001 18.77 10.98 16.86 11.21C16.85 11.21 16.85 11.21 16.84 11.21H16.81C16.75 11.21 16.69 11.21 16.64 11.23C15.67 11.28 14.78 10.97 14.11 10.4C15.14 9.48001 15.73 8.10001 15.61 6.60001C15.54 5.79001 15.26 5.05001 14.84 4.42001C15.22 4.23001 15.66 4.11001 16.11 4.07001C18.07 3.90001 19.82 5.36001 19.99 7.34001Z" fill="white"></path>
                                            <path d="M21.99 16.59C21.91 17.56 21.29 18.4 20.25 18.97C19.25 19.52 17.99 19.78 16.74 19.75C17.46 19.1 17.88 18.29 17.96 17.43C18.06 16.19 17.47 15 16.29 14.05C15.62 13.52 14.84 13.1 13.99 12.79C16.2 12.15 18.98 12.58 20.69 13.96C21.61 14.7 22.08 15.63 21.99 16.59Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Mức lương khởi điểm</div>
                                        @if (Auth::check())
                                        <div class="box-general-group-info-value">{{ $job->salary_fm }}</div>
                                        @else
                                        <a href="{{ route('staff.login') }}">Đăng nhập để xem</a>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if ($job->formWork)
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21.09 6.98002C20.24 6.04002 18.82 5.57002 16.76 5.57002H16.52V5.53002C16.52 3.85002 16.52 1.77002 12.76 1.77002H11.24C7.47998 1.77002 7.47998 3.86002 7.47998 5.53002V5.58002H7.23998C5.16998 5.58002 3.75998 6.05002 2.90998 6.99002C1.91998 8.09002 1.94998 9.57002 2.04998 10.58L2.05998 10.65L2.13743 11.4633C2.1517 11.6131 2.23236 11.7484 2.35825 11.8307C2.59806 11.9877 2.9994 12.2464 3.23998 12.38C3.37998 12.47 3.52998 12.55 3.67998 12.63C5.38998 13.57 7.26998 14.2 9.17998 14.51C9.26998 15.45 9.67998 16.55 11.87 16.55C14.06 16.55 14.49 15.46 14.56 14.49C16.6 14.16 18.57 13.45 20.35 12.41C20.41 12.38 20.45 12.35 20.5 12.32C20.8967 12.0958 21.3083 11.8195 21.6834 11.5489C21.7965 11.4673 21.8687 11.3413 21.8841 11.2028L21.9 11.06L21.95 10.59C21.96 10.53 21.96 10.48 21.97 10.41C22.05 9.40002 22.03 8.02002 21.09 6.98002ZM13.09 13.83C13.09 14.89 13.09 15.05 11.86 15.05C10.63 15.05 10.63 14.86 10.63 13.84V12.58H13.09V13.83ZM8.90998 5.57002V5.53002C8.90998 3.83002 8.90998 3.20002 11.24 3.20002H12.76C15.09 3.20002 15.09 3.84002 15.09 5.53002V5.58002H8.90998V5.57002Z" fill="white"></path>
                                            <path d="M20.8735 13.7342C21.2271 13.5659 21.6344 13.8462 21.599 14.2362L21.24 18.19C21.03 20.19 20.21 22.23 15.81 22.23H8.19003C3.79003 22.23 2.97003 20.19 2.76003 18.2L2.41932 14.4522C2.38427 14.0667 2.78223 13.7868 3.13487 13.9463C4.27428 14.4618 6.37742 15.3764 7.6766 15.7167C7.8409 15.7597 7.9738 15.8773 8.04574 16.0312C8.65271 17.3293 9.96914 18.02 11.87 18.02C13.7521 18.02 15.0852 17.3027 15.6942 16.0014C15.7662 15.8474 15.8992 15.7299 16.0636 15.6866C17.4432 15.3236 19.6818 14.3013 20.8735 13.7342Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Hình thức làm việc</div>
                                        <div class="box-general-group-info-value">{{ $job->formWork->name }}</div>
                                    </div>
                                </div>
                                @endif
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 2C9.38 2 7.25 4.13 7.25 6.75C7.25 9.32 9.26 11.4 11.88 11.49C11.96 11.48 12.04 11.48 12.1 11.49C12.12 11.49 12.13 11.49 12.15 11.49C12.16 11.49 12.16 11.49 12.17 11.49C14.73 11.4 16.74 9.32 16.75 6.75C16.75 4.13 14.62 2 12 2Z" fill="white"></path>
                                            <path d="M17.08 14.15C14.29 12.29 9.74002 12.29 6.93002 14.15C5.66002 15 4.96002 16.15 4.96002 17.38C4.96002 18.61 5.66002 19.75 6.92002 20.59C8.32002 21.53 10.16 22 12 22C13.84 22 15.68 21.53 17.08 20.59C18.34 19.74 19.04 18.6 19.04 17.36C19.03 16.13 18.34 14.99 17.08 14.15Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Giới tính</div>
                                        <div class="box-general-group-info-value">{{ $job->gender_name }}</div>
                                    </div>
                                </div>
                                @if ($job->province)
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.39 15.67L13.35 12H10.64L6.59998 15.67C5.46998 16.69 5.09998 18.26 5.64998 19.68C6.19998 21.09 7.53998 22 9.04998 22H14.94C16.46 22 17.79 21.09 18.34 19.68C18.89 18.26 18.52 16.69 17.39 15.67ZM13.82 18.14H10.18C9.79998 18.14 9.49998 17.83 9.49998 17.46C9.49998 17.09 9.80998 16.78 10.18 16.78H13.82C14.2 16.78 14.5 17.09 14.5 17.46C14.5 17.83 14.19 18.14 13.82 18.14Z" fill="white"></path>
                                            <path d="M18.35 4.32C17.8 2.91 16.46 2 14.95 2H9.04998C7.53998 2 6.19998 2.91 5.64998 4.32C5.10998 5.74 5.47998 7.31 6.60998 8.33L10.65 12H13.36L17.4 8.33C18.52 7.31 18.89 5.74 18.35 4.32ZM13.82 7.23H10.18C9.79998 7.23 9.49998 6.92 9.49998 6.55C9.49998 6.18 9.80998 5.87 10.18 5.87H13.82C14.2 5.87 14.5 6.18 14.5 6.55C14.5 6.92 14.19 7.23 13.82 7.23Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Tỉnh - Thành phố</div>
                                        <div class="box-general-group-info-value">{{ $job->province->name }}</div>
                                    </div>
                                </div>
                                @endif
                                @if ($job->international)
                                <div class="box-general-group">
                                    <div class="box-general-group-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.39 15.67L13.35 12H10.64L6.59998 15.67C5.46998 16.69 5.09998 18.26 5.64998 19.68C6.19998 21.09 7.53998 22 9.04998 22H14.94C16.46 22 17.79 21.09 18.34 19.68C18.89 18.26 18.52 16.69 17.39 15.67ZM13.82 18.14H10.18C9.79998 18.14 9.49998 17.83 9.49998 17.46C9.49998 17.09 9.80998 16.78 10.18 16.78H13.82C14.2 16.78 14.5 17.09 14.5 17.46C14.5 17.83 14.19 18.14 13.82 18.14Z" fill="white"></path>
                                            <path d="M18.35 4.32C17.8 2.91 16.46 2 14.95 2H9.04998C7.53998 2 6.19998 2.91 5.64998 4.32C5.10998 5.74 5.47998 7.31 6.60998 8.33L10.65 12H13.36L17.4 8.33C18.52 7.31 18.89 5.74 18.35 4.32ZM13.82 7.23H10.18C9.79998 7.23 9.49998 6.92 9.49998 6.55C9.49998 6.18 9.80998 5.87 10.18 5.87H13.82C14.2 5.87 14.5 6.18 14.5 6.55C14.5 6.92 14.19 7.23 13.82 7.23Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="box-general-group-info">
                                        <div class="box-general-group-info-title">Quốc gia</div>
                                        <div class="box-general-group-info-value">{{ $job->international->name }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Ngành nghề -->
                        <div class="mt-3 job-detail__box--right job-detail__body-right--item job-detail__body-right--box-category">
                            <div class="box-category">
                                <div class="box-title">Ngành nghề</div>
                                <div class="box-category-tags">
                                    @foreach ($job->careers as $career)
                                    <a href="javascrit:;" class="box-category-tag" target="_blank">{{ $career->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- <div class="box-category">
                                            <div class="box-title">Khu vực</div>
                                            <div class="box-category-tags">
                                                <span><a class="box-category-tag"
                                                        href="https://www.topcv.vn/tim-viec-lam-chuyen-vien-tu-van-tai-nam-tu-liem-kl1d131"
                                                        target="_blank" title="Tìm việc làm chuyên viên tư vấn tại Nam Từ Liêm">Nam
                                                        Từ Liêm</a></span>
                                                <span><a class="box-category-tag"
                                                        href="https://www.topcv.vn/tim-viec-lam-chuyen-vien-tu-van-tai-ha-noi-kl1"
                                                        target="_blank" title="Tìm việc làm chuyên viên tư vấn tại Hà Nội">Hà
                                                        Nội</a></span>
                                            </div>
                                        </div> -->
                        </div>
                    </aside>
                    <div class="box-category">
                        @include('website.includes.global.attractive-banner')
                    </div>
                </div>
            </div>
            <!-- Related Jobs -->

        </div>
    </div>
</section>
@endsection

@section('header')
<link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/job-detail-new.min.befd3ea464210690.css">
@endsection
@section('footer')
<script>
    $(document).ready(function() {
        $('.do-bookmark').on('click', function(e) {
            var btnWhitlist = $(this)
            e.preventDefault();

            var url = $(this).data('href');

            $.ajax({
                url: url
                , method: 'GET'
                , dataType: 'json'
                , success: function(response) {
                    if (response.success) {
                        if (response.type == 'add') {
                            btnWhitlist.find('span').addClass('active');
                        } else {
                            btnWhitlist.find('span').removeClass('active');
                        }
                    }
                }
                , error: function() {}
            });
        });
    });

</script>
@endsection
