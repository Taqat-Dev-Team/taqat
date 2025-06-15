<div class="text-center">
    <!-- Edit Button -->
    <a href="#" class="btn btn-sm btn-light edit_expense" data-expense_id="{{ $data->id }}"
        data-title="{{ $data->title }}"
        data-total_amount="{{ $data->total_amount }}"
        data-price="{{ $data->price }}"
        data-quantity="{{ $data->quantity }}"
        data-cash_paid="{{ $data->cash_paid }}"
        data-bank_paid="{{ $data->bank_paid }}"
        data-generator_id="{{ $data->generator_id }}"
        data-date="{{$data->date}}"


        role="button" title="{{ __('label.edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>

    <!-- Delete Button -->
    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->title }}" class="btn btn-sm btn-light delete" title="{{ __('label.delete') }}">
        <i class="fa fa-trash text-danger"></i>
    </a>
</div>
