@extends('website.layouts.master')
@section('title') Đặc quyền tin @endsection
@section('content')
<style>
span.duration {
    margin-bottom: 2px;
}
.pricing-table {
    flex-direction: column;
    height: 100%; /* Đảm bảo chiều cao của mỗi pricing-table là bằng nhau */
}

.pricing-table .inner-box {
    flex-direction: column;
    height: 100%; /* Đảm bảo chiều cao của mỗi inner-box trong pricing-table là bằng nhau */
    align-items: flex-start; /* Căn nội dung lên đầu ô */
}

.pricing-table .title,
.pricing-table .price,
.pricing-table .table-content {
    flex: 1; /* Các thành phần này sẽ căn chỉnh để chiếm hết không gian dọc */
}

.pricing-table .table-content ul {
    list-style: none; /* Loại bỏ dấu đầu dòng của danh sách */
    padding: 0; /* Xóa padding của danh sách */
    margin: 0; /* Xóa margin của danh sách */
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
                                    <div class="price justify-content-center">{{ number_format($item->price) }}<span class="duration">P / 01 tin</span></div>
                                    <div class="table-content">
                                        <ul>
                                            {!! $item->description !!}
                                        </ul>
                                    </div>
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
<script>
    // JavaScript để đồng bộ chiều cao các pricing-table
    document.addEventListener("DOMContentLoaded", function() {
        synchronizePricingTableHeights();
    });

    // Hàm tính toán và đồng bộ chiều cao các pricing-table
    function synchronizePricingTableHeights() {
        let pricingTables = document.querySelectorAll('.pricing-table');
        let maxHeight = 0;

        pricingTables.forEach(function(table) {
            let height = table.offsetHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });

        pricingTables.forEach(function(table) {
            table.style.height = maxHeight + 'px';
        });
    }
</script>

<!-- End Pricing Section -->
@endsection
