<div class="dropdown text-center">
    <button class="btn btn-sm btn-light btn-icon" data-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="z-index: 1055;">
        <ul class="nav nav-hoverable flex-column">

            <!-- Edit Button -->
            <li class="nav-item">
                <a href="#" class="nav-link edit_expense gap-5"


                data-expense_id="{{$data->id}}"
                data-account_id="{{$data->account_id}}"

                data-child_account_id="{{$data->child_account_id}}"
                data-user_id="{{$data->user_id}}"
                data-payment_method_id="{{$data->payment_method_id}}"
                data-amount="{{$data->amount}}"
                data-currency_cd_id="{{$data->currency_cd_id}}"
                data-start_date="{{$data->start_date}}"
                data-end_date="{{$data->end_date}}">

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
