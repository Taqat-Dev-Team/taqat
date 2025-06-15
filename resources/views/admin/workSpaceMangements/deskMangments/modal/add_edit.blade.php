<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_new_desk_mangment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form"
                action="{{ route('admin.workSpaceManagments.deskManagments.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->



                    <div class="row">

                        <!-- حقل parent_id -->
                        <div class="form-group col-md-6">
                            <label for="parent_id">{{ __('label.work_space') }}

                                <span class="error">*</span>

                            </label>
                            <select class="form-control" id="add_edit_work_space_id" name="work_space_id"
                                style="width: 100%">
                                <option value="">{{ __('label.work_space') }}</option>
                                @foreach ($workSpaces as $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                            <label for="user_id">{{ __('label.users') }}


                            </label>
                            <select id="add_edit_user_id" name="user_id" class="form-control select2"
                                style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>


                            </select>
                        </div>





                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.code') }}

                                <span class="error">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_code" name="code" required>
                        </div>
                        <input type="hidden" class="form-control" id="add_edit_desk_mangment_id"
                            name="desk_mangment_id" required>

                        <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                            <label for="add_edit_subscription_type_id">{{ __('label.subscription_types') }} </label>
                            <select class="form-control" id="add_edit_subscription_type_id" name="subscription_type_id"
                                style="width: 100%">
                                <option value="">{{ __('label.subscription_types') }}</option>
                                @foreach ($subscriptionTypes as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                            <label>{{ __('label.start_date') }}</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                name="start_date" id="add_edit_start_date" placeholder="" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                        <label>{{ __('label.end_date') }}</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker" value="" readonly="readonly"
                                name="end_date" id="add_edit_end_date" placeholder="" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
               





                    <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                        <label for="add_edit_send_invoice">اصدار فاتورة   </label>
                        <select class="form-control" id="add_edit_send_invoice" name="send_invoice"
                            style="width: 100%">

                            <option value="0">لا</option>
                            <option value="1">نعم</option>

                        </select>
                    </div>


                     <div class="form-group col-md-6 desk_mnangment_hide" style="display: none">
                        <label for="add_edit_send_internet">ارسال حساب انترنت </label>
                        <select class="form-control" id="add_edit_send_internet" name="send_internet"
                            style="width: 100%">

                            <option value="0">لا</option>
                            <option value="1">نعم</option>

                        </select>
                    </div>



                    <div class="form-group col-md-6 add_edit_send_invoice_row" style="display: none">


                        <div class="form-group col-md-6">
                            <label for="amount">{{ __('label.amount') }}</label>
                            <input type="number" class="form-control" id="add_edit_amount" name="amount" step="0.01" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="currency">العملة</label>
                            <select class="form-control" id="add_edit_amount_type" name="amount_type" style="width: 100%">
                                <option value="1">دولار</option>
                                <option value="2">شيكل</option>
                            </select>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.close') }}</button>
                </div>

                <!-- زر التأكيد -->
            </form>
        </div>
    </div>
</div>
</div>
