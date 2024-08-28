<select class="form-control select-user" name="user_id">
    <option value="">Tài khoản</option>
    @foreach( $items as $item )
    <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>