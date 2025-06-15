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
    }, 'Please enter a value with a valid mimetypes');

    $("form[name='my-form']").validate({
                rules: {

                    company_name: {
                        required: true
                    },
                    sallary: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    job_type: {
                        required: true
                    },
                    duration: {
                        required: true
                    },
                    photo: {
                        mimetype: "image/jpeg,image/png,application/pdf",
                        filesize: 2097152 // 2 MB in bytes

                    },






                },
                messages: {
                    job_type: {
                        required: "{{ __('validation.job_type_reqired') }}"
                    },
                    company_name: {
                        required: "{{ __('vaildation.company_name_required') }}"
                    },
                    sallary: {
                        required: "{{ __('validation.sallary_required') }}"
                    },
                    date: {
                        required: "{{ __('validation.date_required') }}"
                    },
                    duration: {
                        required: "{{ __('vaildation.duration_required') }}"
                    },
                    photo: {
                        required: "{{ __('vaildation.attachment_required') }}",
                    },


                },

                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // var my_form=$('#my-form');
                    var data = new FormData(document.getElementById("my-form"));

                    data.append('note', CKEDITOR.instances['description'].getData());

                    $('#spinner').show();
                    $('.btn-primary').attr('disabled', true);
                    $('.hiden_icon').hide();
                    $.ajax({
                            url: '{{ route('admin.jobConstrancts.update') }}',
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
                                setTimeout(function() {
                                        window.location.replace(
                                            '{{ route('admin.jobConstrancts.index') }}')
                                    },
                                    2000);


                                },
                                error: function(response) {
                                    $('#spinner').hide();
                                    $('.btn-primary').attr('disabled', false);
                                    $('.hiden_icon').show();

                                    var response = response.responseJSON;

                                    console.log(response);
                                    var errors = response.errors;
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
