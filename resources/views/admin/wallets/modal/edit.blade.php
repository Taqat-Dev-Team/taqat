    <div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">تغير حالة معاملة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="my-form" name="my-form" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="row">




                            <div class="col-lg-6 col-sm-12">
                                <label for="status" class="form-label fw-bold">الحالة</label>
                                <select class="form-control form-select " id="status_cd_id" name="status_cd_id" required
                                    style="width: 100%">
                                    <option value="">{{ __('label.selected') }}</option>
                                    <option value="">{{ __('اختر الحالة') }}</option>
                                    <option value="1">{{ __('تم الدفع') }}</option>
                                    <option value="2">{{ __('قيد الانتظار') }}</option>
                                </select>
                            </div>

                            <input type="hidden" class="form-control" id="wallet_id" name="wallet_id">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span> تاكيد </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
