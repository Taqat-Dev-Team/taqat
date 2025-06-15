<div class="modal fade" id="releaseModal" tabindex="-1" aria-labelledby="releaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="releaseModalLabel">تأكيد التحرير</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="release-form" name="release-form" method="POST" action="{{ route('admin.workSpaceManagments.rooms.release') }}">
                @csrf
            <div class="modal-body">


                    هل انت متأكد من تحرير الغرفة مع رقم الكود <strong id="roomCode"></strong>؟

                    <input type="hidden" name="room_id" id="release_room_id" >
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="confirmRelease">تحرير</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
            </form>
        </div>
    </div>
</div>
