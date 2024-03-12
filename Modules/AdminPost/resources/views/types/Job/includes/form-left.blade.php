<div class="card">
    <div class="card-header">
        <div class="text-uppercase fw-bold">Thông tin công việc</div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.career_ids') }}</label>
            <select name="career_ids[]" class="form-control" multiple="multiple">
                @php
                if(isset($item)){
                $selected_ids = $item->careers->pluck('id')->toArray();
                }
                @endphp
                @foreach (\App\Models\Career::all() as $career)
                <option {{ isset($selected_ids) && in_array($career->id, $selected_ids) ?? 'selected' }}
                    value="{{ $career->id }}">
                    {{ $career->name }}
                </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="career_ids" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.formwork_id') }}</label>
            <select name="formwork_id" class="form-control">
                @foreach (\App\Models\FormWork::all() as $formwork)
                <option {{ isset($item) && $item->formwork_id == $formwork->id ?? 'selected' }}
                    value="{{ $formwork->id }}">
                    {{ $formwork->name }}
                </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="formwork_id" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.deadline') }}</label>
            <input type="text" class="form-control" name="deadline" value="{{ $item->deadline ?? old('deadline') }}">
            <x-admintheme::form-input-error field="deadline" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.experience') }}</label>
            <select name="experience" class="form-control">
                <option {{ isset($item) && $item->experience == 2 ?? 'selected' }} value="2">Có yêu cầu</option>
                <option {{ isset($item) && $item->experience == 1 ?? 'selected' }} value="1">Không yêu cầu</option>
            </select>
            <x-admintheme::form-input-error field="experience" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.wage_id') }}</label>
            <select name="wage_id" class="form-control">
                @foreach (\App\Models\Wage::all() as $wage)
                <option {{ isset($item) && $item->wage_id == $wage->id ?? 'selected' }} value="{{ $wage->id }}">
                    {{ $wage->name }}</option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="deadline" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.gender') }}</label>
            <select name="gender" class="form-control">
                <option {{ !isset($item) ?? 'selected' }} value="">Không yêu cầu</option>
                <option {{ isset($item) && $item->gender == 1 ?? 'selected' }} value="1">Nam</option>
                <option {{ isset($item) && $item->gender == 2 ?? 'selected' }} value="2">Nữ</option>
            </select>
            <x-admintheme::form-input-error field="deadline" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.work_address') }}</label>
            <input type="text" class="form-control" name="work_address"
                value="{{ $item->work_address ?? old('work_address') }}">
            <x-admintheme::form-input-error field="work_address" />
        </div>
        <div class="mb-4 d-flex">
            <div class="col-6">
                <label class="mb-3">{{ __('adminpost::form.degree_id') }}</label>
                <select name="degree_id" class="form-control">
                    @foreach (\App\Models\Level::all() as $degree)
                    <option {{ isset($item) && $item->degree_id == $degree->id ?? 'selected' }}
                        value="{{ $degree->id }}">
                        {{ $degree->name }}</option>
                    @endforeach
                </select>
                <x-admintheme::form-input-error field="work_address" />
            </div>
            <div class="col-6">
                <label class="mb-3">{{ __('adminpost::form.rank_id') }}</label>
                <select name="rank_id" class="form-control">
                    @foreach (\App\Models\Rank::all() as $rank)
                    <option {{ isset($item) && $item->rank_id == $rank->id ?? 'selected' }} value="{{ $rank->id }}">
                        {{ $rank->name }}</option>
                    @endforeach
                </select>
                <x-admintheme::form-input-error field="rank_id" />
            </div>
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('adminpost::form.requirements') }}</label>
            <textarea name="requirements" placeholder="Yêu cầu..."
                class="form-control">{{ isset($item) ?? $item->requirements }}</textarea>
            <x-admintheme::form-input-error field="requirements" />
        </div>
    </div>
</div>