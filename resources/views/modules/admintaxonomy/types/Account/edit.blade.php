@extends('admintaxonomy::edit')
@section('custom-fields-left')
<div class="card">
    <div class="card-body">
        <table class="table">
            @foreach( \App\Models\JobPackage::all() as $job_package )
            <tr>
                <td>{{ $job_package->name }}</td>
                <td><input type="text" class="form-control" name="job_package_ids[{{ $job_package->id }}]" value="{{ $item->setting_job_packages[$job_package->id] }}"></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@php
$groups = [
    'clipboard' => ['Undo', 'Redo'],
    'editing' => ['FindAndReplace', 'SelectAll'],
    'links' => ['Link', 'Unlink'],
    'insert' => ['ImageUpload', 'InsertTable', 'MediaEmbed', 'HorizontalLine'],
    'basicstyles' =>  ['Bold', 'Italic', 'Underline', 'Strikethrough', 'BlockQuote'],
    'paragraph' => ['BulletedList', 'NumberedList', 'Outdent', 'Indent', 'Alignment'],
    'styles' => ['FontSize', 'FontFamily', 'Highlight', 'FontColor', 'FontBackgroundColor'],
];
@endphp



<div class="card">
    <div class="card-body">
        <h5>{{ __('Cấu hình CKEditor') }}</h5>
        <div class="form-check">
            <input type="checkbox" id="select-all" style="width: 15px; height: 15px;" {{ $selectAllChecked }} />
            <label for="select-all" style="font-size: 16px; font-weight: bold;">{{ __('Chọn tất cả') }}</label>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Nhóm công cụ') }}</th>
                            <th>{{ __('Chọn') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $groupName => $features)
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox" class="group-checkbox" data-group="{{ $groupName }}" {{ isset($ckeditor_features[$groupName]) && !empty($ckeditor_features[$groupName]) ? 'checked' : '' }}>
                                    {{ __(ucfirst($groupName)) }}
                                </label>
                            </td>
                            <td>
                                @foreach($features as $feature)
                                <div class="form-check">
                                    <input type="checkbox" value="1" class="feature-checkbox" name="ckeditor_features[{{ $groupName }}][{{ $feature }}]" {{ isset($ckeditor_features[$groupName][$feature]) ? 'checked' : '' }} data-group="{{ $groupName }}">
                                    <label>{{ __($feature) }}</label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý khi chọn/deselect nhóm công cụ
        document.querySelectorAll('.group-checkbox').forEach(function(groupCheckbox) {
            groupCheckbox.addEventListener('change', function() {
                var groupName = this.getAttribute('data-group');
                var isChecked = this.checked;
                document.querySelectorAll('.feature-checkbox[data-group="' + groupName + '"]').forEach(function(featureCheckbox) {
                    featureCheckbox.checked = isChecked;
                });
            });
        });

        // Xử lý khi chọn/deselect tất cả công cụ
        document.querySelector('#select-all').addEventListener('change', function() {
            var isChecked = this.checked;
            document.querySelectorAll('.feature-checkbox').forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
            document.querySelectorAll('.group-checkbox').forEach(function(groupCheckbox) {
                groupCheckbox.checked = isChecked;
            });
        });
    });

</script>



@endsection

@section('custom-fields-right')

<style>
    #form-right-wrapper {
        display: none !important;
    }

    #salary_min_wrapper {
        display: none !important;
    }

    #salary_max_wrapper {
        display: none !important;
    }

</style>
<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{__('price')}}</label>
            <input type="text" class="form-control" name="price" value="{{ $item->price ?? old('price') }}">
            <x-admintheme::form-input-error field="price" />
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const featureCheckboxes = document.querySelectorAll('.feature-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            featureCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });

</script>
