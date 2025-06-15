<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('label.add_bill_exchange') }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="my-form" novalidate method="post" action="">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="bill_exchange_id" name="bill_exchange_id">
                    <div class="form-group row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="name">{{ __('label.name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="name"></div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="mobile">{{ __('label.mobile') }} <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" id="mobile" required>
                            <div class="mobile"></div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="id_number">{{ __('label.Idnumber') }} <span class="text-danger">*</span></label>
                            <input type="text" name="id_number" class="form-control" id="id_number" required>
                            <div class="id_number"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="amount">{{ __('label.amount') }} <span class="text-danger">*</span></label>
                            <input type="number" min="1" name="amount" class="form-control" id="amount" required>
                            <div class="amount error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="amount_letter">{{ __('label.amount_letter') }} <span class="text-danger">*</span></label>
                            <input type="text" name="amount_letter" class="form-control" id="amount_letter" required>
                            <div class="amount_letter error"></div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="date">{{ __('label.date') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker" name="date" id="date" readonly required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="method">{{ __('label.payment_method') }} <span class="text-danger">*</span></label>
                            <div class="border p-3 rounded">
                                <!-- Cash -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="payment_method" value="cash" id="method_cash">
                                    <label class="form-check-label" for="method_cash">
                                        نقدًا
                                    </label>
                                </div>

                                <!-- Bank Transfer -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="payment_method" value="bank_transfer" id="method_bank_transfer">
                                    <label class="form-check-label" for="method_bank_transfer">
                                        تحويل بنكي
                                    </label>
                                </div>

                                <!-- Cheque -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="payment_method" value="cheque" id="method_cheque">
                                    <label class="form-check-label" for="method_cheque">
                                        شيك
                                    </label>
                                    <div class="mt-2">
                                        <input type="text" class="form-control mt-1" name="cheque_number" id="cheque_number" placeholder="رقم الشيك" disabled>
                                        <input type="text" class="form-control mt-1" name="bank_name" id="bank_name" placeholder="اسم البنك" disabled>
                                    </div>
                                </div>

                                <!-- Other -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="payment_method" value="other" id="method_other">
                                    <label class="form-check-label" for="method_other">
                                        طريقة أخرى
                                    </label>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="other_method" id="other_method" placeholder="طريقة أخرى" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane hiden_icon"></i>
                        <span id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </span>
                        {{ __('label.submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-window-close"></i> {{ __('label.cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
