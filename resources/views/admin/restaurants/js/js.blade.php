<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {

        $('#add_edit').on('click', function(e) {
            e.preventDefault(); // منع السلوك الافتراضي للـ href
            $('#kt_modal_add_edit').modal('show'); // إظهار الـ modal
        });
        // Reset form and hide previews when modal is closed
        $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-form')[0].reset();
            $('.modal-title').text("{{ __('label.add_restaurant') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.restaurants.store') }}");
            $('#add_edit_image-preview').hide();
            $('#add_edit_is_parent_category').attr('checked', false);
            $('#add_edit_image-preview').attr('src', '#');



        });

        $('#searchTable').on('click', function(e) {
            e.preventDefault();
            $('.data-table').DataTable().draw();
        });

        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true, // Improves speed by deferring the rendering of rows
            ajax: {
                url: "{{ route('admin.restaurants.getIndex') }}",
                data: function(d) {
                    d.restaurant_id = $('#user_id').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.status_cd_id = $('#status_cd_id').val();
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




                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    orderable: true,
                    searchable: false
                },

                {
                    data: 'order_count',
                    name: 'order_count',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'order_amount',
                    name: 'order_amount',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'total_sales_weekly',
                    name: 'total_sales_weekly',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'total_sales',
                    name: 'total_sales',
                    orderable: true,
                    searchable: false
                },


                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'asc']
            ], // Ensure proper default ordering
            language: {
                loadingRecords: "Please wait - loading...",
            },
            lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
        });
        // Search filter
        $('[data-kt-drivers-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Form validation and AJAX submit


        table.on('xhr', function() {
            let json = table.ajax.json();
            if (json.meta) {
                $('.total-restaurants').text(json.meta.total_restaurants ?? 0);
                $('.total-orders').text(json.meta.total_orders ?? 0);
                $('.total-profit').text('شيكل' + (json.meta.total_profit ?? '0'));
                $('.total-canceled').text(json.meta.total_canceled ?? 0);

                $('.total-clients').text(json.meta.total_clients ?? 0);
                $('.total-completed-orders').text(json.meta.total_completed_orders ?? 0);
                $('.total-pending-orders').text(json.meta.total_pending_orders ?? 0);
                $('.avg-delivery-time').text((json.meta.avg_delivery_time ?? 0) + ' دقيقة');
            }
        });



        $('#logo').on('change', function(event) {
            previewImage(event, '#add_edit_image-preview');
        });

        $(document).on('click', '.view, .edit', function(e) {
            e.preventDefault();

            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.view_restaurant') }}' :
                '{{ __('label.edit_restaurant') }}';

            const form = $('#my-form');
            form.attr('action', "{{ route('admin.restaurants.update') }}");

            // قائمة الحقول التي سيتم تعبئتها
            const fields = ['name', 'email', 'mobile', 'address', 'restaurant_id'];
            const imagePreview = $('#' + action + '_image-preview');

            imagePreview.toggle($(this).data('logo')).attr('src', $(this).data('logo') ||
                '#');

            // تعبئة حقول النموذج
            fields.forEach(field => {
                const value = $(this).data(field);
                const input = $('#' + action + '_' + field);


                input.val(value);

            });


            $('#add_edit_bio').text($(this).data('bio'));
            $('.restaurant_edit').text(title);
            $('#kt_modal_' + action).modal('show');
        });


        $('#logo').on('change', function(event) {
            previewImage(event, '#add_edit_image-preview');
        });












    });

    $("#my-form").validate({
        rules: {
            name: {
                required: true
            },

            password: {
                required: function() {
                    return $('#add_edit_restaurant_id').val() == '';
                }
            },
            logo: {
                required: function() {
                    return $('#add_edit_restaurant_id').val() == '';
                }
            },



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
                        $('#kt_modal_add_edit').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
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

    function previewImage(event, previewSelector) {
        const output = $(previewSelector);
        output.attr('src', URL.createObjectURL(event.target.files[0])).show();
    }



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
            url: '{{ route('admin.restaurants.delete') }}',
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

                $('.data-table').DataTable().ajax.reload();




            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload();

            }


        });




    });
</script>
