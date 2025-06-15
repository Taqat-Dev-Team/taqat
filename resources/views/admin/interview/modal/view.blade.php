
<div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl"" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="contractModalLabel"{{__('label.Contract_details')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form or content for the modal goes here -->




                <div class="row">
                    <!-- Date Input -->
                    <div class="col-lg-6 col-sm-12">
                        <label for="start_date">
                            {{ __('label.start_date') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                <input type="text" class="form-control datepicker" value=""
                                    name="start_date" placeholder=" " data-target="#kt_datetimepicker_10" />
                                <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text">
                                        <i class="ki ki-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Input -->
                    <div class="col-lg-6 col-sm-12">
                        <label for="end_date">
                            {{ __('label.end_date') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                <input type="text" class="form-control datepicker" value=""
                                    name="end_date" placeholder=" " data-target="#kt_datetimepicker_10" />
                                <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text">
                                        <i class="ki ki-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">

                        <label for="requirements">{{ __('label.job_requirements') }}</label>
                        <textarea class="form-control ckeditor" id="requirements" name="requirements" rows="3" required></textarea>

                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-6 col-sm-12">

                        <label for="salary">{{ __('label.salary') }}
                            <span class="text-danger">*</span>

                        </label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary"
                            required>

                    </div>
                    <div class="col-lg-6 col-sm-12">

                        <label for="attachment">{{ __('label.attachments') }}</label>
                        <input type="file" class="form-control " id="attachment" name="attachment">
                    </div>
                </div>
                <div class="row ">

                <div class="col-lg-6 col-sm-12">
                    <label for="specialization_id">
                        {{__('label.specializations')}}
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-control select_2" name="specialization_id" id="specialization_id" >
                        <option value="">{{__('label.seleted')}}</option>

                        @foreach ($specializations as $value)
                            <option value="{{ $value->id }}" @if($value->id==$job->specialization_id) selected @endif>{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-primary">{{ __('label.submit') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
