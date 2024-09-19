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
        <form action="{{ route('admin.messages.store', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">{{ __('Nội dung tin nhắn') }}</label>
                <textarea id="message" name="message" class="form-control" rows="4" placeholder="Nhập nội dung tin nhắn"></textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{ __('Gửi tin nhắn') }}</button>
        </form>
    </div>
</div>
@endsection
