@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Danh sách người dùng',
'actions' => [
'add_new' => route($route_prefix.'create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])

<!-- Item actions -->
<form action="{{ route($route_prefix.'index') }}" method="get">
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row">
        <div class="col">
            <input class="form-control" name="name" type="text" placeholder="Tên" value="{{ request()->name }}">
        </div>
        <div class="col">
            <input class="form-control" name="email" type="text" placeholder="Email" value="{{ request()->email }}">
        </div>
        <div class="col">
            <x-admintheme::form-status model="{{ $model }}" status="{{ request()->status }}" showAll="1" />
        </div>
        <div class="col">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button class="btn btn-light px-4"><i class="bi bi-box-arrow-right me-2"></i>Tìm</button>
            </div>
        </div>
    </div>
</form>

<div class="card mt-4">
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('name') }}</th>
                            <th>Email</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('created_at') }}</th>
                            <th>{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>{{ $item->created_at_fm }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route($route_prefix.'edit',['adminuser' => $item->id, 'type'=>request()->type]) }}">
                                                {{ __('sys.edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route($route_prefix.'destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick=" return confirm('{{ __('sys.confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('sys.delete') }}
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route($route_prefix.'showCVs',['id' => $item->id, 'type'=>request()->type]) }}">
                                                Show CV
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


git add Modules/AdminTaxonomy/resources/views/includes/form-left.blade.php
git add Modules/AdminUser/app/Http/Controllers/AdminUserController.php
git add Modules/AdminUser/app/Http/Requests/StoreAdminUserRequest.php
git add Modules/AdminUser/app/Models/AdminUser.php
git add Modules/AdminUser/resources/views/includes/form-right-show.blade.php
git add Modules/AdminUser/resources/views/includes/form-right.blade.php
git add Modules/AdminUser/resources/views/index.blade.php
git add Modules/AdminUser/resources/views/showCV.blade.php
git add Modules/AdminUser/resources/views/showCVs.blade.php
git add Modules/AdminUser/resources/views/types/employee/includes/form-left.blade.php
git add Modules/AdminUser/resources/views/types/employee/index.blade.php
git add Modules/AdminUser/resources/views/types/staff/index.blade.php
git add app/Models/UserEmployee.php
git add Modules/AdminUser/resources/views/showEmployee.blade.php
git add Modules/AdminUser/resources/views/showStaff.blade.php
git add Modules/AdminUser/resources/views/types/employee/show.blade.php     