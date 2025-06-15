<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true" style="z-index: 1050;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">{{ __('label.view_all_invoices') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom gutter-b">
             
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-lg-6 col-sm6">
                                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                    <label>{{ __('label.total_invoice') }}</label>
                                    <span id="total_invoice"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm6">
                                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                    <label>{{ __('label.total_payment') }}</label>
                                    <span id="total_payment"></span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-head-custom table-vertical-center invoice_table"
                            id="invoice_table">
                            <thead>
                                <tr class="text-left">
                                    <th></th>
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.amount') }}</th>
                                    <th>{{ __('label.start_date') }}</th>
                                    <th>{{ __('label.end_date') }}</th>
                                    <th>{{ __('label.status') }}</th>
                                    <th>{{ __('label.created_at') }}</th>
                                    <th></th>


                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
