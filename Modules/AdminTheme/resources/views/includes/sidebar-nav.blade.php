<!--navigation-->
<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('admin.home') }}">
            <div class="parent-icon"><span class="material-symbols-outlined">home</span>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="menu-label">Tài Khoản</li>
    <li>
        <a class="has-arrow" aria-expanded="false" href="javascript:;">
            <div class="parent-icon">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="menu-title">Ứng Viên</div>
        </a>
        <ul class="mm-collapse">
            <li>
                <a href="{{ route('adminuser.index',['type'=>'staff']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Danh Sách
                </a>
            </li>
            <li>
                <!-- <a href="{{ route('adminpost.index',['type'=>'UserCV']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Hồ Sơ</a>
            </li> -->
        </ul>
    </li>
    <li>
        <a class="has-arrow" aria-expanded="false" href="javascript:;">
            <div class="parent-icon">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="menu-title">Nhà Tuyển Dụng</div>
        </a>
        <ul class="mm-collapse">
            <li>
                <a href="{{ route('adminuser.index',['type'=>'employee']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Danh Sách</a>
            </li>
            <li>
                <a href="{{ route('adminpost.index',['type'=>'Job']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Tin Đăng</a>
            </li>
        </ul>
    </li>
    <li class="menu-label">Cấu Hình Việc Làm</li>
    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="menu-title">Công Việc</div>
        </a>
        <ul class="mm-collapse">
            <li>
                <a href="{{ route('admintaxonomy.index',['type'=>'Career']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Ngành Nghề
                </a>
            </li>
            <li>
                <a href="{{ route('admintaxonomy.index',['type'=>'Level']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Trình độ
                </a>
            </li>
            <li>
                <a href="{{ route('admintaxonomy.index',['type'=>'Rank']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Cấp bậc
                </a>
            </li>
            <li>
                <a href="{{ route('admintaxonomy.index',['type'=>'Wage']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Mức lương
                </a>
            </li>
            <li>
                <a href="{{ route('admintaxonomy.index',['type'=>'FormWork']) }}">
                    <span class="material-symbols-outlined">arrow_right</span>Hình Thức Làm Việc
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-label">Giao dịch</li>
    <li>
        <a class="has-arrow" aria-expanded="false" href="javascript:;">
            <div class="parent-icon">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="menu-title">Giao dịch</div>
        </a>
        <ul class="mm-collapse">
            <li>
                <a href="{{ route('admin.transactions') }}">
                    <span class="material-symbols-outlined">arrow_right</span>Danh sách</a>
            </li>
        </ul>
    </li>
    <li class="menu-label">Hệ Thống</li>
    <li>
        <a class="has-arrow" aria-expanded="false" href="javascript:;">
            <div class="parent-icon">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <div class="menu-title">Tài Khoản</div>
        </a>
        <ul class="mm-collapse">
            <li>
                <a href="{{ route('adminuser.index') }}">
                    <span class="material-symbols-outlined">arrow_right</span>Quản Trị Viên</a>
            </li>
            <li>
                <a href="{{ route('adminuser.index') }}">
                    <span class="material-symbols-outlined">arrow_right</span>Nhóm</a>
            </li>
        </ul>
    </li>
</ul>
<!--end navigation-->