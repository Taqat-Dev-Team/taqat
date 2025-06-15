<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_reading_generators') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form"
                action="{{ route('admin.generatorSubscriptions.generatorReceipt') }}">
                @csrf
                <div class="modal-body">


                    <div class="row">
                        <!-- حقل الاسم -->

                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.name') }}


                            </label>
                            <select id="add_edit_generator_subscription_id" name="generator_subscription_id"
                                class="form-control select2" style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($generator_subsriptions as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.amount') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" class="form-control" id="add_edit_amount" name="amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.date') }}

                                <span class="error">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                    name="date" id="add_edit_date" placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">
                            <label for="branch_id">
                                {{ __('label.send_sms') }}
                                <span class="error">*</span>

                            </label>
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" id="status" value="1" name="send_sms"
                                        checked="checked" />
                                    <span></span>
                                </label>
                            </span>
                        </div>


                        <input type="hidden" class="form-control" id="add_edit_receipt_id" name="receipt_id">






                        <!-- حقل parent_id -->

                    </div>


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
