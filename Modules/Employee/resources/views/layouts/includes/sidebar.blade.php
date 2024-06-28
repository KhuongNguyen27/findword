<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop"></div>

<!-- User Sidebar -->
<div class="user-sidebar">

    <div class="sidebar-inner">
    <ul class="navigation">
        
    <li><a href="{{ route('employee.home')}}"> <i class="la la-home"></i>{{ __('dashboard') }}</a></li>
    <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>{{ __('profile') }}</a></li>
    <li><a href="{{ route('employee.job.create')}}"><i class="la la-paper-plane"></i>Đăng tin</a></li>
    <li>
        <a href="#" class="dropdown-toggle"><i class="la la-user-tie"></i>Ứng viên</a>
        <ul class="sub-menu">
            <li><a href=""><i class="la la-file-invoice"></i>UV nộp đơn (0)</a></li>
            <li><a href=""><i class="la la-bookmark-o"></i>UV giới thiệu (0)</a></li>
            <li><a href=""><i class="la la-box"></i>UV đã xem (0)</a></li>
            <li><a href=""><i class="la la-comment-o"></i>UV đã lưu (0) </a></li>
        </ul>
    </li>
    <li><a href="{{ route('employee.job.index')}}"><i class="la la-briefcase"></i>{{ __('work_manager') }}</a></li>
    <!-- <li><a href="{{ route('employee.cv.index')}}"><i class="la la-box"></i>{{ __('cv_manager') }}</a></li> -->
    <li><a href="{{ route('employee.transaction.index')}}"><i class="la la-box"></i>{{ __('transaction_manager') }}</a></li>
    <li><a href="{{ route('employee.profile.editpassword')}}"><i class="la la-box"></i>{{ __('change_password') }}</a></li>
    <li><a href="{{ route('employee.logout')}}"><i class="la la-sign-out"></i>{{ __('logout') }}</a></li>
</ul>

    </div>
</div>
<style>
    .navigation .sub-menu {
    display: none;
    padding-left: 20px;
}

.navigation .sub-menu.active {
    display: block;
}

/* .dropdown-toggle::after {
    float: right;
    margin-left: 5px;
} */

/* .navigation .dropdown-toggle.active {
    color: red; 
} */


</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var navigationLinks = document.querySelectorAll('.user-sidebar .navigation a');

    navigationLinks.forEach(function(link) {
        // Add 'active' class to the link if the current URL matches the link's href
        if (link.getAttribute('href') === window.location.href) {
            link.parentElement.classList.add('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const subMenu = this.nextElementSibling;
            if (subMenu) {
                subMenu.classList.toggle('active');
                this.classList.toggle('active');
            }
        });
    });
});

</script>
<!-- End User Sidebar -->