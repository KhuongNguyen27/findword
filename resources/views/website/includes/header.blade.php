@php
$currentRouteName = \Request::route()->getName();
@endphp
<style>
{{-- span.material-symbols-outlined {
    margin-left: 12px;
    margin-top: 3px;
} --}}

#mark-all-read {
cursor: pointer; /* Đổi con trỏ thành pointer khi hover */
}

#mark-all-read:hover {
color: #0A58CA; /* Thay đổi màu chữ thành màu xanh khi hover */
}

.dropdown-toggle::after {
display: inline-block;
margin-left: .255em;
vertical-align: .255em;
border-top: 0px !important;
border-right: 0px !important;
border-bottom: 0;
border-left: .3em solid transparent;
}
.nav-link {
font-size: 22px;
cursor: pointer;
width: 35px;
height: 35px;
background-color: #ffffff;
display: flex;
align-items: center;

color: #212529;
border-radius: 50%;
{{-- border: 1px solid #dee2e6; --}}
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
            <style>
                .btn-groupz .dropdown-content {
                    display: none;
                    position: absolute;
                    background-color: white;
                    min-width: 50px;
                    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
                    z-index: 1;
                }

                .btn-groupz:hover .dropdown-content {
                    display: block;
                }

                .btn-groupz .dropdown-content ul {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .btn-groupz .dropdown-content ul li {
                    padding: 8px 10px;
                }

                .btn-groupz .dropdown-content ul li a {
                    display: flex;
                    align-items: center;
                    text-decoration: none;
                }

                .btn-groupz .dropdown-content ul li a img {
                    margin-right: 5px;
                }

                .flag-icon {
                    width: 24px;
                    height: auto;
                    transition: width 0.3s ease-in-out;
                }

                .btn-lang .flag-icon {
                    width: 32px;
                    /* Kích thước lớn hơn cho lá cờ được chọn */
                }

                .dropdown-content .flag-icon {
                    width: 24px;
                }

                /* Ẩn phần tử chứa logo và liên kết của Google Dịch */
                #google_translate_element .VIpgJd-ZVi9od-l4eHX-hSRGPd {
                    display: none !important;
                }

            </style>

            <!-- Thay đổi phần header để bao gồm ngôn ngữ -->
            <div class="btn-groupz btn-groupz-empty dropdown">
                <div class="btn-lang">
                    @if(session('locale') == 'en')
                    <img class="flag-icon" src="{{ asset('storage/images/gb.svg') }}" alt="flag-en">
            @elseif(session('locale') == 'vi')
            <img class="flag-icon" src="{{ asset('storage/images/vn.svg') }}" alt="flag-vn">
            @elseif(session('locale') == 'ja')
            <img class="flag-icon" src="{{ asset('storage/images/jp.svg') }}" alt="flag-jp">
            @elseif(session('locale') == 'ko')
            <img class="flag-icon" src="{{ asset('storage/images/hq.png') }}" alt="flag-kr">
            @else
            <!-- Hiển thị cờ mặc định nếu không có ngôn ngữ nào được chọn -->
            <img class="flag-icon" src="{{ asset('storage/images/gb.svg') }}" alt="flag-en">
            @endif
        </div>
        <span class="caret"></span>
        <div class="dropdown-content dropdown__content--lang">
            <ul class="drop-menu-em animate slideIn" role="menu">
                @if(session('locale') != 'en')
                <li>
                    <a href="{{ route('changeLang', ['lang' => 'en']) }}">
                        <img class="flag-icon" src="{{ asset('storage/images/gb.svg') }}" alt="flag-en">
                        English
                    </a>
                </li>
                @endif
                @if(session('locale') != 'vi')
                <li>
                    <a href="{{ route('changeLang', ['lang' => 'vi']) }}">
                        <img class="flag-icon" src="{{ asset('storage/images/vn.svg') }}" alt="flag-vn">
                        Vietnamese
                    </a>
                </li>
                @endif
                @if(session('locale') != 'ja')
                <li>
                    <a href="{{ route('changeLang', ['lang' => 'ja']) }}">
                        <img class="flag-icon" src="{{ asset('storage/images/jp.svg') }}" alt="flag-jp">
                        Japanese
                    </a>
                </li>
                @endif
                @if(session('locale') != 'ko')
                <li>
                    <a href="{{ route('changeLang', ['lang' => 'ko']) }}">
                        <img class="flag-icon" src="{{ asset('storage/images/hq.png') }}" alt="flag-kr">
                        Korean
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div> 

   
    {{-- <div class="row">
        <div class="col-4">

            <div id="google_translate_element"></div>
        </div>
    </div>

     <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement(
                    {pageLanguage: 'en'},
                    'google_translate_element'
                );
            }
    </script> 
     

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', 
                includedLanguages: 'vi,en,ja,ko', 
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script> --}}


    <!-- Notification -->
    @if(Auth::user()->type !== "user")
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined">
    <div class="dropdown nav-item dropdown-large">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
            <div class="position-relative">
                <span class="notify-badge"></span>
                <span class="material-symbols-outlined">notifications_none</span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-lg-2">
            <a href="javascript:;">
                <div class="msg-header">
                    <p class="msg-header-title">Thông báo</p>
                    <p class="msg-header-clear ms-auto" id="mark-all-read">Đánh dấu tất cả là đã đọc</p>
                </div>
            </a>
            <div class="header-notifications-list"> </div>
            <a href="javascript:;">
                <div class="text-center msg-footer"></div>
            </a>
        </div>
    </div>
    @endif

    <script>
        document.getElementById('mark-all-read').addEventListener('click', function() {
            fetch('{{ route('notifications.markAllRead') }}', {
                        method: 'POST'
                        , headers: {
                            'Content-Type': 'application/json'
                            , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.header-notifications-list .dropdown-item').forEach(item => {
                            item.classList.add('read'); // Thêm class để đánh dấu là đã đọc (nếu cần)
                        });
                        document.querySelector('.notify-badge').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

    </script>


    <div class="dropdown dashboard-option">
        <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span>{{ __('header.hi') }},{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
            @if(Auth::user()->type == 'staff')
            <li class="@if($currentRouteName == 'staff.home') active @endif"><a href="{{ route('staff.home')}}"><i class="la la-box"></i>Bảng điều khiển</a></li>
            <li class="@if($currentRouteName == 'staff.profile.index' || $currentRouteName == 'staff.home1') active @endif">
                <a href="{{ route('staff.profile.index')}}"> <i class="la la-user-alt"></i>Thông tin cá
                    nhân</a>
            </li>
            <li class="@if($currentRouteName == 'staff.cv.index') active @endif"><a href="{{ route('staff.cv.index')}}"><i class="la la-box"></i>Danh sách hồ sơ</a></li>
            <li class="@if($currentRouteName == 'staff.favorite') active @endif"><a href="{{ route('staff.favorite')}}"><i class="la la-bookmark-o"></i>Việc làm đã lưu</a>
            </li>
            <li class="@if($currentRouteName == 'staff.job-applied') active @endif"><a href="{{ route('staff.job-applied')}}"><i class="la la-briefcase"></i>Việc làm đã
                    nộp</a>
            </li>
            @endif
            @if(Auth::user()->type == 'employee')
            <li class="@if($currentRouteName == 'employee.home') active @endif"><a href="{{ route('employee.home')}}"><i class="la la-box"></i>Bảng điều khiển</a>
            <li>
            <li><a href="{{ route('employee.profile.index')}}"><i class="la la-user-tie"></i>Hồ sơ</a></li>
            <li><a href="{{ route('employee.job.create')}}"><i class="la la-paper-plane"></i>Đăng Tin</a></li>
            <li><a href="{{ route('employee.job.index')}}"><i class="la la-briefcase"></i> Quản lý công việc
                </a></li>
            <li><a href="{{ route('employee.cv.index')}}"><i class="la la-box"></i>Quản lý CV</a></li>
            <li><a href="{{ route('employee.transaction.index')}}"><i class="la la-box"></i>Quản lý giao
                    dịch</a></li>
            @endif
            <li class="@if($currentRouteName == 'auth.logout') active @endif"><a href="{{ route('auth.logout')}}"><i class="la la-sign-out"></i>Đăng xuất</a></li>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    var url = "{{ route('changeLang')}}";
    $('.changeLang').change(function(event) {
        window.location.href = url + "?lang=" + $(this).val();
    });

</script>
