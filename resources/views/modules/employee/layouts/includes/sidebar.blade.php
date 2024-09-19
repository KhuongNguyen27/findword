<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop"></div>
<style>
.dropdown-toggle #totalApplicants {
    background-color: #ff0000;
    padding: 0px 11px;
    border-radius: 38px;
    color: #fff;
    margin-left: 7px;
}

.dropdown-toggle::after {
    margin-left: 3.255em;
}
.notification-badge {
    background-color: #ff0000;
    padding: 0px 11px;
    border-radius: 38px;
    color: #fff;
    margin-left: 7px;
    font-size: 12px; /* Adjust size as needed */
}
</style>

<!-- User Sidebar -->
<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li><a href="{{ route('employee.home') }}"> <i class="la la-home"></i>{{ __('dashboard') }}</a></li>
            <li><a href="{{ route('employee.profile.index') }}"><i class="la la-user-tie"></i>{{ __('profile') }}</a>
            </li>
            <li><a href="{{ route('employee.job.create') }}"><i class="la la-paper-plane"></i>Đăng tin</a></li>
            <li>
                <a href="#" class="dropdown-toggle"><i class="la la-users"></i> Ứng viên <span
                        id="totalApplicants">0</span></a>
                <ul class="sub-menu">
                    <li><a class="{{ (request()->route()->getName() == 'employee.applied.jobs') ? 'active-li mt-1' : '' }}"
                            href="{{ route('employee.applied.jobs') }}"><i class="la la-file-invoice"></i>
                            UV nộp đơn (<span id="appliedCount">{{ $appliedCount }}</span>)</a></li>
                    <li><a class="{{ (request()->route()->getName() == 'employee.referred.jobs') ? 'active-li' : '' }}"
                            href="{{ route('employee.referred.jobs') }}"><i class="la la-user-friends"></i> UV giới thiệu
                            (<span id="referredCount">{{ $referredCount }}</span>)</a></li>
                    <li><a class="{{ (request()->route()->getName() == 'employee.viewed.jobs') ? 'active-li' : '' }}"
                            href="{{ route('employee.viewed.jobs') }}"><i class="la la-eye"></i> UV đã
                            xem
                            (<span id="viewedCount">{{ $viewedCount }}</span>)</a></li>
                    <li><a class="{{ (request()->route()->getName() == 'employee.saved') ? 'active-li' : '' }}"
                            href="{{ route('employee.saved') }}"><i class="la la-bookmark"></i> UV
                            đã
                            lưu (<span id="savedCount">{{ $savedCount }}</span>)</a></li>
                </ul>
            </li>
            <style>
            .active-li {
                color: #28c1bc;
                background: rgba(25, 103, 210, 0.1);
            }
            </style>
            <li><a href="{{ route('employee.job.index') }}"><i class="la la-briefcase"></i>{{ __('work_manager') }}</a>
            </li>
            <li><a href="{{ route('employee.transaction.index') }}"><i
                        class="la la-box"></i>{{ __('transaction_manager') }}</a></li>
            <li><a href="{{ route('employee.profile.editpassword') }}"><i
                        class="la la-box"></i>{{ __('change_password') }}</a></li>


            {{-- @php
                $admin = App\Models\User::where('type', 'user')->first();
            @endphp

            @if($admin)
            <li>
                <a href="{{ route('messages.index', $admin->id) }}">
                    <i class="la la-envelope"></i>
                    Tin nhắn 
                    @if($unreadMessagesCount > 0)
                        <span id="totalMessages" class="notification-badge">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
            </li>
            @endif --}}


            <li><a href="{{ route('employee.logout') }}"><i class="la la-sign-out"></i>{{ __('logout') }}</a></li>
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

.navigation .dropdown-toggle.active {
    color: #28c1bc;
    /* hoặc màu bạn muốn */
    background: rgba(25, 103, 210, 0.1);
}

.navigation .dropdown-toggle.active i {
    color: #28c1bc;
    /* hoặc màu bạn muốn */
}

.user-sidebar .navigation li.active a i,
.user-sidebar .navigation li:hover a i {
    color: #28c1bc;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var navigationLinks = document.querySelectorAll('.user-sidebar .navigation a');

    navigationLinks.forEach(function(link) {
        // Add 'active' class to the link if the current URL matches the link's href
        if (link.href === window.location.href) {
            link.parentElement.classList.add('active');

            // Nếu liên kết này nằm trong một sub-menu, hiển thị sub-menu đó
            var parentMenu = link.closest('.sub-menu');
            if (parentMenu) {
                parentMenu.classList.add('active');
                var dropdownToggle = parentMenu.previousElementSibling;
                if (dropdownToggle && dropdownToggle.classList.contains('dropdown-toggle')) {
                    dropdownToggle.classList.add('active');
                }
            }
        }
    });

    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const subMenu = this.nextElementSibling;
            if (subMenu) {
                subMenu.classList.toggle('active');
                this.classList.toggle('active');
            }
        });
    });
    // Calculate total applicants count
    var appliedCount = parseInt(document.getElementById('appliedCount').innerText);
    var viewedCount = parseInt(document.getElementById('viewedCount').innerText);
    var savedCount = parseInt(document.getElementById('savedCount').innerText);
    var referredCount = parseInt(document.getElementById('referredCount').innerText);

    var totalApplicants = appliedCount + viewedCount + referredCount + savedCount;
    document.getElementById('totalApplicants').innerText = totalApplicants;
});
</script>
<!-- End User Sidebar -->