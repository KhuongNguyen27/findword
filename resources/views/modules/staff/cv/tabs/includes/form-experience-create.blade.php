<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-lg-12 col-md-12">
                <label>Thứ tự</label>
                <input type="number" name="numerical" value="{{ old('numerical', $experience->numerical ?? '') }}">
                @if ($errors->any())
                    <p style="color:red">{{ $errors->first('numerical') }}</p>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="required">Thời gian bắt đầu</label>
                    <input class="form-control" name="start_date" type="date"
                        value="{{ old('start_date', $experience->start_date ?? '') }}">
                    @if ($errors->any())
                        <p style="color:red">{{ $errors->first('start_date') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="WorkTo">Thời gian kết thúc</label>
                    <input class="form-control" name="end_date" type="date"
                        value="{{ $experience->end_date ?? old('end_date') }}">
                    @if ($errors->any())
                        <p style="color:red">{{ $errors->first('end_date') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-group col-12">
                <label>Công ty</label>
                <input type="text" name="company" value="{{ old('company', $experience->company ?? '') }}">
                @if ($errors->any())
                    <p style="color:red">{{ $errors->first('company') }}</p>
                @endif
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-check">
                    <label class="form-check-sign" for="chk-0">Đang làm ở đây?</label>
                    <input type="hidden" name="is_current" value="0">
                    <input class="form-check-input" name="is_current" type="checkbox" value="1"
                        @checked($experience && $experience->is_current == 1)>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-12">
                <label for="rank_id">Trình độ</label>
                <select name="rank_id" class="form-control">
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}" {{ $item->rank_id == $rank->id ? 'selected' : '' }}>
                            {{ $rank->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->any())
                    <p style="color:red">{{ $errors->first('rank_id') }}</p>
                @endif
            </div>
            <div class="form-group col-12">
                <label>Vị trí chức danh</label>
                <input type="text" name="position" value="{{ old('position', $experience->position ?? '') }}">
                @if ($errors->any())
                    <p style="color:red">{{ $errors->first('position') }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label>Mô tả công việc</label>
                <input type="text" name="job_description"
                    value="{{ old('job_description', $experience->job_description ?? '') }}">
                @if ($errors->any())
                    <p style="color:red">{{ $errors->first('job_description') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="text-right">
    <button class="btn btn-primary ms-auto mt-2" type="submit">
        <i class="fas fa-plus"></i> Lưu
    </button>
</div>
