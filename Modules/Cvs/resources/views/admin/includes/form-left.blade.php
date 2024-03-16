<div class="card">
    <div class="card-header">
        <div class="text-uppercase fw-bold">Thông tin CV mẫu</div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">Tên CV</label>
            <input type="text" value="{{ old('name') ?? '' }}" name="name" placeholder="Tên CV mẫu"
                class="form-control">
            @if ($errors->any())
            <p style="color:red">
                {{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="mb-3">Ngành nghề</label>
            <select name="career_ids[]" class="form-control" multiple="multiple">
                <option value="" {{ (old('career_ids')) === 'null'? 'selected' : '' }}>Giữ Ctrl
                    để chọn nhiều ngành nghề</option>
                @foreach ($careers as $career)
                <option {{ (old('career_ids') !== null && in_array($career->id, old('career_ids'))) ? 'selected' : '' }}
                    value="{{ $career->id }}">
                    {{ $career->name }}
                </option>
                @endforeach
            </select>
            @if ($errors->any())
            <p style="color:red">
                {{ $errors->first('career_ids') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="mb-3">Thiết kế</label>
            <select name="style_ids[]" class="form-control" multiple="multiple">
                <option value="" {{ (old('style_ids')) === 'null'? 'selected' : '' }}>Giữ Ctrl
                    để chọn nhiều thiết kế</option>
                @foreach ($styles as $style)
                <option {{ (old('style_ids') !== null && in_array($style->id, old('style_ids'))) ? 'selected' : '' }}
                    value="{{ $style->id }}">
                    {{ $style->name }}
                </option>
                @endforeach
            </select>
            @if ($errors->any())
            <p style="color:red">
                {{ $errors->first('style_ids') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="mb-3">Ngôn ngữ</label>
            <select name="language" class="form-control">
                <option value="" {{ old('language') === 'null' ? 'selected' : ''}}>Chọn ngôn ngữ sử dụng</option>
                <option value="TiengViet" {{ old('language')=="TiengViet"? 'selected' : '' }}>Tiếng Việt</option>
                <option value="TiengAnh" {{ old('language')=="TiengAnh"? 'selected' : '' }}>Tiếng Anh</option>
                <option value="TiengNhat" {{ old('language')=="TiengNhat"? 'selected' : '' }}>Tiếng Nhật</option>
            </select>
            @if ($errors->any())
            <p style="color:red">
                {{ $errors->first('language') }}</p>
            @endif
        </div>
    </div>
</div>