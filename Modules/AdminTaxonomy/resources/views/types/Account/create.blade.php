@extends('admintaxonomy::create')
@section('custom-fields-left')

@endsection

    @section('custom-fields-right')
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