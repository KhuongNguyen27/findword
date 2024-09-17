@extends('admintheme::layouts.master')
@section('content')

@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Chỉ Số',
'actions' => [
'add_new' => route('metrics.create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])
<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <input class="form-check-input" type="checkbox">
                            </th>
                            <th>Tên</th>
                            <th>Giá trị</th>
                            {{-- <th>Hành động</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                @foreach ($metrics as $metric)
                <tr>
                    <td>{{ $metric->id }}</td>
                    <td>{{ $metric->name }}</td>
                    <td>{{ $metric->total }}</td>
                    {{-- <td>
                        <a href="{{ route('metrics.show', $metric->id) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('metrics.edit', $metric->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('metrics.destroy', $metric->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
                </table>
            </div>
        </div>
    </div>
  
</div>







@endsection