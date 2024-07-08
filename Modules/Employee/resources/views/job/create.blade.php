@extends('employee::layouts.master')
@section('content')
<style>
input {
    margin-bottom: 0%;
}

.label-required {
    color: red;
}
</style>
<!-- Dashboard -->
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>Thêm mới một công việc!</h3>
            <div class="text">Lao động là vinh quang!</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('employee.job.store') }}" method="post" class="default-form">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4></h4>
                            </div>
                            <div class="widget-content">
                                <div class="post-job-steps">
                                    <div class="step">
                                        <span class="icon flaticon-briefcase"></span>
                                        <h5>Chi tiết công việc</h5>
                                    </div>
                                </div>
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
                                    <div class="form-group col-lg-12 col-md-12" style="margin-bottom:3%!important">
                                        <label>Tên công việc <span class="label-required">*</span></label>
                                        <input type="text" value="{{ old('name') }}" name="name" id="nameInput"
                                            placeholder="Tên công việc">
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('name') }}</p>
                                        @endif
                                    </div>

                                    <!-- Input -->

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Ngành Nghề <span class="label-required">*</span></label>
                                        <select name="career_ids[]" class="chosen-select career_ids"
                                            multiple="multiple">
                                            @foreach ($param['careers'] as $career)
                                            <option value="{{ $career->id }}">{{ $career->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('career_ids') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Hạn nộp hồ sơ <span class="label-required">*</span></label>
                                        <input type="date" value="{{ old('deadline') }}" name="deadline"
                                            id="deadlineInput" placeholder="">
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('deadline') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Hình thức làm việc</label>
                                        <select name="formwork_id" class="chosen-select">
                                            @foreach ($param['formworks'] as $formwork)
                                            <option value="{{ $formwork->id }}">{{ $formwork->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('formwork_id') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Kinh Nghiệm <span class="label-required">*</span></label>
                                        <select name="experience" class="chosen-select">
                                            <option value="0">Không yêu cầu</option>
                                            @for ($i = 1; $i <= 15; $i++) <option value="{{ $i }}">{{ $i }}
                                                </option>
                                                @endfor
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('experience') }}</p>
                                        @endif
                                    </div>

                                    <div class="">Để trống mức lương có nghĩa là Thỏa Thuận</div>
                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Mức lương tối thiểu </label>
                                        <input type="number" name="salaryMin" id="salaryMin"
                                            value="{{ old('salaryMin') }}" />
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Mức lương tối đa </label>
                                        <input type="number" name="salaryMax" id="salaryMax"
                                            value="{{ old('salaryMax') }}" />
                                    </div>

                                    <!-- Input -->
                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Giới tính <span class="label-required">*</span></label>
                                        <select name="gender" class="chosen-select">
                                            <option value="">Không yêu cầu</option>
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('gender') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Nơi làm việc <span class="label-required">*</span></label>
                                        <input type="text" value="{{ old('work_address') }}" name="work_address"
                                            id="nameInput" placeholder="Nơi làm việc...">
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('work_address') }}</p>
                                        @endif
                                    </div>

                                    <!-- <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 3%!important;">
                                        <label>Quốc gia</label>
                                        <select name="country" class="chosen-select" id="country">
                                            <option id="vn" value="VN" {{ old('country') == 'VN' ? 'selected' : '' }}>
                                                Trong nước
                                            </option>
                                            @if($param['userAllowedAbroad'])
                                            <option id="nn" value="NN" {{ old('country') == 'NN' ? 'selected' : '' }}>
                                                Ngoài nước
                                            </option>
                                            @endif
                                        </select>
                                    </div> -->

                                    <!-- <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 3%!important;">
                                        <label>Quốc gia</label>
                                        <select name="country" class="chosen-select" id="country">
                                            <option id="vn" value="VN" {{ old('country') == 'VN' ? 'selected' : '' }}>
                                                Trong nước
                                            </option>
                                            @if($param['userAllowedAbroad'])
                                            <option id="nn" value="NN" {{ old('country') == 'NN' ? 'selected' : '' }}>
                                                Ngoài nước
                                            </option>
                                            @endif
                                        </select>
                                        @if(!$param['userAllowedAbroad'])
                                        <p class="text-warning">Liên hệ với Quản Trị Viên để đăng Tin Ngoài Nước.</p>
                                        @endif
                                    </div> -->

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 3%!important;">
                                        <label>Quốc gia</label>
                                        <select name="country" class="chosen-select" id="country"
                                            style="display: none;">
                                            <option id="vn" value="VN">Trong nước</option>
                                            <option id="nn" value="NN">Ngoài nước</option>
                                        </select>
                                        <p id="country-error" class="text-danger" style="display: none;">Công ty của bạn
                                            hiện chưa thể đăng tuyển lao động đi nước ngoài.</p>
                                    </div>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var countrySelect = document.getElementById('country');
                                        var errorText = document.getElementById('country-error');
                                        var userAllowedAbroad = {
                                            {
                                                $param['userAllowedAbroad'] ? 'true' : 'false'
                                            }
                                        };

                                        console.log('userAllowedAbroad:',
                                        userAllowedAbroad); // Log giá trị của userAllowedAbroad

                                        // Lắng nghe sự kiện khi Chosen.js thay đổi giá trị
                                        $('#country').on('change', function() {
                                            var selectedValue = $(this).val(); // Lấy giá trị đã chọn
                                            console.log('Selected value:',
                                            selectedValue); // Log giá trị được chọn

                                            // Kiểm tra điều kiện
                                            if (selectedValue === 'NN' && userAllowedAbroad === false) {

                                                errorText.style.display = 'block';
                                                // Sử dụng phương thức của Chosen.js để thay đổi giá trị
                                                $(this).val('VN').trigger(
                                                'chosen:updated'); // Reset lại lựa chọn thành 'Trong nước'
                                            } else {
                                                errorText.style.display = 'none';
                                            }
                                        });

                                        // Kích hoạt Chosen.js cho select
                                        $('#country').chosen();
                                    });
                                    </script>



                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 3%!important;"
                                        id="provinceDiv">
                                        <label>Tỉnh - Thành phố <span class="label-required">*</span></label>
                                        <select name="province_id[]" class="chosen-select form-select" id="province" multiple="multiple">
                                            @foreach ($param['provinces'] as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('province_id') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom: 3%!important;"
                                        id="internationalDiv">
                                        <label>Quốc tế<span class="label-required"> *</span></label>
                                        <select name="country_id[]" class="chosen-select form-select" id="international" multiple="multiple">
                                            @foreach ($param['countries'] as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('country_id') }}</p>
                                        @endif
                                        </p>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label>Lĩnh Vực <span class="label-required">*</span></label>
                                        <select name="degree_id" class="chosen-select">
                                            @foreach ($param['degrees'] as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('degree_id') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                        <label> Cấp bậc <span class="label-required">*</span></label>
                                        <select name="rank_id" class="chosen-select">
                                            @foreach ($param['ranks'] as $rank)
                                            <option value="{{ $rank->id }}">{{ $rank->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('rank_id') }}</p>
                                        @endif
                                    </div>

                                    <!-- About Company -->
                                    <div class="form-group col-lg-12 col-md-12" style="margin-bottom:3%!important">
                                        <label>Mô tả công việc <span class="label-required">*</span></label>
                                        <textarea name="description" id="description"
                                            placeholder="Mô tả...">{{ old('description') }}</textarea>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('description') }}</p>
                                        @endif
                                    </div>

                                    <!-- About Company -->
                                    <div class="form-group col-lg-12 col-md-12">
                                        <label>Yêu cầu công việc <span class="label-required">*</span></label>
                                        <textarea name="requirements" id="requirements"
                                            placeholder="Yêu cầu...">{{ old('requirements') }}</textarea>
                                        @if ($errors->any())
                                        <p style="color:red">
                                            {{ $errors->first('requirements') }}</p>
                                        @endif
                                    </div>

                                </div>
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
                                        <div class="form-group col-lg-12 col-md-12" style="margin-bottom:3%!important">
                                            <label>Loại tin đăng <span class="label-required">*</span></label>
                                            <select id="package_type" onchange="handle_price_package()"
                                                name="jobpackage_id" class="chosen-select">
                                                @foreach ($param['job_packages'] as $job_package)
                                                <option id="{{ $job_package->id }}"
                                                    data-price="{{ $job_package->price }}"
                                                    value="{{ $job_package->id }}"
                                                    data-count_job="{{ Auth::user()->checkJob($job_package->id) }}">
                                                    {{ $job_package->name }}
                                                    {{ Auth::user()->checkJob($job_package->id) > 0 ? '(' . Auth::user()->checkJob($job_package->id) . ')' : '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('jobpackage_id') }}</p>
                                            @endif
                                            <!-- <a style="color:gray"><i>* Sử dụng tin VIP để tự động duyệt</i></a> -->
                                        </div>
                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Ngày bắt đầu <span class="label-required">*</span></label>
                                            <input type="date" value="{{ old('start_day') ?? date('Y-m-d') }}"
                                                name="start_day" placeholder="" onchange="calculateDays()" readonly>
                                            @if ($errors->any())
                                            <p style="color:red">
                                                {{ $errors->first('start_day') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-3 col-md-12" style="margin-bottom:3%!important">
                                            <label>Ngày hết hạn <span class="label-required">*</span></label>
                                            <input type="date" value="{{ old('end_day') }}" name="end_day"
                                                placeholder="" onchange="calculateDays()">
                                            @if ($errors->any())
                                            <p style="color:red">
                                                {{ $errors->first('end_day') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                            <label>Số ngày :</label>
                                            <input type="number" value="{{ old('number_day') }}" class="number_day"
                                                name="number_day" id="nameInput" placeholder="Số ngày..." readonly>
                                            @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('number_day') }}</p>
                                            @endif
                                        </div>



                                        <div class="form-group col-lg-6 col-md-12" style="margin-bottom:3%!important">
                                            <label>Tổng thanh toán cho tin đăng (ĐTD) :</label>
                                            <input id="price" type="text" value="{{ old('price') }}" name="price"
                                                placeholder="Giá..." readonly>
                                            @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>

                                    </div>
                                    <!-- Input -->
                                    <div class="form-group col-lg-12 col-md-12 text-right">
                                        <button class="theme-btn btn-style-one">Đăng Tin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

            </div>
        </div>


    </div>
</section>
<style>
#internationalDiv {
    display: none
}
</style>
@endsection

@section('footer')
<script>
//hàm xử lý tính số ngày

function calculateDays() {
    var startDayInput = document.querySelector('input[name="start_day"]');
    var endDayInput = document.querySelector('input[name="end_day"]');
    var numberDayInput = document.querySelector('input[name="number_day"]');

    if (startDayInput.value && endDayInput.value) {
        var startDay = new Date(startDayInput.value);
        var endDay = new Date(endDayInput.value);

        var timeDiff = endDay - startDay;
        var dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        if (!isNaN(dayDiff) && dayDiff >= 0 && dayDiff <=
            30) { // Kiểm tra số ngày có nằm trong khoảng từ 0 đến 30 không
            numberDayInput.value = dayDiff;
        } else {
            alert("Số ngày đăng tin không vượt quá 30 ngày");
            endDayInput.value = "";
            numberDayInput.value = "";
        }

        // validate

        var startDate = new Date(document.querySelector('input[name="start_day"]').value);
        var endDate = new Date(document.querySelector('input[name="end_day"]').value);

        if (endDate < startDate) {
            alert("Ngày hết hạn phải lớn hơn hoặc bằng ngày bắt đầu");
            document.querySelector('input[name="end_day"]').value = "";
        }
        handle_price_package();
    }


}

// hàm xử lý tính giá tiền
function handle_price_package() {
    var price = parseFloat($("#package_type").find("option:selected").data("price"));
    var jobCount = $("#package_type").find("option:selected").data("count_job");
    if (jobCount == 0) {
        if (price !== undefined) {
            var formatted_total_price = price.toLocaleString("vi-VN");
            $("#price").val(formatted_total_price);
        }
    } else {
        $("#price").val(0);
    }
}

$(document).ready(function() {
    // $('.career_ids').select2();
});
</script>
<script>
var currentDate = new Date().toISOString().split('T')[0];
document.getElementById('deadlineInput').min = currentDate;
</script>

<script>
$(document).ready(function() {
    $('#country').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue === 'VN') {
            $('#provinceDiv').show();
            $('#internationalDiv').hide();
        } else if (selectedValue === 'NN') {
            $('#provinceDiv').hide();
            $('#internationalDiv').show();
        }
    });
});

$(document).ready(function() {
    $("form").submit(function(event) {
        var salaryMin = parseInt($("#salaryMin").val());
        var salaryMax = parseInt($("#salaryMax").val());
        if (salaryMax <= salaryMin) {
            alert("Mức lương tối đa phải lớn hơn mức lương tối thiểu.");
            event.preventDefault();
        }
    });

});
</script>
@endsection