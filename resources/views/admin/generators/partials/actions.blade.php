<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            @if (auth('admin')->user()->can('edit_generator') && !request('status') == 'delete-generator')
                <!-- Edit Button -->
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-generator_id="{{ $data->id }}"
                        data-name="{{ $data->name }}" role="button">
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('view_generator_subscriptions') && !request('status') == 'delete-generator')
                <li class="nav-item">
                    <a href="#" class="nav-link list-generator-subscription"
                        data-generator_id="{{ $data->id }}" role="button">
                        <i class="fas fa-list text-info"></i> {{ __('label.list_generator_subscriptions') }}
                    </a>
                </li>
            @endif

                <li class="nav-item">
                    <a href="#" class="nav-link list-generator-expenses" data-generator_id="{{ $data->id }}"
                        role="button">
                        <i class="fas fa-money-bill-wave text-secondary"></i> {{ __('label.list_generator_expenses') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link add-generator-expense" data-generator_id="{{ $data->id }}"
                        role="button">
                        <i class="fas fa-plus-circle text-success"></i> {{ __('label.add_generator_expense') }}
                    </a>
                </li>
            @if (auth('admin')->user()->can('add_generator_subscription') && !request('status') == 'delete-generator')
                <li class="nav-item">
                    <a href="#" class="nav-link add-generator-subscription"
                        data-generator_id="{{ $data->id }}" role="button">
                        <i class="fas fa-plus text-success"></i> {{ __('label.add_generator_subscription') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('excel_generator_subscriptions') && !request('status') == 'delete-generator')
                <li class="nav-item">
                    <a href="#" class="nav-link import-generator-subscription" data-toggle="modal"
                        data-target="#importExcelModal" data-generator_id="{{ $data->id }}" role="button">
                        <i class="fas fa-file-alt text-warning"></i> {{ __('label.excel_generator_subscriptions') }}
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('restore_users') && request('status') == 'delete-generator')
                <li class="nav-item">
                    <a href="#" class="nav-link btn-restore" data-id="{{ $data->id }}"
                        name_delete="{{ $data->name }}" title="Restore Generator">
                        <i class="fas fa-undo text-success"></i> {{ __('label.restore_generator') }}
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('delete_generator') && !request('status') == 'delete-generator')
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->name }}"
                        class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
