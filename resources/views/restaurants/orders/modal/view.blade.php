<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">{{ __('label.order_details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('label.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="order-details-content">
                <!-- سيتم تعبئة التفاصيل هنا عبر AJAX -->
            </div>
        </div>
    </div>
</div>
