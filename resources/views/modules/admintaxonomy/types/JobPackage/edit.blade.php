@extends('admintaxonomy::edit')
@section('custom-fields-left')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-4">
                    <label class="mb-3">[Danh sách] Màu viền logo</label>
                    <input type="color" class="form-control" name="job_small_logo_border_color" value="{{ $item->job_small_logo_border_color ?? old('price') }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label class="mb-3">[Danh sách] Màu viền tin</label>
                    <input type="color" class="form-control" name="job_small_box_border_color" value="{{ $item->job_small_box_border_color ?? old('price') }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label class="mb-3">[Danh sách] Màu tiêu đề tin</label>
                    <input type="color" class="form-control" name="job_small_title_color" value="{{ $item->job_small_title_color ?? old('price') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <label class="mb-3">[Chi tiết] Màu nền header</label>
                    <input type="color" class="form-control" name="job_detail_header_bg" value="{{ $item->job_detail_header_bg ?? old('job_detail_header_bg') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-4">
                    <label class="mb-3">[Chi tiết] Màu nền công ty</label>
                    <input type="color" class="form-control" name="job_detail_company_bg" value="{{ $item->job_detail_company_bg ?? old('job_detail_company_bg') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-fields-right')
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Giá</label>
            <input type="text" class="form-control" name="price" value="{{ $item->price ?? old('price') }}">
            <x-admintheme::form-input-error field="price"/>
        </div>
        <div class="mb-4">
            <label class="mb-3">Tự động duyệt</label>
            <input type="hidden" name="auto_approve" value="0">
            <input type="checkbox" value="1" name="auto_approve" class="form-checkbox" id="nameInput" @checked(@$item->auto_approve == 1)>
            <x-admintheme::form-input-error field="auto_approve" />
        </div>
    </div>
</div>
@endsection