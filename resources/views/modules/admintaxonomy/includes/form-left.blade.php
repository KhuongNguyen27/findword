<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
            <x-admintheme::form-input-error field="name" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('position') }}</label>
            <input type="number" class="form-control" name="position" value="{{ $item->position ?? old('position') }}">
            <x-admintheme::form-input-error field="position" />
        </div>
        @if(request()->type =="JobPackage")
        <div class="mb-4">
            <label class="mb-3">Tự động lên top</label>
            <div class="col-md-12 row">
                <div class="col-md-6 mb-3">
                    <label for=""class="mb-3">Khu vực</label>
                    <select class="form-select" name="area" id="">
                        <option value="">Khu vực</option>
                        <option value="today"
                            {{  isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "today" ? "selected" : ''}}>
                            Việc làm Hôm nay</option>
                        <option value="hot"
                            {{isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "hot" ? "selected" : ''}}>
                            Việc làm Hot nhất</option>
                        <option value="urgent"
                            {{ isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "urgent" ? "selected" : ''}}>
                            Tuyển gấp</option>
                        <option value="moi-nhat"
                            {{ isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "moi-nhat" ? "selected" : ''}}>
                            Việc làm Mới nhất</option>
                        <option value="tot-nhat"
                            {{ isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "tot-nhat" ? "selected" : ''}}>
                            Việc làm Tốt nhất</option>
                        <option value="hap-dan"
                            {{ isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->area == "hap-dan" ? "selected" : ''}}>
                            Việc làm Hấp dẫn</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="mb-3">Tự động theo ngày</label>
                    <select class="form-select" name="daily" id="">
                        <option value="">Lựa chọn</option>
                        <option value="hàng ngày"
                            {{isset($item)  && $item->autoPostJobPackage && $item->autoPostJobPackage->daily == "hàng ngày" ? "selected" : ''}}>
                            hàng ngày</option>
                        <option value="trong ngày"
                            {{isset($item)  && $item->autoPostJobPackage && $item->autoPostJobPackage->daily == "trong ngày" ? "selected" : ''}}>
                            trong ngày</option>
                        <option value="ngày tiếp theo"
                            {{isset($item)  && $item->autoPostJobPackage && $item->autoPostJobPackage->daily == "ngày tiếp theo" ? "selected" : ''}}>
                            ngày tiếp theo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="mb-3">vào lúc mấy giờ </label>
                    <select class="form-select" name="hour" id="">
                        <option value="">Lựa chọn</option>
                        @for($i = 0; $i < 24; $i++) @php $formattedHour=sprintf('%02d:00', $i); @endphp <option
                            value="{{ $formattedHour }}" @if(isset($item->
                            autoPostJobPackage) && $item->autoPostJobPackage->hour == $formattedHour)
                            selected
                            @endif
                            >
                            {{ $formattedHour }}
                            </option>
                            @endfor
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="" class="mb-3">Duy trì trong bao nhiêu tiếng</label>
                    <select class="form-select" name="auto_in_hour" id="">
                        <option value="">Lựa chọn</option>
                        @for($i = 1; $i <= 24;$i++) <option value="{{$i}}"
                            {{isset($item) && $item->autoPostJobPackage && $item->autoPostJobPackage->auto_in_hour == $i ? "selected" : ''}}>
                            {{$i}}h</option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="mb-4" id="salary_min_wrapper">
            <label class="mb-3">{{ __('salaryMin') }}</label>
            <input class="form-control" name="salaryMin" type="number"
                value="{{ $item->salaryMin ?? old('salaryMin') }}">
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="salaryMin" />
            </div>
        </div>
        <div class="mb-4" id="salary_max_wrapper">
            <label class="mb-3">{{ __('salaryMax') }}</label>
            <input class="form-control" name="salaryMax" type="number"
                value="{{ $item->salaryMax ?? old('salaryMax') }}">
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="salaryMax" />
            </div>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('description') }}</label>
            <textarea class="html-editor" name="description" id="description" cols="4"
                rows="6">{{ $item->description ?? old('description') }}</textarea>
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="description" />
            </div>
        </div>
    </div>
</div>

@yield('custom-fields-left')