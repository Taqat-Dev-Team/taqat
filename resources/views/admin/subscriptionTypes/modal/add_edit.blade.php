<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_subscription_type') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('admin.subscriptionTypes.store') }}">
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
                            <label for="name">{{ __('label.duration') }} (hours)

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_duration"
                                name="duration" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="cost">{{ __('label.cost') }} ($)

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_cost" name="cost"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="add_edit_subscription_type_id"
                            name="subscription_type_id" required>

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
