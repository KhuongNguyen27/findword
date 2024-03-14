@extends('staff::dashboards.layouts.dashboard')
@section('content')
    <!-- Dashboard -->

    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Thông tin cá nhân!</h3>
                <!-- <div class="text">Ready to jump back in?</div> -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Thông tin của tôi</h4>
                            </div>

                            <div class="widget-content">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form class="default-form" method="POST" action="{{ route('staff.update', $item->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <span><strong>Tải lên logo</strong></span>
                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <input class="uploadButton-input" type="file" name="image"
                                                accept="image/*, application/pdf" id="upload" multiple>
                                            <label class="uploadButton-button ripple-effect" for="upload">Browse
                                                Logo</label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="image-preview"></div>
                                        <div class="new-image-preview">
                                            <?php if ($item->image):?>
                                            <img src="<?php echo asset($item->image); ?>" alt="Preview Image"
                                                style="max-width: 150px; max-height: 120px;">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Họ và tên</label>
                                            <input type="text" name="name" value="{{ $item->user->name }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Email</label>
                                            <input type="text" name="email" value="{{ $item->user->email }}"
                                                placeholder="creativelayers">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="phone" value="{{ $item->phone }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Năm Sinh</label>
                                            <input type="date" name="birthdate" value="{{ $item->birthdate }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('birthdate') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Số năm kinh nghiệm</label>
                                            <input type="number" name="experience_years"
                                                value="{{ $item->experience_years }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('experience_years') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Giới tính</label>
                                            <select name="gender" class="form-control">
                                                <option value="nam" {{ $item->gender == 'nam' ? 'selected' : '' }}>Nam
                                                </option>
                                                <option value="nu" {{ $item->gender == 'nu' ? 'selected' : '' }}>Nữ
                                                </option>
                                                <option value="khac" {{ $item->gender == 'khac' ? 'selected' : '' }}>Khác
                                                </option>
                                            </select>
                                        </div>


                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Tỉnh\Thành phố</label>
                                            <input type="text" name="city" value="{{ $item->city }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('city') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Địa chỉ</label>
                                            <input type="text" name="address" value="{{ $item->address }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Thành tích nổi bật</label>
                                            <input type="text" name="outstanding_achievements"
                                                value="{{ $item->outstanding_achievements }}">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('outstanding_achievements') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <button class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#upload').on('change', function() {
            $('.new-image-preview').hide();
            var fileInput = $(this)[0];
            var file = fileInput.files[0];
            if (file && file.type.startsWith('image/')) {
                var imageUrl = URL.createObjectURL(file);
                $('.uploadButton-file-name').html('<img src="' + imageUrl +
                    '" alt="Preview Image" style="max-width: 150px; max-height: 120px;">');
            }
        });
    });
</script>
