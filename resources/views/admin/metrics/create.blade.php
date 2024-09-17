@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb', [
    'page_title' => 'Cập nhật chỉ Số'
])
<div class="container">
    <form action="{{ route('metrics.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Các chỉ số -->
            @php
                $externalValues = [
                    1 => 3250,
                    2 => 40865,
                    3 => 14320,
                    4 => 48000,
                    5 => 12000,
                    6 => 40865,
                    7 => 3250,
                ];  
                $metrics = [
                    1 => 'Việc làm mới 24h gần nhất',
                    2 => 'Việc làm đang tuyển',
                    3 => 'Công ty đang tuyển',
                    4 => 'Tăng trưởng cơ hội việc làm',
                    5 => 'Nhu cầu tuyển dụng theo',
                    6 => 'Vị trí chờ bạn khám phá',
                    7 => 'Việc làm mới nhất',
                ];
            @endphp
            
            @foreach($metrics as $id => $title)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tiêu đề -->
                                <div class="col-12 mb-3">
                                    <h5 class="font-weight-bold">{{ $title }}</h5>
                                </div>

                                <!-- Chỉ số từ trang bên ngoài -->
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="metric_{{ $id }}_external">Chỉ số từ trang bên ngoài</label>
                                        <input type="text" id="metric_{{ $id }}_external" name="metrics[{{ $id }}][external]" class="form-control" placeholder="Chỉ số từ trang bên ngoài" value="{{ $externalValues[$id] ?? 0 }}" readonly>
                                    </div>
                                </div>
                                
                                <!-- Chỉ số từ trang của bạn -->
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="metric_{{ $id }}_internal" class="mt-2">Chỉ số từ trang của bạn</label>
                                        <input type="text" id="metric_{{ $id }}_internal" name="metrics[{{ $id }}][internal]" class="form-control" placeholder="Chỉ số từ trang của bạn" value="{{ $internalValues[$id] ?? 0 }}" readonly>
                                    </div>
                                </div>
                                
                               <div class="col-3">
    <div class="form-group">
        <label for="metric_{{ $id }}_manual" class="mt-2">Nhập giá trị thủ công</label>
        <input type="text" id="metric_{{ $id }}_manual" 
               name="metrics[{{ $id }}][manual]" 
               class="form-control" 
               placeholder="Nhập giá trị thủ công" 
               value="{{ $existingMetrics[$id]->manual ?? 0 }}" 
               oninput="updateMetricTotal({{ $id }})">
    </div>
</div>
                                
                                <!-- Tổng cộng -->
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="metric_{{ $id }}_total" class="mt-2">Tổng cộng</label>
                                        <input type="text" id="metric_{{ $id }}_total" class="form-control" placeholder="Tổng cộng" readonly>
                                        
                                        <!-- Input ẩn để lưu giá trị tổng -->
                                        <input type="hidden" id="metric_{{ $id }}_total_hidden" name="metrics[{{ $id }}][total]" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Các nút điều hướng -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('metrics.index') }}" class="btn btn-danger px-4">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Hàm cập nhật tổng giá trị khi nhập dữ liệu
    function updateMetricTotal(metricId) {
        // Lấy giá trị từ các trường input (external, internal, manual)
        const externalInput = document.getElementById(`metric_${metricId}_external`);
        const internalInput = document.getElementById(`metric_${metricId}_internal`);
        const manualInput = document.getElementById(`metric_${metricId}_manual`);
        
        // Đảm bảo các trường tồn tại
        if (!externalInput || !internalInput || !manualInput) {
            console.error(`Một trong các trường không tồn tại cho metric ID ${metricId}`); 
            return;
        }

        const external = parseFloat(externalInput.value) || 0;
        const internal = parseFloat(internalInput.value) || 0;
        const manual = parseFloat(manualInput.value) || 0;

        // Tính tổng
        const total = external + internal + manual;

        console.log(`Metric ${metricId} - External: ${external}, Internal: ${internal}, Manual: ${manual}, Total: ${total}`);

        // Cập nhật giá trị cho input hiển thị tổng cộng
        const totalInput = document.getElementById(`metric_${metricId}_total`);
        if (totalInput) {
            totalInput.value = total;
        } else {
            console.error(`Input tổng không tồn tại cho metric ID ${metricId}`);
        }

        // Cập nhật giá trị cho input ẩn (dùng để lưu vào cơ sở dữ liệu)
        const totalHiddenInput = document.getElementById(`metric_${metricId}_total_hidden`);
        if (totalHiddenInput) {
            totalHiddenInput.value = total;
        } else {
            console.error(`Input ẩn tổng không tồn tại cho metric ID ${metricId}`);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Lặp qua tất cả các chỉ số
    @foreach($metrics as $id => $title)
        updateMetricTotal({{ $id }}); // Cập nhật tổng giá trị khi trang vừa tải
    @endforeach

    // Gắn sự kiện 'input' cho các ô nhập thủ công
    const manualInputs = document.querySelectorAll('input[id*="_manual"]');
    manualInputs.forEach(input => {
        input.addEventListener('input', function() {
            const metricId = input.id.split('_')[1]; // Lấy ID từ input, phần thứ 2 của id là ID chỉ số
            updateMetricTotal(metricId); // Cập nhật tổng giá trị khi nhập thủ công
        });
    });
});

</script>

@endsection
