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
        <div class="mb-4">
            <label class="mb-3">{{ __('status') }}</label>
            <x-admintheme::form-status-show model="{{ $model }}" status="{{ $item->status ?? old('status') }}"
                name="status" />
        </div>
    </div>
</div>

@yield('custom-fields-right')


