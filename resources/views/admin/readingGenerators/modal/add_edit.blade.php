<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_reading_generators') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('admin.readingGenerators.store') }}">
                @csrf
                <div class="modal-body">


                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="generator_subscription_id">{{ __('label.name') }}


                            </label>
                            <select id="add_edit_generator_subscription_id" name="generator_subscription_id"
                                class="form-control select2" style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($generator_subsriptions as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="killo_watt_cost">سعر كيلو واط

                                <span class="error">*</span>
                            </label>
                            <input type="number" class="form-control" id="add_edit_killo_watt_cost"
                                name="killo_watt_cost" required>
                        </div>

                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.current_reading') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" class="form-control" id="add_edit_current_reading"
                                name="current_reading" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cost">{{ __('label.consumption_quantity') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="0" class="form-control" id="add_edit_consumption_quantity"
                                name="consumption_quantity" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.consumption_value') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_consumption_value"
                                name="consumption_value" required>
                        </div>


                        <div class="col-lg-6 col-sm-12">
                            <label for="send_sms">
                                {{ __('label.send_sms') }}
                                <span class="error">*</span>

                            </label>
                            <select class="form-control select2" name="send_sms" style="width: 100%;" required>
                                <option value="">{{ __('label.select') }}</option>
                                <option value="1">{{ __('label.yes') }}</option>
                                <option value="0">{{ __('label.no') }}</option>


                            </select>
                        </div>


                        <input type="hidden" class="form-control" id="add_edit_reading_generator_id"
                            name="reading_generator_id" required>

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
