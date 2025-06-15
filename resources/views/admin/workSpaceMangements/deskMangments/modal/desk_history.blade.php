<div class="modal fade" id="RoomHistoryModal" tabindex="-1" aria-labelledby="RoomHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RoomHistoryModalLabel">سجل المقعد </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="DeskHistoriesTable" >
                    <thead>
                        <tr>
                            <th>اسم</th>
                            <th>الايميل</th>

                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                        </tr>
                    </thead>
                    <tbody >
                        <!-- سيتم ملء البيانات هنا عبر AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.close') }}</button>
            </div>
        </div>
    </div>
</div>
