@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => "Danh sách giao dịch",
'actions' => ['add_new' => route($route_prefix.'create')]
])
<!-- Item actions -->
<form action="{{ route($route_prefix.'index') }}" method="get">
    <div class="row">
        <div class="col col-xs-6">
            <input class="form-control" name="id" type="text" placeholder="{{ __('transaction_code') }}"
                value="{{ request()->id }}">
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
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('code') }}</th>
                            <th>{{ __('name') }}</th>
                            <th>{{__('purpose')}}</th>
                            <th>{{ __('recharge_level') }}</th>
                            <th>Thời gian</th>
                            <th>{{ __('status') }}</th>
                            <th>{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count( $items ) )
                        @foreach( $items as $item )
                        <tr>
                            <td>FW{{ $item->user_id }}</td>
                            <td>
                                {{ $item->user->name ?? '' }}
                            </td>
                            <td>{{ $item->type  ?? '' }}</td>
                            <td>{{ number_format($item->amount, 0, '', '.') }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>
                                @if($item->status == $item::INACTIVE)
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item show-form-edit" href="javascript:;"
                                                data-id="{{ $item->id }}"
                                                data-action="{{ route($route_prefix.'update',$item->id) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route($route_prefix.'destroy',$item->id) }}" method="get">
                                                @csrf
                                                <button onclick=" return confirm('{{ __('confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif
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
                    let formData = res.data;
                    // Bắt giá trị của input radio "status"
                    console.log(res.data);
                    let status = formData.status;
                    formUpdate.prop('action', action);
                    formUpdate.find('.input-name-update input').val(formData.user_id);
                    formUpdate.find('.input-amount-update input').val(formData.amount);
                    formUpdate.find('input[name="status"][value="' + status + '"]').prop(
                        'checked', true);
                }
            }
        });
    });
    jQuery('body').on('click', "button.close", function(e) {
        jQuery('#modalUpdate').modal('hide');
    });
    // jQuery('body').on('click', ".edit-item", function(e) {
    //     let formUpdate = jQuery(this).closest('#formUpdate');
    //     formUpdate.find('.input-error').empty();
    //     var url = formUpdate.prop('action');
    //     let formData = new FormData($('#formUpdate')[0]);
    //     jQuery.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: url,
    //         type: "POST",
    //         processData: false,
    //         contentType: false,
    //         data: formData,
    //         success: function(res) {
    //             if (res.has_errors) {
    //                 for (const key in res.errors) {
    //                     jQuery('.input-' + key).find('.input-error').html(res.errors[key][
    //                         0
    //                     ]);
    //                 }
    //             }
    //             if (res.success) {
    //                 // Disable modal
    //                 jQuery('#modalUpdate').modal('hide');
    //                 // Recall items
    //                 getAjaxTable(indexUrl, wrapperResults, positionUrl, params);
    //             }

    //         }
    //     });
    // });
});
</script>
@endsection