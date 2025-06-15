<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            <li class="nav-item">
                <a href="#"
                    class="nav-link  view" data-order_id="{{$data->id}}">
                    <i class="fa fa-eye text-waring"></i> {{ __('label.view') }}
                </a>
            </li>

               <li class="nav-item">
                <a href="#"
                    class="nav-link  edit" data-order_id="{{$data->id}}"
data-status_cd_id="{{$data->status_cd_id}}"
                    >
                    <i class="fa fa-edit text-primary "></i> {{ __('label.edit') }}
                </a>
            </li>


        </ul>
    </div>
</div>
