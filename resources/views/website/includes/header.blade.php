
@php
$currentRouteName = \Request::route()->getName();
@endphp
<style>
.nav-link {
    font-size: 22px;
    cursor: pointer;
    width: 35px;
    height: 35px;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #212529;
    border-radius: 50%;
    border: 1px solid #dee2e6;
}
.notify-badge {
    position: absolute;
    top: -6px;
    right: -8px;
    color: #fff;
    font-size: 12px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f50d0d;
    z-index: 1;
}
.material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    line-height: inherit;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
.dropdown-menu {
    width: 330px;
    border: 1px solid #dee2e6;
    padding: 0 0;
    border-radius: 16px;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
}
.header-notifications-list {
    position: relative;
    height: 360px;

}
.dropdown-large .dropdown-menu .dropdown-item {
    padding: .5rem 1.3rem;
    border-bottom: 1px solid #ededed;
}
.align-items-center {
    align-items: center!important;
}
.dropdown-large .notify {
    font-size: 24px;
    text-align: center;
    margin-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 50%;
}
.material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    line-height: inherit;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
.flex-grow-1 {
    flex-grow: 1!important;
}
.dropdown-large .msg-name {
    font-size: 13px;
    margin-bottom: 0;
}
.dropdown-large .msg-time {
    font-size: 11px;
    margin-bottom: 0;
    color: #919191;
}
.float-end {
    float: right!important;
}
.dropdown-large .msg-info {
    font-size: 12px;
    margin-bottom: 0;
}
.dropdown-large .msg-header {
    padding: .8rem 1rem;
    border-bottom: 1px solid #ededed;
    background-clip: border-box;
    text-align: left;
    display: flex;
    align-items: center;
}
.dropdown-large .msg-footer {
    padding: .8rem 1rem;
    color: #1c1b1b;
    border-top: 1px solid #ededed;
    background-clip: border-box;
    background: 0% 0;
    font-size: 14px;
    font-weight: 500;
}
.header-notifications-list {
    position: relative;
    height: 360px;
    overflow-y: scroll;
}
</style>
<header class="main-header">
    <div class="main-box">
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo">
                    <a href="{{ route('home') }}" class="fw-bold fs-4 text-black">
                        <img style="width:250px;margin:-8% 0 -10% -10%" height="100" src="{{ asset('website-assets/images/logo-hd.png')}}">
                        <span class="logo-text"></span>
                    </a>
                </div>
            </div>
            @include('website.includes.header.main-menu')
        </div>
        <div class="outer-box">
            @if(Auth::check())
                @if(Auth::user()->type == "employee")
                <a class="menu-btn" href="{{ route('employee.transaction.create') }}">
                    <span class="icon flaticon-money-1"></span>
                    <span class="fs-5" style="color:#202124">{{ number_format(Auth::user()->points, 0, '', '.') ?? 0 }}P</span>
                </a>
                @endif
            <!-- <button class="menu-btn">
                <span class="count">1</span>
                <span class="icon la la-heart-o"></span>
            </button> -->

            <!-- <button class="menu-btn">
                <span class="icon la la-bell"></span>
            </button> -->
            <!-- Dashboard Option -->

            <!-- Notification --> 
             <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined">
            <div class="dropdown nav-item dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                    data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <span class="notify-badge">8</span>
                        <span class="material-symbols-outlined">notifications_none</span>

                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-lg-2">
                    <a href="javascript:;">
                        <div class="msg-header">
                            <p class="msg-header-title">Thông báo</p>
                            <p class="msg-header-clear ms-auto">Đánh dấu tất cả là đã đọc</p>
                        </div>
                    </a>
                    <div class="header-notifications-list">
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-primary border">
                                    <span class="material-symbols-outlined">account_circle</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                            ago</span></h6>
                                    <p class="msg-info">You have recived new orders</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-danger border">
                                <span class="material-symbols-outlined">account_circle</span>

                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
                                            ago</span></h6>
                                    <p class="msg-info">5 new user registered</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-success border">
                                    <span class="material-symbols-outlined">
                                        picture_as_pdf
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
                                            ago</span></h6>
                                    <p class="msg-info">The pdf files generated</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-info border">
                                    <span class="material-symbols-outlined">
                                        store
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs
                                            ago</span></h6>
                                    <p class="msg-info">Your new product has approved</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-warning border">
                                    <span class="material-symbols-outlined">
                                        event_available
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
                                            ago</span></h6>
                                    <p class="msg-info">5.1 min avarage time response</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-danger border">
                                    <span class="material-symbols-outlined">
                                        forum
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
                                            ago</span></h6>
                                    <p class="msg-info">New customer comments recived</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-primary border">
                                    <span class="material-symbols-outlined">
                                        local_florist
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                                            ago</span></h6>
                                    <p class="msg-info">24 new authors joined last week</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-success border">
                                    <span class="material-symbols-outlined">
                                        park
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                                            ago</span></h6>
                                    <p class="msg-info">Successfully shipped your item</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-warning border">
                                    <span class="material-symbols-outlined">
                                        elevation
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
                                            ago</span></h6>
                                    <p class="msg-info">45% less alerts last 4 weeks</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="javascript:;">
                        <div class="text-center msg-footer">View All</div>
                    </a>
                </div>
            </div> -->


            <div class="dropdown dashboard-option">
                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>Hi,{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->type == 'staff')
                    <li class="@if($currentRouteName == 'staff.home') active @endif"><a
                            href="{{ route('staff.home')}}"><i class="la la-box"></i>Bảng điều khiển</a></li>
                    <li
                        class="@if($currentRouteName == 'staff.profile.index' || $currentRouteName == 'staff.home1') active @endif">
                        <a href="{{ route('staff.profile.index')}}"> <i class="la la-user-alt"></i>Thông tin cá
                            nhân</a>
                    </li>
                    <li class="@if($currentRouteName == 'staff.cv.index') active @endif"><a
                            href="{{ route('staff.cv.index')}}"><i class="la la-box"></i>Danh sách hồ sơ</a></li>
                    <li class="@if($currentRouteName == 'staff.favorite') active @endif"><a
                            href="{{ route('staff.favorite')}}"><i class="la la-bookmark-o"></i>Việc làm đã lưu</a>
                    </li>
                    <li class="@if($currentRouteName == 'staff.job-applied') active @endif"><a
                            href="{{ route('staff.job-applied')}}"><i class="la la-briefcase"></i>Việc làm đã
                            nộp</a>
                    </li>
                    @endif
                    @if(Auth::user()->type == 'employee')
                    <li class="@if($currentRouteName == 'employee.home') active @endif"><a
                            href="{{ route('employee.home')}}"><i class="la la-box"></i>Bảng điều khiển</a>
                    <li>
                    <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>Hồ sơ</a></li>
                    <li><a href="{{ route('employee.job.create')}}"><i class="la la-paper-plane"></i>Đăng Tin</a></li>
                    <li><a href="{{ route('employee.job.index')}}"><i class="la la-briefcase"></i> Quản lý công việc
                        </a></li>
                    <li><a href="{{ route('employee.cv.index')}}"><i class="la la-box"></i>Quản lý CV</a></li>
                    <li><a href="{{ route('employee.transaction.index')}}"><i class="la la-box"></i>Quản lý giao
                            dịch</a></li>
                    @endif
                    <li class="@if($currentRouteName == 'auth.logout') active @endif"><a
                            href="{{ route('auth.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
                </ul>
            </div>
            @else
            <div class="btn-box">
                <a href="{{ route('staff.login') }}" class="theme-btn btn-style-three">Đăng nhập / Đăng ký</a>
                <a href="{{ route('employee.login') }}" class="theme-btn btn-style-one">Nhà tuyển dụng</a>
            </div>
            @endif
        </div>
    </div>
    @include('website.includes.header.mobile-menu')
</header>