<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Verify </label>
            <select type="text" class="form-control" name="verify">
                <option value="0" @selected($item->verify == 0)>InConfirm</option>
                <option value="1" @selected($item->verify == 1)>Confirm</option>
            </select>
            <x-admintheme::form-input-error field="verify" />
        </div>
    </div>
</div>