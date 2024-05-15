@extends('website.layouts.master')
@section('header')
<link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/company/detail.min.b7fffc86741bf76c.css">
@endsection

@section('content')
<section class="job-detail-section">
    <div class="upper-box pb-2">
        @include('employee::employers.includes.company-cover')
    </div>

    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">

                    <div class="section-introduce">
                        <h4 class="card-title">Giới thiệu về công ty</h4>
                        <div class="card-body">
                            <div class="text">
                                {!! $userEmployee->about ?? 'Chưa có giới thiệu' !!}
                            </div>
                        </div>
                    </div>

                    <div class="section-introduce">
                        <h4 class="card-title">Tuyển dụng</h4>
                        <div class="card-body">
                            <div class="related-jobs">
                                @foreach($jobs as $job)
                                @include('job::includes.components.job-item',[
                                'job' => $job,
                                'job_info' => true,
                                'job_other_info' => true,
                                'bookmark' => true,
                                'company_name' => true,
                                ])
                                @endforeach
                                <div class="ls-show-more">
                                    <div class="ls-pagination">
                                        {{ $jobs->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="section-introduce">
                            <h4 class="card-title">Thông tin liên hệ</h4>
                            <div class="card-body">
                                <ul class="company-info mt-0">
                                    <li>
                                        @if ($userEmployee->is_hidden_phone == 0)
                                        <span class="icon"><i class="fa fa-solid fa-phone"></i></span>
                                        <span>{{ $userEmployee->phone }}</span>
                                        @endif
                                    </li>
                                    <li>
                                        @if ($userEmployee->is_hidden_email == 0)
                                        <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                                        <span>{{ $userEmployee->user->email }}</span>
                                        @endif
                                    <li><span class="icon"><i class="fa fa-solid fa-globe"></i></span>
                                        <span>{{ $userEmployee->website }}</span>
                                    </li>
                                    <li><span class="icon"><i class="fa fa-solid fa-location-arrow"></i></span>
                                        <span>{{ $userEmployee->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="section-introduce">
                            <h4 class="card-title">Xem bản đồ</h4>
                            <div class="card-body">
                                {!! $userEmployee->map_iframe ?? '-' !!}
                            </div>
                        </div>
                        <div class="section-introduce">
                            <h4 class="card-title">Fanpage</h4>
                            <div class="card-body">
                                {!! $userEmployee->fanpage_iframe ?? '-' !!}
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection