<div class="modal fade" id="invoiceSingleModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-single-invoice" id="invoiceModalLabel">{{ __('label.export_invoice_monthly') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="my-single-invoice" action="{{route('admin.users.storeSingleInvoce')}}" name="my-single-invoice" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="single_amount" class="form-label">{{ __('label.amount') }}</label>
                            <input type="number" class="form-control" id="add_edit_amount" name="amount">
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="amout_type">
                                {{ __('label.amount_type') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control amout_type" name="amout_type" id="add_edit_amount_type" required
                                style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($currencies as $value)
                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                @endforeach

                            </select>
                            <div class="amout_type error"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="invoce_user_id" name="user_id" placeholder="">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>{{ __('label.expiration_date') }}</label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                    name="expiration_date" id="add_edit_expiration_date" placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <label>{{ __('label.due_date') }}</label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                    name="due_date" id="add_edit_due_date" placeholder="" required />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                    <div class="col-lg-6 col-sm-12">
                        <label for="status" class="form-label fw-bold">الحالة</label>
                        <select class="form-control form-select status" id="add_edit_invocie_status" name="status"
                            required style="width: 100%">
                            <option value="">اختر</option>
                            <option value="0" class="text-danger">غير مدفوع</option>
                            <option value="1" class="text-success">مدفوع</option>
                            <option value="2" class="text-warning">قيد الانتظار</option>
                            <option value="3" class="text-muted">ملغى</option>
                        </select>
                    </div>

                    <input type="hidden" class="form-control" id="invoce_id" name="invoce_id">
                </div>

                <div class="row payment_type_block" style="display: none" id="payment_type_block">
                    <div class="col-lg-6 col-sm-12">
                        <label for="status" class="form-label fw-bold">طريقة الدفع</label>
                        <select class="form-control form-select status" id="add_edit_payment_type_id"
                            name="payment_type_id" required style="width: 100%">
                            <option value="">اختر</option>

                            @foreach ($paymentTypes as $value )

                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                {{ __('label.submit') }}
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.close') }}</button>
        </div>
        </form>
    </div>
</div>
</div>
