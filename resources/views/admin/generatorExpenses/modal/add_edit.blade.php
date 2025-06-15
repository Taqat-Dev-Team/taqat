<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">بيانات مصاريف المولد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form"
                action="{{ route('admin.generatorExpenses.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-lg-4 col-sm-12">
                            <label for="expense_title">{{ __('label.title') }}</label>
                            <input type="text" class="form-control" id="expense_title" name="title" required>

                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="date">
                                {{ __('label.date') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                    <input type="text" class="form-control datepicker" required name="date"
                                        id="date" placeholder=" " data-target="#kt_datetimepicker_10" />
                                    <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                        data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                                  <div class="col-lg-4 col-sm-12">
                    <label>{{ __('label.generator') }}</label>

                    <select id="generator_id" name="generator_id" class="form-control select2" style="width: 100%">
                        <option value="">{{ __('label.selected') }}</option>

                        @foreach ($generators as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="expense_total_price">{{ __('label.price') }}</label>
                            <input type="number" class="form-control" id="expense_price" name="price" min="0"
                                required>
                            <input type="hidden" class="form-control" id="expense_id" name="expense_id" required>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="expense_quantity">{{ __('label.quantity') }}</label>
                            <input type="number" class="form-control" id="expense_quantity" name="quantity"
                                min="1" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="expense_total_price">{{ __('label.total_price') }}</label>
                            <input type="number" class="form-control" id="expense_total_price" name="total_amount"
                                min="0" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expense_cash_paid">{{ __('label.cash_paid') }}</label>
                            <input type="number" class="form-control" id="expense_cash_paid" name="cash_paid" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="expense_bank_paid">{{ __('label.bank_paid') }}</label>
                            <input type="number" class="form-control" id="expense_bank_paid" name="bank_paid" required>
                        </div>
                    </div>
                    <input type="hidden" name="expense_generator_id" id="expense_generator_id">



                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('label.close') }}</button>
                </div>

                <!-- زر التأكيد -->
            </form>
        </div>
    </div>
</div>
</div>
