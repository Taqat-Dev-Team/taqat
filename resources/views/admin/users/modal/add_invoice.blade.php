<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title add-invoice" id="addInvoiceModalLabel">{{ __('label.add_invoice') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x&times;</span>
                </button>

            </div>
            <form class="needs-validation " id="my-invoice" name="my-invoice" method="POST"
                enctype="multipart/form-data">

                <div class="modal-body">

                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>من تاريخ</label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" readonly="readonly"
                                    name="expiration_date" id="add_edit_expiration_date" placeholder="" required />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label>الى تاريخ </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" readonly="readonly"
                                    name="adue_date" id="add_edit_due_date" placeholder="" />
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
            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                        aria-hidden="true"></i></span>
                {{ __('label.submit') }}

            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.close') }}</button>

        </div>

        </form>
    </div>
</div>
</div>
