 <!-- Main Header-->
 <header class="main-header header-shaddow">
     <div class="container-fluid">
         <!-- Main box -->
         <div class="main-box">
             <!--Nav Outer -->
             <div class="nav-outer">
                 <div class="logo-box">
                     <div class="logo"><a href="{{ route('home') }}"><img
                                 src="{{ asset('website-assets/images/logo.png')}}" alt="" title=""></a></div>
                 </div>

                 @include('website.includes.header.main-menu')
             </div>

             <div class="outer-box">

                 {{-- <button class="menu-btn">
                     <span class="count">1</span>
                     <span class="icon la la-heart-o"></span>
                 </button>

                 <button class="menu-btn">
                     <span class="icon la la-bell"></span>
                 </button> --}}

                 <!-- Dashboard Option -->
                 <div class="dropdown dashboard-option">
                     <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span class="name">Xin chào, {{ auth()->user()->name }}</span>
                     </a>
                     <ul class="dropdown-menu">
                         <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>Hồ sơ</a>
                         </li>
                         
                         <li><a href="{{ route('employee.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>

     <!-- Mobile Header -->
     <div class="mobile-header">
         <div class="logo"><a href="index.html"><img src="images/logo.svg" alt="" title=""></a></div>

         <!--Nav Box-->
         <div class="nav-outer clearfix">

             <div class="outer-box">
                 <!-- Login/Register -->
                 <div class="login-box">
                     <a href="login-popup.html" class="call-modal"><span class="icon-user"></span></a>
                 </div>

                 <button id="toggle-user-sidebar"><img src="{{ asset(Auth::user()->image_fm) }}" alt="avatar"
                         class="thumb"></button>
                 <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span
                         class="flaticon-menu-1"></span></a>
             </div>
         </div>

     </div>

     <!-- Mobile Nav -->
     <div id="nav-mobile"></div>
 </header>
 <!--End Main Header -->