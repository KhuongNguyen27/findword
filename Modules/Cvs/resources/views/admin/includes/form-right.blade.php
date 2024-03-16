<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.cvs.index') }}" class="btn btn-danger px-4">Back</a>
            <button type="submit" class="btn btn-primary px-4">Save</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="text-uppercase fw-bold">Tệp đính kèm Cv</div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Ảnh Cv</label>
            <input type="file" name="image" class="form-control">
            <x-admintheme::form-input-error field="image" />
        </div>
        <div class="mb-4">
            <label class="mb-3">File Cv mẫu</label>
            <input type="file" name="file_cv" class="form-control">
            <x-admintheme::form-input-error field="file_cv" />
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>