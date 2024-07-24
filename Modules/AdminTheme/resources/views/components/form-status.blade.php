<select class="form-control dropdown-toggle" name="status">
    @if($showAll)
        <option value="">Trạng thái</option>
    @endif
    
    <option value="{{ $model::INACTIVE }}" @selected($status == $model::INACTIVE)>
        {{ __('sys.inactive') }}
    </option>
    
    <option value="{{ $model::ACTIVE }}" @selected($status == $model::ACTIVE)>
        {{ __('sys.active') }}
    </option>
    @if($_GET['type'] == 'Job')
        <option value="{{ $model::REJECTED }}" @selected($status == $model::REJECTED)>
            Từ chối tin đăng
        </option>
    @endif
</select>
