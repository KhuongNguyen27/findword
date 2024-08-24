@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
'page_title' => 'Thêm Popup'
])

<form action="{{ route('popups.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Title -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Title') }}</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        <x-admintheme::form-input-error field="title" />
                    </div>

                    <!-- Video Link -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Video Link') }}</label>
                        <input type="url" class="form-control" name="video_link" value="{{ old('video_link') }}">
                        <x-admintheme::form-input-error field="video_link" />
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Content') }}</label>
                        <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                        <x-admintheme::form-input-error field="content" />
                    </div>
        
                <!-- Image Upload -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Image') }}</label>
                        <input type="file" class="form-control" name="image">
                        <x-admintheme::form-input-error field="image" />
                    </div>
                    
                    <!-- Is Active -->
                    <div class="mb-4">
                        <label class="mb-3">{{ __('Active') }}</label>
                        <select class="form-control" name="is_active">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <x-admintheme::form-input-error field="is_active" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('popups.index') }}" class="btn btn-danger px-4">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end row-->
@endsection
