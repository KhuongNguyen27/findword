@extends('admintheme::layouts.master')
@section('content')
@include('admintheme::includes.globals.breadcrumb',[
'page_title' => 'Popup',
'actions' => [
'add_new' => route('popups.create',['type'=>request()->type]),
//'export' => route($route_prefix.'export'),
]
])
<style>
    .product-table .product-box img {
        width: 117px;
        height: 55px;
        border-radius: 0.25rem;
    }

</style>
<!-- Item actions -->
<form action="{{ route('banners.index') }}" method="get">
    <input type="hidden" name="type" value="{{ request()->type }}">
    <div class="row g-3">
        <div class="col-auto flex-grow-1">
            <div class="position-relative">
                <input class="form-control" name="name" type="text" placeholder="{{ __('sys.search_name') }}" value="{{ request()->name }}">
            </div>
        </div>

        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button class="btn btn-light px-4"><i class="bi bi-box-arrow-right me-2"></i>Search</button>
            </div>
        </div>
    </div>
</form>

<div class="card mt-4">
    <div class="card-body">
        <div class="product-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Video Link</th>
                            <th>Is Active</th>
                            <th>Actions</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($popups as $popup)
                        <tr>
                            <td>{{ $popup->id }}</td>
                            <td>{{ $popup->title }}</td>
                            <td>
                                <a href="{{ $popup->video_link }}" target="_blank">{{ $popup->video_link }}</a>
                            </td>
                            <td>
                                <span class="badge {{ $popup->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $popup->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                          

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('popups.edit', $popup->id) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('popups.destroy', $popup->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick=" return confirm('{{ __('sys.confirm_delete') }}') "
                                                    class="dropdown-item">
                                                    {{ __('sys.delete') }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                      
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>



@endsection
