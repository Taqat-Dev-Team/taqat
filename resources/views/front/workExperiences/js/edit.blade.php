<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    function readURL(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'يجيب ان يكون حجم المرفق اقل من 5 ميجا بايت');
    $("form[name='my-form']").validate({
        rules: {

            company_name: {
                required: true
            },
            location: {
                required: true
            },
            job: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },

            tasks: {
                required: true
            },
            photo: {
                filesize: 5 * 1024 * 1024 // 5 MB in bytes
            },






        },
        messages: {
            company_name: {
                required: "اسم المؤسسة مطلوب"
            },
            tasks: {
                required: "المهام مطلوبة"
            },
            location: {
                required: "مكان المؤسسة مطلوب"
            },
            job: {
                required: "المسمى الوظيفي مطلوب"
            },
            start_date: {
                required: "تاريخ البداية مطلوب"
            },
            end_date: {
                required: "تاريخ الانتهاء مطلوب"
            },
            photo: {
                required: "الصورة مطلوبة"
            },
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-form"));
            data.append('tasks', CKEDITOR.instances['description'].getData());

            $("#spinner").show();

            $.ajax({
                url: '{{ route('front.workExperiences.update') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $("#spinner").hide();
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout(function() {
                            window.location.replace(
                                '{{ route('front.workExperiences.index') }}');
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message
                        });
                    }
                },
                error: function(response) {
                    // Hide the spinner
                    $("#spinner").hide();

                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });
                    }
                }
            });



        }

    });
</script>
