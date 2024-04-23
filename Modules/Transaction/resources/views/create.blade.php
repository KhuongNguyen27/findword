@extends('employee::layouts.master')
@section('content')
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Quản Lý Giao Dịch</h3>
                {{-- <div class="text">Ready to jump back in?</div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="paymentForm" action="{{ route($route_prefix . 'store') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="amount">Số tiền</label>
                                    <input type="number" class="form-control" name="amount" id="amount" min="1000"
                                        max="100000000" placeholder="Nhập vào số tiền">
                                    @error('amount')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="transaction_code">Mã giao dịch</label>
                                    <input type="text" class="form-control" value="FW{{ Auth::id() }}" disabled>
                                </div>
                                <div class="mb-4">
                                    <button type="button" id="openModalBtn" class="form-control btn btn-primary">Thực hiện thanh toán</button> <!-- Nút mở modal -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="paymentConfirmationModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4" style="text-align: center;">
                                <h2>Thông tin tài khoản giao dịch</h2>
                            </div>
                            <div class="mb-4">
                                <label for="amount">Số tài khoản</label>
                                <input type="number" class="form-control" value="0123456789" disabled>
                            </div>
                            <div class="mb-4">
                                <label for="amount">Tên ngân hàng</label>
                                <input type="text" class="form-control" value="Vietcombank" disabled>
                            </div>
                            <div class="mb-4">
                                <label for="transaction_code">Nội dung chuyển khoản</label>
                                <input type="text" class="form-control" value="FW{{ Auth::id() }}" disabled>
                            </div>
                            <div class="mb-4">
                                <p>Nếu bạn đã thực hiện giao dịch vui lòng chọn Xác nhận thanh toán.</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="confirmPayment" class="btn btn btn-primary">Xác nhận thanh toán</button>
                </div>
            </div>
            <script>
                var modal = document.getElementById("paymentConfirmationModal");
                var openModalBtn = document.getElementById("openModalBtn");
                var closeModal = document.querySelector(".close");
                var confirmPaymentBtn = document.getElementById("confirmPayment");

                openModalBtn.addEventListener("click", function(event) {
                    event.preventDefault();
                    modal.style.display = "flex";
                });
                closeModal.addEventListener("click", function() {
                    modal.style.display = "none";
                });
                window.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
                confirmPaymentBtn.addEventListener("click", function() {
                    modal.style.display = "none";
                    document.getElementById("paymentForm").submit();
                });
            </script>
    </section>
@endsection
