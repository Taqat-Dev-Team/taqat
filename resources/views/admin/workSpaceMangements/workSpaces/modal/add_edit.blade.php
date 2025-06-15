<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_new_work_space') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{route('admin.workSpaceManagments.workSpaces.store')}}">
                @csrf
            <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->
                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.name') }}

                                <span class="error">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_name" name="name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.code') }}

                                <span class="error">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_code" name="code" required>
                        </div>
                        <input type="hidden" class="form-control" id="add_edit_work_space_id" name="work_space_id" required>

                    </div>

                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.room_count') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number" min="0" class="form-control" id="add_edit_room_count" name="room_count" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.desk_count') }}

                                <span class="error">*</span>
                            </label>
                            <input type="number"  class="form-control" id="add_edit_desk_count" name="desk_count" required>
                        </div>
                    </div>
                        <div class="row"
                        >

                        <!-- حقل parent_id -->
                        <div class="form-group col-md-6">
                            <label for="parent_id">{{ __('label.branch') }}

                                <span class="error">*</span>

                            </label>
                            <select class="form-control" id="add_edit_branch_id" name="branch_id" style="width: 100%">
                                <option value="">{{ __('label.branches') }}</option>
                                @foreach($branches as $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>





            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تاكيد </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>

                    <!-- زر التأكيد -->
                </form>
            </div>
        </div>
    </div>
</div>
