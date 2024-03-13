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
                <form action="{{ route($route_prefix.'store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="amount">Số tiền</label>
                                <input type="number" class="form-control" name="amount" id="amount" min="1000" max="100000000"
                                    placeholder="100000">
                                @error('amount')
                                <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="amount">Mã giao dịch</label>
                                <input type="text" class="form-control" value="FW{{ Auth::id() }}" disabled>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="form-control btn btn-primary">Gửi yêu cầu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--end row-->
@endsection