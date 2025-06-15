<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title restaurant_edit" id="kt_modal_add_editLabel">{{ __('label.add_restaurant') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('admin.restaurants.store') }}">
                @csrf
                <div class="modal-body">


                    <div class="row">
           <div class="form-group col-md-6">
    <label for="name">{{ __('label.name') }} <span class="error">*</span></label>
    <input type="text" class="form-control" id="add_edit_name" name="name" required>
    <div class="text-danger" id="name_error"></div>
</div>

<!-- حقل البريد الإلكتروني -->
<div class="form-group col-md-6">
    <label for="add_edit_email">{{ __('label.email') }} <span class="error">*</span></label>
    <input type="text" class="form-control" id="add_edit_email" name="email" required>
    <div class="text-danger" id="email_error"></div>
</div>

<!-- حقل الجوال -->
<div class="form-group col-md-6">
    <label for="add_edit_mobile">{{ __('label.mobile') }} <span class="error">*</span></label>
    <input type="text" min="1" class="form-control" id="add_edit_mobile" name="mobile" required>
    <div class="text-danger" id="mobile_error"></div>
</div>
    <input type="hidden" min="1" class="form-control" id="add_edit_restaurant_id" name="restaurant_id" required>

<!-- حقل كلمة المرور -->
<div class="form-group col-md-6">
    <label for="add_edit_password">{{ __('label.password') }} <span class="error">*</span></label>
    <input type="password" class="form-control" id="add_edit_password" name="password">
    <div class="text-danger" id="password_error"></div>
</div>

<!-- حقل العنوان -->
<div class="form-group col-md-12">
    <label for="add_edit_address">{{ __('label.address') }} <span class="error">*</span></label>
    <input type="text" class="form-control" id="add_edit_address" name="address" required>
    <div class="text-danger" id="address_error"></div>
</div>

<!-- حقل نبذة -->
<div class="form-group col-md-12">
    <label for="add_edit_bio">{{ __('label.bio') }} <span class="error">*</span></label>
    <textarea type="text" class="form-control" id="add_edit_bio" name="bio" required> </textarea>
    <div class="text-danger" id="bio_error"></div>
</div>

<!-- حقل الصورة -->
<div class="form-group col-md-6">
    <label for="logo" class="form-label">{{ __('label.photo') }} <span class="text-danger">*</span></label>
    <input type="file" class="form-control" accept="image/jpg,jpeg,png,gif" id="logo" name="logo">
    <div class="text-danger" id="logo_error"></div>

    <div class="mb-3">
        <img id="add_edit_image-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px;">
    </div>
</div>
</div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('label.close') }}</button>
                    </div>

                    <!-- زر التأكيد -->
            </form>
        </div>
    </div>
</div>
</div>
