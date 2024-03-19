<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('address') }}</label>
            <input type="text" class="form-control" name="address" value="{{ $item->employee->address ?? '' }}" placeholder="">
            <x-admintheme::form-input-error field="address"/>
        </div>

        <!-- Input -->
        <div class="mb-4">
            <label class="mb-3">{{ __('phone') }}</label>
            <input type="text" class="form-control" name="phone" value="{{ $item->employee->phone ?? '' }}" placeholder="">
            <x-admintheme::form-input-error field="phone"/>
        </div>

        <div class="mb-4">
            <label class="mb-3">Website </label>
            <input type="text" class="form-control" name="website" value="{{ $item->employee->website ?? '' }}" placeholder="">
            <x-admintheme::form-input-error field="website"/>
        </div>
    </div>
</div>

    