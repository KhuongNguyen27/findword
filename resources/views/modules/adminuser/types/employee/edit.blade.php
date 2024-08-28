@extends('adminuser::edit')

@section('custom-fields-left')
    @include('adminuser::types.employee.includes.form-left')
@endsection

@section('custom-fields-right')
    @include('adminuser::types.employee.includes.form-right')
@endsection