
{{-- @if (auth('admin')->user()->can('update_status_category')) --}}



<span class="switch switch-icon">
    <label>
        <input type="checkbox"
        data-id="{{ $data->id }}"

        onchange="toggleActive(this)"

        {{ $data->is_active ? 'checked' : '' }} class="chk-box" name="is_active" value="1">
        <span></span>
    </label>
</span>
{{-- @endif --}}
