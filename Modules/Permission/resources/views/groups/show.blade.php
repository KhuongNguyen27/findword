@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
    'page_title' => 'Cấp quyền'
])
<style>
.card-header {
    background: #0D6EFD;
    color: white;
}
</style>
<form action="{{ route('groups.updateRoles', $group->id) }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        @php
                            $chunks = $permissions->chunk(5); // Chia danh sách quyền thành các nhóm 5 quyền
                        @endphp
                        <div class="row">
                            @foreach ($chunks as $index => $chunk)
                                <div class="col-md-4">
                                    <div class="card border-secondary mb-3">
                                        <div class="card-header">
                                            <h6 class="d-flex justify-content-between align-items-center">
                                                @if($index == 0)
                                                    {{ __('Nhóm quyền UV và NTD') }}
                                                @elseif($index == 1)
                                                    {{ __('Nhóm quyền Công Việc và Hệ Thống') }}
                                                @else
                                                    {{ __('Nhóm quyền Tin đăng') }}
                                                @endif
                                                <!-- Checkbox Select All -->
                                                <input type="checkbox" class="form-check-input select-all" data-index="{{ $index }}">
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input group-{{ $index }}" type="checkbox" name="roles[]" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $groupPermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ array_key_exists($permission->name, \App\Models\User::PERMISSION) ? \App\Models\User::PERMISSION[$permission->name] : $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('groups.index') }}" class="btn btn-danger px-4">{{ __('back') }}</a>
                        <button type="submit" class="btn btn-primary px-4">{{ __('Cập nhật quyền') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Xử lý sự kiện khi checkbox "Select All" được chọn
        document.querySelectorAll('.select-all').forEach(function(selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const checkboxes = document.querySelectorAll('.group-' + index);

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        });
    });
</script>
@endsection
