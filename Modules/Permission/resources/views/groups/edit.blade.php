@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
    'page_title' => 'Nhóm'
])
<form action="{{ route('groups.update', ['group' => $group->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <label class="mb-3">{{ __('name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $group->name }}">
                        <x-admintheme::form-input-error field="name" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('countries.index') }}" class="btn btn-danger px-4">{{ __('back') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ __('save') }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<!--end row-->
@endsection