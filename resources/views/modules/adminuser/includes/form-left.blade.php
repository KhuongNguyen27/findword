<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4 mb-4">
                <label class="mb-3">{{ __('name') }} <span class="label-required text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
                <x-admintheme::form-input-error field="name" />
            </div>
            <div class="col-4 mb-4">
                <label class="mb-3">{{ __('email') }} <span class="label-required text-danger">*</span></label>
                <input type="text" class="form-control" name="email" value="{{ $item->email ?? old('email') }}">
                <x-admintheme::form-input-error field="email" />
            </div>
            <div class="col-4 mb-4">
                <label class="mb-3">{{ __('password') }} <span class="label-required text-danger">*</span></label>
                <input type="password" class="form-control" name="password" value="">
                <x-admintheme::form-input-error field="password" />
            </div>
        </div>
        @if (request()->type == 'staff')
            <div class="row">
                <div class="col-6 mb-4">
                    <label class="mb-3">{{ __('phone') }} <span class="label-required text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" value="{{ $item->staff->phone ?? old('phone') }}">
                    <x-admintheme::form-input-error field="phone" />
                </div>
                <div class="col-6 mb-4">
                    <label class="mb-3">{{ __('address') }} <span class="label-required text-danger">*</span></label>
                    <input type="text" class="form-control" name="address" value="{{ $item->staff->address ?? old('address') }}">
                    <x-admintheme::form-input-error field="address" />
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-4">
                    <label class="mb-3">{{ __('province_city') }} <span class="label-required text-danger">*</span></label>
                    <input type="text" class="form-control" name="city" value="{{ $item->staff->city ?? old('city') }}">
                    <x-admintheme::form-input-error field="city" />
                </div>
                <div class="col-6 mb-4">
                    <label class="mb-3">Ngày sinh <span class="label-required text-danger">*</span></label>
                    <input type="date" class="form-control" name="birthdate" value="{{ $item->staff->birthdate ?? old('birthdate') }}">
                    <x-admintheme::form-input-error field="birthdate" />
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-4">
                    <label class="mb-3">{{ __('gender') }} <span class="label-required text-danger">*</span></label>
                    @if (isset($item))
                        <select name="gender" class="form-control">
                            <option value="nam" {{ $item->staff->gender == 'nam' ? 'selected' : '' }}>Nam
                            </option>
                            <option value="nu" {{ $item->staff->gender == 'nu' ? 'selected' : '' }}>Nữ
                            </option>
                            <option value="khac" {{ $item->staff->gender == 'khac' ? 'selected' : '' }}>Khác
                            </option>
                        </select>
                    @else
                        <select name="gender" class="form-control">
                            <option value="nam">Nam
                            </option>
                            <option value="nu" >Nữ
                            </option>
                            <option value="khac">Khác
                            </option>
                        </select>
                    @endif
                    <x-admintheme::form-input-error field="gender" />
                </div>
                <div class="col-6 mb-4">
                    <label class="mb-3">Số năm kinh nghiệm <span class="label-required text-danger">*</span></label>
                    <input type="text" class="form-control" name="experience_years" value="{{ $item->staff->experience_years ?? old('experience_years') }}">
                    <x-admintheme::form-input-error field="experience_years" />
                </div>
            </div>
         <div class="row">
         <div class="col-6 mb-4">
                <label class="mb-3">{{ __('outstanding_achievements') }} <span class="label-required text-danger">*</span></label>
                <input type="text" class="form-control" name="outstanding_achievements" value="{{ $item->staff->outstanding_achievements ?? old('outstanding_achievements') }}">
                <x-admintheme::form-input-error field="outstanding_achievements" />
            </div>
            <div class="col-6 mb-4">
                <label class="mb-3" >{{ __('position') }}</label> <span class="label-required text-danger">*</span></label>
                <input type="number" class="form-control" name="position" value="{{ $item->position ?? old('position') }}">
                <x-admintheme::form-input-error field="position" />
            </div>
         </div>
        @endif
    </div>
</div>

@yield('custom-fields-left')
