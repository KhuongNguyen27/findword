<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <label class="mb-3">{{ __('name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $item->name ?? old('name') }}">
            <x-admintheme::form-input-error field="name"/>
        </div>
        @if (request()->type == 'employee')
        <div class="mb-4">
            <label class="mb-3">{{ __('Slug') }}</label>
            <input type="text" class="form-control" name="slug" value="{{ $item->slug ?? old('slug') }}">
            <x-admintheme::form-input-error field="slug"/>
        </div>
        @endif
        @if (request()->type == 'Job')
            <div class="mb-4">
                <label class="mb-3">Vị trí trong top đầu</label>
                <select class="form-select" name="top_position" id="">
                    <option value="">Chọn vị trí trong top đầu</option>
                    @for($i =1; $i <= 10; $i++)
                        <option value="{{$i}}" {{($item->top_position ?? old('top_position')) == $i ? "selected" : ""}}> Luôn nằm vị trí số {{$i}} trong khu vực theo logic</option>
                    @endfor 
                </select>
                <x-admintheme::form-input-error field="slug"/>
            </div>
        @endif
         @if (request()->type == 'Post')
        <div class="mb-4">
            <label class="mb-3">Chuyên mục</label>
            <select class="form-select" name="category">
                <option value="">Chọn chuyên mục</option>
                <option value="1" {{ ($item->category ?? old('category')) == 1 ? "selected" : "" }}>Cẩm Nang Nghề Nghiệp</option>
                <option value="2" {{ ($item->category ?? old('category')) == 2 ? "selected" : "" }}>Góc Giải Trí</option>
            </select>
            <x-admintheme::form-input-error field="category"/>
        </div>
        @endif
        <div class="mb-4">
            <label class="mb-3">{{ __('description') }}</label>
            <textarea class="form-control" id="description" name="description" cols="4" rows="6">{{ $item->description ?? old('description') }}</textarea>
            <x-admintheme::form-input-error field="description"/>
        </div>
    </div>
</div>
@yield('custom-fields-left')