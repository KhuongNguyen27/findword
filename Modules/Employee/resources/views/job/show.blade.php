@extends('employee::layouts.master')
@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Chi tiết công việc</h3>
                {{-- <div class="text">Lao động là vinh quang!</div> --}}
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4></h4>
                            </div>

                            <div class="widget-content">


                                <form action="{{ route('employee.job.update', $job->id) }}" method="post"
                                    class="default-form">
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
                                    @csrf
                                    <div class="row">
                                        <!-- Input -->
                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Tên công việc</label>
                                            <input type="text" name="name" value="{{ $job->name }}" id="nameInput"
                                                placeholder="Tên công việc" readonly>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Ngành Nghề</label>
                                            <select name="career_ids[]" class="chosen-select js-example-basic-multiple"
                                                multiple="multiple" disabled>
                                                @foreach ($param['careers'] as $career)
                                                    @php
                                                        $selected = $careerjobs->contains($career->id) ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $career->id }}" {{ $selected }}>
                                                        {{ $career->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('career_ids'))
                                                <p style="color: red">{{ $errors->first('career_ids') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Hình thức làm việc</label>
                                            <select name="formwork_id" class="chosen-select" disabled>
                                                @foreach ($param['formworks'] as $formwork)
                                                    <option @selected($job->formwork_id = $formwork->id) value="{{ $formwork->id }}">
                                                        {{ $formwork->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('formwork_id') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Hạn cuối nộp hồ sơ</label>
                                            <input type="date" value="{{ $job->deadline }}" name="deadline"
                                                placeholder="" readonly>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('deadline') }}</p>
                                            @endif
                                        </div>


                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Kinh Nghiệm</label>
                                            <select name="experience" class="chosen-select" disabled>
                                                <option @selected($job->experience == 2) value="2">Có yêu cầu</option>
                                                <option @selected($job->experience == 1) value="1"><Kbd></Kbd>Không yêu cầu
                                                </option>
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('experience') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->
                                        {{-- <div class="form-group col-lg-6 col-md-12">
                                            <label>Lương</label>
                                            <select name="wage_id" class="chosen-select" disabled>
                                                @foreach ($param['wages'] as $wage)
                                                    <option @selected($job->wage_id == $wage->id) value="{{ $wage->id }}">
                                                        {{ $wage->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('wage_id') }}</p>
                                            @endif
                                        </div> --}}
                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Mức lương tối thiểu </label>
                                            <input type="number" name="salaryMin" id="salaryMin"
                                                value="{{ $job->salaryMin }}" disabled/>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Mưc lương tối đa </label>
                                            <input type="number" name="salaryMax" id="salaryMax"
                                                value="{{ $job->salaryMax }}" disabled />
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Giới tính</label>
                                            <select name="gender" class="chosen-select" disabled>
                                                <option @selected($job->gender == '') value="">Không yêu cầu</option>
                                                <option @selected($job->gender == 1) value="1">Nam</option>
                                                <option @selected($job->gender == 2) value="2">Nữ</option>
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('gender') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Nơi làm việc</label>
                                            <input type="text" value="{{ $job->work_address }}" name="work_address"
                                                id="nameInput" placeholder="Nơi làm việc..." readonly>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('work_address') }}</p>
                                            @endif
                                        </div>
                               
                                        <div class="form-group col-lg-3 col-md-12">
                                            <label>Vị trí</label>
                                            <select name="degree_id" class="chosen-select" disabled>
                                                @foreach ($param['degrees'] as $degree)
                                                    <option @selected($job->degree_id == $degree->id) value="{{ $degree->id }}">
                                                        {{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('degree_id') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-3 col-md-12">
                                            <label>Bằng cấp</label>
                                            <select name="rank_id" class="chosen-select" disabled>
                                                @foreach ($param['ranks'] as $rank)
                                                    <option @selected($job->rank_id == $rank->id) value="{{ $rank->id }}">
                                                        {{ $rank->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('rank_id') }}</p>
                                            @endif
                                        </div>


                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Mô tả công việc</label>
                                            <div name="description" placeholder="Mô tả..." readonly>{!! $job->description !!}</div>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('description') }}</p>
                                            @endif
                                        </div>

                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Yêu cầu công việc</label>
                                            <div name="requirements" placeholder="Yêu cầu..." readonly>{!! $job->requirements !!}</div>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('requirements') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ls-widget">
                                        <div class="tabs-box">
                                            <div class="widget-content">
                                                <div class="widget-title">
                                                    <h4></h4>
                                                </div>
                                                <div class="post-job-steps">

                                                    <div class="step">
                                                        <span class="icon flaticon-money"></span>
                                                        <h5>Gói và thanh toán</h5>
                                                    </div>

                                                    <div class="step">
                                                        <span class="icon flaticon-checked"></span>
                                                        <h5>Xác Nhận công việc</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <label>Loại tin đăng</label>
                                                        <select name="jobpackage_id" class="chosen-select" disabled>
                                                            @foreach ($param['job_packages'] as $job_package)
                                                                <option @selected($job->jobpackage_id == $job_package->id)
                                                                    value="{{ $job_package->id }}">
                                                                    {{ $job_package->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('jobpackage_id') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Ngày bắt đầu</label>
                                                        <input type="date" value="{{ $job->start_day }}"
                                                            name="start_day" placeholder="" readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('start_day') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Ngày hết hạn</label>
                                                        <input type="date" name="end_day" value="{{ $job->end_day }}"
                                                            placeholder="" readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('end_day') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Số ngày :</label>
                                                        <input type="number" value="{{ $job->number_day }}"
                                                            name="number_day" id="nameInput" placeholder="Số ngày..."
                                                            readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('number_day') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Tổng thanh toán cho tin đăng (VNĐ) :</label>
                                                        <input type="number" value="{{ $job->price }}" name="price"
                                                            id="nameInput" placeholder="Giá..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('price') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Giờ bắt đầu đăng :</label>
                                                        <input type="text" name="start_hour"
                                                            value="{{ $job->start_hour }}" id="nameInput"
                                                            placeholder="Giờ..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('start_hour') }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Giờ Kết thúc :</label>
                                                        <input type="text" name="end_hour"
                                                            value="{{ $job->end_hour }}" id="nameInput"
                                                            placeholder="Giờ..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('end_hour') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 text-right">
                                                    <a style="background-color: red !important;"
                                                        href="{{ route('employee.job.index') }}"
                                                        class="theme-btn btn-style-one danger">Trở về</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- End Dashboard -->
@endsection
