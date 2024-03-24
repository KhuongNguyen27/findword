<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- Stylesheets -->
    <link href="{{ asset('website-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/custom.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('website-assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('website-assets/images/favicon.png')}}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ asset('website-assets/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <script src="{{ asset('website-assets/js/jquery.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery-ui.min.js')}}"></script>
    <link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/welcome.min.f52a5c4bfa977462.css">
</head>

<body data-anm=".anm">
    <div class="page-wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader"></div> -->
        @include('website.includes.header')
        @yield('content')
        @include('website.includes.footer')
    </div><!-- End Page Wrapper -->
    <script>
    // Resolve name collision between jQuery UI and Twitter Bootstrap
    $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>
    <script src="{{ asset('website-assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/chosen.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery.modal.min.js')}}"></script>
    <script src="{{ asset('website-assets/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/mmenu.polyfills.js')}}"></script>
    <script src="{{ asset('website-assets/js/mmenu.js')}}"></script>
    <script src="{{ asset('website-assets/js/appear.js')}}"></script>
    <script src="{{ asset('website-assets/js/anm.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/ScrollMagic.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/rellax.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/owl.js')}}"></script>
    <script src="{{ asset('website-assets/js/wow.js')}}"></script>
    <script src="{{ asset('website-assets/js/script.js')}}"></script>
    <script src="{{ asset('website-assets/js/repeater.js')}}"></script>
    <script src="{{ asset('website-assets/js/custom.js?t='.time())}}"></script>
    <script>
    $(document).ready(function() {
        $('.bookmark-btn').on('click', function(e) {
            var btnWhitlist = $(this)
            e.preventDefault();

            var url = $(this).data('href');

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        if (response.type == 'add') {
                            btnWhitlist.find('span').addClass('active');
                        } else {
                            btnWhitlist.find('span').removeClass('active');
                        }
                    }
                },
                error: function() {}
            });
        });
    });
    </script>
     @yield('footer')
</body>

</html>