<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;

class MetricsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metrics = Metric::all(); // Lấy tất cả các chỉ số từ bảng metrics
        return view('admin.metrics.index', compact('metrics')); // Truyền dữ liệu đến view
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $now = \Carbon\Carbon::now();
    $yesterday = $now->subDay();
    $oneMonthAgo = \Carbon\Carbon::now()->subMonth();

    // Các giá trị nội bộ (internal) cho các chỉ số
    $internalValues = [
        1 => Job::where('created_at', '>=', $yesterday)->count(), // Việc làm mới 24h
        2 => Job::where('status', 1)->count(), // Việc làm đang tuyển
        3 => User::where('type', 'employee')->count(), // Công ty đang tuyển
        4 => Job::count(), // Tăng trưởng cơ hội việc làm
        5 => Job::count(), // Nhu cầu tuyển dụng
        6 => Job::count(), // Vị trí chờ khám phá
        7 => Job::where('created_at', '>=', $oneMonthAgo)->count(), // Việc làm trong 1 tháng qua
    ];

    // Lấy các chỉ số đã lưu từ cơ sở dữ liệu
    $existingMetrics = Metric::get()->keyBy('id'); // Lưu các chỉ số đã lưu dưới dạng key là 'id'
    // Truyền dữ liệu xuống view
    return view('admin.metrics.create', compact('internalValues', 'existingMetrics'));
}


    
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // Mảng tên chỉ số
    //     $metrics = [
    //         1 => 'Việc làm mới 24h gần nhất',
    //         2 => 'Việc làm đang tuyển',
    //         3 => 'Công ty đang tuyển',
    //         4 => 'Tăng trưởng cơ hội việc làm',
    //         5 => 'Nhu cầu tuyển dụng theo',
    //         6 => 'Vị trí chờ bạn khám phá',
    //         7 => 'Việc làm mới nhất',
    //     ];
    
    //      // Duyệt qua từng chỉ số trong form để lưu
    // foreach ($request->input('metrics') as $key => $metric) {
    //     $name = $metrics[$key]; // Lấy tên chỉ số từ mảng $metrics

    //     // Tính tổng giá trị từ external, internal và manual
    //     $totalValue = ($metric['external'] ?? 0) + ($metric['internal'] ?? 0) + ($metric['manual'] ?? 0);

    //     // Lưu hoặc cập nhật chỉ số với tổng giá trị
    //     Metric::updateOrCreate(
    //         ['name' => $name],
    //         ['value' => $totalValue]
    //     );
    // }
    
    //     return redirect()->route('metrics.index')->with('success', 'Metrics saved successfully!');
    // }
    
    public function store(Request $request)
    {
        // Mảng tên chỉ số
        $metrics = [
            1 => 'Việc làm mới 24h gần nhất',
            2 => 'Việc làm đang tuyển',
            3 => 'Công ty đang tuyển',
            4 => 'Tăng trưởng cơ hội việc làm',
            5 => 'Nhu cầu tuyển dụng theo',
            6 => 'Vị trí chờ bạn khám phá',
            7 => 'Việc làm mới nhất',
        ];

        // Duyệt qua từng chỉ số trong form để lưu
        foreach ($request->input('metrics') as $key => $metric) {
            $name = $metrics[$key]; // Lấy tên chỉ số từ mảng $metrics

            // Lấy giá trị từ các trường
            $externalValue = isset($metric['external']) ? (int)$metric['external'] : 0;
            $internalValue = isset($metric['internal']) ? (int)$metric['internal'] : 0;
            $manualValue = isset($metric['manual']) ? (int)$metric['manual'] : 0;

            // Tính tổng giá trị
            $totalValue = $externalValue + $internalValue + $manualValue;

            // Lưu hoặc cập nhật chỉ số với giá trị
            Metric::updateOrCreate(
                ['name' => $name],
                [
                    'external' => $externalValue,
                    'internal' => $internalValue,
                    'manual' => $manualValue,
                    'total' => $totalValue
                ]
            );
        }
    
        return redirect()->route('metrics.index')->with('success', 'Metrics saved successfully!');
    }

    /**
     * Display the specified resource.
     */
  

     public function show(string $id)
     {
         $metric = Metric::findOrFail($id); // Tìm chỉ số theo ID hoặc trả về lỗi 404 nếu không tìm thấy
         return view('admin.metrics.show', compact('metric')); // Truyền dữ liệu đến view
     }
     


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $metric = Metric::findOrFail($id); // Tìm chỉ số theo ID hoặc trả về lỗi 404 nếu không tìm thấy
        return view('admin.metrics.edit', compact('metric')); // Truyền dữ liệu đến view
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $metric = Metric::findOrFail($id); // Tìm chỉ số theo ID hoặc trả về lỗi 404 nếu không tìm thấy
        $metric->update([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
        ]);
    
        return redirect()->route('admin.metrics.index')->with('success', 'Chỉ số đã được cập nhật thành công.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metric = Metric::findOrFail($id); // Tìm chỉ số theo ID hoặc trả về lỗi 404 nếu không tìm thấy
        $metric->delete();
    
        return redirect()->route('admin.metrics.index')->with('success', 'Chỉ số đã được xóa thành công.');
    }
    
}
