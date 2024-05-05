@extends('staff::dashboards.layouts.dashboard')
@section('content')
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>{{ __('work_list') }}</h3>
                <div class="text">{{ __('ready_to_jump_back_in') }}?</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>{{ __('my_favorite_job') }}</h4>
                            </div>

                            <div class="widget-content">
                                <div class="row">
                                    @foreach ($userJobFavorites as $job)
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            @include('job::includes.components.job-item', [
                                                'job' => $job,
                                                'job_info' => true,
                                                'job_other_info' => true,
                                                'bookmark' => false,
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
