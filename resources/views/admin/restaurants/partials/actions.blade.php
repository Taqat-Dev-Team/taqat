<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.restaurants.view', $data->id) }}" class="nav-link ">
                    <i class="fa fa-eye text-waring"></i> {{ __('label.view') }}
                </a>
            </li>
            <!-- Edit Button -->
            @if (auth('admin')->user()->can('edit_restaurant'))
                <li class="nav-item">
                    <a href="#" class="nav-link edit" data-bio="{{$data->bio }}"
                        data-restaurant_id="{{ $data->id }}" data-name="{{ $data->name }}"
                        data-email="{{ $data->email }}" data-mobile="{{ $data->mobile }}"
                        data-address="{{ $data->address }}" data-logo="{{ $data->logo }}">
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                    </a>
                </li>
            @endif

            <!-- Delete Button -->


            @if (auth('admin')->user()->can('delete_restaurant'))
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->name }}"
                        class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
