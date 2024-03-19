<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
            <x-admintheme::form-input-error field="name" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('email') }}</label>
            <input type="text" class="form-control" name="email" value="{{ $item->email ?? old('email') }}">
            <x-admintheme::form-input-error field="email" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('password') }}</label>
            <input type="password" class="form-control" name="password" value="">
            <x-admintheme::form-input-error field="password"/>
        </div>
    </div>
</div>

@yield('custom-fields-left')