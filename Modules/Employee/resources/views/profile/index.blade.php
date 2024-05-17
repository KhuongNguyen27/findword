@extends('employee::layouts.master')
@section('content')
<!-- Dashboard -->
<section class="user-dashboard">
    <div class="dashboard-outer">
        <div class="upper-title-box">
            <h3>{{ __('employer_profile') }}</h3>
            @if (Auth::user()->getAccountName())
            <h4>Loại tài khoản : {{ Auth::user()->getAccountName() }}</h4>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Ls widget -->
                <div class="ls-widget">
                    <div class="tabs-box">
                        <div class="widget-title">
                            <h4>{{ __('information') }}</h4>
                        </div>

                        <div class="widget-content">
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif


                            <style>
                            .image-preview img {
                                width: 50px;
                                height: 50px;
                                object-fit: contain;
                            }

                            .new-image-preview {
                                width: 100px;
                                height: 100px;
                                object-fit: contain;
                                margin-left: 230px;
                            }

                            .label-required {
                                color: red;
                            }
                            </style>





                            {{-- <div class="uploading-outer">
                                <div class="uploadButton">
                                    <input class="uploadButton-input" type="file" name="attachments[]"
                                        accept="image/*, application/pdf" id="upload" multiple />
                                    <label class="uploadButton-button ripple-effect" for="upload">Tải lên logo công ty</label>
                                    <span class="uploadButton-file-name"></span>
                                </div>
                                <div class="text">ảnh .jpg & .png</div>
                            </div> --}}
                            <form class="default-form" action="{{ route('employee.profile.update', $user->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <span><strong>{{ __('logo_upload') }}</strong></span>
                                <div class="uploading-outer">
                                    <div class="uploadButton">
                                        <input class="uploadButton-input" type="file" name="image"
                                            accept="image/*, application/pdf" id="upload" multiple
                                            {{ (isset($user_employee) && $user_employee->user->verify == 1) ? 'disabled' : '' }}>
                                        <label class="uploadButton-button ripple-effect"
                                            for="upload">{{ __('logo_browse') }}</label>
                                        <span class="uploadButton-file-name"></span>
                                    </div>
                                    <div class="new-image-preview" style="margin-left:0px">
                                        <?php if (isset($user_employee->image)):?>
                                        <img src="<?php echo asset($user_employee->image); ?>" alt="Preview Image">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <script>
                                const uploadInput = document.querySelector('.uploadButton-input');
                                const fileNameSpan = document.querySelector('.uploadButton-file-name');
                                const imagePreviewDiv = document.querySelector('.image-preview');

                                uploadInput.addEventListener('change', function() {
                                    const files = Array.from(uploadInput.files);
                                    const fileNames = files.map(file => file.name);
                                    fileNameSpan.textContent = fileNames.join(', ');

                                    if (files.length > 0) {
                                        const fileReader = new FileReader();
                                        fileReader.onload = function(event) {
                                            const imagePreview = document.createElement('img');
                                            imagePreview.src = event.target.result;
                                            imagePreviewDiv.innerHTML = ''; // Xóa hình ảnh trước nếu có
                                            imagePreviewDiv.appendChild(imagePreview);
                                        };
                                        fileReader.readAsDataURL(files[0]);
                                    } else {
                                        imagePreviewDiv.innerHTML =
                                            ''; // Xóa hình ảnh khi không có tệp tin nào được chọn
                                    }
                                });
                                </script>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('employer_name') }}<span class="label-required"> *</span></label>
                                        <input type="text" name="user_name" value="{{ $user->name }}"
                                            placeholder="Tên nhà tuyển dụng"
                                            {{ ($user->verify == 1) ? 'readonly' : '' }}>
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('company_website') }}<span class="label-required"> *</span></label>
                                        @if(isset($user_employee) && isset($user_employee->user) &&
                                        $user_employee->user->verify == 1)
                                        <input type="url" name="website"
                                            value="{{ isset($user_employee->website) ? $user_employee->website : '' }}"
                                            placeholder="" readonly>
                                        @else
                                        <input type="url" name="website"
                                            value="{{ isset($user_employee->website) ? $user_employee->website : '' }}"
                                            placeholder="">
                                        @endif
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('website') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('company_name') }}<span class="label-required"> *</span></label>
                                        @if(isset($user_employee) && $user_employee->user->verify == 1)
                                        <input id="name" type="text" name="name"
                                            value="{{ isset($user_employee->name) ? $user_employee->name : '' }}"
                                            placeholder="" readonly>
                                        @else
                                        <input id="name" type="text" name="name"
                                            value="{{ isset($user_employee->name) ? $user_employee->name : '' }}"
                                            placeholder="">
                                        @endif
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>


                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('company_address') }}<span class="label-required"> *</span></label>
                                        @if(isset($user_employee) && isset($user_employee->user) &&
                                        $user_employee->user->verify == 1)
                                        <input type="text" name="address"
                                            value="{{ isset($user_employee->address) ? $user_employee->address : '' }}"
                                            placeholder="" readonly>
                                        @else
                                        <input type="text" name="address"
                                            value="{{ isset($user_employee->address) ? $user_employee->address : '' }}"
                                            placeholder="">
                                        @endif
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>


                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('phone') }}<span class="label-required"> *</span></label>
                                        <input type="text" name="phone"
                                            value="{{ isset($user_employee->phone) ? $user_employee->phone : '' }}"
                                            placeholder=""
                                            {{ (isset($user_employee) && $user_employee->user->verify == 1) ? 'readonly' : '' }}>
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('phone') }}</p>
                                        @endif
                                        <div class="form-check mt-2">
                                            <input type="checkbox" class="form-check-input" id="is_hidden_phone"
                                                name="is_hidden_phone"
                                                {{ (old('is_hidden_phone') || ($user_employee && $user_employee->is_hidden_phone == 1)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hidden_phone">Ẩn số điện
                                                thoại</label>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>{{ __('email_address') }}<span class="label-required"> *</span></label>
                                        <input type="text" name="email" value="{{ $user->email }}"
                                            placeholder="Email Nhà Tuyển Dụng"
                                            {{ (isset($user_employee) && $user_employee->user->verify == 1) ? 'readonly' : '' }}>
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('email') }}</p>
                                        @endif
                                        <div class="form-check mt-2">
                                            <input type="checkbox" class="form-check-input" id="is_hidden_email"
                                                name="is_hidden_email"
                                                {{ (old('is_hidden_email') || ($user_employee && $user_employee->is_hidden_email == 1)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_hidden_email">Ẩn email</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12">
                                        <label>Giới thiệu công ty<span class="label-required"> *</span></label>
                                        <textarea name="about"
                                            id="about">{{ isset($user_employee->about) ? $user_employee->about : 'Mô tả về công ty của bạn' }}</textarea>
                                        @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('about') }}</p>
                                        @endif
                                    </div>
                                    <style>
                                    .uploadButton-business .uploadButton-business-button {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        flex-direction: column;
                                        cursor: pointer;
                                        height: 120px;
                                        width: 200px;
                                        border-radius: 5px;
                                        transition: 0.3s;
                                        margin: 0;
                                        color: #1b2032;
                                        font-size: 16px;
                                        border: 2px dashed #ced4e1;
                                    }

                                    .uploadButton-business .uploadButton-business-input {
                                        opacity: 0;
                                        position: absolute;
                                        overflow: hidden;
                                        z-index: -1;
                                        pointer-events: none;
                                        height: 0;
                                        width: 0;
                                        display: none;
                                    }

                                    .uploadButton-business .uploadButton-business-button:before {
                                        font-family: "Flaticon";
                                        content: "\f15c";
                                        color: #9fa9b8;
                                        font-size: 20px;
                                        transition: 0.3s;
                                    }

                                    .uploadButton-business .uploadButton-business-file-name {
                                        align-items: center;
                                        padding: 0 10px;
                                        padding-left: 18px;
                                        min-height: 36px;
                                        top: 1px;
                                        position: relative;
                                        color: #1b2032;
                                        background-color: transparent;
                                        overflow: hidden;
                                        line-height: 22px;
                                    }

                                    .new-business-preview {
                                        width: 100px;
                                        height: 100px;
                                        object-fit: contain;
                                        /* margin-left: 230px; */
                                    }

                                    .new-business-preview {
                                        display: inline-block;
                                        /* width: 50%; */
                                        /* height: 50%; */
                                        text-align: center;
                                        /* object-fit: contain; */
                                    }

                                    img {
                                        display: inline-block;
                                        width: 100%;
                                        height: 100%;
                                        text-align: center;
                                        object-fit: contain;
                                    }

                                    .uploading-outer-business {
                                        position: relative;
                                        display: flex;
                                        width: 100%;
                                        padding-bottom: 30px;
                                        border-bottom: 1px solid #f1f3f7;
                                        margin-bottom: 30px;
                                        align-items: center;
                                    }

                                    .uploading-outer-business .uploadButton-business {
                                        position: relative;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                    }
                                    </style>
                                    <span><strong>{{ __('image_business_license') }}</strong></span>
                                    <div class="uploading-outer-business">
                                        <div class="uploadButton-business">
                                            <input class="uploadButton-business-input" type="file"
                                                name="image_business_license" accept="image/*, application/pdf"
                                                id="upload-business-license" multiple
                                                {{ (isset($user_employee) && $user_employee->user->verify == 1) ? 'disabled' : '' }}>
                                            <label class="uploadButton-business-button ripple-effect"
                                                for="upload-business">{{ __('image') }}</label>
                                            <span class="uploadButton-business-file-name"></span>
                                        </div>
                                        <div class="new-business-preview" style="margin-left:0px">
                                            <?php if (isset($user_employee->image_business_license)): ?>
                                            <img src="<?php echo asset($user_employee->image_business_license); ?>"
                                                alt="Preview Image">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span><strong> {{ __('background') }} </strong></span>
                                    <div class="uploading-outer-background">
                                        <div class="uploadButton-background">
                                            <input class="uploadButton-background-input" type="file" name="background"
                                                accept="image/*, application/pdf" id="upload-background" multiple
                                                {{ (isset($user_employee) && $user_employee->user->verify == 1) ? 'disabled' : '' }}>
                                            <label class="uploadButton-background-button ripple-effect"
                                                for="upload-background"> {{ __('background_browser') }} </label>
                                            <span class="uploadButton-background-file-name"></span>
                                        </div>
                                        <div class="new-background-preview" style="margin-left:0px">
                                            <?php if (isset($user_employee->background)):?>
                                            <img src="<?php echo asset($user_employee->background); ?>"
                                                alt="Preview Image">
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-6 col-md-12">
                                        <button type="submit" class="theme-btn btn-style-one">{{ __('save') }}</button>
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

$(document).ready(function() {
    $('#upload-business-license').on('change', function() {
        $('.new-business-preview').hide();
        var fileInput = $(this)[0];
        var file = fileInput.files[0];
        if (file && file.type.startsWith('image/')) {
            var businessUrl = URL.createObjectURL(file);
            $('.uploadButton-business-file-name').html('<img src="' + businessUrlUrl +
                '" alt="Preview Background" style="max-width: 150px; max-height: 120px;">');
        }
    });
})

$(document).ready(function() {
    $('#upload-background').on('change', function() {
        $('.new-background-preview').hide();
        var fileInput = $(this)[0];
        var file = fileInput.files[0];
        if (file && file.type.startsWith('image/')) {
            var backgroundUrl = URL.createObjectURL(file);
            $('.uploadButton-background-file-name').html('<img src="' + backgroundUrl +
                '" alt="Preview Background" style="max-width: 150px; max-height: 120px;">');
        }
    });
})
</script>
{{-- xử lý logo --}}
<script>
const uploadInput = document.querySelector('.uploadButton-input');
const fileNameSpan = document.querySelector('.uploadButton-file-name');
const imagePreviewDiv = document.querySelector('.image-preview');

uploadInput.addEventListener('change', function() {
    const files = Array.from(uploadInput.files);
    const fileNames = files.map(file => file.name);
    fileNameSpan.textContent = fileNames.join(', ');

    if (files.length > 0) {
        const fileReader = new FileReader();
        fileReader.onload = function(event) {
            const imagePreview = document.createElement('img');
            imagePreview.src = event.target.result;
            imagePreviewDiv.innerHTML = ''; // Xóa hình ảnh trước nếu có
            imagePreviewDiv.appendChild(imagePreview);
        };
        fileReader.readAsDataURL(files[0]);
    } else {
        imagePreviewDiv.innerHTML = ''; // Xóa hình ảnh khi không có tệp tin nào được chọn
    }
});
</script>
{{-- background --}}
{{-- <script>
    const uploadBackgroundInput = document.querySelector('.uploadButton-background-input');
    const fileNameSpan = document.querySelector('.uploadButton-background-file-name');
    const backgroundPreviewDiv = document.querySelector('.new-background-preview');

    uploadBackgroundInput.addEventListener('change', function() {
        const files = Array.from(uploadBackgroundInput.files);
        const fileNames = files.map(file => file.name);
        fileNameSpan.textContent = fileNames.join(', ');

        if (files.length > 0) {
            const fileReader = new FileReader();
            fileReader.onload = function(event) {
                const backgroundPreview = document.createElement('img');
                backgroundPreview.src = event.target.result;

                // Xóa hình ảnh cũ và thêm hình ảnh mới
                const existingBackgroundImage = backgroundPreviewDiv.querySelector('img');
                if (existingBackgroundImage) {
                    existingBackgroundImage.remove();
                }
                backgroundPreviewDiv.appendChild(backgroundPreview);

                fileNameSpan.style.display = 'block'; // Hiển thị văn bản
            };
            fileReader.readAsDataURL(files[0]);
        } else {
            backgroundPreviewDiv.innerHTML = ''; // Xóa hình ảnh khi không có tệp tin nào được chọn
            fileNameSpan.style.display = 'none'; // Ẩn văn bản
        }
    });
</script> --}}