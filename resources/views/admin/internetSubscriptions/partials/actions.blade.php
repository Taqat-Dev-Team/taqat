<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            @if(auth('admin')->user()->can('edit_internet_subscription'))

            <!-- Edit Button -->
            <li class="nav-item">
                <a href="#" class="nav-link edit" title="تعديل"
                   data-internet_subscription_id="{{ $data->id }}"
                   data-status="{{ $data->status }}">
                    <i class="fas fa-edit text-primary"></i> {{__('label.edit')}}
                </a>
            </li>
            @endif


            <!-- Users Button (Only for specific route condition) -->
            @if(request()->segment(4) == 'getAvailable' &&auth('admin')->user()->can('view_available_internet_subscription'))
                <li class="nav-item">
                    <a href="#" class="nav-link users"title="المستخدمين"
                       data-internet_subscription_id="{{ $data->id }}">
                        <i class="fas fa-users text-info"></i> {{__('label.users')}}
                    </a>
                </li>
            @endif
            @if(request()->segment(4) == 'getReady' &&auth('admin')->user()->can('notification_internet_subscription'))


                <li class="nav-item">
                    <a href="#" class="nav-link notification_modal"
                       data-user_id="{{ $data->user_id }}" title="اشعار تنبيه مستحقات المتببقية">
                        <i class="fas fa-bell text-warning"></i> {{__('label.notifications')}}
                    </a>
                </li>
                @endif



        </ul>
    </div>
</div>
