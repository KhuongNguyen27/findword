@extends('admintheme::layouts.master')
@section('content')
    @include('admintheme::includes.globals.breadcrumb', [
        'page_title' => 'Chi tiết tài khoản',
    ])
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{ request()->type ?? $item->type }}">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('name') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input style="border: none; background-color: white" disabled readonly type="text"
                                    class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
                                <x-admintheme::form-input-error field="name" />
                            </div>
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('email') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ $item->email ?? old('email') }}" style="border: none; background-color: white"
                                    disabled readonly>
                                <x-admintheme::form-input-error field="email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('phone') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $item->staff->phone ?? old('phone') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="phone" />
                            </div>
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('address') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ $item->staff->address ?? old('address') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="address" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('province_city') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="city"
                                    value="{{ $item->staff->city ?? old('city') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="city" />
                            </div>
                            <div class="col-6 mb-4">
                                <label class="mb-3">Ngày sinh <span class="label-required text-danger">*</span></label>
                                <input type="date" class="form-control" name="birthdate"
                                    value="{{ $item->staff->birthdate ?? old('birthdate') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="birthdate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('gender') }} <span
                                        class="label-required text-danger">*</span></label>
                                <select name="gender" class="form-control" style="border: none; background-color: white"
                                    disabled>
                                    <option value="nam" {{ $item->staff->gender == 'nam' ? 'selected' : '' }} disabled>
                                        Nam
                                    </option>
                                    <option value="nu" {{ $item->staff->gender == 'nu' ? 'selected' : '' }} disabled>Nữ
                                    </option>
                                    <option value="khac" {{ $item->staff->gender == 'khac' ? 'selected' : '' }} disabled>
                                        Khác
                                    </option>
                                </select>
                                <x-admintheme::form-input-error field="gender" />
                            </div>
                            <div class="col-6 mb-4">
                                <label class="mb-3">Số năm kink nghiệm <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="experience_years"
                                    value="{{ $item->staff->experience_years ?? old('experience_years') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="experience_years" />
                            </div>
                        </div>
                      <div class="row">
                        <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('outstanding_achievements') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="outstanding_achievements"
                                    value="{{ $item->staff->outstanding_achievements ?? old('outstanding_achievements') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="outstanding_achievements" />
                            </div>
                            <div class="col-6 mb-4">
                                <label class="mb-3">{{ __('position') }} <span
                                        class="label-required text-danger">*</span></label>
                                <input type="text" class="form-control" name="position"
                                    value="{{ $item->position ?? old('position') }}"
                                    style="border: none; background-color: white" disabled readonly>
                                <x-admintheme::form-input-error field="position" />
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @yield('custom-fields-left')
            </div>
            <div class="col-12 col-lg-4">
                @include('adminuser::includes.form-right-show')
            </div>
        </div>
        </div>
    </form>
    <!--end row-->
@endsection
