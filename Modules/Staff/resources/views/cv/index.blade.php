@extends('website.dashboards.layouts.dashboard')
@section('content')
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Danh sách hồ sơ</h3>
            <div class="text">Ready to jump back in?</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- applicants Widget -->
                <div class="applicants-widget ls-widget">
                    <div class="widget-title">
                        <h4>Danh sách hồ sơ</h4>
                        <a href="{{ route('staff.cv.create') }}" class="btn btn-primary name" style="cursor: pointer;">
                            Thêm mới
                        </a>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="widget-content">
                        <!-- Candidate block three -->
                        @foreach ($items as $item)
                        <div class="candidate-block-three">
                            <div class="inner-box">
                                <div class="content">
                                    <figure class="image"><img src="images/resource/candidate-1.png" alt=""></figure>
                                    <h4 class="name"><a href="#">{{ $item->cv_file }}</a></h4>
                                    <ul class="candidate-info">
                                        <li class="designation">UI Designer</li>
                                        <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                        <li><span class="icon flaticon-money"></span> $99 / hour</li>
                                    </ul>
                                </div>
                                <div class="option-box">
                                    <div class="option-box">
                                        <div class="dropdown resume-action">
                                            <button class="dropdown-toggle theme-btn btn-style-three" role="button"
                                                data-toggle="dropdown" aria-expanded="false">Action <i
                                                    class="fa fa-angle-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('staff.cv.show', $item->id) }}">
                                                        <span class="la la-eye"></span> Xem chi tiết
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('staff.cv.edit', $item->id) }}">
                                                        <span class="la la-pencil"></span> Cập nhật
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <li>
                                        <form action="{{ route('staff.cv.destroy', $item->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" data-text="Delete Application">
                                                <span class="la la-trash"></span>
                                            </button>
                                        </form>
                                    </li>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->
@endsection