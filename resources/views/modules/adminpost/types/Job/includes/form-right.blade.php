<div class="card">
    <div class="card-header">
        <div class="text-uppercase fw-bold">{{ __('messsage_config') }}</div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('jobpackage') }}</label>
            <select id="package_tye" name="jobpackage_id" onchange="handle_price_package()" class="form-control">
                @foreach (\App\Models\JobPackage::all() as $job_package)
                    <option data-price="{{ $job_package->price }}"
                        {{ isset($item) && $item->jobpackage_id == $job_package->id ? 'selected' : '' }}
                        value="{{ $job_package->id }}">
                        {{ $job_package->name }}
                    </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="jobpackage_id" />
        </div>
        
        <div class="mb-4 row">
            <div class="col-6">
                <label class="mb-3">{{ __('start_day') }}</label>
                <input type="date" value="{{ @$item->start_day }}" name="start_day" placeholder="" class="form-control"
                    onchange="calculateDays()">
                <x-admintheme::form-input-error field="start_day" />
            </div>
            <div class="col-6">
                <label class="mb-3">{{ __('adminpost::form.end_day') }}</label>
                <input type="date" value="{{ @$item->end_day }}" name="end_day" placeholder="" class="form-control"
                    onchange="calculateDays()">
                <x-admintheme::form-input-error field="end_day" />
            </div>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('number_day') }}</label>
            <input type="number" value="{{ @$item->number_day }}" name="number_day" class="form-control" id="nameInput"
                placeholder="Số ngày..." readonly disabled>
            <x-admintheme::form-input-error field="number_day" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('price') }}</label>
            <input type="number" value="{{ @$item->price }}" name="price" class="form-control" id="nameInput"
                placeholder="Số ngày...">
            <x-admintheme::form-input-error field="price" />
        </div>
        <div class="mb-4 row">
            <div class="col-6">
                <label class="mb-3">{{ __('start_hour') }}</label>
                <input type="time" value="{{ @$item->start_hour }}" name="start_hour" placeholder=""
                    class="form-control">
                <x-admintheme::form-input-error field="start_hour" />
            </div>
            <div class="col-6">
                <label class="mb-3">{{ __('end_hour') }}</label>
                <input type="time" value="{{ @$item->end_hour }}" name="end_hour" placeholder="" class="form-control">
                <x-admintheme::form-input-error field="end_hour" />
            </div>
        </div>
    </div>
</div>
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
    var price = $("#package_tye").find("option:selected").data("price");
    var number_day = $(".number_day").val();
    // Kiểm tra nếu cả hai giá trị đều có thì mới tính toán tổng giá trị
    if (price !== undefined && number_day !== "") {
        var total_price = price * number_day;
        // Hiển thị tổng giá trị trong ô input
        $("#price").val(total_price);
    }
}


// Gọi hàm calculateDays() lần đầu khi trang đã tải xong để tính toán số ngày ban đầu.
calculateDays();

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
