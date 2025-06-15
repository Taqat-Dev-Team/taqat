<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="z-index: 1055;">
        <ul class="nav nav-hoverable flex-column">

            <!-- Send SMS Button -->
            <li class="nav-item">
                <a href="#" class="nav-link sendSms  gap-5"" data-user_id="{{ $data->user_id }}">
                    <i class="fas fa-sms" style="color:black"></i> {{__('label.send_sms')}}
                </a>
            </li>

            <!-- Edit Button -->
            <li class="nav-item">
                <a href="#" class="nav-link edit_invoice gap-5"
                   data-invoice_id="{{ $data->id }}"
                   data-amount="{{ $data->amount }}"
                   data-payment_type_id="{{ $data->payment_type_id }}"

                   data-status="{{ $data->status }}"
                   data-amount_type="{{ $data->amount_type }}"
                   data-expiration_date="{{ $data->expiration_date ? \Carbon\Carbon::parse($data->expiration_date)->format('Y-m-d') : '' }}"
                   data-due_date="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('Y-m-d') : '' }}">
                    <i class="fas fa-edit" style="color:blue"></i> {{ __('label.edit') }}
                </a>
            </li>
            @if($data->status==1)



            <li class="nav-item">
                <a  class="nav-link  gap-5"" href="{{route('admin.invoices.generateReceipt', ['invoice_id' => $data->id]) }}" target="_blank" title="سند قبض">
                    <span><i class="fas fa-file-pdf" style="color:green"></i></span>

                    سند قبض
                </a>
            </li>
                        @endif


            <!-- Delete Button -->
            @if(!$data->photo)
                <li class="nav-item">
                    <a href="#" id="{{ $data->id }}" name_delete="{{ $data->users?->name ?? 'Unknown' }}" class="nav-link delete">
                        <i class="fa fa-trash text-danger"></i> {{ __('label.delete') }}
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
