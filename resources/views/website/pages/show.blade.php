@extends('website.layouts.master')
@section('content')
    <section class="banner-section pb-5">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box">
                            <h3>{{ $item->name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Section-->

    <section class="ls-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text">
                        {!! $item->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
