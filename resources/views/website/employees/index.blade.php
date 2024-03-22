@extends('website.layouts.master')
@section('content')

<!-- Banner Section-->
<style>
span.flaticon-bookmark.active {
    color: red;
}
</style>
<section class="banner-section pb-5">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="title-box">
                        <h3>Khám phá 100.000+ công ty nổi bật</h3>
                        <div class="text">Tra cứu thông tin công ty và tìm kiếm nơi làm việc tốt nhất dành cho bạn</div>
                    </div>
                    <!-- Job Search Form -->
                    @include('website.employees.includes.search-form')
                    <!-- Job Search Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Section-->

<section class="ls-section pt-5 pb-5">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>DANH SÁCH CÁC CÔNG TY NỔI BẬT</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid">
                    <div class="row">
                        @foreach( $items as $item )
                        <div class="candidate-block-four col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <ul class="job-other-info">
                                    <li class="green">Nỗi bật</li>
                                </ul>
                                <div class="cover-wrapper">
                                    <span class="thumb-cover">
                                        <img src="https://www.vietnamworks.com/_next/image?url=https%3A%2F%2Fimages02.vietnamworks.com%2Fcompanyprofile%2Fnull%2Fen%2F%E1%BA%A2nh_b%C3%ACa_m%E1%BB%9Bi.png&w=1920&q=75"
                                            alt="">
                                    </span>
                                    <span class="thumb"><img src="{{ $item->image_fm }}" alt=""></span>
                                </div>
                                <div class="name-wrapper">
                                    <h3 class="name">
                                        <a href="{{ route('employee.show', ['id' => $item->slug]) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h3>
                                    <ul class="job-info">
                                        <li>
                                            <span class="icon">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 0px;"><g clip-path="url(#clip0_533_6629)"><path d="M4.02887 4C3.19226 4 2.51464 4.67762 2.51464 5.51423V7.78557V9.29979H16.8998H20.6854V7.02845C20.6854 6.19184 20.0077 5.51423 19.1711 5.51423H9.47949L9.01221 4.73493C8.73889 4.27915 8.24613 4 7.71388 4H4.02887ZM2.13757 10.814C1.37364 10.814 0.82659 11.554 1.0507 12.2839L3.29837 19.5874C3.49447 20.2226 4.08131 20.6565 4.74606 20.6565H11.6H18.4539C19.1187 20.6565 19.7055 20.2226 19.9016 19.5874L22.1493 12.2839C22.3734 11.554 21.8264 10.814 21.0624 10.814H11.6H2.13757Z" fill="#888"></path></g><defs><clipPath id="clip0_533_6629"><rect width="24" height="24" fill="white"></rect></clipPath></defs></svg>
                                            </span> London, UK
                                        </li>
                                        <li>
                                            <span class="icon">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2 2.40002C10.316 2.40002 9.59998 3.11602 9.59998 4.00002H3.19998C2.31598 4.00002 1.59998 4.71602 1.59998 5.60002V12.8C1.59998 13.684 2.31598 14.4 3.19998 14.4H20.8C21.684 14.4 22.4 13.684 22.4 12.8V5.60002C22.4 4.71602 21.684 4.00002 20.8 4.00002H14.4C14.4 3.11602 13.684 2.40002 12.8 2.40002H11.2ZM12 11.2C12.4416 11.2 12.8 11.5584 12.8 12C12.8 12.4416 12.4416 12.8 12 12.8C11.5584 12.8 11.2 12.4416 11.2 12C11.2 11.5584 11.5584 11.2 12 11.2ZM1.59998 15.5547V18.4C1.59998 19.284 2.31598 20 3.19998 20H20.8C21.684 20 22.4 19.284 22.4 18.4V15.5547C21.9272 15.8299 21.3856 16 20.8 16H3.19998C2.61438 16 2.07278 15.8299 1.59998 15.5547Z" fill="#888"></path></svg>
                                            </span> 
                                            $99 / hour
                                        </li>
                                    </ul>
                                    <a href="{{ route('employee.show', ['id' => $item->slug]) }}"
                                        class="theme-btn btn-style-three">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Pagination -->
                    <nav class="ls-pagination">
                        {{ $items->appends(request()->input())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection