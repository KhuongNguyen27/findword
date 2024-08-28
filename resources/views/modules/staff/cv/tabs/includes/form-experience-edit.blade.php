<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-lg-12 col-md-12">
                <label>Thứ tự</label>
                <input type="number" name="numerical" value="{{ $experience->numerical }}">
                <div class="input-error text-danger">@error('numerical') {{ $message }} @enderror</div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group input-start_date-update">
                    <label class="required">Thời gian bắt đầu</label>
                    <input class="form-control" name="start_date" type="date" value="{{ $experience->start_date }}">
                    <div class="input-error text-danger">@error('start_date') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group input-end_date-update">
                    <label for="WorkTo">Thời gian kết thúc</label>
                    <input class="form-control" name="end_date" type="date" value="{{ $experience->end_date }}">
                    <div class="input-error text-danger">@error('end_date') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="form-group input-company-update col-12">
                <label>Công ty</label>
                <input type="text" name="company" value="{{ old('company', $experience->company ?? '') }}">
                <div class="input-error text-danger">@error('company') {{ $message }} @enderror</div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" name="is_current" type="checkbox" value="1" @checked( $experience &&
                        $experience->is_current == 1 )>
                    <label class="form-check-sign" for="chk-0">Đang làm ở đây?</label>
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
                    <option value="{{ $rank->id }}"
                        {{ $experience && $experience->rank_id == $rank->id ? 'selected' : '' }}>
                        {{ $rank->name }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group input-position-update col-12">
                <label>Vị trí chức danh</label>
                <input type="text" name="position" value="{{ $experience->position }}">
                <div class="input-error text-danger">@error('company') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="form-group input-job_description-update col-12">
            <label>Mô tả công việc</label>
            <input type="text" name="job_description" value="{{ $experience->job_description }}">
            <div class="input-error text-danger">@error('job_description') {{ $message }} @enderror</div>
        </div>

    </div>
</div>
<div class="text-right" style="display: flex; align-items: center;">
    <button class="btn btn-primary ms-auto experience-update" type="button" style="margin-top: 20px;">
        <i class="far fa-save"></i> Cập nhật
    </button>
</div>