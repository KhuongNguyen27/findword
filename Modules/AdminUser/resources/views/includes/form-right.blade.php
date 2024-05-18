<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('adminuser.index',['type'=>request()->type]) }}"
                class="btn btn-danger px-4">{{ __('back') }}</a>
            <button type="submit" class="btn btn-primary px-4">{{ __('save') }}</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('image') }}</label>
            <x-admintheme::form-image name="image" imageUrl="{{ $item->employee->image_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image" />
        </div>
        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <x-admintheme::form-image name="image_business_license" imageUrl="{{ !empty($item->employee->image_business_license) ? asset($item->employee->image_business_license) : asset('/website-assets/images/backgroudemploy.jpg') }}" upload="1"
            accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image_business_license" />
        </div>
        @endif
        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Ảnh bìa</label>
            <x-admintheme::form-image name="background" imageUrl="{{ $item->employee->background_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="background" />
        </div>
        @endif

        <div class="mb-4">
            <label class="mb-3">{{ __('status') }}</label>
            <x-admintheme::form-status model="{{ $model }}" status="{{ $item->status ?? old('status') }}"
                name="status" />
        </div>
    </div>
</div>

@yield('custom-fields-right')