 <!-- News Section -->
 <section class="news-section pt-5 pb-5">
     <div class="auto-container">
         <div class="sec-title text-center">
             <h2>{{ __('career_guide') }}</h2>
             <!-- <div class="text">Fresh job related news content posted each day.</div> -->
         </div>

         <div class="row wow fadeInUp">
             <!-- News Block -->
             <div class="news-block col-lg-4 col-md-6 col-sm-12">
                 <div class="inner-box">
                     <div class="image-box">
                         <figure class="image"><img src="images/resource/news-1.jpg" alt="" /></figure>
                     </div>
                     <div class="lower-content">
                         <ul class="post-meta">
                            <li><a href="#">{{ now()->format('d / n / Y') }}</a></li>
                             <li><a href="#">12 {{ __('comment') }}</a></li>
                         </ul>
                         <h3><a href="blog-single.html">{{ __('attract_sales_and_profits') }}</a></h3>
                         <p class="text">Nâng cao năng lực</p>
                         <a href="#" class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                     </div>
                 </div>
             </div>

             <!-- News Block -->
             <div class="news-block col-lg-4 col-md-6 col-sm-12">
                 <div class="inner-box">
                     <div class="image-box">
                         <figure class="image"><img src="images/resource/news-2.jpg" alt="" /></figure>
                     </div>
                     <div class="lower-content">
                         <ul class="post-meta">
                            <li><a href="#">{{ now()->format('d / n / Y') }}</a></li>
                             <li><a href="#">12 {{ __('comment') }}</a></li>
                         </ul>
                         <h3><a href="blog-single.html">5 {{ __('tips_for_your_job_interviews') }}</a></h3>
                         <p class="text">1. {{ __('calm') }}</p>
                         <p class="text">2. {{ __('neat_uniform') }}</p>
                         <a href="#" class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                     </div>
                 </div>
             </div>

             <!-- News Block -->
             <div class="news-block col-lg-4 col-md-6 col-sm-12">
                 <div class="inner-box">
                     <div class="image-box">
                         <figure class="image"><img src="images/resource/news-3.jpg" alt="" /></figure>
                     </div>
                     <div class="lower-content">
                         <ul class="post-meta">
                            <li><a href="#">{{ now()->format('d / n / Y') }}</a></li>
                             <li><a href="#">12 {{ __('comment') }}</a></li>
                         </ul>
                         <h3><a href="blog-single.html"></a></h3>
                         <p class="text"></p>
                         <a href="#" class="read-more">{{ __('read_more') }}<i class="fa fa-angle-right"></i></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- End News Section -->