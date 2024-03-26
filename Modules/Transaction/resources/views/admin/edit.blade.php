<div class="modal fade" id="modalUpdate" style="display: none;" aria-hidden="true">
    <form id="formUpdate" action="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-centered" role="document">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác minh giao dịch</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-4 input-name-update">
                        <label for="name">{{ __('name')  }}</label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group mt-4 input-type-update">
                        <label for="type">{{ __('purpose')  }}</label>
                        <select name="" class="form-control">
                            <option value="" checked>Nạp tiền</option>
                        </select>
                    </div>
                    <div class="form-group mt-4 input-amount-update">
                        <label for="amount">{{ __('recharge_level')  }}</label>
                        <input type="text" name="amount" class="form-control">
                    </div>
                    <div class="form-group mt-4 input-status-update">
                        <label for="status">{{ __('status') }}</label>
                        <select class="form-control" name="status">
                            <option value="0" checked>{{__('sys.inactive')}}</option>
                            <option value="1">{{__('sys.active')}}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Cập nhập</button>
                </div>
            </div>
        </div>
    </form>
</div>