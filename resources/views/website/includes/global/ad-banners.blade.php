<section class="top-companies pt-5 pb-5">
    <div class="auto-container">
        <div class="carousel-outer wow fadeInUp">
            <div class="companies-carousel owl-carousel owl-theme default-dots">
                @foreach($bottomBanners as $banner)
                    <div class="company-block-item">
                        <figure class="image">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->name }}">
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
