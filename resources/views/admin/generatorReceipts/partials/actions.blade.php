<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">


            <!-- Edit Button -->
            @if (auth('admin')->user()->can('edit_generator_receipt') && !request('status') )
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-receipt_id="{{ $data->id }}"
                        data-generator_subscription_id="{{ $data->generator_subscription_id }}"
                        data-amount="{{ $data->amount }}" data-date="{{ $data->date }}">
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('restore_generator_receipt') && request('status'))
                <li class="nav-item">
                    <a href="#" class="nav-link btn-restore" data-id="{{ $data->id }}"
                        name_delete="{{ $data->name }}" title="Restore Generator">
                        <i class="fas fa-undo text-success"></i> {{ __('label.restore_generator_receipt') }}
                    </a>
                </li>
            @endif
            <!-- Delete Button -->
            @if (auth('admin')->user()->can('delete_generator_receipt') && !request('status') )
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->generatorSubscriptions?->name }}"
                        class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
