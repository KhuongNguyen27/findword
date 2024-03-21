@extends('website.layouts.master')
@section('content')
<section class="job-real-detail-section job-detail-section pt-5">
    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="job-block-outer">
                        <!-- Job Block -->
                        <div class="job-block-seven style-two">
                            <div class="inner-box">
                                <div class="content">
                                    <h1 class="job-detail-title">
                                        <a href="{{ route('website.jobs.show',$job->slug) }}">{{ $job->name }}</a>
                                    </h1>
                                    <div class="job-detail__info--sections">
                                        <div class="job-detail__info--section">
                                            <div class="job-detail__info--section-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21.92 16.75C21.59 19.41 19.41 21.59 16.75 21.92C15.14 22.12 13.64 21.68 12.47 20.82C11.8 20.33 11.96 19.29 12.76 19.05C15.77 18.14 18.14 15.76 19.06 12.75C19.3 11.96 20.34 11.8 20.83 12.46C21.68 13.64 22.12 15.14 21.92 16.75Z" fill="white"></path>
                                                    <path d="M9.99 2C5.58 2 2 5.58 2 9.99C2 14.4 5.58 17.98 9.99 17.98C14.4 17.98 17.98 14.4 17.98 9.99C17.97 5.58 14.4 2 9.99 2ZM9.05 8.87L11.46 9.71C12.33 10.02 12.75 10.63 12.75 11.57C12.75 12.65 11.89 13.54 10.84 13.54H10.75V13.59C10.75 14 10.41 14.34 10 14.34C9.59 14.34 9.25 14 9.25 13.59V13.53C8.14 13.48 7.25 12.55 7.25 11.39C7.25 10.98 7.59 10.64 8 10.64C8.41 10.64 8.75 10.98 8.75 11.39C8.75 11.75 9.01 12.04 9.33 12.04H10.83C11.06 12.04 11.24 11.83 11.24 11.57C11.24 11.22 11.18 11.2 10.95 11.12L8.54 10.28C7.68 9.98 7.25 9.37 7.25 8.42C7.25 7.34 8.11 6.45 9.16 6.45H9.25V6.41C9.25 6 9.59 5.66 10 5.66C10.41 5.66 10.75 6 10.75 6.41V6.47C11.86 6.52 12.75 7.45 12.75 8.61C12.75 9.02 12.41 9.36 12 9.36C11.59 9.36 11.25 9.02 11.25 8.61C11.25 8.25 10.99 7.96 10.67 7.96H9.17C8.94 7.96 8.76 8.17 8.76 8.43C8.75 8.77 8.81 8.79 9.05 8.87Z" fill="white"></path>
                                                </svg>
                                            </div>
                                            <div class="job-detail__info--section-content">
                                                <div class="job-detail__info--section-content-title">Mức lương</div>
                                                <div class="job-detail__info--section-content-value">
                                                    {{ auth()->check() ? $job->wage->name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-detail__info--section">
                                            <div class="job-detail__info--section-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                                    <path d="M21.2866 8.45C20.2366 3.83 16.2066 1.75 12.6666 1.75C12.6666 1.75 12.6666 1.75 12.6566 1.75C9.1266 1.75 5.0866 3.82 4.0366 8.44C2.8666 13.6 6.0266 17.97 8.8866 20.72C9.9466 21.74 11.3066 22.25 12.6666 22.25C14.0266 22.25 15.3866 21.74 16.4366 20.72C19.2966 17.97 22.4566 13.61 21.2866 8.45ZM12.6666 13.46C10.9266 13.46 9.5166 12.05 9.5166 10.31C9.5166 8.57 10.9266 7.16 12.6666 7.16C14.4066 7.16 15.8166 8.57 15.8166 10.31C15.8166 12.05 14.4066 13.46 12.6666 13.46Z" fill="white"></path>
                                                </svg>
                                            </div>
                                            <div class="job-detail__info--section-content">
                                                <div class="job-detail__info--section-content-title">Địa điểm</div>
                                                <div class="job-detail__info--section-content-value">{{ $job->work_address }}</div>
                                            </div>
                                        </div>
                                        <div class="job-detail__info--section" id="job-detail-info-experience">
                                            <div class="job-detail__info--section-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.39 15.67L13.35 12H10.64L6.59998 15.67C5.46998 16.69 5.09998 18.26 5.64998 19.68C6.19998 21.09 7.53998 22 9.04998 22H14.94C16.46 22 17.79 21.09 18.34 19.68C18.89 18.26 18.52 16.69 17.39 15.67ZM13.82 18.14H10.18C9.79998 18.14 9.49998 17.83 9.49998 17.46C9.49998 17.09 9.80998 16.78 10.18 16.78H13.82C14.2 16.78 14.5 17.09 14.5 17.46C14.5 17.83 14.19 18.14 13.82 18.14Z" fill="white"></path>
                                                    <path d="M18.35 4.32C17.8 2.91 16.46 2 14.95 2H9.04998C7.53998 2 6.19998 2.91 5.64998 4.32C5.10998 5.74 5.47998 7.31 6.60998 8.33L10.65 12H13.36L17.4 8.33C18.52 7.31 18.89 5.74 18.35 4.32ZM13.82 7.23H10.18C9.79998 7.23 9.49998 6.92 9.49998 6.55C9.49998 6.18 9.80998 5.87 10.18 5.87H13.82C14.2 5.87 14.5 6.18 14.5 6.55C14.5 6.92 14.19 7.23 13.82 7.23Z" fill="white"></path>
                                                </svg>
                                            </div>
                                            <div class="job-detail__info--section-content">
                                                <div class="job-detail__info--section-content-title">Kinh nghiệm</div>
                                                <div class="job-detail__info--section-content-value">{{ $job->experience ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job-detail">
                        <h4 class="job-sub-title">Chi tiết tuyển dụng </h4>
                        <p>As a Product Designer, you will work within a Product Delivery Team fused with UX,
                            engineering, product and data talent. You will help the team design beautiful interfaces
                            that solve business challenges for our clients. We work with a number of Tier 1 banks on
                            building web-based applications for AML, KYC and Sanctions List management workflows. This
                            role is ideal if you are looking to segue your career into the FinTech or Big Data arenas.
                        </p>
                        <h4>Key Responsibilities</h4>
                        <ul class="list-style-three">
                            <li>Be involved in every step of the product design cycle from discovery to developer
                                handoff and user acceptance testing.</li>
                            <li>Work with BAs, product managers and tech teams to lead the Product Design</li>
                            <li>Maintain quality of the design process and ensure that when designs are translated into
                                code they accurately reflect the design specifications.</li>
                            <li>Accurately estimate design tickets during planning sessions.</li>
                            <li>Contribute to sketching sessions involving non-designersCreate, iterate and maintain UI
                                deliverables including sketch files, style guides, high fidelity prototypes, micro
                                interaction specifications and pattern libraries.</li>
                            <li>Ensure design choices are data led by identifying assumptions to test each sprint, and
                                work with the analysts in your team to plan moderated usability test sessions.</li>
                            <li>Design pixel perfect responsive UI’s and understand that adopting common interface
                                patterns is better for UX than reinventing the wheel</li>
                            <li>Present your work to the wider business at Show &amp; Tell sessions.</li>
                        </ul>
                        <h4>Skill &amp; Experience</h4>
                        <ul class="list-style-three">
                            <li>You have at least 3 years’ experience working as a Product Designer.</li>
                            <li>You have experience using Sketch and InVision or Framer X</li>
                            <li>You have some previous experience working in an agile environment – Think two-week
                                sprints.</li>
                            <li>You are familiar using Jira and Confluence in your workflow</li>
                        </ul>
                    </div>

                    <!-- Other Options -->
                    <div class="other-options">
                        <div class="social-share">
                            <h5>Share this job</h5>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-style-one">Apply For Job</a>
                            <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
                        </div>

                        <div class="sidebar-widget company-widget">
                            <div class="widget-content">
                                <div class="company-title">
                                    <div class="company-logo"><img src="images/resource/company-7.png" alt=""></div>
                                    <h5 class="company-name">InVision</h5>
                                    <a href="#" class="profile-link">View company profile</a>
                                </div>

                                <ul class="company-info">
                                    <li>Primary industry: <span>Software</span></li>
                                    <li>Company size: <span>501-1,000</span></li>
                                    <li>Founded in: <span>2011</span></li>
                                    <li>Phone: <span>123 456 7890</span></li>
                                    <li>Email: <span>info@joio.com</span></li>
                                    <li>Location: <span>London, UK</span></li>
                                    <li>Social media:
                                        <div class="social-links">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </li>
                                </ul>

                                <div class="btn-box"><a href="#"
                                        class="theme-btn btn-style-three">www.invisionapp.com</a></div>
                            </div>
                        </div>

                        <div class="sidebar-widget contact-widget">
                            <h4 class="widget-title">Contact Us</h4>
                            <div class="widget-content">
                                <!-- Comment Form -->
                                <div class="default-form">
                                    <!--Comment Form-->
                                    <form>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Your Name" required="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email Address"
                                                    required="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <textarea class="darma" name="message" placeholder="Message"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <button class="theme-btn btn-style-one" type="submit"
                                                    name="submit-form">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Related Jobs -->
            <div class="related-jobs">
                <div class="title-box">
                    <h3>Related Jobs</h3>
                    <div class="text">2020 jobs live - 293 added today.</div>
                </div>
                <div class="row">
                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-1.png" alt=""></span>
                            <span class="company-name">Catalyst</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-2.png" alt=""></span>
                            <span class="company-name">Catalyst</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-3.png" alt=""></span>
                            <span class="company-name">Upwork</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-4.png" alt=""></span>
                            <span class="company-name">invision</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<link rel="stylesheet" href="https://static.topcv.vn/v4/css/components/desktop/job-detail-new.min.befd3ea464210690.css">
@endsection