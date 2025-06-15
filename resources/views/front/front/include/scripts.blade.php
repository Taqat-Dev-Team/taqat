<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/additional-methods.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script>
    $(document).ready(function() {

        // Initialize Select2
        $('.select2').select2();

        // Form validation setup
        $("form[name='my-form']").validate({
            // Specify validation rules
            rules: {
                name: { required: true },
                mobile: { required: true },
                whatsapp: { required: true },
                marital_status: { required: true },
                photo: { required: true },
                job: { required: true },
                sallary: { required: true },
                company_name: { required: true },
                displacement_place: { required: true },
                original_place: { required: true }
            },
            messages: {
                name: { required: "اسم مطلوب" },
                displacement_place: { required: "مكان النزوح مطلوب" },
                original_place: { required: "مكان الاصلي مطلوب" },
                marital_status: { required: "الحالة الاجتماعية مطلوبة" },
                mobile: { required: "رقم الجوال مطلوب" },
                whatsapp: { required: "رقم الواتس اب مطلوب" },
                email: { email: "ادخل الايميل بشكل صحيح", required: "الايميل مطلوب" },
                company_name: { required: "اسم الشركة مطلوب" },
                job: { required: "المسمى الوظيفي مطلوب" },
                sallary: { required: "الراتب الشهري مطلوب" },
                photo: { required: "الصورة مطلوبة" },
                // "attachment[]": {
                //     required: "المرفقات مطلوبة",
                //     extension: "يجب أن تكون الملفات من الأنواع التالية: jpg, jpeg, png, pdf, doc, docx",
                //     filesize: "حجم الملف لا يجب أن يتجاوز 2 ميجابايت"
                // }
            },
            submitHandler: function(form) {
                // Show loading spinner
                var spinner = $('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                $('.submit-container').append(spinner);

                // Disable submit button during AJAX request
                $('button[type="submit"]').prop('disabled', true);

                // Prepare data for AJAX request
                var formData = new FormData(form);

                // AJAX request
                $.ajax({
                    url: '{{ route("front.addUsers") }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // Hide loading spinner
                        spinner.remove();

                        // Enable submit button
                        $('button[type="submit"]').prop('disabled', false);

                        // Handle response
                        if (response.status == 201) {
                            swal({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $("#my-form")[0].reset();
                        } else {
                            swal({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    },
                    error: function(response) {
                        // Hide loading spinner
                        spinner.remove();

                        // Enable submit button
                        $('button[type="submit"]').prop('disabled', false);

                        // Handle errors
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

        // Handle other actions or events as needed
        $(document).on('click', '.check_users', function(e) {
            e.preventDefault();
            var email = $('#email').val();

            if (email == '') {
                $('.email').text('الايميل مطلوب');
                return;
            }

            var spinner = $('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                $('.submit-check-container').append(spinner);

            $.ajax({
                url: '{{ route("front.checkUsers") }}',
                type: 'POST',
                data: { "email": email, "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    spinner.remove();

                    if (response.status == 201) {
                        $('#name').val(response.data.name);
                        $('#mobile').val(response.data.mobile);
                        $('#email').val(response.data.email);
                    } else {
                        $('.email').text(response.message);
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            $('.' + key).text(value);
                        });
                    }
                }
            });
        });

        // Custom method to validate file size
        $.validator.addMethod('filesize', function(value, element, param) {
            var files = element.files;
            if (files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    if (files[i].size > param) {
                        return false;
                    }
                }
            }
            return true;
        }, 'حجم الملف لا يجب أن يتجاوز {0}');
    });
</script>
