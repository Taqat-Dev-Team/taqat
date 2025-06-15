<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <h5 style="color: #0c0e1a">&times;</h5>
                    </span>
                </button>
            </div>

            <form class="needs-validation" id="my-form" action="{{ route('admin.attendances.attendances') }}" method="post" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <!-- Date Input -->
                        <div class="col-lg-6 col-sm-12">
                            <label for="date">
                                {{ __('label.date') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                    <input type="text" class="form-control datepicker"

                                    value="{{Carbon\Carbon::now()->format('d/m/Y')}}"
                                           name="date" placeholder=" " data-target="#kt_datetimepicker_10"/>
                                    <div class="input-group-append" data-target="#kt_datetimepicker_10" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Time Input -->
                        <div class="col-lg-6 col-sm-12">
                            <label for="time">
                                {{ __('label.time') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group timepicker">
                                <input type="text" class="form-control"
                                       name="time" id="kt_timepicker_2"

                                       value="17:30:00"
                                       readonly="readonly" placeholder=""/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-clock-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                        </i>
                        <span id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </span>
                    {{ __('label.submit') }}

                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                        {{ __('label.cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
