<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-lg-6 col-md-12">
                <label>Thứ tự</label>
                <input type="number" name="numerical" value="{{ old('numerical', $education->numerical ?? '') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('numerical') }}</p>
                @endif
            </div>
            <div class="form-group col-lg-6 col-md-12">
            <label for="rank_id">Trình độ</label>
                <select name="rank_id" class="form-control">
                    @foreach ($ranks as $rank)
                    <option value="{{ $rank->id }}" {{ $item->rank_id == $rank->id ? 'selected' : '' }}>
                        {{ $rank->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="required">Ngày nhận bằng / Ngày tốt nghiệp</label>
                    <input class="form-control" name="graduation_date" type="date"
                    value="{{ old('graduation_date', $education->graduation_date ?? '') }}">
                    @if ($errors->any())
                    <p style="color:red">{{ $errors->first('graduation_date') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group col-lg-6 col-md-12">
                <label>Ngoại ngữ</label>
                <select name="language" class="form-control">
                    <option @selected(!empty($education->language) && $education->language == '1') value="1">Anh
                    </option>
                    <option @selected(!empty($education->language) && $education->language == '2') value="2">Pháp
                    </option>
                    <option @selected(!empty($education->language) && $education->language == '3') value="3">Hàn
                    </option>
                    <option @selected(!empty($education->language) && $education->language == '4') value="4">Nhật
                    </option>
                    <option @selected(!empty($education->language) && $education->language == '6') value="6">Khác
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-12">
                <label>Trường / Khóa học</label>
                <input type="text" name="school_course"  value="{{ old('school_course', $education->school_course ?? '') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('school_course') }}</p>
                @endif
            </div>
            <div class="form-group col-12">
                <label>Ngành / Chuyên ngành</label>
                <input type="text" name="major"  value="{{ old('major', $education->major ?? '') }}">
                @if ($errors->any())
                <p style="color:red">{{ $errors->first('major') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="text-right"><button class="btn btn-primary ms-auto" type="submit" style="margin-top: 20px;">
        <i class="fas fa-plus"></i> Lưu </button></div>