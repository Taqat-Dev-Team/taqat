@php
    $logout_time = $data->logout_time ? \Carbon\Carbon::parse($data->logout_time)->format('H:i') : null;
    $date = $data->attendance_date ? \Carbon\Carbon::parse($data->attendance_date)->format('Y-m-d') : null;
    $login_time = $data->login_time ? \Carbon\Carbon::parse($data->login_time)->format('H:i') : null;
@endphp

<div class="dropdown">
    <button class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            @can('update_attendances')
                <li class="nav-item">
                    <a class="nav-link edit_attendances" href="#" data-date="{{ $date }}" data-user_id="{{ $data->id }}" data-logout_time="{{ $logout_time }}" data-login_time="{{ $login_time }}">
                        <i style="color:blue" class="fas fa-edit"></i>{{__('label.edit')}}
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
