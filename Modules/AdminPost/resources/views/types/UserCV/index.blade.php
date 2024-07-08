@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Hồ sơ',
'actions' => [
'add_new' => route($route_prefix.'create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])
<style>
.form-check-input {
    width: 1.5em;
    height: 1.5em;
}
</style>
<!-- Item actions -->
<form action="{{ route($route_prefix.'index') }}" method="get">
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row g-3">
        <div class="col-auto flex-grow-1">
            <div class="position-relative">
                <input class="form-control" name="name" type="text" placeholder="{{ __('sys.search_name') }}"
                    value="{{ request()->name }}">
            </div>
        </div>
        <div class="col-auto">
            <x-admintheme::form-status model="{{ $model }}" status="{{ request()->status }}" showAll="1" />
        </div>
        <div class="col-auto">
            <x-admintheme::form-user type="" user_id="{{ request()->user_id }}" />
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
                            <!-- <th>
                                <input class="form-check-input" type="checkbox">
                            </th> -->
                            <th>{{ __('adminpost::table.name') }}</th>
                            <th>CV đã tải / lưu</th>
                            <th>Tổng CV</th>
                            <th>{{ __('adminpost::table.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr data-item-id="{{ $item->id }}">
                        <!-- <td>
                                <input class="form-check-input" type="checkbox">
                            </td> -->
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                 
                                    <div class="product-info">
                                        <a href="javascript:;" class="product-title">{{ $item->name }}</a>
                                        <p class="mb-0 product-category">{{ $item->user_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input class="form-check-input" type="checkbox">
                            </td>
                            <td>{{ $item->user_c_vs_count }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                       <li>
                                            <a class="dropdown-item" href="{{ route('user_cvs', ['user_id' => $item->id, 'type' => 'UserCV']) }}">
                                                {{ __('show') }}
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.form-check-input');

        // Load saved checkbox state from local storage
        checkboxes.forEach(checkbox => {
            const itemId = checkbox.closest('tr').dataset.itemId; // Lấy id của mục từ dataset của dòng tr
            const isChecked = localStorage.getItem(itemId) === 'true';
            checkbox.checked = isChecked;
        });

        // Save checkbox state to local storage on change
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const itemId = checkbox.closest('tr').dataset.itemId; // Lấy id của mục từ dataset của dòng tr
                localStorage.setItem(itemId, this.checked);
            });
        });
    });
</script>
@endsection