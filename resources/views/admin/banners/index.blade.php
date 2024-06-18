@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Banner',
'actions' => [
'add_new' => route('banners.create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])
<style>
.product-table .product-box img {
    width: 117px;
    height: 55px;
    border-radius: 0.25rem;
}
</style>
<!-- Item actions -->
<form action="{{ route('banners.index') }}" method="get">
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row g-3">
        <div class="col-auto flex-grow-1">
            <div class="position-relative">
                <input class="form-control" name="name" type="text" placeholder="{{ __('sys.search_name') }}"
                    value="{{ request()->name }}">
            </div>
        </div>
        
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button class="btn btn-light px-4"><i class="bi bi-box-arrow-right me-2"></i>Search</button>
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
                            <th>
                                <input class="form-check-input" type="checkbox">
                            </th>
                            <th>{{ __('adminpost::table.name') }}</th>
                            <th>{{ __('adminpost::table.image') }}</th>
                            <th>{{ __('Link') }}</th>
                            <th>{{ __('Position') }}</th>
                            <th>{{ __('Group') }}</th>
                            <th>{{ __('adminpost::table.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox">
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                 
                                    <div class="product-info">
                                        <a href="javascript:;" class="product-title">{{ $item->name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box">
                                        <img src="{{ $item->image_fm }}" alt="">
                                    </div>
                                </div>
                            </td>
                            <!-- <td>
                                
                                        <img src="{{ $item->image_fm }}" alt="">
                                 
                                </div>
                            </td> -->
                          <td>{{$item->link}}</td>
                          <td>{{$item->position}}</td>
                          <td>{{$item->group_banner}}</td>
                          <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('banners.edit',['banner' => $item->id]) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('banners.destroy', ['banner' => $item->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick=" return confirm('{{ __('sys.confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('sys.delete') }}
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