@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb')
<form action="{{ route($route_prefix.'update',$item->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('cvs::admin.includes.form-left')
        </div>
        <div class="col-12 col-lg-4">
            @include('cvs::admin.includes.form-right')
        </div>
    </div>
</form>
<!--end row-->
@endsection