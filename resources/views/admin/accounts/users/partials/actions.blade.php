<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Button -->
            @if(auth('admin')->user()->can('edit_account_user'))
                <li class="nav-item">
                    <a href="#" class="nav-link edit"

                    data-account_id="{{ $data->id }}"
                    data-parent_id="{{ $data->parent_id }}"
                    data-name="{{ $data->name }}"
                    data-email="{{ $data->email }}"
                    data-mobile="{{ $data->mobile }}"
                    data-fax_number="{{ $data->fax_number }}"

                    data-city="{{ $data->city }}"
                    data-address="{{ $data->address }}"
                    data-balance_type_id="{{ $data->balance_type_id }}">
                        <i class="fas fa-edit" style="color:blue"></i> {{__('label.edit')}}
                    </a>
                </li>
            @endif

            <!-- Delete Button -->
            @if(auth('admin')->user()->can('delete_account_user'))
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->name }}" class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{__('label.delete')}}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
