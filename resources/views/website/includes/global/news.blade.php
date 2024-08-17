 <style>
    .news-block .image-box img {
    display: block;
    width: 100%;
    transition: all 300ms ease;
    object-fit: fill !important;
    height: 190px;
}
 </style>
 <section class="news-section pt-5 pb-5">
     <div class="auto-container">
         <div class="ls-outer theme-card">
             <div class="ls-switcher theme-card-header">
                 <div class="sec-title mb-3 mt-3">
                     <h2>{{ __('career_guide') }}</h2>
                 </div>
                 <!-- <a href="{{ route('website.home') }}" class="mb-3 mt-3">
                     <span class="btn-title text-uppercase">Xem tất cả</span>
                 </a> -->
             </div>
         </div>
         <div class="theme-card-body">
             <div class="carousel-outer wow fadeInUp">
                 <div class="companies-carousel owl-carousel owl-theme default-dots">
                     @foreach( $careerGuidePosts as $post )
                     <div class="company-block-item news-block">
                         <div class="inner-box">
                             <div class="image-box">
                                 <figure class="image"><img src="{{ $post->image_fm }}" alt="" /></figure>
                             </div>
                             <div class="lower-content">
                                 <h3 class="two-line-ellipsis"><a
                                         href="{{ route('posts.show',$post->slug) }}">{{ $post->name }}</a></h3>
                                 <p class="text">{!! $post->short_description !!}</p>
                                 <a href="{{ route('posts.show',$post->slug) }}"
                                     class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                             </div>
                         </div>
                     </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>

  <section class="news-section pt-5 pb-5">
     <div class="auto-container">
         <div class="ls-outer theme-card">
             <div class="ls-switcher theme-card-header">
                 <div class="sec-title mb-3 mt-3">
                     <h2>Góc Giải Trí</h2>
                 </div>
                 <!-- <a href="{{ route('website.home') }}" class="mb-3 mt-3">
                     <span class="btn-title text-uppercase">Xem tất cả</span>
                 </a> -->
             </div>
         </div>
         <div class="theme-card-body">
             <div class="carousel-outer wow fadeInUp">
                 <div class="companies-carousel owl-carousel owl-theme default-dots">
                     @foreach( $entertainmentPosts as $post )
                     <div class="company-block-item news-block">
                         <div class="inner-box">
                             <div class="image-box">
                                 <figure class="image"><img src="{{ $post->image_fm }}" alt="" /></figure>
                             </div>
                             <div class="lower-content">
                                 <h3 class="two-line-ellipsis"><a
                                         href="{{ route('posts.show',$post->slug) }}">{{ $post->name }}</a></h3>
                                 <p class="text">{!! $post->short_description !!}</p>
                                 <a href="{{ route('posts.show',$post->slug) }}"
                                     class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                             </div>
                         </div>
                     </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>