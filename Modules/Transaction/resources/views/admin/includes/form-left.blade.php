<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('name') }}</label>
            <select class="form-control" name="user_id">
                @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            <x-admintheme::form-input-error field="user_id" />
        </div>
        <div class="mb-4">
            <label for="type">{{ __('purpose')  }}</label>
            <select name="type" class="form-control">
                <option value="Nạp tiền" checked>Nạp tiền</option>
            </select>
            <x-admintheme::form-input-error field="email" />
        </div>
        <div class="mb-4">
            <label class="mb-3">{{ __('amount') }}</label>
            <input type="amount" class="form-control" name="amount" placeholder="Số tiền giao dịch">
            <x-admintheme::form-input-error field="amount" />
        </div>
    </div>
</div>

@yield('custom-fields-left')