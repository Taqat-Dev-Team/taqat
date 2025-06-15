<div class="dropdown text-center">
    <!-- Dropdown Button -->
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Work Space Button -->
            @if (auth('admin')->user()->can('edit_work_space'))
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-work_space_id="{{ $data->id }}" data-name="{{ $data->name }}"
                       data-code="{{ $data->code }}" data-room_count="{{ $data->rooms()->count() }}"
                       data-desk_count="{{ $data->deskMangments()->count() }}" data-branch_id="{{ $data->branch_id }}">
                        <i class="fas fa-edit" style="color: blue;"></i>{{__('label.edit_work_spaces')}}
                    </a>
                </li>
            @endif

            <!-- Add Desk Management Button -->
            @if (auth('admin')->user()->can('add_desk_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link add_desk_mangment" data-work_space_id="{{ $data->id }}">
                        <i class="fas fa-plus" style="color: green;"></i>  {{__('label.add_new_desk_mangment')}}
                    </a>
                </li>
            @endif

            <!-- Delete Work Space Button -->
            @if (auth('admin')->user()->can('delete_work_space'))
                <li class="nav-item">
                    <a href="#" class="nav-link delete" data-id="{{ $data->id }}" data-name_delete="{{ $data->name }}">
                        <i class="fas fa-trash" style="color: red;"></i> {{__('label.delete_work_spaces')}}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
