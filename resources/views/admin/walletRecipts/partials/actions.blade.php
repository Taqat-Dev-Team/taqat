<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            @can('edit_wallet_movements')
                <li class="nav-item">
                    <a href="#" class="nav-link edit" id="{{ $data->id }}" data-wallet_id="{{ $data->id }}"
                        data-amount="{{ $data->amount }}" data-attachment="{{ $data->getAttachment() }}"
                        data-status_cd_id="{{ $data->status_cd_id }}" title="edit Wallet">
                        <i class="fas fa-edit text-success"></i> {{ __('label.edit') }}
                    </a>
                </li>
            @endcan
            @can('delete_wallet_movements')
                <li class="nav-item">
                    <a href="#" class="nav-link delete" id="{{ $data->id }}"
                        name_delete="{{ $data->wallet?->users?->name }}" title="Delete User">
                        <i class="fas fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</div>
