<!-- Invoice Modal -->
<div class="modal fade" id="internetSubscriptionModal" tabindex="-1" aria-labelledby="internetSubscriptionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="internetSubscriptionModalLabel">{{ __('label.internet_subscription') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.users.addSubscription')}}" method="POST" id="add_subscription" name="add_subscription">
                @csrf
                <div class="modal-body">

                    <div class="row">

                        <input type="hidden" name="user_id" id="internet_user_id">
                        <div class="form-group col-md-6">
                            <label for="add_edit_subscription_type_id">{{ __('label.subscription_types') }}

                                <span class="error">*</span>

                            </label>
                            <select class="form-control" id="add_edit_subscription_type_id" name="subscription_type_id"
                                style="width: 100%">

                                @foreach ($subscriptionTypes as $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                @endforeach


                            </select>
                        </div>

                        <!-- حقل parent_id -->

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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                            {{ __('label.cancel') }}
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
