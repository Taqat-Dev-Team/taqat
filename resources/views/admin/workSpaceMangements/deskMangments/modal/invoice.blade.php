
<div class="modal fade" id="invoiceSingleModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="invoiceModalLabel">إصدار فاتورة شهرية</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x&times;</span>
            </button>
        </div>
        <form class="needs-validation" id="my-single-invoice"  name="my-single-invoice" method="POST"
            enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="single_amount" class="form-label">المبلغ</label>
                        <input type="number" class="form-control" id="single_amount" name="amount"
                            placeholder="أدخل المبلغ">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="amout_type">
                            العملة
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control amout_type" name="amout_type" id="amout_type" required
                            style="width: 100%">
                            <option value="">{{__('label.selected')}}</option>
                            @foreach ($currencies as $value)
                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                        @endforeach
                        </select>
                        <div class="amout_type error"></div>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="invoce_user_id" name="user_id"
                    placeholder="">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label>{{ __('label.expiration_date') }}</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker" value=""
                                readonly="readonly" name="expiration_date" id="expiration_date"
                                placeholder="" />
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
                            <input type="text" class="form-control datepicker" value=""
                                readonly="readonly" name="due_date" id="due_date" placeholder=""
                                required />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تاكيد
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </form>
    </div>
</div>
</div>
