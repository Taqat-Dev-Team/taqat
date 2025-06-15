<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            @can('create_branch')
                <li class="nav-item">
                    <a class="nav-link edit_branch"
                        data-branch_id="{{ $data->id }}"
                        data-name="{{ $data->name }}"
                        data-code="{{ $data->code }}"
                        data-status="{{ $data->status }}">
                        <i class="fas fa-edit text-primary"></i>
                        <span class="badge badge-light-primary">{{__('label.edit')}}</span>
                    </a>
                </li>
            @endcan

            @can('delete_branch')
                <li class="nav-item">
                    <a class="nav-link delete" href="#"
                        id="{{ $data->id }}"
                        name_delete="{{ $data->name }}">
                        <i class="fas fa-trash text-danger"></i>
                        <span class="badge badge-light-danger">{{__('label.delete')}}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
