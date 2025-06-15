<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">


            @if (auth('admin')->user()->can('view_users') && !request('status') !== 'delete-hub')
                <li class="nav-item">
                    <a href="{{ route('admin.users.views', $data->id) }}" class="nav-link"
                        title="{{ __('label.view_user') }}">
                        <i class="fas fa-eye text-info"></i> {{ __('label.view_user') }}
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('edit_users') && request('status') !== 'delete-hub')
                <li class="nav-item">
                    <a href="{{ route('admin.users.edit', $data->id) }}" class="nav-link"
                        title="{{ __('label.edit_user') }}">
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit_users') }}
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_internet_subscription') &&
                    $data->status == 1 &&
                    !request('status') !== 'delete-hub')
                <li class="nav-item">
                    <a href="#" class="nav-link internet_subscription" data-user_id="{{ $data->id }}"
                        data-desk_mangment_id="{{ $data->id }}" title="اشتراك الانترنت">
                        <i class="fas fa-wifi" style="color: rgb(177, 177, 177);"></i> اشتراك الانترنت
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('release_desk_mangment') && $data->deskMangment)
                <li class="nav-item">
                    <a href="#" class="nav-link release" data-id="{{ $data->deskMangment->id }}"
                        data-code="{{ $data->deskMangment->code }}" title="تحرير الغرفة">
                        <i class="fas fa-rocket" style="color: green;"></i> تحرير المقعد
                    </a>
                </li>
            @endif
            @if (
                (auth('admin')->user()->can('view_invoice') &&
                    !request('status') !== 'delete-hub' &&
                    $data->userRooms->isEmpty()) ||
                    $data->rooms()->count() > 0)
                <li class="nav-item">
                    <a href="#" class="nav-link view-invoice" data-user_id="{{ $data->id }}"
                        title="عرض الفاتورة">
                        <i class="fas fa-file-invoice" style="color: rgb(177, 177, 177);"></i> عرض الفاتورة
                    </a>
                </li>
            @endif


            @if (
                (auth('admin')->user()->can('add_invoce') &&
                    $data->status == 1 &&
                    !request('status') !== 'delete-hub' &&
                    $data->userRooms->isEmpty()) ||
                    $data->rooms()->count() > 0)
                <li class="nav-item">
                    <a href="#" class="nav-link invoiceSingleModal" data-user_id="{{ $data->id }}"
                        title="{{ __('label.add_invoice') }}">
                        <i class="fas fa-file-invoice text-brown"></i> {{ __('label.add_invoice') }}
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_service') && $data->status == 1)
                <li class="nav-item">
                    <a href="#" class="nav-link service_list" data-user_id="{{ $data->id }}"
                        title="{{ __('label.services') }}">
                        <i class="fas fa-concierge-bell text-brown"></i> {{ __('label.services') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('add_service') && $data->status == 1)
                <li class="nav-item">
                    <a href="#" class="nav-link add_service" data-user_id="{{ $data->id }}"
                        title="{{ __('label.add_service') }}">
                        <i class="fas fa-plus-circle text-brown"></i> {{ __('label.add_service') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('view_expense'))
                <li class="nav-item">
                    <a href="#" class="nav-link expense_list" data-user_id="{{ $data->id }}"
                        title="{{ __('label.expense_list') }}">
                        <i class="fas fa-receipt text-brown"></i> {{ __('label.expense_list') }}
                    </a>
                </li>
            @endif


            @if (auth('admin')->user()->can('expense_list'))
                <li class="nav-item">
                    <a href="#" class="nav-link expense_list" data-user_id="{{ $data->id }}"
                        title="{{ __('label.expense_list') }}">
                        <i class="fas fa-receipt text-brown"></i> {{ __('label.expense_list') }}
                    </a>
                </li>
            @endif



            @if (auth('admin')->user()->can('verification_users'))
                <li class="nav-item">
                    <a href="#" class="nav-link verification_user" data-user_id="{{ $data->id }}"
                        title="{{ __('label.user_verification') }}">
                        <i class="fas fa-check-circle text-success"></i> {{ __('label.user_verification') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('add_expense'))
                <li class="nav-item">
                    <a href="#" class="nav-link add_expense" data-user_id="{{ $data->id }}"
                        title="اضافة المصاريف">
                        <i class="fas fa-money-bill-wave text-brown"></i> اضافة المصاريف
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('add_To_branch') && !request('status') !== 'delete-hub')
                <li class="nav-item">
                    <a href="#" class="nav-link add_user" data-user_id="{{ $data->id }}"
                        data-branch_id="{{ $data->branch_id }}" data-status="{{ $data->status }}"
                        data-work_space_id="{{ $data->work_space_id }}"
                        data-desk_mangment_id="{{ $data->desk_mangment_id }}"
                        data-user_type_cd_id="{{ $data->user_type_cd_id }}" title="{{ __('label.status') }}">
                        <i class="fas fa-cogs  text-success"></i> {{ __('label.status_user') }}
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link notification_modal" data-user_id="{{ $data->id }}">
                    <i class="fas fa-bell text-warning"></i> {{ __('label.notifications') }}
                </a>
            </li>
            @if (auth('admin')->user()->can('restore_users') && request('status') === 'delete-hub')
                <li class="nav-item">
                    <a href="#" class="nav-link btn-restore" data-id="{{ $data->id }}"
                        name_delete="{{ $data->name }}" title="Restore User">
                        <i class="fas fa-undo text-success"></i> {{ __('label.restore_users') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('delete_users') && !request('status') !== 'delete-hub')
                <li class="nav-item">
                    <a href="#" class="nav-link delete" id="{{ $data->id }}"
                        name_delete="{{ $data->name }}" title="Delete User">
                        <i class="fas fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif


        </ul>
    </div>
</div>
