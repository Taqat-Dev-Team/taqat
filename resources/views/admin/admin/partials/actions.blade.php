<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">





            @if (auth('admin')->user()->can('edit_admin'))
                <li class="nav-item">
                    <a href="{{ route('admin.admins.edit', $data->id) }}" class="nav-link"
                        title="{{ __('label.edit_user') }}">
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                    </a>
                </li>
            @endif



            @if (auth('admin')->user()->can('delete_admin'))
                <li class="nav-item">
                    <a href="#" class="nav-link delete" id="{{ $data->id }}" name_delete="{{ $data->name }}"
                        title="Delete User">
                        <i class="fas fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
