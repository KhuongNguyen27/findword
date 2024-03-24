<!-- Top Companies -->
<section class="top-companies pt-5 pb-5">
    <div class="auto-container">
        <div class="ls-outer theme-card">
            <div class="ls-switcher theme-card-header">
                <div class="sec-title mb-3 mt-3">
                    <h2 class="">Top công ty hàng đầu</h2>
                </div>
                <a href="{{ route('website.home') }}" class="mb-3 mt-3">
                    <span class="btn-title text-uppercase">Xem tất cả</span>
                </a>
            </div>
            <div class="theme-card-body">
                <div class="carousel-outer wow fadeInUp">
                    <div class="companies-carousel owl-carousel owl-theme default-dots">
                        @foreach ($employees as $employee)
                        <!-- Company Block -->
                        <div class="company-block">
                            <div class="inner-box">
                                <a href="{{ route('employee.show', ['id' => $employee->slug]) }}">
                                    <figure class="image"><img src="{{ $employee->image_fm }}" alt=""></figure>
                                    <h4 class="name">{{ $employee->name }}</h4>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Top Companies -->