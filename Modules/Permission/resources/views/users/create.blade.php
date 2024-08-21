@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
    'page_title' => 'Thêm Người Dùng'
])

<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        <x-admintheme::form-input-error field="name" />
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Email') }}</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        <x-admintheme::form-input-error field="email" />
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Password') }}</label>
                        <input type="password" class="form-control" name="password">
                        <x-admintheme::form-input-error field="password" />
                    </div>
<!-- Group ID Field -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Group') }}</label>
                        <select class="form-control" name="group_id">
                            <option value="">{{ __('Select Group') }}</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-admintheme::form-input-error field="group_id" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-danger px-4">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
