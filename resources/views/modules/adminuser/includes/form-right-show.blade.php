<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('adminuser.index',['type' => request()->type]) }}"
                class="btn btn-danger px-4">{{ __('back') }}</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('image') }}</label>
            <x-admintheme::form-image-show name="image" imageUrl="{{ $item->employee->image_fm ?? '' }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image" />
        </div>
        <!-- @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">{{ __('image_business_license') }}</label>
            <x-admintheme::form-image-show name="image" imageUrl="{{ !empty($item->employee->image_business_license) ? asset($item->employee->image_business_license) : asset('/website-assets/images/backgroudemploy.jpg') }}" upload="1"
                accept=".jpg, .png, image/jpeg, image/png" />
            <x-admintheme::form-input-error field="image" />
        </div>
        @endif -->
        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">Giấy phép kinh doanh</label>
            <div class="image-gallery" id="business-license-preview">
                @if (!empty($item->employee->image_business_license))
                @foreach (json_decode($item->employee->image_business_license) as $image)
                <div class="image-item" style="display: inline-block; position: relative; margin: 5px;">
                    <img src="{{ asset($image) }}" alt="Preview Image" style="max-width: 150px; max-height: 120px;">
                    <a href="#" class="delete-image" data-image="{{ $image }}"
                        data-url="{{ route('employee.image.delete') }}"
                        style="position: absolute; top: 5px; right: 5px; color: red; font-size: 20px; text-decoration: none;">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        @endif
        <div class="mb-4">
            <label class="mb-3">{{ __('status') }}</label>
            <x-admintheme::form-status-show model="{{ $model }}" status="{{ $item->status ?? old('status') }}"
                name="status" />
        </div>
    </div>
</div>

@yield('custom-fields-right')


