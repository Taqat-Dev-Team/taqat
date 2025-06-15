@extends('layouts.front')
@section('title', 'البيانات الشخصية')
@section('content')




    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل البيانات الشخصية الخاص بك</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->
                <h6 class="card-label"></h6>


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">

            <div class="modal-body">

                <form class="needs-validation " id="form" name="form" method="POST" enctype="multipart/form-data"
                    style="margin:auto">
                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    @csrf

                    <div class="row">
                        <div class="col-lg-3  col-sm-12">
                            <div class="form-group">
                                <label for="name">الاسم
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="first_name"
                                    value="{{ auth()->user()->first_name }}" name="first_name" required>
                                <div class="error name"></div>

                            </div>
                        </div>

                        <div class="col-lg-3  col-sm-12">
                            <div class="form-group">
                                <label for="name">الاسم الاب
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="second_name"
                                    value="{{ auth()->user()->second_name }}" name="second_name" required>
                                <div class="error name"></div>

                            </div>
                        </div>

                        <div class="col-lg-3  col-sm-12">
                            <div class="form-group">
                                <label for="third_name">اسم الجد
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="third_name"
                                    value="{{ auth()->user()->third_name }}" name="third_name" required>
                                <div class="error name"></div>

                            </div>
                        </div>

                        <div class="col-lg-3  col-sm-12">
                            <div class="form-group">
                                <label for="name">اسم العائلة
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="last_name"
                                    value="{{ auth()->user()->last_name }}" name="last_name" required>
                                <div class="error last_name"></div>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-3  col-sm-12">
                            <div class="form-group">
                                <label for="id_number">رقم الهوية
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="id_number" required
                                    value="{{ auth()->user()->id_number }}" name="id_number">
                                <div class="error id_number"></div>

                            </div>
                        </div>


                        <div class="col-lg-3 col-sm-12">

                            <label for="date">
                                تاريخ الميلاد
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group birth_date">
                                <input type="text" class="form-control datepicker" value="{{auth()->user()->birth_date}}" readonly="readonly" required
                                    name="birth_date" placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="birth_date error"></div>
                        </div>



                        <div class="col-lg-3 col-sm-12">
                            <label for="photo">صورة الهوية
                                <span style="color: red">*</span>
                            </label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                @if (!auth()->user()->id_photo) required @endif onchange="previewPhoto(event)">
                            <div class="error photo"></div>

                            <div class="mt-2" id="current-photo-container">
                                <label>معاينة الصورة الحالية:</label><br>
                                <img src="{{ auth()->user()->getIdPhoto() }}" id="photo-preview" alt="صورة الهوية"
                                    style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </div>




                    <hr>


                    <button class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4 btn-spinner" id="submit">
                        تاكيد
                        <div class="spinner-border"></div>
                    </button>
                </form>

            @endsection

            @section('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
                <script>
                    // إضافة التحقق من حجم الملف
                    $.validator.addMethod('filesize', function(value, element, param) {
                        return this.optional(element) || (element.files[0].size <= param);
                    }, 'يجب أن يكون حجم المرفق أقل من 0.5 ميجا بايت');

                    // تفعيل التحقق على الفورم
                    $('#form').validate({
                        errorClass: "error fail-alert",
                        validClass: "valid success-alert",
                        rules: {
                            photo: {
                                required: {{ auth()->user()->id_photo ? 'false' : 'true' }},
                                filesize: 2097152 // 2MB

                            }
                        },
                        messages: {

                        },

                        submitHandler: function(form) {
                            const $submitButton = $('#submit');
                            const $spinner = $submitButton.find('.spinner-border');

                            const formData = new FormData(form);

                            // إعداد CSRF
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            // تعطيل الزر وظهور الـ spinner
                            $submitButton.prop('disabled', true);
                            $spinner.show();

                            $.ajax({
                                url: '{{ route('front.profile.updatepersonalData') }}',
                                type: "POST",
                                data: formData,
                                dataType: 'JSON',
                                contentType: false,
                                cache: false,
                                processData: false,

                                success: function(response) {
                                    $spinner.hide();
                                    $submitButton.prop('disabled', false);

                                    if (response.status) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: response.message,
                                            timer: 1000,
                                            showConfirmButton: false
                                        });

                                        setTimeout(function() {
                                            window.location.replace(
                                                '{{ route('front.profile.personalData') }}');
                                        }, 2000);
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'حدث خطأ',
                                            text: response.message
                                        });
                                    }
                                },

                                error: function(response) {
                                    $spinner.hide();
                                    $submitButton.prop('disabled', false);

                                    var errors = response.responseJSON.errors;
                                    if (errors) {
                                        $.each(errors, function(key, value) {
                                            $('.' + key).text(value);
                                        });
                                    }
                                }
                            });
                        }
                    });

                    // عرض معاينة الصورة
                    function previewPhoto(event) {
                        const input = event.target;
                        const preview = document.getElementById('photo-preview');
                        const currentPhotoContainer = document.getElementById('current-photo-container');

                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                                if (currentPhotoContainer) currentPhotoContainer.style.display = 'block';
                            };
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            preview.src = "{{ auth()->user()->getIdPhoto() }}";
                            preview.style.display = 'block';
                            if (currentPhotoContainer) currentPhotoContainer.style.display = 'block';
                        }
                    }
                </script>

            @endsection
