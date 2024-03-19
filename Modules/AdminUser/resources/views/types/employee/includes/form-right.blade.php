<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('verify') }}</label>
            <select type="text" class="form-control" name="verify">
                <option value="0" @selected($item->verify == 0)>{{ __('inconfirm') }}</option>
                <option value="1" @selected($item->verify == 1)>{{ __('confirm') }}</option>
            </select>
            <x-admintheme::form-input-error field="verify" />
        </div>
    </div>
</div>