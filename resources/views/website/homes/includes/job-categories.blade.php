<section class="job-categories pt-5 pb-5">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2 class="">Top ngành nghề nổi bật</h2>
            <div class="text">Bạn muốn tìm việc mới? Xem danh sách việc làm tại đây</div>
        </div>

        <div class="theme-card-body">
            <div class="swiper jobCategoriesSwiper">
                <div class="swiper-wrapper">
                    @foreach( $job_categories as $careers )
                    <div class="swiper-slide">
                        <div class="row">
                            @foreach ($careers as $career)
                            <!-- Category Block -->
                            <div class="category-block col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="content">
                                        <span class="icon">
                                            <img src="{{ $career->image }}" alt="">
                                        </span>
                                        <h4><a href="{{ route('careers.show',$career->slug) }}">{{ $career->name }}</a>
                                        </h4>
                                        <p>{{ $career->jobs->count() ?? 0 }} việc làm</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>