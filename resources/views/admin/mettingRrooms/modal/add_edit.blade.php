<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_service') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('admin.workSpaceManagments.services.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->
                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-12">
                            <label for="name">{{ __('label.name') }}

                                <span class="error">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_name" name="name" required>
                        </div>




                    </div>
                    <div class="row">

                    <div class="form-group col-md-6">
                        <label for="cost">{{ __('label.amount') }}

                            <span class="error">*</span>
                        </label>
                        <input type="number" min="1" class="form-control" id="add_edit_amount" name="amount"
                            required>
                    </div>

                    <div class="col-lg-6 col-sm-12">

                        <label for="amout_type">
                            {{ __('label.amount_type') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control amout_type" name="amount_type" id="add_edit_amount_type" required
                            style="width: 100%">
                            <option value="">{{ __('label.selected') }}</option>

                            <option value="1">{{ __('label.dollar') }}
                            </option>
                            <option value="2">{{ __('label.shekel') }}
                            </option>
                        </select>
                        <div class="amout_type error"></div>

                    </div>
                    <input type="hidden" class="form-control" id="add_edit_service_id" name="service_id" required>

                    <!-- حقل parent_id -->

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
