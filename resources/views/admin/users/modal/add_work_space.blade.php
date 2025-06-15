<div class="modal fade" id="addWorkSpaceModal" tabindex="-1" aria-labelledby="addWorkSpaceModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addWorkSpaceModalLabel"> {{ _('label.work_space') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="needs-validation" id="add-work-space" name="add-work-space" method="POST"
            enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">

                    <input type="hidden" name="user_id" id="add_work_space_user_id">
                    <div class="col-lg-6 col-sm-12">
                        <label for="work_space_id">
                            {{ __('label.work_space') }}
                        </label>
                        <select class="form-control select2" name="work_space_id" id="add_work_space_id"
                            required style="width: 100%">
                            <option value="">{{ __('label.select') }}</option>

                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <label for="work_space_type">
                            {{ __('label.work_space_type') }}
                        </label>
                        <select class="form-control select2" name="work_space_type" id="add_work_space_type"
                            required style="width: 100%">
                            <option value="">{{ __('label.select') }}</option>
                            <option value="1">{{ __('label.desk_mangments') }}</option>
                            <option value="2">{{ __('label.room_mangments') }}</option>
                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-6 col-sm-12 room_mangment" style="display: none">
                        <label for="room_id">
                            {{ __('label.rooms') }}
                        </label>
                        <select class="form-control select2" name="room_id" id="add_work_space_room_id"
                            required style="width: 100%">
                            <option value="">{{ __('label.select') }}</option>

                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 desk_mangment" style="display: none">
                        <label for="desk_mangment_id">
                            {{ __('label.desk_mangments') }}
                        </label>
                        <select class="form-control select2" name="desk_mangment_id"
                            id="add_work_space_desk_mangment_id" required style="width: 100%">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تأكيد
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </form>
    </div>
</div>
</div>
