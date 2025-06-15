<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    // alert('asas');

    // $('').

    if ($('#status').val() == 1) {
        $('#branch_div').show();
    } else {
        $('#branch_div').hide();

    }


    function toggleFields() {
        const selectedType = $('#user_type_id').val();

        // Adjust logic according to your business rules
        if (selectedType == 20) {
            $('#specialization_box').show();
            $('#attendance_box').show();
            $('#initial_reading_box').hide();
            $('#university_box').hide();


        } else if (selectedType == 21) {
            $('#initial_reading_box').show();
            $('#specialization_box').hide();
            $('#attendance_box').hide();
            $('#university_box').hide();



        } else if (selectedType == 31) {
            $('#initial_reading_box').hide();
            $('#specialization_box').hide();
            $('#attendance_box').hide();
            $('#university_box').show();



        } else {
            $('#initial_reading_box').hide();

            $('#specialization_box').hide();
            $('#attendance_box').hide();
            $('#university_box').hide();


        }
    }

    $(document).ready(function() {
        toggleFields(); // Initial check
        $('#user_type_id').on('change', toggleFields);
    });


    $(document).on('change', '#status', function(e) {
        if ($(this).val() == 1) {
            $('#branch_div').show();
        } else {
            $('#branch_div').hide();

        }
    });
    $(document).ready(function() {
        $("form[name='my-form']").validate({
            // Specify validation rules
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    minlength: 10
                },
                whatsapp: {
                    required: true,
                    minlength: 10
                },
                user_type_cd_id: {
                    required: true
                },
                specialization_id: {
                    required: function() {
                        return $('#user_type_id').val() == 20;
                    }
                },
                initial_reading: {
                    required: function() {
                        return $('#user_type_id').val() == 21;
                    }
                },
                university_cd_id: {
                    required: function() {
                        return $('#user_type_id').val() == 31;
                    }
                },
                password: {

                    required: function() {
                        return $('#user_id').val() == null;
                    },
                    minlength: 6
                },
                original_place: {
                    required: true
                },
                photo: {
                    required: false,
                    extension: "jpg|jpeg|png|gif"
                },
                status: {
                    required: true
                },
                branch_id: {
                    required: false
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name should be at least 3 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email"
                },
                mobile: {
                    required: "Please enter your mobile",
                    minlength: "Mobile should be at least 10 digits"
                },
                whatsapp: {
                    required: "Please enter your whatsapp number",
                    minlength: "Whatsapp should be at least 10 digits"
                },
                user_type_cd_id: {
                    required: "Please select user type"
                },
                specialization_id: {
                    required: "Please select specialization"
                },
                initial_reading: {
                    required: "Please enter initial reading"
                },
                university_cd_id: {
                    required: "Please select university"
                },
                password: {
                    required: "Please enter password",
                    minlength: "Password should be at least 6 characters"
                },
                original_place: {
                    required: "Please select original place"
                },
                photo: {
                    extension: "Allowed file types are jpg, jpeg, png, gif"
                },
                status: {
                    required: "Please select status"
                }
            },
            // errorPlacement: function(error, element) {
            //     var id = element.attr('id'); // الحصول على ID العنصر
            //     $("#" + id + "_error").html(error); // وضع الخطأ في العنصر المناسب
            // },
            // highlight: function(element) {
            //     $(element).addClass('is-invalid'); // إضافة تنسيق الخطأ (حدود حمراء)
            // },
            // unhighlight: function(element) {
            //     $(element).removeClass('is-invalid'); // إزالة تنسيق الخطأ عند صلاحية الحقل
            // },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                var data = new FormData(document.getElementById("my-form"));
                var actionUrl = $("form[name='my-form']").attr("action");
                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });

                        setTimeout(() => {
                            window.location.href =
                                "{{ route('admin.users.index') }}";
                        }, 2000);
                        $("#my-form")[0].reset();
                    },
                    error: function(xhr) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();

                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them
                            var errors = xhr.responseJSON
                                .errors; // الحصول على الأخطاء من الخادم
                            for (var field in errors) {
                                $('#' + field + '_error').text(errors[field][
                                    0
                                ]); // عرض رسالة الخطأ في العنصر المناسب
                            }
                        } else {
                            // Display generic error message for other types of errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON.message ||
                                    'An error occurred. Please try again.',
                            });
                        }
                    }

                });
            }
        });


    });
</script>
