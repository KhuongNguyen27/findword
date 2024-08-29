@extends('website.layouts.master')
@section('content')
<style>
span.logo-trending {
    margin-right: 0px !important;
}
</style>
    <section class="banner-section pb-5">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box">
                            <h1>Khám phá 100.000+ công ty nổi bật</h1>
                            <div class="text">Tra cứu thông tin công ty và tìm kiếm nơi làm việc tốt nhất dành cho bạn
                            </div>
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
                            @foreach ($items as $item)
                                <div class="candidate-block-four col-lg-4 col-md-6 col-sm-12">
                                    @include('website.employees.includes.employ-item')
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="ls-pagination">
                            {{ $items->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
