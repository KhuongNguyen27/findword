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
                                                accept="image/*, application/pdf" id="upload" multiple>
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

                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>{{ __('employer_name') }}<span class="label-required"> *</span></label>
                                            <input type="text" name="user_name" value="{{ $user->name }}"
                                                placeholder="Tên nhà tuyển dụng">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>{{ __('email_address') }}<span class="label-required"> *</span></label>
                                            <input type="text" name="email" value="{{ $user->email }}"
                                                placeholder="Email Nhà Tuyển Dụng">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>{{ __('company_name') }}<span class="label-required"> *</span></label>
                                            <input id="name" type="text" name="name"
                                                value="{{ isset($user_employee->name) ? $user_employee->name : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>{{ __('company_address') }}<span class="label-required">
                                                    *</span></label>
                                            <input type="text" name="address"
                                                value="{{ isset($user_employee->address) ? $user_employee->address : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>{{ __('phone') }}<span class="label-required"> *</span></label>
                                            <input type="text" name="phone"
                                                value="{{ isset($user_employee->phone) ? $user_employee->phone : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md12">
                                            <label>{{ __('company_website') }}<span class="label-required">
                                                    *</span></label>
                                            <input type="url" name="website"
                                                value="{{ isset($user_employee->website) ? $user_employee->website : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('website') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Giới thiệu công ty<span class="label-required"> *</span></label>
                                            <textarea name="about" id="about">{{ isset($user_employee->about) ? $user_employee->about : 'Mô tả về công ty của bạn' }}</textarea>
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('about') }}</p>
                                            @endif
                                        </div>


                                        <span><strong> {{__('background')}} </strong></span>
                                        <div class="uploading-outer-background">
                                            <div class="uploadButton-background">
                                                <input class="uploadButton-background-input" type="file"
                                                    name="background" accept="image/*, application/pdf"
                                                    id="upload-background" multiple>
                                                <label class="uploadButton-background-button ripple-effect"
                                                    for="upload-background"> {{__('background_browser')}} </label>
                                                <span class="uploadButton-background-file-name"></span>
                                            </div>
                                            <div class="new-background-preview" style="margin-left:0px">
                                                <?php if (isset($user_employee->background)):?>
                                                <img src="<?php echo asset($user_employee->background); ?>" alt="Preview Image">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <button type="submit"
                                                class="theme-btn btn-style-one">{{ __('save') }}</button>
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
