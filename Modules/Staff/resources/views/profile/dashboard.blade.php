@extends('staff::dashboards.layouts.dashboard')
@section('content')
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>{{ __('hello') }}, {{ auth()->user()->name }}!!</h3>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item">
                        <div class="left">
                            <i class="icon flaticon-briefcase"></i>
                        </div>
                        <div class="right">
                            <h4>{{ $userJobApplies->count() }}</h4>
                            <p>{{ __('applied_job') }}</p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item ui-red">
                        <div class="left">
                            <i class="icon la la-file-invoice"></i>
                        </div>
                        <div class="right">
                            <h4>9382</h4>
                            <p>{{ __('applied_job') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item ui-green">
                        <div class="left">
                            <i class="icon la la-bookmark-o"></i>
                        </div>
                        <div class="right">
                            <!-- <h4>{{ optional(auth()->user()->userJobFavorites)->count() ?? 0 }}</h4> -->
                            <h4>32</h4>
                            <p>{{ __('favourite') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- applicants Widget -->
                    <div class="applicants-widget ls-widget">
                        <div class="widget-title">
                            <h4>Việc làm đã ứng tuyển gần đây</h4>
                        </div>
                        <div class="widget-content">
                            <div class="row">
                                @foreach ($userJobApplies as $userJobApplie)
                                    <!-- Job Block -->
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        @include('job::includes.components.job-item', [
                                            'job' => $userJobApplie->job,
                                            'job_info' => true,
                                            'job_other_info' => true,
                                            'bookmark' => true,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



        git add    Modules/AdminHome/lang/vi.json
        git add        Modules/Job/resources/views/includes/components/job-item.blade.php
        git add        Modules/Job/resources/views/includes/components/quickview-job-tooplip.blade.php

        git add     Modules/Staff/resources/views/profile/dashboard.blade.php