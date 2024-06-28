@extends('website.layouts.master')
@section('title') Đặc quyền tin @endsection
@section('content')
<style>
span.duration {
    margin-bottom: 2px;
}
</style>
<!-- Pricing Sectioin -->
<section class="pricing-section">
    <div class="auto-container">
        <div class="sec-title text-center mt-5">
            <h2>Đặc Quyền Tin</h2>
            <!-- <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor.</div> -->
        </div>
        <!--Pricing Tabs-->
        <div class="pricing-tabs tabs-box">
            <!--Tab Btns-->
            <!--div class="tab-buttons">
                <h4>Tiết kiệm đến 10%</h4>
                <ul class="tab-btns">
                    <li data-tab="#monthly" class="tab-btn active-btn">Gói tháng</li>
                    <li data-tab="#annual" class="tab-btn">Gói năm</li>
                </ul>
            </div-->

            <!--Tabs Container-->
            <div class="tabs-content">
                <!--Tab / Active Tab-->
                <div class="tab active-tab" id="monthly">
                    <div class="content">
                        <div class="row">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <!-- Pricing Table -->
                            @foreach($items as $item)
                            <div class="pricing-table col-lg-4">
                                        <div class="inner-box">
                                            <div class="title">
                                                <h2>{{ $item->name }}</h2>
                                            </div>
                                            <div class="price justify-content-center">{{ number_format($item->price) }}<span
                                                    class="duration">P /
                                                    tháng</span></div>
                                            <div class="table-content">
                                                <ul>
                                                    {!!$item->description!!}
                                                </ul>
                                            </div>
                                            <!-- <div class="table-footer">
                                                @if(Auth::user()->verify == $item::ACTIVE)
                                                <a href="#" class="theme-btn btn-style-three">Tài khoản đã được xác minh</a>
                                                @else
                                                <a href="{{ Auth::user()->verify == 0 ? route('employee.profile.index') : '' }}"
                                                    class="theme-btn btn-style-three">Xác minh tài khoản</a>
                                                @endif
                                            </div> -->
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pricing Section -->
@endsection