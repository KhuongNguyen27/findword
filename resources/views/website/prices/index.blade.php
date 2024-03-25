@extends('website.layouts.master')
@section('content')
    <!-- Pricing Sectioin -->
    <section class="pricing-section">
        <div class="auto-container">
            <div class="sec-title text-center mt-5">
                <h2>{{ __('price_list') }}</h2>
                <!-- <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor.</div> -->
            </div>
            <!--Pricing Tabs-->
            <div class="pricing-tabs tabs-box">
                <!--Tab Btns-->
                <div class="tab-buttons">
                    <h4>{{ __('save_up_to') }} 10%</h4>
                    <ul class="tab-btns">
                        <li data-tab="#monthly" class="tab-btn active-btn">{{ __('monthly_package') }}</li>
                        <li data-tab="#annual" class="tab-btn">{{ __('year_package') }}</li>
                    </ul>
                </div>

                <!--Tabs Container-->
                <div class="tabs-content">

                    <!--Tab / Active Tab-->
                    <div class="tab active-tab" id="monthly">
                        <div class="content">
                            <div class="row">
                                <!-- Pricing Table -->
                                <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="title">{{ __('basic') }}</div>
                                        <div class="price">4 triệu VND<span class="duration">/ {{ __('monthly') }}</span>
                                        </div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>1 {{ __('job_posting') }}</span></li>
                                                <li><span>0 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 20 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Table -->
                                <div class="pricing-table tagged col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <span class="tag">{{ __('recommended') }}</span>
                                        <div class="title">{{ __('standard') }}</div>
                                        <div class="price">10 triệu VND <span class="duration">/
                                                {{ __('monthly') }}</span></div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>10 {{ __('job_posting') }}</span></li>
                                                <li><span>10 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 30 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Table -->
                                <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="title">{{ __('premium') }}</div>
                                        <div class="price">15 triệu VND <span class="duration">/
                                                {{ __('monthly') }}</span></div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>50 {{ __('job_posting') }}</span></li>
                                                <li><span>50 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 90 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Tab-->
                    <div class="tab" id="annual">
                        <div class="content">
                            <div class="row">
                                <!-- Pricing Table -->
                                <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="title">{{ __('basic') }}</div>
                                        <div class="price">20 triệu VND <span class="duration">/
                                                {{ __('annual') }}</span></div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>1 {{ __('job_posting') }}</span></li>
                                                <li><span>0 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 20 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Table -->
                                <div class="pricing-table tagged col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <span class="tag">{{ __('recommended') }}</span>
                                        <div class="title">{{ __('standard') }}</div>
                                        <div class="price">30 triệu <span class="duration">/ {{ __('annual') }}</span>
                                        </div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>1 {{ __('job_posting') }}</span></li>
                                                <li><span>0 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 20 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Table -->
                                <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="title">{{ __('premium') }}</div>
                                        <div class="price">30 triệu VND <span class="duration">/
                                                {{ __('annual') }}</span></div>
                                        <div class="table-content">
                                            <ul>
                                                <li><span>1 {{ __('job_posting') }}</span></li>
                                                <li><span>0 {{ __('featured_job') }}</span></li>
                                                <li><span>{{ __('job_displayed_for') }} 20 {{ __('day') }}</span></li>
                                                <li><span>{{ __('premium_support') }} 24/7 </span></li>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="#" class="theme-btn btn-style-three">{{ __('show') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Section -->
@endsection


