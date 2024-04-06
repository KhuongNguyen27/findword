<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- Stylesheets -->
    <link href="{{ asset('website-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('website-assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('website-assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('website-assets/css/custom.css')}}">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>
    <div class="page-wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader"></div> -->
        <!-- Main Header-->
        <header class="main-header">
            <div class="container-fluid">
                <!-- Main box -->
                <div class="main-box">
                    <!--Nav Outer -->
                    <div class="nav-outer">
                        <div class="logo-box">
                            <div class="logo"><a href="index.html"><img
                                        src="{{ asset('website-assets/images/logo-2.svg')}}" alt="" title=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="logo"><a href="index.html"><img src="{{ asset('website-assets/images/logo.svg')}}" alt=""
                            title=""></a></div>
            </div>
            <!-- Mobile Nav -->
            <div id="nav-mobile"></div>
        </header>
        <!--End Main Header -->
        <!-- Info Section -->
        <div class="login-section">
            <div class="image-layer"
                style="background-image: url({{ asset('website-assets/images/background/login-bg.png')}});"></div>
            <div class="outer-box">
                @yield('content')
            </div>
        </div>
        <!-- End Info Section -->


    </div><!-- End Page Wrapper -->


    <script src="{{ asset('website-assets/js/jquery.js')}}"></script>
    <script src="{{ asset('website-assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/chosen.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery.modal.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/mmenu.polyfills.js')}}"></script>
    <script src="{{ asset('website-assets/js/mmenu.js')}}"></script>
    <script src="{{ asset('website-assets/js/appear.js')}}"></script>
    <script src="{{ asset('website-assets/js/ScrollMagic.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/rellax.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/owl.js')}}"></script>
    <script src="{{ asset('website-assets/js/wow.js')}}"></script>
    <script src="{{ asset('website-assets/js/script.js')}}"></script>
    <script src="{{ asset('website-assets/js/custom.js')}}"></script>
</body>

</html>