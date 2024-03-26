@extends('staff::dashboards.layouts.dashboard')
@section('header')
<link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/manager-cv.b392051575793632.css">
@endsection

@section('content')
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="row">
            <div class="col-lg-12">
                <!-- applicants Widget -->
                <div id="manager-cv" class="applicants-widget ls-widget">
                    <div class="widget-title">
                        <h4>{{ __('profile_list') }}</h4>
                        <a href="{{ route('staff.cv.create') }}" class="btn btn-primary name" style="cursor: pointer;">
                            {{ __('add_new') }}
                        </a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div id="cv-list" class="widget-content">
                        <!-- Candidate block three -->
                        <div class="row">
                            @foreach ($items as $item)
                            <div class="col-md-6 col-12 pr-12">
                                @include('staff::includes.components.box-cv')
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->
@endsection