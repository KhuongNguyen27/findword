{{-- @if($upload)
<input class="form-control" name="{{ $name }}" type="file" accept="{{ $accept }}">
@endif --}}
@if($imageUrl)
<div class="card mt-2">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <img src="{{ $imageUrl }}" class="card-img" style="width: 200px; height: 200px;">
        </div>
    </div>
</div>
@endif