<div class="modal fade" id="open_add_subscription_Modal" tabindex="-1" aria-labelledby="sendNotificationModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="sendNotificationModalLabel">{{ __('label.notifications') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form id="send_notification" method="POST"
                action="{{ route('admin.users.sendNotification') }}">
                @csrf


                <input type="hidden" id="user_id" name="user_id">

                <h3> هل انت متاكد من ارسال اشعار تنبيه فواتير المستحقة</h3>


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ __('label.close') }}</button>
            <button type="submit" class="btn btn-primary"
                id="assignSubscription">{{ __('label.submit') }}</button>
        </div>
        </form>

    </div>
</div>
</div>
