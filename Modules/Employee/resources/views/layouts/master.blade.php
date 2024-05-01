<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Stylesheets -->
    <link href="{{ asset('website-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('website-assets/css/custem_search.css')}}">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    @yield('header')

</head>

<body>

    <div class="page-wrapper dashboard ">
        <!-- Preloader -->
        <!-- <div class="preloader"></div> -->
        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- include('employee::layouts.includes.header') -->
        @include('website.includes.header')

        @include('employee::layouts.includes.sidebar')
        @yield('content')

        <!-- Copyright -->
        <div class="copyright-text">
            <p>© <?= date('Y');?> {{ env('APP_NAME') }}. All Right Reserved.</p>
        </div>
    </div><!-- End Page Wrapper -->
    <script src="{{ asset('website-assets/js/jquery.js')}}"></script>
    <script src="{{ asset('website-assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/chosen.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/bootstrap-5.min.js')}}"></script>
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
    @yield('footer')

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
      if ($('#description').length) {
        CKEDITOR.replace('description');
    }
    if ($('#requirements').length) {
        CKEDITOR.replace('requirements');
    }
    if ($('#about').length) {
        CKEDITOR.replace('about');
    }
    if ($('#more_information').length) {
        CKEDITOR.replace('more_information');
    }
    </script>
</body>

</html>