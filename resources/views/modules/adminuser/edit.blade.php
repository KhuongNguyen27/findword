@extends('admintheme::layouts.master')
@section('content')
    @include('admintheme::includes.globals.breadcrumb',[
        'page_title' => 'Cập nhật tài khoản'
    ])
    <form action="{{ route('adminuser.update',$item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{ request()->type ?? $item->type }}">
        <div class="row">
            <div class="col-12 col-lg-8">
                @include('adminuser::includes.form-left')
            </div>
            <div class="col-12 col-lg-4">
                @include('adminuser::includes.form-right')
            </div>
        </div>
    </div>
</form>
<!--end row-->
@endsection