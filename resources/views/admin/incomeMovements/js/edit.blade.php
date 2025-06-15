<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script>
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} bytes');

    $.validator.addMethod('mimetype', function(value, element, param) {
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
                required: "{{ __('vaildation.source Required') }}"
            },
            amount: {
                required: "{{ __('validation.ammount_required') }}"
            },
            date: {
                required: "{{ __('validation.date_required') }}",
            },
            photo: {
                required: "{{ __('validation.attachment_required') }}",
                mimetype: "{{ __('label.mimetype_invalid') }}",
                filesize: "{{ __('label.filesize_exceeded') }}"
            },
        },
        submitHandler: function(form) {
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
            data.append('note', CKEDITOR.instances['description'].getData());
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.incomeMovements.update') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // Hide spinner
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
                                '{{ route('admin.incomeMovements.index') }}');
                        }, 2000);
                    }
                },
                error: function(response) {
                    // Hide spinner
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    response.responseJSON;
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        });
                    }
                }
            });
        }
    });
</script>
