<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Stylesheets -->
    <link href="{{ asset('website-assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('website-assets/css/custom.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    @yield('header')
</head>
<style>
.msg-info {
    word-wrap: break-word; /* Tự động ngắt dòng khi từ quá dài */
    white-space: normal; /* Cho phép nội dung xuống dòng */
}
.header-notifications-list .dropdown-item .d-flex {
    display: flex;
    align-items: center;
}

.header-notifications-list .dropdown-item .notify {
    width: 20px; /* Chiều rộng cố định cho icon để icon không bị thay đổi kích thước */
    height: 20px; /* Chiều cao cố định cho icon */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0; /* Ngăn icon bị co lại nếu nội dung văn bản quá dài */
}

.header-notifications-list .dropdown-item .flex-grow-1 {
    flex-grow: 1;
    padding-left: 0px; /* Khoảng cách giữa icon và nội dung văn bản */
}

.header-notifications-list .dropdown-item .msg-info {
    word-wrap: break-word; /* Đảm bảo văn bản dài sẽ xuống dòng thay vì bị bể layout */
    margin: 0;
}

</style>
<body>

    <div class="page-wrapper dashboard ">
        <!-- Preloader -->
        <!-- <div class="preloader"></div> -->
        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- include('staff::dashboards.includes.header') -->

        @include('website.includes.header')


        @include('staff::dashboards.includes.sidebar')
        @yield('content')

        <!-- Copyright -->
        <div class="copyright-text">
            <p>© 2021 {{ env('APP_NAME') }}. All Right Reserved.</p>
        </div>
    </div><!-- End Page Wrapper -->
    <script src="{{ asset('website-assets/js/jquery.js')}}"></script>
    <script src="{{ asset('website-assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/chosen.min.js')}}"></script>
    <!-- <script src="{{ asset('website-assets/js/bootstrap.min.js')}}"></script> -->
    <script src="{{ asset('website-assets/js/bootstrap-5.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/jquery.fancybox.js')}}"></script>
    <!-- <script src="{{ asset('website-assets/js/jquery.modal.min.js')}}"></script> -->
    <script src="{{ asset('website-assets/js/mmenu.polyfills.js')}}"></script>
    <script src="{{ asset('website-assets/js/mmenu.js')}}"></script>
    <script src="{{ asset('website-assets/js/appear.js')}}"></script>
    <script src="{{ asset('website-assets/js/ScrollMagic.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/rellax.min.js')}}"></script>
    <script src="{{ asset('website-assets/js/owl.js')}}"></script>
    <script src="{{ asset('website-assets/js/wow.js')}}"></script>
    <script src="{{ asset('website-assets/js/script.js')}}"></script>
    <script src="{{ asset('website-assets/js/repeater.js')}}"></script>
    <script src="{{ asset('admin-assets/js/app.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.bookmark-btn').on('click', function(e) {
                var btnWhitlist = $(this)
                e.preventDefault();

                var url = $(this).data('href');

                $.ajax({
                    url: url
                    , method: 'GET'
                    , dataType: 'json'
                    , success: function(response) {
                        if (response.success) {
                            if (response.type == 'add') {
                                btnWhitlist.find('span').addClass('active');
                            } else {
                                btnWhitlist.find('span').removeClass('active');
                            }
                        }
                    }
                    , error: function() {}
                });
            });
            setInterval(function() {
                $.ajax({
                    url: '{{ route("notifications.getNotification") }}'
                    , method: 'GET'
                    , dataType: 'json'
                    , success: function(response) {
                        if (response.success) {
                            let notificationsHtml = '';
                            $('.notify-badge').html(response.unreadCount);
                            for (let i = 0; i < response.data.length; i++) {
                                let notification = response.data[i];
                                notificationsHtml += `
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify text-primary">
                                                <span class="material-symbols-outlined" style="color: ${notification.color};">${notification.icon}</span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name" style="font-weight: bold;">${notification.title}<span class="msg-time float-end">${notification.time}</span></h6>
                                                    <p class="msg-info">${notification.message}</p>
                                                </div>
                                            </div>
                                        </a>
                                     `;
                            }
                            $('.header-notifications-list').html(notificationsHtml);
                        } else {
                            console.log(response.message);
                        }
                    }
                    , error: function() {
                        console.log('Failed to fetch notifications.');
                    }
                });
            }, 3000);
        });

    </script>
    @yield('footer')
</body>

</html>
