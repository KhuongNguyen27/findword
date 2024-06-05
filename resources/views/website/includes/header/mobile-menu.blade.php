<!-- Mobile Header -->
<div class="mobile-header">
    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('website-assets/images/logo-hd.png')}}" alt="" title=""></a></div>

    <!--Nav Box-->
    <div class="nav-outer clearfix">
        <div class="outer-box">
            <!-- Login/Register -->
            <div class="login-box">
                @if(Auth::check())
                    @php
                        $userType = Auth::user()->type; // assuming 'type' is the field that stores the user type
                    @endphp

                    @if($userType == 'staff')
                        <a onclick="window.location.href='{{ route('staff.register') }}'" href="{{ route('staff.register') }}" class="call-modal"><span class="icon-user"></span></a>
                    @elseif($userType == 'employee')
                        <a onclick="window.location.href='{{ route('employee.register') }}'" href="{{ route('employee.register') }}" class="call-modal"><span class="icon-user"></span></a>
                    @endif
                @else
                    <!-- If the user is not logged in, you can redirect them to a login page or show a generic link -->
                    <a onclick="window.location.href='{{ route('login') }}'" href="{{ route('login') }}" class="call-modal"><span class="icon-user"></span></a>
                @endif
            </div>

            <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
        </div>
    </div>
</div>

<!-- Mobile Nav -->
<div id="nav-mobile"></div>
