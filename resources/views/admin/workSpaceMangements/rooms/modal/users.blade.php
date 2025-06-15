<div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUsersModalLabel">مستخدمين الغرفة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="users-form" name="users-form" method="POST"
                action="{{route('admin.workSpaceManagments.rooms.postUsers')}}">
                @csrf
                <div class="modal-body">


                    <div class="form-group">
                        <label for="users">اختر المستخدمين:</label>
                        <select class="form-control" id="add_user_room" name="user_ids[]" multiple style="width: 100%">

                        </select>
                    </div>

                    <input type="hidden" name="room_id" id="add_room_users">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>

            </form>
        </div>
    </div>
</div>
