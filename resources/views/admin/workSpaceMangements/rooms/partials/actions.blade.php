<div class="dropdown text-center">
    <!-- Dropdown Button -->
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Internet Subscription Button (If expired) -->
            @if (auth('admin')->user()->can('internet_subscription_room_mangment') && $data->end_date < now())
                <li class="nav-item">
                    <a href="#" class="nav-link issue-internet-card" data-start_date="{{ $data->start_date }}"
                        data-end_date="{{ $data->end_date }}"
                        data-subscription_type_id="{{ $data->subscription_type_id }}" data-room_id="{{ $data->id }}"
                        data-work_space_id="{{ $data->work_space_id }}" title="إصدار بطاقة الإنترنت">
                        <i class="fas fa-globe" style="color: blue;"></i> إصدار بطاقة الإنترنت
                    </a>
                </li>
            @endif

            <!-- Room Edit Button -->
            @if (auth('admin')->user()->can('edit_room_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-room_id="{{ $data->id }}"
                        data-name="{{ $data->name }}" data-code="{{ $data->code }}"
                        data-capacity="{{ $data->capacity }}" data-user_id="{{ $data->user_id }}"
                        data-branch_id="{{ $data->branch_id }}" data-work_space_id="{{ $data->work_space_id }}"
                        data-subscription_type_id="{{ $data->subscription_type_id }}"
                        data-start_date="{{ $data->start_date }}" data-end_date="{{ $data->end_date }}"
                        data-amount="{{ $data->amount }}"
                        data-attendance_status="{{ $data->attendance_status }}" title="تعديل">
                        <i class="fas fa-edit" style="color: blue;"></i> تعديل
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('history_room_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link room_histories" data-room_id="{{ $data->id }}"
                        title="سجل الغرفة">
                        <i class="fas fa-history" style="color: gray;"></i> سجل الغرفة
                    </a>
                </li>
            @endif

            <!-- Release Room Button -->
            @if (auth('admin')->user()->can('release_room_mangment') && $data->user_id)
                <li class="nav-item">
                    <a href="#" class="nav-link release" data-id="{{ $data->id }}"
                        data-subscription_type_id="{{ $data->subscription_type_id }}" data-code="{{ $data->code }}"
                        title="تحرير الغرفة">
                        <i class="fas fa-rocket" style="color: green;"></i> تحرير الغرفة
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('user_room_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link users" data-room_id="{{ $data->id }}"
                        data-work_space_id="{{ $data->work_space_id }}"
                        data-user_ids="{{ json_encode($data->userRooms()->pluck('user_id')->toArray()) }}"
                        title="مستخدمين الغرفة">
                        <i class="fas fa-users" style="color: green;"></i> مستخدمين الغرفة
                    </a>
                </li>
            @endif

            <!-- Add Room Button -->
            @if (auth('admin')->user()->can('add_desk_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link add_room" data-room_id="{{ $data->id }}"
                        title="إضافة مكاتب للغرفة">
                        <i class="fas fa-plus" style="color: green;"></i> إضافة مكاتب للغرفة
                    </a>
                </li>
            @endif

            <!-- Delete Room Button -->
            @if (auth('admin')->user()->can('delete_room_mangment'))
                <li class="nav-item">
                    <a href="#" class="nav-link delete" data-id="{{ $data->id }}"
                        data-name_delete="{{ $data->code }}" title="حذف">
                        <i class="fas fa-trash" style="color: red;"></i> حذف
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
