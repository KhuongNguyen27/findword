@extends('admintaxonomy::edit')
@section('custom-fields-left')
<div class="card">
    <div class="card-body">
        <table class="table">
            @foreach( \App\Models\JobPackage::all() as $job_package )
            <tr>
                <td>{{ $job_package->name }}</td>
                <td><input type="text" class="form-control" 
                name="job_package_ids[{{ $job_package->id }}]" 
                value="{{ $item->setting_job_packages[$job_package->id] }}"></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

@section('custom-fields-right')
   
<style>
    #form-right-wrapper{
        display: none!important;
    }
        #salary_min_wrapper{
            display: none !important;
        }
        #salary_max_wrapper{
            display: none !important;
        }
    </style>
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{__('price')}}</label>
            <input type="text" class="form-control" name="price" value="{{ $item->price ?? old('price') }}">
            <x-admintheme::form-input-error field="price"/>
        </div>
    </div>
</div>
@endsection