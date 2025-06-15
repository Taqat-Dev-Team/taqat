<div class="modal fade" id="addexpenseModal" tabindex="-1" aria-labelledby="addexpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addexpenseModalLabel">{{ __('label.add_expense') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x&times;</span>
                </button>

            </div>
            <form class="needs-validation " id="add-expense" name="add-expense" method="POST"
                enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="amount" class="form-label">{{ __('label.amount') }}</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="">

                        </div>
                        <input type="hidden" class="form-control" id="add_edit_expense_user_id" name="user_id" placeholder="">



                        <div class="col-lg-6 col-sm-12">

                            <label for="currency_cd_id">
                                {{ __('label.amount_type') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control currency_cd_id" name="currency_cd_id" id="currency_cd_id" required
                                style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($currencies as $value)
                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                @endforeach


                            </select>
                            <div class="amout_type error"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="expense_id">
                                {{ __('label.expenses') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="expense_id" id="expense_id" required style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($expenses as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div class="expense_id error"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <label for="child_expense_id">
                                {{ __('label.child_expenses') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="child_expense_id" id="child_expense_id" required style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>
                            </select>
                            <div class="child_expense_id error"></div>
                        </div>
                    </div>


                        <div class="row">



                            <div class="col-lg-6 col-sm-12">
                                <label>{{ __('label.start_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" readonly="readonly"
                                        name="start_date" id="expiration_date" placeholder="" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label>{{ __('label.end_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" readonly="readonly"
                                        name="end_date" id="end_date" placeholder="" required />
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
                                <label for="payment_method_id">
                                    {{ __('label.payment_method') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="payment_method_id" id="payment_method_id" required style="width: 100%">
                                    <option value="">{{ __('label.selected') }}</option>
                                    @foreach ($paymentTypes as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <div class="expense_id error"></div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>
                            {{ __('label.submit') }}

                        </button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('label.close') }}</button>

                    </div>

            </form>
        </div>
    </div>
</div>
