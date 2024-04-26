<!-- Mobile Header -->
<div class="mobile-header">
    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('website-assets/images/logo-hd.png')}}" alt="" title=""></a></div>

    <!--Nav Box-->
    <div class="nav-outer clearfix">

        <div class="outer-box">
            <!-- Login/Register -->
            <div class="login-box">
                <a onclick="window.location.href='{{ route('staff.register') }}'" href="{{ route('staff.register') }}" class="call-modal"><span class="icon-user"></span></a>
            </div>

            <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
        </div>
    </div>
</div>

<!-- Mobile Nav -->
<div id="nav-mobile"></div>