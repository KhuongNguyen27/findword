@extends('adminuser::edit')

@section('custom-fields-left')
    @include('adminuser::types.staff.includes.form-left')
@endsection

@section('custom-fields-right')
    @include('adminuser::types.staff.includes.form-right')
@endsection