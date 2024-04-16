<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Tên công ty</label>
            <input type="text" class="form-control" name="name_company" value="{{ $item->employee->name ?? '' }}" placeholder="">
            <x-admintheme::form-input-error field="name_company"/>
        </div>
        <div class="mb-4">
            <label class="mb-3" >Độ ưu tiên</label>
            <input type="number" name="position" class="form-control" value="{{ ($item->employee->position ?? '') }}" >
        </div>
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
        <div class="mb-4">
            <label class="mb-3"> Token </label>
            <input type="number" class="form-control" name="points" value="{{ $item->points ?? '' }}" placeholder="" max="9999">
            <x-admintheme::form-input-error field="points"/>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('description') }}</label>
            <textarea id="description" class="tinymce" name="about" cols="4" rows="6">{{ $item->employee->about ?? old('about') }}</textarea>
            <div id="tinycomments-container">
                <x-admintheme::form-input-error field="about"/>
            </div>
        </div>
    </div>
</div>

    