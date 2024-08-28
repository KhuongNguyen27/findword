@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Thêm mới tài khoản'
])
<form action="{{ route('adminuser.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('adminuser::includes.form-left')
        </div>
        <div class="col-12 col-lg-4">
            @include('adminuser::includes.form-right')
        </div>
    </div>
</form>
<!--end row-->
@endsection