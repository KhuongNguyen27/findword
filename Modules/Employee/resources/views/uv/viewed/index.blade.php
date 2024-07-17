@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->

<style>
.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px; /* Khoảng cách giữa các hàng */
}

.custom-table-row {
    background: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}

.custom-table-row td {
    padding: 25px;
    border: none; /* Xóa border mặc định của bảng */
    vertical-align: middle;
}

.custom-table th {
    background: #f8f9fa;
    padding: 15px;
    border: none; /* Xóa border mặc định của bảng */
    text-align: left;
    vertical-align: middle;
}

.option-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 10px;
}

.option-list li {
    display: inline-block;
}

.option-list a {
    color: #007bff;
    text-decoration: none;
}

.option-list a:hover {
    text-decoration: underline;
}
/* CSS cho thẻ a trong bảng công việc */
.career-link {
    color: #000; /* Màu mặc định của thẻ a */
    text-decoration: none; /* Bỏ gạch chân mặc định */
}

.career-link:hover {
    color: #007bff; /* Màu khi hover của thẻ a */
    text-decoration: underline;
    text-decoration: none; /* Bỏ gạch chân mặc định */

}
</style>
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Quản lý danh sách ứng viên</h3>
            {{-- <div class="text">Ready to jump back in?</div> --}}
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box">
                        <div class="widget-title">
                            <h4>{{ __('work_list') }}</h4>
                            <form class="form-search" action="{{ route('employee.viewed.jobs') }}">
                                <div class="chosen-outer1">
                                    <input type="text" value="{{ request('name') }}"
                                        placeholder="{{ __('work_name') }}..." name="name">
                                </div>

                                <div class="chosen-outer1">
                                    <label for="">{{ __('from') }} :</label>
                                    <input type="date" value="{{ request('start_day') }}" placeholder="Tên công việc..."
                                        name="start_day" onchange="calculateDays()">
                                    <label for="">{{ __('to') }} :</label>
                                    <input type="date" value="{{ request('end_day') }}" placeholder="Tên công việc..."
                                        name="end_day" onchange="calculateDays()">
                                </div>

                                <div class="chosen-outer1">
                                    <select name="status" class="chosen-select1">
                                        <option value="">{{ __('status') }}</option>
                                        <option {{ request('status') == '1' ? 'selected' : '' }} value="1">
                                            {{ __('recruitment') }}</option>
                                        <option {{ request('status') == '0' ? 'selected' : '' }} value="0">
                                            {{ __('stop_recruiting') }}</option>
                                    </select>
                                </div>
                                <div style="background: #4906c7;" class="chosen-outer1">
                                    <button type="submit" style=" color: white;">{{ __('search') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="widget-content">
                            <div class="table-outer">
                                <table class="table custom-table">
                                    <thead>
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
                                        <tr>
                                            <th>{{ __('work_name') }}</th>
                                            <th>Hồ sơ đã xem</th>
                                            <th>{{ __('deadline') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($jobs as $job)
                                        <tr class="custom-table-row">
                                        <td>
                                            <a href="{{ route('website.jobs.show', $job->slug) }}"
                                                class="career-link">

                                                {{ $job->name }}
                                            </a>
                                        </td>
                                            <td>
                                                <ul class="option-list">
                                                    <li>{{ $job->cv_count }} {{ __('profile') }}</li>
                                                    <li><a href="{{ route('employee.viewed', $job->id) }}"
                                                            data-text="Xem danh sách ứng tuyển"><span
                                                                class="la la-eye"></span></a></li>
                                                </ul>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($job->start_day)) }} -
                                                {{ date('d-m-Y', strtotime($job->end_day)) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="ls-pagination">
                                    <div class="ls-show-more">
                                        <div class="card-footer">
                                            {{ $jobs->appends(request()->query())->links() }}
                                        </div>
                                    </div>
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

@section('footer')
<script>
function calculateDays() {
    var startDate = new Date(document.querySelector('input[name="start_day"]').value);
    var endDate = new Date(document.querySelector('input[name="end_day"]').value);

    if (endDate < startDate) {
        // Nếu ngày hết hạn nhỏ hơn ngày bắt đầu, hiển thị thông báo lỗi
        alert("Ngày hết hạn phải lớn hơn hoặc bằng ngày bắt đầu");
        // Xóa giá trị ngày hết hạn
        document.querySelector('input[name="end_day"]').value = "";
    }
}
</script>
@endsection
