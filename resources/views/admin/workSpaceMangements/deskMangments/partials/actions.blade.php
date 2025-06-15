<div class="dropdown text-center">
    <!-- Dropdown Button -->
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Internet Subscription Button (If expired and user exists) -->
            @if (auth('admin')->user()->can('internet_subscription_desk_mangment') && $data->user_id)
                <li class="nav-item">
                    <a href="#" class="nav-link issue-internet-card" data-desk_mangment_id="{{ $data->id }}"
                        title="إصدار بطاقة الإنترنت" data-start_date="{{ $data->internetSubscription?->start_date }}"
                        data-end_date="{{ $data->internetSubscription?->end_date }}"
                        data-internet_subscription_id="{{ $data->internetSubscription?->id }}"
                        data-subscription_type_id="{{ $data->subscription_type_id }}"
                        data-work_space_id="{{ $data->work_space_id }}" data-code="{{ $data->code }}"
                        data-user_id="{{ $data->user_id }}" data-branch_id="{{ $data->branch_id }}"
                        data-branch_name="{{ $data->branch?->name }}"
                        data-work_space_name="{{ $data->workSpace?->name }}">
                        <i class="fas fa-globe" style="color: blue;"></i> إصدار بطاقة الإنترنت
                    </a>
                </li>
            @endif

            <!-- Desk Edit Button -->
            @if (auth('admin')->user()->can('edit_desk_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-desk_mangment_id="{{ $data->id }}"
                        data-work_space_id="{{ $data->work_space_id }}" data-name="{{ $data->name }}"
                        data-code="{{ $data->code }}" data-user_id="{{ $data->user_id }}"
                        data-start_date="{{ $data->start_date }}" data-end_date="{{ $data->end_date }}"
                        data-subscription_type_id="{{ $data->subscription_type_id }}" title="تعديل">
                        <i class="fas fa-edit" style="color: blue;"></i> تعديل
                    </a>
                </li>
            @endif

            <!-- Desk History Button -->

            @if ($data->user_id && auth('admin')->user()->can('view_invoice'))
                <li class="nav-item">
                    <a href="#" class="nav-link view-invoice" data-user_id="{{ $data->user_id }}"
                        data-desk_mangment_id="{{ $data->id }}" title="عرض الفاتورة">
                        <i class="fas fa-file-invoice" style="color: rgb(177, 177, 177);"></i> عرض الفاتورة
                    </a>
                </li>

            @endif



            @if (auth('admin')->user()->can('notification_internet_subscription') && $data->user_id)
                <li class="nav-item">
                    <a href="#" class="nav-link invoiceSingleModal" data-user_id="{{ $data->user_id }}"
                        title="{{ __('label.add_invoice') }}">
                        <i class="fas fa-file-invoice text-brown"></i> {{ __('label.add_invoice') }}
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('add_invoice') && $data->user_id)

            <li class="nav-item">
                <a href="#" class="nav-link notification_modal" data-user_id="{{ $data->user_id }}">
                    <i class="fas fa-bell text-warning"></i> تنبيه بالمستحقات المتبقية
                </a>
            </li>
            @endif
            @if (auth('admin')->user()->can('history_desk_mangment'))
            <li class="nav-item">
                <a href="#" class="nav-link desk_histories" data-desk_mangment_id="{{ $data->id }}"
                    title="سجل المقعد">
                    <i class="fas fa-history" style="color: gray;"></i> سجل المقعد
                </a>
            </li>
        @endif
            <!-- Release Desk Button -->
            @if (auth('admin')->user()->can('release_desk_mangment') && $data->user_id)
                <li class="nav-item">
                    <a href="#" class="nav-link release" data-id="{{ $data->id }}"
                        data-code="{{ $data->code }}" title="تحرير المقعد">
                        <i class="fas fa-rocket" style="color: green;"></i> تحرير المقعد
                    </a>
                </li>
            @endif

            <!-- Delete Desk Button -->



            @if (auth('admin')->user()->can('delete_desk_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link delete" data-id="{{ $data->id }}"
                        data-name_delete="{{ $data->code }}" title="حذف">
                        <i class="fas fa-trash" style="color: red;"></i> حذف
                    </a>
                </li>
            @endif
            {{-- @endif --}}

        </ul>
    </div>
</div>
