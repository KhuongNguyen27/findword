@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Thêm mới giao dịch'
])
<form action="{{ route($route_prefix.'store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('transaction::admin.includes.form-left')
        </div>
        <div class="col-12 col-lg-4">
            @include('transaction::admin.includes.form-right')
        </div>
    </div>
</form>
<!--end row-->
@endsection