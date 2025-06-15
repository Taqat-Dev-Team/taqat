<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('restaurants.products.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->
                    <!-- حقل الاسم -->
                    <!-- Name and Email Fields -->
                    <input type="hidden" class="form-control" id="add_edit_product_id" name="product_id" required>

                    <!-- حقل الاسم -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="add_edit_name" class="form-label fw-bold">
                                {{ __('label.name') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_name" name="name" required>
                            <div class="error text-danger name"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="add_edit_price" class="form-label fw-bold">
                                {{ __('label.price') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="add_edit_price" name="price" required>
                            <div class="error text-danger price"></div>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="add_edit_name" class="form-label fw-bold">
                                {{ __('label.categories') }} <span class="text-danger">*</span>
                            </label>

                            <select class="form-control" id="add_edit_category_id" name="category_id"
                                style="width: 100%">
                                <option value="">{{ __('label.select_category') }}</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>

                            <div class="error text-danger name"></div>
                        </div>



                        <div class="col-md-6">
                            <label for="logo" class="form-label fw-bold">
                                {{ __('label.photo') }} <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" accept="image/jpg,jpeg,png,gif" id="logo"
                                name="logo">
                            <div class="error text-danger logo"></div>
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <div>
                                <label class="form-label d-block">&nbsp;</label>
                                <img id="add_edit_image-preview" src="#" alt="Image Preview"
                                    style="display:none; max-width: 100px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                        </div>
                    </div>

                    <!-- الحالة (نشط / غير نشط) -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="add_edit_status" class="form-label fw-bold">{{ __('label.status') }}</label>
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" class="chk-box" id="is_active" checked name="is_active"
                                        value="1">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                </div>


                    <div class="modal-footer">
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary" form="my-form">
                            <i class="ki ki-submit-duotone fs-2"></i>{{ __('label.submit') }}
                        </button>

                        <!-- Cancel Button -->
                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            <i class="ki ki-times-duotone fs-2"></i> {{ __('label.cancel') }}
                        </button>

                        <!-- Spinner (hidden initially) -->
                        <div id="spinner" class="spinner-border text-primary" role="status"
                            style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</div>
