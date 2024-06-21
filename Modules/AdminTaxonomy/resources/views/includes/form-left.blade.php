<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
            <x-admintheme::form-input-error field="name"/>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('position') }}</label>
            <input type="number" class="form-control" name="position" value="{{ $item->position ?? old('position') }}">
            <x-admintheme::form-input-error field="position"/>
        </div>
        @if(request()->type =="JobPackage")
            <div class="mb-4" >
                <label class="mb-3">Tự động lên top</label>
                <div class="col-md-12 row">
                    <div class="col-md-4">
                        <label for="">Khu vực</label>
                        <select class="form-select" name="area" id="">
                            <option value="">Khu vực</option>
                            <option value="today" {{$item->autoPostJobPackage->area == "Việc làm Hôm nay" ? "selected" : ''}} >Việc làm Hôm nay</option>
                            <option value="hot" {{$item->autoPostJobPackage->area == "Việc làm Hot nhất" ? "selected" : ''}}>Việc làm Hot nhất</option>
                            <option value="urgent" {{$item->autoPostJobPackage->area == "Tuyển gấp" ? "selected" : ''}}>Tuyển gấp</option>
                            <option value="moi-nhat" {{$item->autoPostJobPackage->area == "Việc làm Mới nhất" ? "selected" : ''}}>Việc làm Mới nhất</option>
                            <option value="Việc làm Tốt nhất" {{$item->autoPostJobPackage->area == "Việc làm Tốt nhất" ? "selected" : ''}}>Việc làm Tốt nhất</option>
                            <option value="hap-dan" {{$item->autoPostJobPackage->area == "Việc làm Hấp dẫn" ? "selected" : ''}} >Việc làm Hấp dẫn</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Tự động theo ngày</label>
                        <select class="form-select" name="daily" id="">
                            <option value="">Lựa chọn</option>
                            <option value="hàng ngày"  {{$item->autoPostJobPackage->daily == "hàng ngày" ? "selected" : ''}} >hàng ngày</option>
                            <option value="trong ngày" {{$item->autoPostJobPackage->daily == "trong ngày" ? "selected" : ''}}>trong ngày</option>
                            <option value="ngày tiếp theo"  {{$item->autoPostJobPackage->daily == "ngày tiếp theo" ? "selected" : ''}}>ngày tiếp theo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">vào lúc mấy giờ </label>
                        <select class="form-select" name="hour" id="">
                            <option value="">Lựa chọn</option>
                            @for($i = 1; $i <= 24;$i++)
                                <option value="{{$i < 10 ? '0' + $i : $i}}:00" {{$item->autoPostJobPackage->hour == $i ? "selected" : ''}}>{{$i < 10 ? "0" + $i : $i}}:00</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Duy trì trong bao nhiêu tiếng</label>
                        <select class="form-select" name="auto_in_hour" id="">
                            <option value="">Lựa chọn</option>
                            @for($i = 1; $i <= 24;$i++)
                                <option value="{{$i}}" {{$item->autoPostJobPackage->auto_in_hour == $i ? "selected" : ''}}>{{$i}}h</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        @endif
        <div class="mb-4" id="salary_min_wrapper">
            <label class="mb-3">{{ __('salaryMin') }}</label>
            <input class="form-control" name="salaryMin" type="number"  value="{{ $item->salaryMin ?? old('salaryMin') }}">
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="salaryMin"/>
            </div>
        </div>
        <div class="mb-4" id="salary_max_wrapper">
            <label class="mb-3">{{ __('salaryMax') }}</label>
            <input class="form-control" name="salaryMax" type="number" value="{{ $item->salaryMax ?? old('salaryMax') }}" >
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="salaryMax"/>
            </div>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('description') }}</label>
            <textarea class="html-editor" name="description" id="description" cols="4" rows="6">{{ $item->description ?? old('description') }}</textarea>
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="description"/>
            </div>
        </div>
    </div>
</div>

@yield('custom-fields-left')