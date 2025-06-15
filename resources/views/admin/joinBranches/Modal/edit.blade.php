<div class="modal fade" id="edit_Brand_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_exampleModalLabel">{{__('label.edit_registering_employees_departure')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="edit-form" novalidate  method="post">


                <div class="modal-body">
                    @csrf
                    <input type="hidden" class="user_id" name="user_id">
                    <input type="hidden" class="date" name="date" >


                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="date">

                                {{__('label.date')}}
                                       <span class="text-danger">*</span>

                               </label>

                               <div class="input-group timepicker">
                                <input class="form-control login_time" name="login_time" id="kt_timepicker_2" readonly="readonly" placeholder="حدد الوقت" type="text" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-clock-o"></i>
                                    </span>
                                </div>
                            </div>







                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <label for="date">
                                {{__('label.time')}}
                                       <span class="text-danger">*</span>

                               </label>

                               <div class="input-group timepicker">
                                <input class="form-control logout_time" name="logout_time" id="kt_timepicker_2" readonly="readonly" placeholder="حدد الوقت" type="text" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-clock-o"></i>
                                    </span>
                                </div>
                            </div>







                        </div>

                    </div>




</div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">

                            <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                            </i>
                            <span id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </span>
                        {{ __('label.submit') }}

                        </button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true"></i>
                                {{__('label.cancel')}}
                        </button>
                    </div>

            </form>
        </div>
    </div>
</div>
