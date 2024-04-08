@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => __('post'),
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
            <input class="form-control" name="name" type="text" placeholder="Tên công việc"
                value="{{ request()->name }}">
        </div>
        <div class="col col-xs-6">
            <select name="jobpackage_id" class="form-control">
                <option value="">{{ __('package') }}</option>
                @foreach( \App\Models\JobPackage::all() as $job_package )
                <option @selected( request()->jobpackage_id == $job_package->id ) value="{{  $job_package->id }}">{{  $job_package->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-xs-6">
            <x-admintheme::form-status model="{{ $model }}" status="{{ request()->status }}" showAll="1" />
        </div>
        <div class="col col-xs-6">
            <x-admintheme::form-user type="employee" user_id="{{ request()->user_id }}" />
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
                            <th>{{ __('position') }}</th>
                            <th>{{ __('package') }}</th>
                            <th>{{ __('start') }}</th>
                            <th>{{ __('end') }}</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                {{ $item->name }}
                                <p class="mb-0 product-category">{{ $item->user->name ?? '' }}</p>
                            </td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->job_package->name  ?? '' }}</td>
                            <td>{{ $item->start_day }}</td>
                            <td>{{ $item->end_day }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route($route_prefix.'edit',['adminpost'=>$item->id,'type'=>request()->type]) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route($route_prefix.'destroy',['adminpost'=>$item->id,'type'=>request()->type]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick=" return confirm('{{ __('sys.confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
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