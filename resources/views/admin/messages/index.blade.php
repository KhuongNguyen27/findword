@extends('admintheme::layouts.master')

@section('content')
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

<div class="card mt-4">
    <div class="card-body">
        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('admin.messages.index', ['user_id' => $user_id]) }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" name="search_name" class="form-control" placeholder="{{ __('Tìm kiếm theo tên người gửi...') }}" value="{{ request('search_name') }}">
                </div>
                <div class="col-md-4">
                    <select name="search_type" class="form-control">
                        <option value=""  selected>{{ __('Chọn loại người gửi') }}</option>
                        <option value="employee" {{ request('search_type') === 'employee' ? 'selected' : '' }}>{{ __('Nhà Tuyển Dụng') }}</option>
                        <option value="staff" {{ request('search_type') === 'staff' ? 'selected' : '' }}>{{ __('Ứng Viên') }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Tìm kiếm') }}</button>
                </div>
            </div>
        </form>

        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>{{ __('Người gửi') }}</th>
                            <th>{{ __('Loại người gửi') }}</th>
                            <th>{{ __('Thao tác') }}</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-table">
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($user->userEmployee)
                                        {{ $user->userEmployee->name }}
                                    @else
                                        {{ $user->name ?? 'Không xác định' }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->type === 'employee')
                                        {{ 'Nhà Tuyển Dụng' }}
                                    @elseif($user->type === 'staff')
                                        {{ 'Ứng Viên' }}
                                    @else
                                        {{ 'Không xác định' }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.messages.details', ['user_id' => $user->id]) }}" class="btn btn-info">Xem tin nhắn</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
