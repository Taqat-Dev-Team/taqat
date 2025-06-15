<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $('#logo').on('change', function(event) {
        previewImage(event, '#add_edit_image-preview');
    });



    function previewImage(event, previewSelector) {
        const output = $(previewSelector);
        output.attr('src', URL.createObjectURL(event.target.files[0])).show();
    }

    $("#my-form").validate({
        rules: {



        },
        submitHandler: function(form) {
            $('#spinner').show();
            // $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            $.ajax({
                url: "{{route('admin.restaurants.payment')}}",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    // Handle the response on success
                    if (response.success) {
                        toastr.success(response.message,
                            '{{ __('label.success') }}', {
                                timeOut: 3000
                            });
                        $('#addPaymentModal').modal('hide');
                        $('.payment_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                },
                error: function(xhr) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    if (xhr.status === 422) {
                        // Loop through the validation errors and display them with toastr
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            // Show the error messages in the corresponding fields
                            var errorContainer = $('#' + field + '_error');
                            errorContainer.text(messages.join(', '))
                                .show(); // Join messages if there are multiple
                        });
                    } else {
                        // For other errors, display a general error message
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
    let table = $('.payment_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true, // Improves speed by deferring the rendering of rows
        ajax: {
            url: "{{ route('admin.restaurants.getPayment') }}",
            data: function(d) {
                d.restaurant_id = $('#add_edit_restaurant_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            cache: true, // Avoid unnecessary repeated requests
        },
        columns: [{


                data: 'logo',
                name: 'logo',
                orderable: true,
                searchable: false
            },
            {




                data: 'amount',
                name: 'amount',
                orderable: true,
                searchable: false
            },
            {
                data: 'admin_name',
                name: 'admin_name',
                orderable: true,
                searchable: false
            },


        ],

        order: [
            [1, 'asc']
        ], // Ensure proper default ordering
        language: {
            loadingRecords: "Please wait - loading...",
        },
        lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
    });
</script>
