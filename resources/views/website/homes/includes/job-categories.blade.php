<section class="job-categories pt-3 pb-3">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2 class="">{{ __('content.top_nganh_nghe_noi_bat') }}</h2>
            <div class="text">{{ __('content.ban_muon_tim_viec_moi') }}</div>
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
                                        <p>{{ $career->jobs->count() ?? 0 }} {{ __('content.viec_lam') }}</p>
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