@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => __('adminpost::general.title_create')
])
<form action="{{ route('admin.cvs.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('cvs::admin.includes.form-left')
        </div>
        <div class="col-12 col-lg-4">
            @include('cvs::admin.includes.form-right')
        </div>
    </div>
</form>
@endsection