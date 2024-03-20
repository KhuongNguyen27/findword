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
                        <div class="news-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image" style="height: 200px;">
                                        <a href="{{ route('employee.show', ['id' => $item->slug]) }}">
                                            <img src="{{ $item->image_fm }}" alt="">
                                        </a>    
                                    </figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('employee.show', ['id' => $item->slug]) }}">{{ $item->name }}</a></h3>
                                    <p class="text">Tất cả những việc làm hot nhất tại công ty {{ $item->name }}. Công ty {{ $item->name }} lọt vào danh sách này dựa trên những tiêu chí Chất lượng sản phẩm - Môi trường làm việc - Chế độ đãi ngộ - Khả năng học hỏi do TopCV đánh giá, để đảm bảo rằng đây là nơi làm việc tốt nhất dành cho bạn</p>
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