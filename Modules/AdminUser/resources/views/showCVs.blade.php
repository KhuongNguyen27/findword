@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => __('cv_list'),
'actions' => [
//'add_new' => route($route_prefix.'create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])

<!-- Item actions -->
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('name') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if( count( $items ) )
                    @foreach( $items as $item )
                    <tr>
                        <td>{{ $item->cv_file }}</td>
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
                                        <a class="dropdown-item"
                                            href="{{ route($route_prefix.'showCV',['id' => $item->id, 'type'=>'UserCV']) }}">
                                            {{ __('detail') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">{{ __('no_item_found') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @if( count( $items ) )
    <div class="card-footer pb-0">
        @include('admintheme::includes.globals.pagination')
    </div>
    @endif
</div>

@endsection