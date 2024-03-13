@extends('admintheme::layouts.master')
@section('content')
<!-- Item actions -->
<form action="{{ route($route_prefix.'index') }}" method="get">
    <div class="row">
        <div class="col col-xs-6">
            <input class="form-control" name="" type="text" placeholder="Mã giao dịch" value="{{ request()->name }}">
        </div>
        <div class="col col-xs-6">
            <x-admintheme::form-status model="{{ $model }}" status="{{ request()->status }}" showAll="1" />
        </div>
        <div class="col col-xs-6">
            <x-admintheme::form-user type="employee" user_id="{{ request()->user_id }}" />
        </div>
        <div class="col col-xs-6">
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
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Mục đích</th>
                            <th>Mức nạp</th>
                            <th>Trạng thái</th>
                            <th>{{ __('adminpost::table.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                {{ $item->user->name ?? '' }}
                            </td>
                            <td>{{ $item->type  ?? '' }}</td>
                            <td>{{ number_format($item->amount, 2, ',', '.') }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item show-form-edit" href="javascript:;"
                                                data-id="{{ $item->id }}"
                                                data-action="{{ route($route_prefix.'show',$item->id) }}">
                                                {{ __('sys.edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route($route_prefix.'destroy',['id'=>$item->id,'type'=>request()->type]) }}"
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
    @include('transaction::admin.edit')
    @if( count( $items ) )
    <div class="card-footer pb-0">
        @include('admintheme::includes.globals.pagination')
    </div>
    @endif
</div>
@endsection
@section('footer')
<script>
jQuery(document).ready(function() {
    jQuery('body').on('click', ".show-form-edit", function(e) {
        // Hien thi modal
        jQuery('#modalUpdate').modal('show');
        let formUpdate = jQuery('#formUpdate');
        let action = jQuery(this).data('action');
        jQuery.ajax({
            url: action,
            type: "GET",
            success: function(res) {
                if (res.success) {
                    console.log(res.data);
                    let formData = res.data;
                    // Bắt giá trị của input radio "status"
                    let status = formData.status;
                    formUpdate.find('input[name="status"][value="' + status + '"]').prop(
                        'checked', true);
                }
            }
        });
    });
    jQuery('body').on('click', "button.close", function(e) {
        jQuery('#modalUpdate').modal('hide');
    });
});
</script>
@endsection