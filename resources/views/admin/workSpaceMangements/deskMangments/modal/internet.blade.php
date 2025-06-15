<div class="modal fade" id="kt_modal_internet" tabindex="-1" aria-labelledby="kt_modal_internet_Label"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="kt_modal_internet_Label">{{ __('label.subscription_internet') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="internet-form" method="POST" name="internet-form"
            action="{{ route('admin.workSpaceManagments.deskManagments.subscriptionInternet') }}">
            @csrf
            <div class="modal-body">





         

                <div class="row">

                    <input type="hidden" class="form-control" id="add_edit_subscription_internet_id"
                        name="subscription_internet_id" required>


                    <input type="hidden" class="form-control" id="add_edit_internet_desk_mangment_id"
                        name="desk_mangment_id" required>

                    <div class="form-group col-md-6">
                        <label for="add_edit_subscription_type_id">{{ __('label.subscription_types') }}
                        </label>
                        <select class="form-control" id="add_edit_internet_subscription_type_id"
                            name="subscription_type_id" style="width: 100%">
                            <option value="">{{ __('label.subscription_types') }}</option>
                            @foreach ($subscriptionTypes as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                            aria-hidden="true"></i></span> تاكيد </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>

        </form>
    </div>
</div>
</div>
