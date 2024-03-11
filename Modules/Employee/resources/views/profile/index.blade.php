@extends('employee::layouts.master')
@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Hồ Sơ Nhà Tuyển Dụng</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Thông Tin</h4>
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

                                    .new-image-preview{
                                        width: 100px;
                                        height: 100px;
                                        object-fit: contain;
                                        margin-left: 230px;
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
                                            <?php if (isset($user_employee->image)):?>
                                                <img src="<?php echo asset('/storage/images/'.$user_employee->image); ?>" alt="Preview Image">
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
                                                imagePreviewDiv.innerHTML = ''; // Xóa hình ảnh khi không có tệp tin nào được chọn
                                            }
                                        });
                                    </script>
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Tên Nhà Tuyển Dụng</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                placeholder="Tên Nhà Tuyển Dụng">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Địa Chỉ Email Nhà Tuyển Dụng</label>
                                            <input type="text" name="email" value="{{ $user->email }}"
                                                placeholder="Email Nhà Tuyển Dụng">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Tên Công Ty</label>
                                            <input id="name" type="text" name="name"
                                                value="{{ isset($user_employee->name) ? $user_employee->name : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Địa Chỉ Công Ty</label>
                                            <input type="text" name="address"
                                                value="{{ isset($user_employee->address) ? $user_employee->address : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Số Điện Thoại Công Ty</label>
                                            <input type="text" name="phone"
                                                value="{{ isset($user_employee->phone) ? $user_employee->phone : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Website Công ty</label>
                                            <input type="text" name="website"
                                                value="{{ isset($user_employee->website) ? $user_employee->website : '' }}"
                                                placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('website') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Mật Khẩu</label>
                                            <input type="password" name="password" value="" placeholder="">
                                            @if ($errors->any())
                                                <p style="color:red">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>

                                        <!-- About Company -->
                                        {{-- <div class="form-group col-lg-12 col-md-12">
                                        <label>About Company</label>
                                        <textarea
                                            placeholder="Spent several years working on sheep on Wall Street. Had moderate success investing in Yugo's on Wall Street. Managed a small team buying and selling Pogo sticks for farmers. Spent several years licensing licorice in West Palm Beach, FL. Developed several new methods for working it banjos in the aftermarket. Spent a weekend importing banjos in West Palm Beach, FL.In this position, the Software Engineer collaborates with Evention's Development team to continuously enhance our current software solutions as well as create new solutions to eliminate the back-office operations and management challenges present"></textarea>
                                    </div> --}}

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <button class="theme-btn btn-style-one">Lưu</button>
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
