@extends('admintheme::layouts.master')

@section('content')
<div class="card mt-4">
    <div class="card-body">
<h4>
            Chi tiết tin nhắn với 
            @if($user->userEmployee)
                {{ $user->userEmployee->name }}
            @else
                {{ $user->name ?? '' }}
            @endif
        </h4>        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>{{ __('Người gửi') }}</th>
                            <th>{{ __('Nội dung') }}</th>
                            <th>{{ __('Ngày gửi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $index => $message)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $message->sender->name ?? 'N/A' }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ __('Không có tin nhắn nào.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Form phản hồi -->
        <div class="mt-4">
            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="message">{{ __('Nhập tin nhắn phản hồi') }}</label>
                    <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ __('Gửi phản hồi') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
