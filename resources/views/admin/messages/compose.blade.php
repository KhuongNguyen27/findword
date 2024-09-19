@extends('admintheme::layouts.master')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4>{{ __('Danh sách người dùng') }}</h4>

        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('admin.messages.recipients') }}">
            <div class="row g-2">
                <div class="col">
                    <input class="form-control" name="search" type="text" placeholder="Tìm kiếm tên người dùng..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-light px-4" type="submit">
                        <i class="bi bi-box-arrow-right me-2"></i>Tìm
                    </button>
                </div>
            </div>
        </form>



        <!-- Form gửi tin nhắn -->
        <form action="{{ route('admin.messages.send') }}" method="POST">
            @csrf
            <div class="row mt-4">
                <!-- Bảng danh sách Employee -->
                <div class="col-md-6">
                    <h5>{{ __('Danh sách Employee') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('STT') }}</th>
                                    <th>{{ __('Tên') }}</th>
                                    <th>
                                        <input type="checkbox" id="select-all-employees"> {{ __('Chọn tất cả') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $key => $employee)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $employee->userEmployee->name ?? '' }}</td>
                                    <td>
                                        <input type="checkbox" class="employee-checkbox" name="recipients[]" value="{{ $employee->id }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bảng danh sách Staff -->
                <div class="col-md-6">
                    <h5>{{ __('Danh sách Staff') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('STT') }}</th>
                                    <th>{{ __('Tên') }}</th>
                                    <th>
                                        <input type="checkbox" id="select-all-staffs"> {{ __('Chọn tất cả') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $key => $staff)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $staff->name }}</td>
                                    <td>
                                        <input type="checkbox" class="staff-checkbox" name="recipients[]" value="{{ $staff->id }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="form-group">
                    <label for="message">{{ __('Nhập nội dung tin nhắn') }}</label>
                    <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{ __('Gửi tin nhắn') }}</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.getElementById('select-all-employees').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.employee-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });

    document.getElementById('select-all-staffs').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.staff-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });

</script>
@endsection
