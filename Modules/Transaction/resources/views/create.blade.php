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
                                    <label for="amount">Số tiền <span style="color: red">*</span></label>
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
                                    <button type="button" id="openModalBtn" class="form-control btn btn-primary">Thực hiện
                                        thanh toán</button> <!-- Nút mở modal -->
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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4" style="text-align: center;">
                                        <h2>Thông tin tài khoản giao dịch</h2>
                                    </div>
                                    <div class="mb-2">
                                        <label for="amount">Số tài khoản</label>
                                        <input type="number" class="form-control" value="3301729747" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="amount">Tên ngân hàng</label>
                                        <input type="text" class="form-control" value="Techcombank" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="amount">Tên công ty</label>
                                        <input type="text" class="form-control"
                                            value="Công ty Cổ phần Cung ứng Nguồn nhân lực HR" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="transaction_code">Nội dung chuyển khoản</label>
                                        <input type="text" class="form-control" value="FW{{ Auth::id() }}" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="amount">Số tiền nạp vào tài khoản</label>
                                        <input type="number" class="form-control" name="amount" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <p style="color: red; text-align: center;">Vui lòng chỉ "Xác nhận thanh toán" khi đã
                                        </p>
                                        <p style="color: red; text-align: center;">HOÀN TẤT CHUYỂN KHOẢN THANH TOÁN. </p>
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <h3>Quét mã QR để thanh toán</h3>
                                    <img src="{{ asset('website-assets/images/qrcode/qrcode1.png') }}"
                                        alt="Mã QR để thanh toán" class="img-fluid">
                                </div>
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
                    var amount = document.getElementById("amount").value;
                    var modalAmountField = document.querySelector("#paymentConfirmationModal input[name='amount']");
                    modalAmountField.value = amount;
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
