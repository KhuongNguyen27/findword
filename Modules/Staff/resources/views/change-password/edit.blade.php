@extends('staff::dashboards.layouts.dashboard')
@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>{{ __('change_password') }}</h3>
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
                               <form class="default-form" action="{{ route('staff.profile.changePassword', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12">
                                        <label>{{ __('current_password') }}: <span class="label-required">*</span></label>
                                        <input type="password" name="password" value="" placeholder="">
                                        @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <label>{{ __('new_password') }}: <span class="label-required">*</span></label>
                                        <input type="password" name="newpassword" value="" placeholder="">
                                        @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('newpassword') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <label>{{ __('repeat_password') }}: <span class="label-required">*</span></label>

                                        <input type="password" name="confirmpassword" value="" placeholder="">
                                        @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('confirmpassword') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12">
                                        <button type="submit" class="theme-btn btn-style-one">{{ __('save') }}</button>
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
