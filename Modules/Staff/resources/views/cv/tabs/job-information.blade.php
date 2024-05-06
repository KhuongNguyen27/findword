<div class="ls-widget">
    <div class="tabs-box">
        <div class="widget-title">
            <h4>Thông tin công việc</h4>
        </div>

        <div class="widget-content">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form class="default-form" method="POST" action="{{ route('staff.cv.update',['cv'=>$cv_id,'tab'=>$tab]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="tab" value="{{ request()->tab }}">
                <div class="row">
                    <!-- Thông tin cá nhân -->
                    <div class="form-group col-lg-6 col-md-12">
                        <label>
                            Tên CV
                            <span class="label-required" > *</span>
                        </label>
                        <input type="text" name="cv_file" value="{{ old('cv_file') ?? $item->cv_file }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('cv_file') }}</p>
                        @endif
                    </div>
                    <!-- Thông tin công việc -->

                    <div class="form-group col-lg-6 col-md-12">
                        <label>
                            Nhập vị trí muốn ứng tuyển
                            <span class="label-required" > *</span>
                        </label>
                        <input type="text" name="desired_position"
                            value="{{ old('desired_position') ?? $item->desired_position }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('desired_position') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                        <label for="rank_id">Cấp bậc mong muốn</label>
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
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="form_work_id">Loại hình làm việc</label>
                        <select name="form_work_id" class="form-control">
                            @foreach ($formWorks as $formWork)
                            <option value="{{ $formWork->id }}"
                                {{ $item->form_work_id == $formWork->id ? 'selected' : '' }}>
                                {{ $formWork->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('form_work_id') }}</p>
                        @endif
                    </div>

                    <!-- <div class="form-group col-lg-6 col-md-12">
                        <label>Ngành nghề</label>
                        <select name="industry[]" class="chosen-select js-example-basic-multiple" id=""
                            multiple="multiple">
                            <option value="1">Xây dựng</option>
                            <option value="2">Nhà hàng</option>
                            <option value="2">May mặc</option>
                        </select>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('industry') }}</p>
                        @endif
                    </div> -->
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="career_id">Ngành nghề</label>
                        <select name="career_id" class="form-control">
                            @foreach ($careers as $career)
                            <option value="{{ $career->id }}" {{ $item->career_id == $career->id ? 'selected' : '' }}>
                                {{ $career->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('career_id') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                        <label>
                            Nơi làm việc mong muốn
                            <span class="label-required" > *</span>
                        </label>
                        <input type="text" name="desired_location"
                            value="{{ old('desired_location') ?? $item->desired_location }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('desired_location') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                        <label>Mức lương mong muốn</label>
                        <select name="wage_id" class="form-control">
                            @foreach ($wages as $wage)
                            <option value="{{ $wage->id }}" {{ $item->wage_id == $wage->id ? 'selected' : '' }}>
                                {{ $wage->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('desired_salary') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                        <label>
                            Mục tiêu nghề nghiệp
                            <span class="label-required" > *</span>
                        </label>
                        <input type="text" name="career_objective"
                            value="{{ old('career_objective') ?? $item->career_objective }}">
                        @if ($errors->any())
                        <p style="color:red">{{ $errors->first('career_objective') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                        <button class="theme-btn btn-style-one"> {{__('save')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>