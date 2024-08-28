<select class="form-control dropdown-toggle" name="status" style="border: none; background-color: white" disabled>
    <option value="{{ $model::INACTIVE }}" @selected( $status==$model::INACTIVE ) disabled>{{ __('sys.inactive') }}</option>
    <option value="{{ $model::ACTIVE }}" @selected( $status==$model::ACTIVE ) disabled>{{ __('sys.active') }}</option>
</select>