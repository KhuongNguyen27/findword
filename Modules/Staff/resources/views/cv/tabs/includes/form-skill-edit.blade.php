<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-lg-6 col-md-12">
                <label>Thứ tự</label>
                <input type="number" name="numerical" value="{{ $skill->numerical }}">
                @if ($errors->any())
                <!-- <p style="color:red">{{ $errors->first('numerical') }}</p> -->
                @endif
            </div>
            <div class="form-group col-12">
                <label for="skill_level">Cấp độ kỹ năng</label>
                <input type="range" id="skill_level_{{ $skill->id }}" name="skill_level"
                    class="form-control-range range-value" data-val="true"
                    data-val-range="The field Skill Level must be between 1 and 100." data-val-range-max="100"
                    data-val-range-min="1" data-val-required="Vui lòng chọn mức độ kỹ năng"
                    value="{{ $skill->skill_level }}">
                <small class="form-text text-muted">
                    <span class="field-validation-valid" data-valmsg-for="skill_level"
                        data-valmsg-replace="true"></span>
                </small>
                <small class="range-text" id="skill_level_display_{{ $skill->id }}"> {{ $skill->skill_level }} %
                </small>
            </div>
            <script>
            // Add script to update the displayed percentage dynamically
            document.addEventListener('DOMContentLoaded', function() {
                const skillLevelInput = document.getElementById('skill_level_{{ $skill->id }}');
                const skillLevelDisplay = document.getElementById('skill_level_display_{{ $skill->id }}');
                // Initial update
                skillLevelDisplay.textContent = skillLevelInput.value + ' %';
                // Update dynamically as the slider is moved
                skillLevelInput.addEventListener('input', function() {
                    skillLevelDisplay.textContent = this.value + ' %';
                });
            });
            </script>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="form-group col-12">
                <label>Kĩ năng đặc biệt</label>
                <input type="text" name="special_skill" value="{{ $skill->special_skill }}">
                @if ($errors->any())
                <!-- <p style="color:red">{{ $errors->first('special_skill') }}</p> -->
                @endif
            </div>
            <div class="form-group col-12">
                <label>Mô tả</label>
                <textarea name="description" rows="3">{{ old('description', $skill->description ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="text-right" style="display: flex; align-items: center;">
    <button class="btn btn-primary ms-auto" type="submit" style="margin-top: 20px;">
        <i class="far fa-save"></i>Cập nhật
    </button>
</div>

