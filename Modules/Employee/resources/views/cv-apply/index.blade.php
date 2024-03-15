@extends('employee::layouts.master')
@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>{{ __('applicant tracking') }}</h3>
                <div class="text"></div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
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
                            <div class="widget-title">
                                <h4>Danh sách hồ sơ</h4>

                                <form class="form-search" action="{{ route('employee.cv.index') }}">
                                    <div class="chosen-outer1">
                                        <input type="text" value="{{ request('name') }}" placeholder="{{ __('profile_name') }}..."
                                            name="name">
                                    </div>


                                    <div class="chosen-outer1">
                                        <select name="status" class="chosen-select1">
                                            <option value="">{{ __('status') }}</option>
                                            <option {{ request('status') == '1' ? 'selected' : '' }} value="1">{{ __('accepted') }}</option>
                                            <option {{ request('status') == '0' ? 'selected' : '' }} value="0">{{ __('not_accepted') }}</option>
                                        </select>
                                    </div>
                                    <div style="background: #4906c7;" class="chosen-outer1">
                                        <button type="submit" style=" color: white;">{{ __('search') }}</button>
                                    </div>
                                </form>
                            </div>

                            <div class="widget-content">

                                <div class="tabs-box">
                                    <div class="aplicants-upper-bar">
                                        <h6></h6>
                                        <ul class="aplicantion-status tab-buttons clearfix">
                                            <li class="tab-btn active-btn totals" data-tab="#totals">{{ __('profile_total') }}:
                                                {{ $param_count['cv_apllys_count'] }}</li>
                                            <li class="tab-btn approved" data-tab="#approved">{{ __('accepted') }}:
                                                {{ $param_count['count_cv_appled'] }}</li>
                                            <li class="tab-btn rejected" data-tab="#rejected">{{ __('not_accepted') }}:
                                                {{ $param_count['count_not_applly'] }}</li>
                                        </ul>
                                    </div>

                                    <div class="tabs-content">
                                        <!--Tab-->
                                        <div class="tab active-tab" id="totals">
                                            <div class="row">
                                                @foreach ($cv_apllys as $cv_aplly)
                                                    <div class="candidate-block-three col-lg-12 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">

                                                                <figure class="image">
                                                                    <img
                                                                        src="{{ $cv_aplly->user->getImage($cv_aplly->cv->user_id) }}">
                                                                </figure>
                                                                <h4 class="name"><a
                                                                        href="#">{{ $cv_aplly->cv->name }}</a></h4>
                                                                <ul class="candidate-info">
                                                                    @if ($cv_aplly->cv->employment_type)
                                                                        <li class="designation">
                                                                            {{ $cv_aplly->cv->employment_type }}</li>
                                                                    @endif
                                                                    @if ($cv_aplly->cv->city)
                                                                        <li><span class="icon flaticon-map-locator"></span>
                                                                            {{ $cv_aplly->cv->city }}</li>
                                                                    @endif
                                                                    @if ($cv_aplly->cv->desired_salary)
                                                                        <li><span class="icon flaticon-money"></span>
                                                                            {{ $cv_aplly->cv->desired_salary }}</li>
                                                                    @endif
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    @if ($cv_aplly->cv->career_objective)
                                                                        <li><a
                                                                                href="#">{{ $cv_aplly->cv->career_objective }}</a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li><a href="{{ route('employee.cv.show', $cv_aplly->id) }}"
                                                                            data-text="View Aplication"><span
                                                                                class="la la-eye"></span></a></li>
                                                                    @if ($cv_aplly->status == 1)
                                                                        <li><button data-text="Approve Aplication"><span
                                                                                    class="la la-check"></span></button>
                                                                        </li>
                                                                    @else
                                                                        <li><button data-text="Reject Aplication"><span
                                                                                    class="la la-times-circle"></span></button>
                                                                        </li>
                                                                    @endif
                                                                    <form
                                                                        action="{{ route('employee.cvs.delete', $cv_aplly->id) }}"
                                                                        method="POST" id="deleteForm"
                                                                        onsubmit="confirmDelete(event)">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <li>
                                                                            <button type="submit" class="delete-button"
                                                                                data-text="Delete Application">
                                                                                <span class="la la-trash"></span>
                                                                            </button>
                                                                        </li>
                                                                    </form>

                                                                    <script>
                                                                        function confirmDelete(event) {
                                                                            event.preventDefault(); // Ngăn chặn hành vi mặc định của form
                                                                            if (confirm("Bạn có muốn xóa không?")) {
                                                                                document.getElementById('deleteForm').submit(); // Gửi form khi xác nhận xóa
                                                                            }
                                                                        }
                                                                    </script>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- Candidate block three -->
                                            </div>
                                            <div class="ls-show-more">
                                                <div class="card-footer">
                                                    {{ $cv_apllys->appends(request()->query())->links() }}
                                                </div>
                                            </div>
                                        </div>

                                        <!--Tab-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Dashboard -->
@endsection
