<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Button -->
            @if(auth('admin')->user()->can('edit_generator_subscription') && !request('status')=='delete-generator-subscriptions')
                <li class="nav-item">
                    <a href="#" class="nav-link edit"
                       data-generator_subscription_id="{{ $data->id }}"
                       data-name="{{ $data->name }}"
                       data-initial_reading="{{ $data->initial_reading }}"
                       data-killo_watt_cost="{{ $data->killo_watt_cost }}"
                       data-generator_id="{{ $data->generator_id }}"


                       data-mobile="{{ $data->mobile }}">
                        <i class="fas fa-edit text-primary"></i> {{__('label.edit')}}
                    </a>
                </li>
            @endif



            @if(auth('admin')->user()->can('view_generator_readings') && !request('status')=='delete-generator-subscriptions')
                <li class="nav-item">
                    <a href="#" class="nav-link list-reading-generators"
                       data-generator_subscription_id="{{ $data->id }}">
                        <i class="fas fa-list text-info"></i> {{__('label.reading_generators')}}
                    </a>
                </li>
            @endif

            @if(auth('admin')->user()->can('add_generator_reading') && !request('status')=='delete-generator-subscriptions')
                <li class="nav-item">
                    <a href="#" class="nav-link add-reading-generators"
                       data-generator_subscription_id="{{ $data->id }}">
                        <i class="fas fa-plus text-success"></i> {{__('label.add_reading_generators')}}
                    </a>
                </li>
            @endif

            @if(!request('status')=='delete-generator-subscriptions')
                <li class="nav-item">
                    <a href="#" class="nav-link list-generator-receipts"
                       data-generator_subscription_id="{{ $data->id }}">
                        <i class="fas fa-file-alt text-warning"></i> {{__('label.list_generator_receipts')}}
                    </a>
                </li>
            @endif

           @if(auth('admin')->user()->can('add_generator_receipt') && !request('status')=='delete-generator-subscriptions')
                <li class="nav-item">
                    <a href="#" class="nav-link add-generator-receipts"
                       data-generator_subscription_id="{{ $data->id }}">
                        <i class="fas fa-plus-circle text-success"></i> {{__('label.add_generator_receipts')}}
                    </a>
                </li>
             @endif



            @if (auth('admin')->user()->can('restore_generator_subscription') && request('status') )
            <li class="nav-item">
                <a href="#" class="nav-link btn-restore" data-id="{{ $data->id }}"
                    name_delete="{{ $data->name }}" title="Restore Generator">
                    <i class="fas fa-undo text-success"></i> {{ __('label.restore_generator_subscription') }}
                </a>
            </li>
          @endif
            @if(auth('admin')->user()->can('delete_generator_subscription') && !request('status')=='delete-generator-subscriptions')
            <li class="nav-item">
                <a href="#" id="{{ $data->id }}" name_delete="{{ $data->name }}" class="nav-link delete">
                    <i class="fa fa-trash text-danger"></i>  {{__('label.delete')}}
                </a>
            </li>
        @endif
        </ul>
    </div>
</div>
