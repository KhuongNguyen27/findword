@extends('employee::layouts.master')

@section('content')
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Soạn Tin Nhắn</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Gửi Tin Nhắn Đến Admin</h4>
                            </div>

                            <div class="widget-content">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('messages.store', $admin->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="message">Nội dung tin nhắn</label>
                                        <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi Tin Nhắn</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
