<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            <li class="nav-item">
                <a class="nav-link add_branch" id="{{ $data->id }}" data-branch_name="{{ $data->branch?->name }}" data-user_name="{{ $data->users?->name }}" data-user_id="{{ $data->user_id }}" data-branch_id="{{ $data->branch_id }}">
                    <i style="color: green" class="fa fa-plus"></i> {{__('label.add_branch')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link delete" id="{{ $data->id }}" name_delete="{{ $data->users?->name }}">
                    <i style="color: red" class="fa fa-trash"></i> {{__('label.delete')}}
                </a>
            </li>
        </ul>
    </div>
</div>
