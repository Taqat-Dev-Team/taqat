<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Button -->
            <li class="nav-item">
                <a href="#" class="nav-link edit_withdraw" data-withdraw_id="{{ $data->id }}">
                    <i class="fas fa-edit" style="color:blue"></i> {{__('label.edit')}}
                </a>
            </li>

        </ul>
    </div>
</div>
