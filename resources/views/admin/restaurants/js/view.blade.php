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
    $('#addPaymentModal').on('hidden.bs.modal', function() {
        const form = $('#my-form'); // The form you want to set the action for
        $('.error').text('');
        $('#my-form')[0].reset();
        // Set the action attribute of the form
        form.attr('action', "{{ route('admin.restaurants.payment') }}");
        $('#add_edit_image-preview').hide();
        $('#add_edit_is_parent_category').attr('checked', false);
        $('#add_edit_image-preview').attr('src', '#');



    });

    $("#my-form").validate({
        rules: {



        },
        submitHandler: function(form) {
            $('#spinner').show();
            // $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            var url = $('#my-form').attr('action');
            $.ajax({
                url: url,
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
        searchable: false,
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
                data: 'date',
                name: 'date',
                orderable: true,
                searchable: false
            },
            {
                data: 'admin_name',
                name: 'admin_name',
                orderable: true,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
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


    $('.order_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true, // Improves speed by deferring the rendering of rows
        ajax: {
            url: "{{ route('admin.orders.getIndex') }}",
            data: function(d) {
                d.restaurant_id = $('#restaurant_id').val();
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




                data: 'user_name',
                name: 'user_name',
                orderable: true,
                searchable: false
            },

            {




                data: 'restaurant_name',
                name: 'restaurant_name',
                orderable: true,
                searchable: false
            },
            {
                data: 'price',
                name: 'price',
                orderable: true,
                searchable: false
            },

            {
                data: 'quantity',
                name: 'quantity',
                orderable: true,
                searchable: false
            },
            {
                data: 'total_price',
                name: 'total_price',
                orderable: true,
                searchable: false
            },
            {
                data: 'date',
                name: 'date',
                orderable: true,
                searchable: false
            },
            {
                data: 'status',
                name: 'status',
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

    // Show modal and set form action on edit button click
    $(document).on('click', '.edit', function() {
        // Get data attributes from the clicked element
        var paymentId = $(this).data('restorant_payment_id');
        var amount = $(this).data('amount');
        var photo = $(this).data('photo');

        // Set the values in the modal form fields
        $('#add_edit_payment_id').val(paymentId);
        $('#amount').val(amount);

        // Preview the photo if available
        if (photo) {
            $('#add_edit_image-preview').attr('src', photo).show();
        } else {
            $('#add_edit_image-preview').hide();
        }

        $('#my-form').attr('action', "{{ route('admin.restaurants.updatePayment') }}")
        // Show the modal
        $('#addPaymentModal').modal('show');
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.restaurants.deletePyament') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.payment_table').DataTable().ajax.reload();




            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.payment_table').DataTable().ajax.reload();

            }


        });




    });
</script>
