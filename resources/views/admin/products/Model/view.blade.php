<div class="modal fade" id="kt_modal_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.view_category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="view_name_ar" class="form-label">{{ __('messages.name_ar') }}
                            </label>
                        <input type="text" readonly class="form-control form-control-solid" id="view_name_ar" name="name_ar"
                        required>
                    </div>


                    <div class="col-md-6">
                        <label for="view_name_en" class="form-label">{{ __('messages.name_en') }}
                            </label>
                        <input type="text" class="form-control form-control-solid" id="view_name_en" name="name_en"
                            required>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="view_color_hex_code" class="form-label">{{ __('messages.color_hex_code') }} 
                            </label>
                        <input type="color" readonly class="form-control form-control-solid" id="view_color_hex_code"
                            name="font_hex_code" required>
                    </div>


                    <div class="col-md-6">
                        <label for="view_background_hex_code" class="form-label">{{ __('messages.background_hex_code') }}
                            </label>
                        <input type="color" readonly class="form-control form-control-solid"
                            id="view_background_hex_code" name="background_hex_code" required>
                    </div>

                </div>
                <div class="row mb-4">

                    <div class="col-md-6 ">
                        <label for="view_is_parent_category" class="form-label">{{ __('messages.is_parent_cateogy') }}

                            </label>
                        <div class="form-check form-check-custom form-check-solid">
                            <input readonly class="form-check-input" type="checkbox" id="view_is_parent_category" value="1"
                                name="is_parent_category">
                        </div>
                    </div>
                    <div class="col-md-6 parent_category_id" style="display: none">


                        <label for="view_parent_category_id" class="form-label">{{ __('messages.parent_cateogries') }}

                        </label>
                        <select class="form-select" disabled data-dir="rtl" id="view_parent_category_id" data-control="select2"
                            name="parent_category_id">
                            <option value="">{{ __('messages.select') }}</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="logo" class="form-label">{{ __('messages.logo') }}</label>


                        <div class="mb-3">
                            <img id="view_image-preview" src="#" alt="Image Preview"
                                style="display:none; max-width: 100px;">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">

                    <div class="col-md-6 ">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" readonly type="checkbox" id="is-active" value="1"
                                name="is_active">
                            <label class="form-check-label ms-2"
                                for="is-active">{{ __('messages.active') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->

        </div>
    </div>
</div>
