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
            <!-- <div class="tab-buttons">
                <h4>Tiết kiệm đến 10%</h4>
                <ul class="tab-btns">
                    <li data-tab="#monthly" class="tab-btn active-btn">Gói tháng</li>
                    <li data-tab="#annual" class="tab-btn">Gói năm</li>
                </ul>
            </div> -->

            <!--Tabs Container-->
            <div class="tabs-content">
                <!--Tab / Active Tab-->
                <div class="tab active-tab" id="monthly">
                    <div class="content">
                        <div class="row d-flex justify-content-center">
                            <!-- Pricing Table -->
                            <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
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
                                    <form action="{{ route($route_prefix.'store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $item->id }}">
                                        <div class="table-content">
                                            <select class="form-control" name="duration_id">
                                                <option value="" style="color:gray">-- Lựa chọn thời gian sử dụng --
                                                </option>
                                                @foreach($durations as $duration)
                                                <option value="{{ $duration->id }}">{{ $duration->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="table-footer">
                                            <button type="submit" class="theme-btn btn-style-three w-100">Mua
                                                gói</button>
                                        </div>
                                    </form>
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