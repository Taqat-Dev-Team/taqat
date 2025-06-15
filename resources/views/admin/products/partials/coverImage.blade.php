<img
data-category_id="{{ $data->id }}"
data-name="{{ $data->name }}"
data-logo="{{ $data->logo ? asset('public/files/' . $data->logo) : asset('images/default.png') }}"
data-is_active="{{ $data->is_active }}"



    class="edit" src="{{ $data->logo ? asset('public/files/' . $data->logo) : asset('images/default.png') }}" alt="{{ $data->name }}"
    style="width: 50px; height: 50px; border-radius: 50%;" />
