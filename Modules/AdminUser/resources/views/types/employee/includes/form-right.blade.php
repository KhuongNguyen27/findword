<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('verify') }}</label>
            <select type="text" class="form-control" name="verify">
                <option value="0" {{ isset($item) && $item->verify == 0 ? 'selected' : '' }}>{{ __('inconfirm') }}
                </option>
                <option value="1" {{ isset($item) && $item->verify == 1 ? 'selected' : '' }}>{{ __('confirm') }}
                </option>
            </select>
            <x-admintheme::form-input-error field="verify" />
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Quyền đăng Tin ngoài nước</label>
            <select type="text" class="form-control" name="is_allowed_abroad">
                <option value="0" {{ isset($item) && $item->employee->is_allowed_abroad == 0 ? 'selected' : '' }}>Không xác nhận
                </option>
                <option value="1" {{ isset($item) && $item->employee->is_allowed_abroad == 1 ? 'selected' : '' }}>Xác nhận
                </option>
            </select>
            <x-admintheme::form-input-error field="is_allowed_abroad" />
        </div>
    </div>
</div>


