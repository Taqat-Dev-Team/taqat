<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, 'File size must be less than {0} bytes');

$.validator.addMethod('mimetype', function (value, element, param) {
    var allowedMimeTypes = param.split(',');
    if (element.files && element.files[0]) {
        var mimeType = element.files[0].type;
        return allowedMimeTypes.includes(mimeType);
    }
    return true;
}, 'Please enter a value with a valid mimetype');

$("form[name='my-form']").validate({
    rules: {
        source: {
            required: true
        },
        amount: {
            required: true
        },
        date: {
            required: true
        },
        photo: {
            // required: true,
            mimetype: "image/jpeg,image/png,application/pdf",
            filesize: 2097152 // 2 MB in bytes
        },
    },
    messages: {
        source: {
            required: "جهه التحويل مطلوبة"
        },
        amount: {
            required: "المبلغ مطلوب"
        },
        date: {
            required: "التاريخ مطلوب"
        },
        photo: {
            required: "المرفق مطلوب",
            mimetype: "يرجى إدخال ملف بصيغة صحيحة (jpg, jpeg, png, pdf)",
            filesize: "يجب أن يكون حجم الملف أقل من 2 ميجا بايت"
        },
    },
    submitHandler: function (form) {
        var $button = $(form).find('button[type="submit"]');
        var $spinner = $button.find('.spinner-border');

        // Show spinner
        $spinner.show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = new FormData(document.getElementById("my-form"));
        // data.append('note', CKEDITOR.instances['description'].getData());

        $.ajax({
            url: '{{route("front.incomeMovements.update")}}',
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                // Hide spinner
                $spinner.hide();

                if (response.status) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function () {
                        window.location.replace('{{route("front.incomeMovements.index")}}');
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function (response) {
                // Hide spinner
                $spinner.hide();

                var errors = response.responseJSON.errors;
                if (errors) {
                    var errorText = "";
                    $.each(errors, function (key, value) {
                        errorText += value + "\n";
                        $('.' + key).text(value);
                    });
                }
            }
        });
    }
});

    </script>
