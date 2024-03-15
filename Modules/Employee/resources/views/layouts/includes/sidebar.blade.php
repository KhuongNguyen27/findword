<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop"></div>

<!-- User Sidebar -->
<div class="user-sidebar">

    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="active"><a href="{{ route('employee.home')}}"> <i class="la la-home"></i> Bảng điều khiển</a>
            </li>
            <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>Hồ sơ</a></li>
            <li><a href="{{ route('employee.job.create')}}"><i class="la la-paper-plane"></i>Đăng tin</a></li>
            <li><a href="{{ route('employee.job.index')}}"><i class="la la-briefcase"></i> Quản lý công việc </a></li>
            <li><a href="{{ route('employee.cv.index')}}"><i class="la la-box"></i>Quản lý CV</a></li>
            <li><a href="{{ route('employee.transaction.index')}}"><i class="la la-box"></i>Quản lý giao dịch</a></li>
            <li><a href="{{ route('employee.profile.editpassword')}}"><i class="la la-box"></i>Đổi mật khẩu</a></li>
            <li><a href="{{ route('employee.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
            {{-- <li><a href="{{ route('aplicants.index')}}"><i class="la la-file-invoice"></i> Tất cả ứng viên</a></li>
            <li><a href="{{ route('Shortlisteds.index')}}"><i class="la la-bookmark-o"></i>Sơ yếu lý lịch lọt vào danh
                    sách</a></li>
            <li><a href="{{ route('pakages.index')}}"><i class="la la-box"></i>Gói</a></li>
            <li><a href="{{ route('messages.index')}}"><i class="la la-comment-o"></i>Tin nhắn</a></li>
            <li><a href="{{ route('resume-alerts.index')}}"><i class="la la-bell"></i>Tiếp tục cảnh báo</a></li>
            <li><a href="{{ route('change-password.index')}}"><i class="la la-lock"></i>Đổi mật khẩu</a></li>
            <li><a href="{{ route('staff.profile.index')}}"><i class="la la-user-alt"></i>Xem hồ sơ</a></li>
            <li><a href="index.html"><i class="la la-trash"></i>Xóa hồ sơ</a></li> --}}
        </ul>
    </div>
</div>
<!-- End User Sidebar -->