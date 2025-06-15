<div class="text-center">

    <a class="btn btn-sm btn-primary m-1 edit" data-category_id="{{ $data->id }}" data-name="{{ $data->name }}"
        data-logo="{{ $data->logo ? asset('public/storage/' . $data->logo) : asset('images/default.png') }}"
        data-is_active="{{ $data->is_active }}">
        <i class="fas fa-edit  " style="font-size: 14px;"></i>
    </a>
    <!-- Delete Button -->
    <a href="#" class="btn btn-sm btn-danger delete" data-id="{{ $data->id }}" data-name_delete="{{ $data->name }}"
        title="delete">
        <i class="fas fa-trash "></i>
    </a>

</div>
