<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_generator_subscription') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('admin.generatorSubscriptions.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->
                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.name') }}

                                <span class="error">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_name" name="name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.mobile') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_mobile"
                                name="mobile" required>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="send_sms">
                                {{ __('label.generator_name') }}
                                 <span class="error">*</span>

                            </label>
                            <select class="form-control select2" name="generator_id" id="add_edit_generator_id" style="width: 100%;" required>
                                <option value="">{{ __('label.select') }}</option>
                       @foreach ($generators as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>







                        <div class="form-group col-md-6">
                            <label for="cost">{{ __('label.killo_watt_cost') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_killo_watt_cost" name="killo_watt_cost"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cost">{{ __('label.initial_reading') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="0" class="form-control" id="add_edit_initial_reading" name="initial_reading"
                                required>
                        </div>



                        <input type="hidden" class="form-control" id="add_edit_generator_subscription_id"
                            name="generator_subscription_id" required>

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
