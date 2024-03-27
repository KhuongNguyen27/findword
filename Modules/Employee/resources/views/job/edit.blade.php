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
                                                placeholder="Tên công việc">
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>


                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Ngành Nghề</label>
                                            <select name="career_ids[]" class="chosen-select js-example-basic-multiple"
                                                multiple="multiple">
                                                @foreach ($param['careers'] as $career)
                                                    @php
                                                        $selected = $careerjobs->contains($career->id)
                                                            ? 'selected'
                                                            : '';
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
                                            <select name="formwork_id" class="chosen-select">
                                                @foreach ($param['formworks'] as $formwork)
                                                    <option @selected($job->formwork_id == $formwork->id) value="{{ $formwork->id }}">
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
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('deadline') }}</p>
                                            @endif
                                        </div>


                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Kinh Nghiệm</label>
                                            <select name="experience" class="chosen-select">
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
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Lương</label>
                                            <select name="wage_id" class="chosen-select">
                                                @foreach ($param['wages'] as $wage)
                                                    <option @selected($job->wage_id == $wage->id) value="{{ $wage->id }}">
                                                        {{ $wage->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('wage_id') }}</p>
                                            @endif
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>giới tính</label>
                                            <select name="gender" class="chosen-select">
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
                                                id="nameInput" placeholder="Nơi làm việc...">
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('work_address') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Tỉnh - Thành phố</label>
                                            <select name="province_id" class="chosen-select form-select">
                                                <option value="">Tất cả địa điểm</option>
                                                @foreach ($param['provinces'] as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ $province->id == $job->province_id ? 'selected' : '' }}>
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('province_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Quốc gia </label>
                                            <input type="text" value="{{ $job->country }}" name="country">
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('country') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Bằng cấp</label>
                                            <select name="degree_id" class="chosen-select">
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

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Vị trí</label>
                                            <select name="rank_id" class="chosen-select">
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
                                            <textarea name="description" placeholder="Mô tả...">{{ $job->description }}</textarea>
                                            @if ($errors->any())
                                                <p style="color:red">
                                                    {{ $errors->first('description') }}</p>
                                            @endif
                                        </div>

                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Yêu cầu công việc</label>
                                            <textarea name="requirements" placeholder="Yêu cầu...">{{ $job->requirements }}</textarea>
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
                                                        {{-- <select id="package_tye" name="jobpackage_id" onchange="handle_price_package()" class="chosen-select" readonly>
                                                        @foreach ($param['job_packages'] as $job_package)
                                                        <option data-price="{{ $job_package->price }}" @selected($job->jobpackage_id == $job_package->id)
                                                            value="{{ $job_package->id }}">
                                                            {{ $job_package->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                        @php
                                                            $selected_job_package_name = ''; // Biến này sẽ lưu trữ tên gói công việc tương ứng với ID đã chọn
                                                            foreach ($param['job_packages'] as $job_package) {
                                                                if ($job->jobpackage_id == $job_package->id) {
                                                                    $selected_job_package_name = $job_package->name;
                                                                    break; // Dừng vòng lặp khi tìm thấy ID tương ứng
                                                                }
                                                            }
                                                        @endphp
                                                        <input type="text" id="package_tye" name="jobpackage_id"
                                                            value="{{ $selected_job_package_name  }}" readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('jobpackage_id') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Ngày bắt đầu</label>
                                                        <input type="date" value="{{ $job->start_day }}"
                                                            name="start_day" placeholder="" onchange="calculateDays()"
                                                            readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('start_day') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Ngày hết hạn</label>
                                                        <input type="date" name="end_day" value="{{ $job->end_day }}"
                                                            placeholder="" onchange="calculateDays()" readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('end_day') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Số ngày :</label>
                                                        <input type="number" value="{{ $job->number_day }}"
                                                            name="number_day" class="number_day" id="nameInput"
                                                            placeholder="Số ngày..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('number_day') }}</p>
                                                        @endif
                                                    </div>



                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Tổng thanh toán cho tin đăng (ĐTD) :</label>
                                                        <input id="price" type="text" value="{{ $job->price }}"
                                                            name="price" placeholder="Giá..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('price') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Giờ bắt đầu đăng :</label>
                                                        <input type="time" name="start_hour"
                                                            value="{{ $job->start_hour }}" id="nameInput"
                                                            placeholder="Giờ..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('start_hour') }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-12">
                                                        <label>Giờ Kết thúc :</label>
                                                        <input type="time" name="end_hour"
                                                            value="{{ $job->end_hour }}" id="nameInput"
                                                            placeholder="Giờ..." readonly>
                                                        @if ($errors->any())
                                                            <p style="color:red">
                                                                {{ $errors->first('end_hour') }}</p>
                                                        @endif
                                                    </div>


                                                </div>
                                                <!-- Input -->
                                                <div class="form-group col-lg-12 col-md-12 text-right">
                                                    <button class="theme-btn btn-style-one">Cập Nhật</button>
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
    <script>
        //  xủ lý tính số ngày
        function calculateDays() {
            var startDayInput = document.querySelector('input[name="start_day"]');
            var endDayInput = document.querySelector('input[name="end_day"]');
            var numberDayInput = document.querySelector('input[name="number_day"]');

            var startDay = new Date(startDayInput.value);
            var endDay = new Date(endDayInput.value);

            var timeDiff = endDay - startDay;
            var dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            if (!isNaN(dayDiff) && dayDiff >= 0) {
                numberDayInput.value = dayDiff;
            }

            // validate

            var startDate = new Date(document.querySelector('input[name="start_day"]').value);
            var endDate = new Date(document.querySelector('input[name="end_day"]').value);

            if (endDate < startDate) {
                // Nếu ngày hết hạn nhỏ hơn ngày bắt đầu, hiển thị thông báo lỗi
                alert("Ngày hết hạn phải lớn hơn hoặc bằng ngày bắt đầu");
                // Xóa giá trị ngày hết hạn
                document.querySelector('input[name="end_day"]').value = "";
            }

            handle_price_package();
        }

        // hàm xử lý tính giá tiền
        function handle_price_package() {
            var price = parseFloat($("#package_tye").find("option:selected").data("price"));
            var number_day = $(".number_day").val();
            // Kiểm tra nếu cả hai giá trị đều có thì mới tính toán tổng giá trị
            if (price !== undefined && number_day !== "") {
                var total_price = price * number_day;
                // Định dạng giá tiền với ký tự ngăn cách hàng nghìn
                var formatted_total_price = total_price.toLocaleString("vi-VN");
                // Hiển thị tổng giá trị trong ô input với đơn vị tiền tệ VNĐ
                $("#price").val(formatted_total_price);
            }
        }


        // Gọi hàm calculateDays() lần đầu khi trang đã tải xong để tính toán số ngày ban đầu.
        calculateDays();

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <!-- End Dashboard -->
@endsection
