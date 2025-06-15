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
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->users?->name ?? 'Unknown' }}" class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>

        </ul>
    </div>
</div>
