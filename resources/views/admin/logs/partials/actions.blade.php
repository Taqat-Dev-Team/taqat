<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            @if ($data->user_id)
                @if (auth('admin')->user()->can('add_invoce'))
                    <li class="nav-item">
                        <a href="" class="nav-link invoiceSingleModal" data-user_id="{{ $data->user_id }}">
                            <i style="color:brown" class="fas fa-file-invoice"></i> {{ __('label.add_invoice') }}
                        </a>
                    </li>
                @endif
                @if (auth('admin')->user()->can('add_To_branch'))
                    <li class="nav-item">
                        <a href="" class="nav-link add_user" data-user_id="{{ $data->user_id }}" data-branch_id="{{ $data->users?->branch_id }}" data-status="{{ $data->users?->status }}">
                            <i style="color:green" class="fas fa-plus"></i> {{ __('label.add_to_branch') }}
                        </a>
                    </li>
                @endif
                @if (auth('admin')->user()->can('add_To_branch'))
                    <li class="nav-item">
                        <a href="{{ route('admin.users.views', $data->user_id) }}" class="nav-link">
                            <i style="color: lightseagreen" class="fas fa-eye"></i> {{ __('label.view_user') }}
                        </a>
                    </li>
                @endif
                @if (auth('admin')->user()->can('edit_users'))
                    <li class="nav-item">
                        <a href="{{ route('admin.users.edit', $data->user_id) }}" class="nav-link">
                            <i style="color:blue" class="fas fa-edit"></i> {{ __('label.edit_user') }}
                        </a>
                    </li>
                @endif
            @endif
            <li class="nav-item">
                <a class="nav-link add_branch" id="{{ $data->id }}" data-branch_name="{{ $data->branch?->name }}" data-user_name="{{ $data->users?->name }}" data-user_id="{{ $data->user_id }}" data-branch_id="{{ $data->branch_id }}">
                    <i style="color: green" class="fa fa-plus"></i> {{ __('label.add_branch') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link delete" id="{{ $data->id }}" name_delete="{{ $data->mobile }}">
                    <i style="color: red" class="fa fa-trash"></i> {{ __('label.delete') }}
                </a>
            </li>
        </ul>
    </div>
</div>
