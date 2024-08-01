<div class="hero-banner mt-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide">
                <a href="{{ $banner->link }}" target="_blank">
                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->name }}">
                </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.mySwiper', {
        loop: true, // Enable loop mode
        autoplay: {
            delay: 2000, // Delay between slides in milliseconds
            disableOnInteraction: false, // Continue autoplay after user interactions
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
