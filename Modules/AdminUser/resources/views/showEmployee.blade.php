@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Chi tiết CV',
'actions' => [
//'add_new' => route($route_prefix.'create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])

<!-- Item actions -->
<div class="row">

    <div class="card mt-4 col-6">
        <div class="card-body">
            <div class="product-table">
                <table class="table align-middle table-borderless">
                    <tbody class="table-light">
                        <div class="row">
                            <tr class="col-6">
                                <th>Tên</th>
                                <th>Email:</th>
                            </tr>
                            <tr class="col-6">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr class="col-6">
                                <th>Số điện thoại:</th>
                                <th>Tên công ty:</th>
                            </tr>
                            <tr class="col-6">
                                <td>{{ $item->employee->phone }}</td>
                                <td>{{ $item->employee->name }}</td>
                            </tr>
                            <tr class="col-6">
                                <th>Địa chỉ công ty:</th>
                                <th>Website công ty:</th>
                            </tr>
                            <tr class="col-6">
                                <td>{{ $item->employee->address }}</td>
                                <td>{{ $item->employee->website }}</td>
                            </tr>
                            <tr class="col-6">
                                <th>Mô tả:</th>
                            </tr>
                            <tr class="col-6">
                                <td>{!! $item->employee->about !!}</td>
                            </tr>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 mt-4">
        @include('adminuser::includes.form-right-show')
    </div>
</div>



@endsection