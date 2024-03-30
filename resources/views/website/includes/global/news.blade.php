 <!-- News Section -->
 <section class="news-section pt-5 pb-5">
     <div class="auto-container">
         <div class="sec-title text-center">
             <h2>{{ __('career_guide') }}</h2>
             <!-- <div class="text">Fresh job related news content posted each day.</div> -->
         </div>

         <div class="row wow fadeInUp">
             <!-- News Block -->
             @foreach( $shared_posts as $post )
             <div class="news-block col-lg-4 col-md-6 col-sm-12">
                 <div class="inner-box">
                     <div class="image-box">
                         <figure class="image"><img src="{{ $post->image_fm }}" alt="" /></figure>
                     </div>
                     <div class="lower-content">
                         <h3><a href="{{ route('posts.show',$post->slug) }}">{{ $post->name }}</a></h3>
                         <p class="text">{!! $post->short_description !!}</p>
                         <a href="{{ route('posts.show',$post->slug) }}" class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                     </div>
                 </div>
             </div>
            @endforeach
            
         </div>
     </div>
 </section>
 <!-- End News Section -->