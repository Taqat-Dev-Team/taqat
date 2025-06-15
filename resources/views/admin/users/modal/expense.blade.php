<!-- Expenses Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel">{{ __('label.expense_list') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom gutter-b">

                    <div class="card-body py-2">
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-6">
                                <div class="bg-light-success px-6 py-4 rounded-2">
                                    <label>{{ __('label.total_expense') }}</label>
                                    <span id="total_invoice">0.00</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="bg-light-warning px-6 py-4 rounded-2">
                                    <label>{{ __('label.total_payment') }}</label>
                                    <span id="total_payment">0.00</span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-hover expense_table" id="expense_table">
                            <thead>
                                <tr>
                                    <th>{{ __('label.amount') }}</th>
                                    <th>{{ __('label.start_date') }}</th>
                                    <th>{{ __('label.end_date') }}</th>
                                    <th>{{ __('label.status') }}</th>

                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
