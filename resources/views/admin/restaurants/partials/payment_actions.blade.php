<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Button -->
            {{-- @if (auth('admin')->user()->can('edit_restaurant')) --}}
                <li class="nav-item">
                    <a href="#" class="nav-link edit"
                        data-restorant_payment_id="{{ $data->id }}"
                        data-amount="{{ $data->amount }}"
                       data-photo="{{ $data->getPhoto() }}"
                   >
                        <i class="fas fa-edit text-primary"></i> {{ __('label.edit') }}
                    </a>
                </li>
            {{-- @endif --}}

            <!-- Delete Button -->


            {{-- @if (auth('admin')->user()->can('delete_restaurant')) --}}
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->restaurants?->name }}"
                        class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            {{-- @endif --}}
        </ul>
    </div>
</div>
