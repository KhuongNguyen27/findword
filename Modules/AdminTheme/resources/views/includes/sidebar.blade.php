<!--start sidebar-->
<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/logo-icon.png" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">{{ ENV('APP_NAME') }}</h5>
        </div>
        <div class="sidebar-close ">
            <span class="material-symbols-outlined">{{ __('close') }}</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
        @include('admintheme::includes.sidebar-nav')
    </div>
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/01.png" alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name">{{ Auth::user()->name }}</h5>
                <p class="mb-0 user-designation">{{ Auth::user()->type }}</p>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:;">
                    <span class="material-symbols-outlined me-2"></span>
                    <span>{{ __('profile') }}</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('adminuser.logout') }}">
                    <span class="material-symbols-outlined me-2"></span>
                    <span>{{ __('logout') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<!--end sidebar-->
