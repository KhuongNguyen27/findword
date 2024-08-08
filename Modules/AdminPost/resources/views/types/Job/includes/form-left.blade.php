<div class="card">
    <div class="card-header">
        <div class="text-uppercase fw-bold">{{ __('job_information') }}</div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('career') }}</label>
            <select name="career_ids[]" class="form-control select2" multiple="multiple">
                @php
                if (isset($item)) {
                $selected_ids = $item->careers->pluck('id')->toArray();
                }
                @endphp
                @foreach (\App\Models\Career::all() as $career)
                <option @selected(isset($selected_ids) && in_array($career->id, $selected_ids)) value="{{ $career->id }}">
                    {{ $career->name }}
                </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="career_ids" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('form_work') }}</label>
            <select name="formwork_id" class="form-control">
                @foreach (\App\Models\FormWork::all() as $formwork)
                <option {{ isset($item) && $item->formwork_id == $formwork->id ? 'selected': ''}} value="{{ $formwork->id }}">
                    {{ $formwork->name }}
                </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="formwork_id" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('deadline') }}</label>
            <input type="date" class="form-control" name="deadline" value="{{ $item->deadline ?? old('deadline') }}">
            <x-admintheme::form-input-error field="deadline" />
        </div>
        <div class="mb-4">
    <label class="mb-3">{{ __('experience') }}</label>
    <select name="experience" class="form-control">
        <option value="2" {{ isset($item) && $item->experience == 2 ? 'selected' : '' }}>Có yêu cầu</option>
        <option value="1" {{ isset($item) && $item->experience == 1 ? 'selected' : '' }}>Không yêu cầu</option>
    </select>
    <x-admintheme::form-input-error field="experience" />
</div>

        {{-- <div class="mb-4">
            <label class="mb-3">{{ __('wage') }}</label>
        <select name="wage_id" class="form-control">
            @foreach (\App\Models\Wage::all() as $wage)
            <option {{ isset($item) && $item->wage_id == $wage->id ?? 'selected' }} value="{{ $wage->id }}">
                {{ $wage->name }}</option>
            @endforeach
        </select>
        <x-admintheme::form-input-error field="deadline" />
    </div> --}}
    <div class="row">
        <div class="col-6 mb-4">
            <label class="mb-3">{{ __('salaryMin') }}</label>
            <input type="number" class="form-control" name="salaryMin" value="{{ $item->salaryMin ?? old('salaryMin') }}">
            <x-admintheme::form-input-error field="salaryMin" />
        </div>
        <div class="col-6 mb-4">
            <label class="mb-3">{{ __('salaryMax') }}</label>
            <input type="number" class="form-control" name="salaryMax" value="{{ $item->salaryMax ?? old('salaryMax') }}">
            <x-admintheme::form-input-error field="salaryMax" />
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-4">
            <label class="mb-3">{{ __('gender') }}</label>
            <select name="gender" class="form-control">
                <option value="" {{ !isset($item) || $item->gender == '' ? 'selected' : '' }}>Không yêu cầu</option>
                <option value="1" {{ isset($item) && $item->gender == 1 ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ isset($item) && $item->gender == 2 ? 'selected' : '' }}>Nữ</option>
            </select>
            <x-admintheme::form-input-error field="gender" />
        </div>

        <div class="col-6 mb-4">
            <label class="mb-3">{{ __('position') }}</label>
            <input type="number" class="form-control" name="position" value="{{ $item->position ?? old('position') }}">
            <x-admintheme::form-input-error field="position" />
        </div>
    </div>
    <div class="mb-4">
        <label class="mb-3">{{ __('work_address') }}</label>
        <input type="text" class="form-control" name="work_address" value="{{ $item->work_address ?? old('work_address') }}">
        <x-admintheme::form-input-error field="work_address" />
    </div>
    <div class="mb-4 row">
        <div class="col-6">
            <label class="mb-3">{{ __('degree') }}</label>
            <select name="degree_id" class="form-control">
                     @foreach (\App\Models\Level::all() as $degree)
            <option value="{{ $degree->id }}" {{ isset($item) && $item->degree_id == $degree->id ? 'selected' : '' }}>
                {{ $degree->name }}
            </option>
        @endforeach
            </select>
            <x-admintheme::form-input-error field="degree_id" />
        </div>
        <div class="col-6">
            <label class="mb-3">{{ __('rank') }}</label>
            <select name="rank_id" class="form-control">
                @foreach (\App\Models\Rank::all() as $rank)
                <option value="{{ $rank->id }}" {{ isset($item) && $item->rank_id == $rank->id ? 'selected' : '' }}>
                    {{ $rank->name }}
                </option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="rank_id" />
        </div>
    </div>
    <div class="mb-4">
        <label class="mb-3">{{ __('requirements') }}</label>
        <textarea name="requirements" placeholder="Yêu cầu..." id="requirements" class="form-control">{{ @$item->requirements }}</textarea>
        <x-admintheme::form-input-error field="requirements" />
    </div>
    <div class="form-group col-lg-12 col-md-12">
        <label>{{__('more_information')}}</label>
        <textarea name="more_information" id="more_information" placeholder="{{__('more_information')}}...">
        {{@$item->more_information}}
        </textarea>
        <x-admintheme::form-input-error field="more_information" />
    </div>


    <div class="mb-4">
        <label class="mb-3">Từ khóa</label>
        @php
        if (isset($item)) {
        $selected_ids = $item->job_tags->pluck('id')->toArray();
        }
        @endphp
        <select name="job_tag_ids[]" class="form-control select2" multiple="multiple">
            @foreach (\App\Models\JobTag::all() as $job_tag)
            <option @selected(isset($selected_ids) && in_array($job_tag->id, $selected_ids)) value="{{ $job_tag->id }}">
                {{ $job_tag->name }}
            </option>
            @endforeach
        </select>
        <x-admintheme::form-input-error field="job_tag_ids" />
    </div>
</div>
</div>
