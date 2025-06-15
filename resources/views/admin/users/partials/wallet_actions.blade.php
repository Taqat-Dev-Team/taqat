<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">



                <li class="nav-item">
                    <a href="#" class="nav-link edit_wallet" id="{{ $data->id }}"
                        data-wallet_id="{{ $data->id }}"
                        data-amount="{{ $data->amount }}"
                        data-attachment="{{ $data->getAttachment() }}"
                        data-status="{{ $data->status_cd_id }}"
                        name_delete="{{ $data->name }}" title="edit Wallet">
                        <i class="fas fa-edit text-success"></i> {{ __('label.edit') }}
                    </a>
                </li>


        </ul>
    </div>
</div>
