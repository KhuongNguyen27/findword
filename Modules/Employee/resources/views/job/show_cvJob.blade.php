@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Hồ Sơ Ứng Tuyển cho công việc: {{$job->name}}</h3>
            <div class="text"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box">
                        <div class="widget-title">
                            <h4>Danh sách</h4>
                        </div>

                        <div class="widget-content">

                            <div class="tabs-box">
                                <div class="aplicants-upper-bar">
                                    <h6>{{$job->name}}</h6>
                                    <ul class="aplicantion-status tab-buttons clearfix">
                                        <li class="tab-btn active-btn totals" data-tab="#totals">Tổng số hồ sơ:
                                            {{$param_count['count_job']}}</li>
                                        <li class="tab-btn approved" data-tab="#approved">Đã duyệt:
                                            {{$param_count['count_cv_appled']}}</li>
                                        <li class="tab-btn rejected" data-tab="#rejected">Chưa duyệt:
                                            {{$param_count['count_not_applly']}}</li>
                                    </ul>
                                </div>

                                <div class="tabs-content">
                                    <!--Tab-->
                                    <div class="tab active-tab" id="totals">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>Tên hồ sơ</th>
                                                            <th>Ngày ứng tuyển</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cv_apllys as $key => $cv_aplly)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $cv_aplly->cv->cv_file }}</td>
                                                            <td>{{ date('d/m/Y H:i',strtotime($cv_aplly->created_at)) }}</td>
                                                            <td>
                                                                <div class="option-box">
                                                                    <ul class="option-list">
                                                                        <li>
                                                                            <a target="_blank" href="{{ route('employee.cv.showCv', $cv_aplly->cv->id) }}"
                                                                                data-text="Xem hồ sơ">
                                                                                <span class="la la-eye"></span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form
                                                                                action="{{ route('employee.cvs.delete', $cv_aplly->id) }}"
                                                                                method="POST"
                                                                                id="deleteForm_{{ $job->id }}"
                                                                                onsubmit="confirmDelete(event, {{ $job->id }})">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    data-text="Xóa hồ sơ">
                                                                                    <span class="la la-trash"></span>
                                                                                </button>
                                                                            </form>
                                                                            <script>
                                                                            function confirmDelete(event, jobId) {
                                                                                event.preventDefault();
                                                                                if (confirm("Bạn có muốn xóa không?")) {
                                                                                    document.getElementById(
                                                                                            'deleteForm_' + jobId)
                                                                                        .submit();
                                                                                }
                                                                            }
                                                                            </script>
                                                                    </ul>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Candidate block three -->
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