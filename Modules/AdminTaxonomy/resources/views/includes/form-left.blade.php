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