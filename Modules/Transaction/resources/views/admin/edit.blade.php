<div class="modal fade" id="modalUpdate" style="display: none;" aria-hidden="true">
    <form id="formUpdate" action="{{ route($route_prefix.'update',$item->id) }}" method="post"
        enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-centered" role="document">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác minh giao dịch</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <select class="form-control" name="status">
                        <option value="0">INACTIVE</option>
                        <option value="1">ACTIVE</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Cập nhập</button>
                </div>
            </div>
        </div>
    </form>
</div>