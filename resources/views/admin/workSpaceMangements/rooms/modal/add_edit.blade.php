<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_room') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" action="{{ route('admin.workSpaceManagments.rooms.store') }}">
                @csrf
                <div class="modal-body">


                    <input type="hidden" class="form-control" id="add_edit_room_id" name="room_id" required>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="work_space_id">{{ __('label.work_space') }} <span
                                    class="error">*</span></label>
                            <select class="form-control" id="add_edit_work_space_id" name="work_space_id"
                                style="width: 100%">
                                <option value="">{{ __('label.work_space') }}</option>
                                @foreach ($workSpaces as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6  room_hide" style="display: none">
                            <label for="user_id">{{ __('label.users') }}</label>
                            <select class="form-control" id="add_edit_user_id" name="user_id" style="width: 100%">
                                <option value="">{{ __('label.users') }}</option>
                                @foreach ($users as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code">{{ __('label.code') }} <span class="error">*</span></label>
                            <input type="text" class="form-control" id="add_edit_code" name="code" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="capacity">{{ __('label.capacity') }} <span class="error">*</span></label>
                            <input type="number" min="0" class="form-control" id="add_edit_capacity"
                                name="capacity" required>
                        </div>



                        <div class="form-group col-md-6 room_hide" style="display: none">
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


                        <div class="form-group col-md-6 room_hide" style="display: none">
                            <label for="capacity">{{ __('label.amount') }} <span class="error">*</span></label>
                            <input type="number" min="0" class="form-control" id="add_edit_amount"
                                name="amount" required>
                        </div>



                        <div class="form-group col-md-6 room_hide" style="display: none">
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


                        <div class="form-group col-md-6 room_hide" style="display: none">
                            <label for="add_edit_subscription_type_id">{{ __('label.subscription_types') }} </label>
                            <select class="form-control" id="add_edit_subscription_type_id" name="subscription_type_id"
                                style="width: 100%">
                                <option value="">{{ __('label.subscription_types') }}</option>
                                @foreach ($subscriptionTypes as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 room_hide" style="display: none">
                            <label for="remote_admin">حالة الحضور</label>
                            <select class="form-control" id="add_edit_attendance_status" name="attendance_status"
                                style="width: 100%">
                                <option value="">{{ __('label.attendance_status') }}</option>
                                <option value="1">داخل الغرفة</option>
                                <option value="2">عن بعد</option>
                            </select>
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
