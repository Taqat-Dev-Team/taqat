<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script>
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('front.wallets.getIndex') }}",
            type: 'get',
            data: function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.status_cd_id = $('#status_cd_id').val();
            }
        },

        columns: [


            {
                data: 'photo',
                name: 'photo',
                searchable: true

            },



            {
                data: 'amount',
                name: 'amount',
            },



            {
                data: 'status',
                name: 'status',
                searchable: true
            },







        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });



    $("#my-form").validate({
        rules: {
            amount: {
                required: true,
                number: true,
                min: 1
            },
            attachment: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            amount: {
                required: "يرجى إدخال المبلغ",
                number: "يرجى إدخال رقم صحيح",
                min: "يجب أن يكون المبلغ أكبر من أو يساوي 1"
            },
            attachment: {
                required: "يرجى إرفاق صورة",
                extension: "يرجى اختيار صورة بصيغة صحيحة (jpg, jpeg, png, gif)"
            }
        },
        errorPlacement: function(error, element) {
            var field = element.attr('name');
            var errorContainer = $('#' + field + '_error');
            if (errorContainer.length) {
                errorContainer.text(error.text()).show();
            } else {
                error.insertAfter(element);
            }
        },
        success: function(label, element) {
            var field = $(element).attr('name');
            var errorContainer = $('#' + field + '_error');
            if (errorContainer.length) {
                errorContainer.hide();
            }
        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled', true); // Disable submit button to prevent multiple submissions
            var url = $('#my-form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message, '{{ __('label.success') }}', {
                            timeOut: 3000
                        });
                        $('#addBalanceModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                        $('#my-form')[0].reset();
                    } else {
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                },
                error: function(xhr) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            var errorContainer = $('#' + field + '_error');
                            errorContainer.text(messages.join(', ')).show();
                        });
                    } else {
                        toastr.error(
                            '{{ __('messages.An error occurred. Please try again later') }}',
                            'Error', {
                                timeOut: 3000
                            });
                    }
                }
            });
        }
    });

    $('#submit_search').on('click', function(e) {
        e.preventDefault();
        table.draw();
    });
</script>
