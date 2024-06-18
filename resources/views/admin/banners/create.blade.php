@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
    'page_title' => 'Thêm Banner'
])
<form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        <x-admintheme::form-input-error field="name" />
                    </div>
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Image') }}</label>
                        <input type="file" class="form-control" name="image">
                        <x-admintheme::form-input-error field="image" />
                    </div>
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Link') }}</label>
                        <input type="url" class="form-control" name="link" value="{{ old('link') }}">
                        <x-admintheme::form-input-error field="link" />
                    </div>
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Position') }}</label>
                        <input type="number" class="form-control" name="position" value="{{ old('position') }}">
                        <x-admintheme::form-input-error field="position" />
                    </div>
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Group Banner') }}</label>
                        <select class="form-control" name="group_banner">
                            @foreach($groupBannerOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        <x-admintheme::form-input-error field="group_banner" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('banners.index') }}" class="btn btn-danger px-4">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end row-->
@endsection
