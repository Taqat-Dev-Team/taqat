<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <li class="nav-item">
                <a href="#" class="nav-link edit_expense" data-expense_id="{{ $data->id }}"
                    data-title="{{ $data->title }}" data-total_amount="{{ $data->total_amount }}"
                    data-price="{{ $data->price }}" data-quantity="{{ $data->quantity }}"
                    data-cash_paid="{{ $data->cash_paid }}" data-bank_paid="{{ $data->bank_paid }}"
                    data-generator_id="{{ $data->generator_id }}" data-date="{{ $data->date }}" role="button"
                    title="{{ __('label.edit') }}">
                    <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" id="{{ $data->id }}" name_delete="{{ $data->title }}" class="nav-link delete"
                    title="{{ __('label.delete') }}">
                    <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                </a>
            </li>
        </ul>
    </div>
</div>
