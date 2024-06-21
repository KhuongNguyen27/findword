@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Danh sách ứng viên',
'actions' => [
'add_new' => route($route_prefix.'create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])

<!-- Item actions -->
<form action="{{ route($route_prefix.'index') }}" method="get">
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col col-xs-6">
            <input class="form-control" name="name" type="text" placeholder="Tên" value="{{ request()->name }}">
        </div>
        <div class="col col-xs-6">
            <input class="form-control" name="email" type="text" placeholder="Email" value="{{ request()->email }}">
        </div>
        <div class="col col-xs-6">
            <input class="form-control" name="phone" type="text" placeholder="Số điện thoại" value="{{ request()->phone }}">
        </div>
        <div class="col col-xs-6">
            <input class="form-control" name="address" type="text" placeholder="Địa chỉ" value="{{ request()->address }}">
        </div>
        <div class="col col-xs-6">
            <x-admintheme::form-status model="{{ $model }}" status="{{ request()->status }}" showAll="1" />
        </div>
        <div class="col col-xs-6">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button class="btn btn-light px-4"><i class="bi bi-box-arrow-right me-2"></i>{{ __('search') }}</button>
            </div>
        </div>
    </div>
</form>

<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('code') }}</th>
                            <th>{{ __('name') }}</th>
                            <th>{{__('email')}}</th>
                            <th>{{ __('position') }}</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('created_at') }}</th>
                            <th>{{ __('las_login') }}</th>
                            <th>{{ __('Xác thực') }}</th>
                            <th>{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}
                            <p class="mb-0 product-category">{{ $item->staff->phone ?? '' }}</p>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>{{ $item->created_at_fm }}</td>
                            <td>{{ $item->last_login ? date('H:i:s d-m-Y', strtotime($item->last_login)) : '' }}</td> 
                            <td>{!! $item->email_status_fm !!}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route($route_prefix.'edit',['adminuser' => $item->id, 'type'=>request()->type]) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route($route_prefix.'destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick=" return confirm('{{ __('sys.confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route($route_prefix.'showCVs',['id' => $item->id, 'type'=>request()->type]) }}">
                                                {{ __('show') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">{{ __('sys.no_item_found') }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if( count( $items ) )
    <div class="card-footer pb-0">
        @include('admintheme::includes.globals.pagination')
    </div>
    @endif
</div>

@endsection