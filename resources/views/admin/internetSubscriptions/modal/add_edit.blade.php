<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_new_work_space') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form"
                action="{{ route('admin.workSpaceManagments.workSpaces.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->

                    <input type="hidden" class="form-control" id="add_edit_internet_subscription_id"
                        name="internet_subscription_id" required>


                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="parent_id">{{ __('label.status') }}

                                <span class="error">*</span>

                            </label>
                            <select class="form-control" id="add_edit_status" name="status" style="width: 100%">
                                <option value="">{{ __('label.status') }}</option>
                                <option value="1">
                                    {{ __('label.active') }}
                                </option>
                                <option value="2">
                                    {{ __('label.pendding') }}
                                </option>

                                <option value="3">
                                    {{ __('label.available') }}
                                </option>

                                <option value="0">
                                    {{ __('label.expired') }}
                                </option>

                                <option value="4">
                                    {{ __('label.delete_subscription') }}
                                </option>


                            </select>
                        </div>

                        <!-- حقل parent_id -->

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></span> {{__('label.submit')}} </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('label.close')}}</button>
                </div>

                <!-- زر التأكيد -->
            </form>
        </div>
    </div>
</div>
</div>
