<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_new_equities') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{route('admin.accounts.equities.store')}}">
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
                        <input type="hidden" class="form-control" id="add_edit_account_id" name="account_id" required placeholder="">

                        <!-- حقل parent_id -->
                        <div class="form-group col-md-6">
                            <label for="parent_id">{{ __('label.parent_asset') }}

                                <span class="error">*</span>

                            </label>
                            <select class="form-control" id="add_edit_parent_id" name="parent_id" style="width: 100%"  placeholder="{{__('label.selected')}}">
                                <option value="">{{ __('label.select_parent') }}</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">
                                        {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                    <!-- حقل balance_type_id -->
                    <div class="form-group col-md-6">
                        <label for="balance_type_id">{{ __('label.balance_type') }}

                            <span class="error">*</span>

                        </label>
                        <select class="form-control" id="add_edit_balance_type_id" name="balance_type_id" style="width: 100%">
                            <option value="">{{ __('label.select_balance_type') }}</option>
                            @foreach($balanceTypes as $balanceType)
                                <option value="{{ $balanceType->id }}">
                                    {{ $balanceType->value}}
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
