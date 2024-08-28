@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
        'page_title' => __('account_jobpackge_edit')
    ])
<form action="{{ route('admintaxonomy.update',$item->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('admintaxonomy::includes.form-left')
        </div>
        <div class="col-12 col-lg-4">
            @include('admintaxonomy::includes.form-right')
        </div>
    </div>
</form>
<style>
    #image-wrapper {
        display: none !important;
    }
    #status-wrapper{
        display: none !important;
    }
    #salary_min_wrapper{
        display: none !important;
    }
    #salary_max_wrapper{
        display: none !important;
    }
</style>
@endsection