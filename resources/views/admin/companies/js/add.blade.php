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

    $("form[name='my-form']").validate({
        rules: {

            name: {
                required: true,

            },
            email: {
                required: true,
                email: true,

            },
            user_name: {
                required: true,

            },
            mobile: {
                required: true,

            },
            phone: {
                required: true,
            }


        },
        messages: {
            name: {
                "required": "اسم مطلوب",
            },
            user_name: {
                "required": "اسم الشخص المسؤول مطلوب",
            },

            email: {
                "required": "الايميل مطلوب",
                "email": "ادخل الايميل بشكل صحيح"
            },
            mobile: "رقم الجوال مطلوب",
            photo: "الايميل مستخدم",
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data = new FormData(document.getElementById("my-form"));


            $('#send_form').html('Sending..');

            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.companies.store') }}',
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
                                    '{{ route('admin.companies.index') }}')
                            },
                            2000);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                },
                error: function(response) {
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
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
