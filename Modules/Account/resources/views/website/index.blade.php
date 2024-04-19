@extends('website.layouts.master')
@section('content')
<!-- Pricing Sectioin -->
<section class="pricing-section">
    <div class="auto-container">
        <div class="sec-title text-center mt-5">
            <h2>Bảng Giá</h2>
            <!-- <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor.</div> -->
        </div>
        <!--Pricing Tabs-->
        <div class="pricing-tabs tabs-box">
            <!--Tab Btns-->
             <div class="tab-buttons">
                <h4>Tiết kiệm đến 10%</h4>
                <ul class="tab-btns">
                    <li data-tab="#monthly" class="tab-btn active-btn">Gói tháng</li>
                    <li data-tab="#annual" class="tab-btn">Gói năm</li>
                </ul>
            </div>
            
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
                            @if (array_search($item->id, $package_current))
                            <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                @if(isset($item->user) &&
                                $item->user->where('user_id',Auth::id())->first()->is_current==1)
                                <span style="color:red" class="form-control">Gói hiện tại</span>
                                @endif
                                <div class="inner-box">
                                    <div class="title">
                                        <h2>{{ $item->name }}</h2>
                                    </div>
                                    <div class="price">{{ number_format($item->price) }}<span class="duration">Điểm/
                                            tháng</span></div>
                                    <div class="table-content">
                                        <ul>
                                            @foreach($item->job_package as $package)
                                            <li><span>Miễn phí {{ $package->amount }} {{ $package->job_package->name }}/
                                                    tháng</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn btn-style-three">Ngày hết hạn :
                                            {{ array_search($item->id, $package_current) }}</a>
                                    </div>
                                </div>
                            </div>
                            @elseif($item->id == $item::NORMAL)
                            <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="title">
                                        <h2>{{ $item->name }}</h2>
                                    </div>
                                    <div class="price">{{ number_format($item->price) }}<span class="duration">Điểm /
                                            tháng</span></div>
                                    <div class="table-content">
                                        <ul>
                                            {{-- @foreach($item->job_package as $package)
                                            <li><span>Miễn phí {{ $package->amount }} {{ $package->job_package->name }}/
                                                    tháng</span></li>
                                            @endforeach --}}
                                            {!!$item->description!!}
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        @if(Auth::user()->verify == $item::ACTIVE)
                                        <a href="#" class="theme-btn btn-style-three">Tài khoản đã được xác thực</a>
                                        @else
                                        <a href="{{ Auth::user()->verify == 0 ? route('employee.profile.index') : '' }}"
                                            class="theme-btn btn-style-three">Xác thực tài khoản</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="title">
                                        <h2>{{ $item->name }}</h2>
                                    </div>
                                    <div class="price">{{ number_format($item->price) }}<span class="duration">Điểm /
                                            tháng</span></div>
                                    <div class="table-content">
                                        <ul>
                                            {{-- @foreach($item->job_package as $package)
                                                @if($package->job_package !== null)
                                                    <li><span>Miễn phí {{ $package->amount }} {{ $package->job_package->name }}/ tháng</span></li>
                                                @endif
                                            @endforeach --}}
                                            {!! $item->description !!}
                                        </ul>
                                        
                                    </div>
                                    <div class="table-footer">
                                        <a href="{{ route($route_prefix.'show',$item->id) }}"
                                            class="theme-btn btn-style-three">Xem gói</a>
                                    </div>
                                </div>
                            </div>
                            @endif
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