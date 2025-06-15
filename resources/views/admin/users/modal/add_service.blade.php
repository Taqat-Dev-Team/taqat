<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title add-service" id="addServiceModalLabel">{{ __('label.add_service') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addServiceForm" action="{{ route('admin.users.addService') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.services') }}

                                <span class="error">*</span>
                            </label>
                            <select class="form-control " name="service_id" id="add_edit_service_id" required
                                style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($services as $value)
                                    <option value="{{ $value->id }}" data-is-monthly="{{ $value->is_monthly ?? 0 }}">
                                        {{ $value->name . '(' . $value->amount . ')' }}
                                        {{ $value->currencyCd?->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quantity">{{ __('label.quantity') }}
                                <span class="error">*</span>
                            </label>
                            <input type="number" class="form-control" id="add_edit_quantity" name="quantity" required>
                        </div>


                        <input type="hidden" " class="form-control" id="add_edit_service_user_id" name="user_id"
                    required>

                    </div>
                    <div class="row show_date" style="display: none;">
                        <div class="col-lg-6 col-sm-12">
                            <label>{{ __('label.start_date') }}</label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                    name="start_date" id="add_edit_service_start_date" placeholder="" />
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
                                <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                    name="end_date" id="add_edit_service_end_date" placeholder="" required />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Form fields for adding a service -->

                    <div class="row">

                    <div class="form-group col-md-6">
                        <label for="amount">{{ __('label.amount') }}
                            <span class="error">*</span>
                        </label>
                        <input type="number" class="form-control" id="add_edit_service_amount" name="amount" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="add_edit_send_sms">{{ __('label.send_sms') }}
                            <span class="error">*</span>
                        </label>
                    <select class="form-control" id="add_edit_send_sms"  required name="send_sms"
                        style="width: 100%">
                        <option value="">{{ __('label.selected') }}</option>

                        <option value="0">لا</option>
                        <option value="1">نعم</option>

                    </select>
                </div>

                    </div>



            </div>




            <div class="row">
                <div class="service-amount"></div>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('label.submit') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.close') }}</button>
            </div>
        </form>
    </div>
</div>
</div>
