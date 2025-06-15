<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@if (app()->getLocale() === 'ar')
    <script src="{{ asset('assets/js/message_ar.js') }}"></script>
@endif
<script>
    $(document).ready(function() {

        $('#search_parent_category_id').on('change', function() {
            table.draw();
        });
        $('[data-kt-data-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });
        const locale = '{{ app()->getLocale() }}'; // Get the current locale
        // Reset form and modal previews when modal is hidden
        $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
            $('.error').text('');
            $('#my-form')[0].reset();
            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.products.store') }}");
            $('#add_edit_category_id').val().trigger('change');
            $('#add_edit_image-preview').hide();
            $('.error').text('');
            $('.edit_product').text('{{ __('label.add_product') }}');

        });




        // Initialize DataTable
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.products.getIndex') }}", // Correcting quotes around URL
                data: function(q) {
                    q.parentId = $('#search_parent_category_id')
                        .val(); // Fixed the assignment operator
                },
            },
            columns: [

                {

                    data: "logo",
                    name: 'logo',
                },
                {

                    data: "name",
                    name: 'name',
                },
                {

                    data: "restaurant_name",
                    name: 'restaurant_name',
                },

                {

                    data: "order_count",
                    name: 'order_count',
                },


                {
                    data: 'is_active',
                    name: 'is_active'
                },

                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'desc']
            ]
        });








        // Search filter

        // Show modal if necessary
        $('#add_edit').on('click', function() {
            $('#my-form')[0].reset();
            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.products.store') }}");
            $('.modal-title').text('{{ __('label.add_product') }}');
            $('#add_edit_image-preview').hide();
            $('#add_edit_is_parent_category').attr('checked', false);
            $('#add_edit_image-preview').attr('src', '#');
            $('.error').text('');
                        $('#add_edit_category_id').val('').trigger('change');

            $('#kt_modal_add_edit').modal('show');
        });
    });
    // Reset form fields and preview images

    $('#my-form').validate({
        rules: {
            name: {
                required: true
            },



            logo: {
                required: function() {
                    return $('#add_edit_category_id').val() == '';

                }
            },




        },

        submitHandler: function(form) {
            $('#spinner').show();
            $('#submit-button').prop('disabled', true);
            var url = $('#my-form').attr('action');
            $.ajax({
                url: url, // Update with your URL
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                success: function(response) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    // Handle the response on success
                    if (response.success) {
                        toastr.success(response.message, 'Success', {
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
                            console.log('#' + field)
                            $('.' + field).text(messages);
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
    // View button click

    // Edit button click
    $(document).on('click', '.view, .edit', function() {
        const action = $(this).hasClass('view') ? 'view' : 'add_edit';
        const title = $(this).hasClass('view') ? '{{ __('label.view_category') }}' :
            '{{ __('label.edit_category') }}';
        const form = $('#my-form'); // The form you want to set the action for


        // Set the action attribute of the form
        form.attr('action', "{{ route('admin.products.update') }}");

        const fields = [
            'category_id', 'name', 'logo', 'is_active', 'restaurant_id', 'price', 'product_id'
        ];
        fields.forEach(field => {

            $('#' + action + '_' + field).val($(this).data(field));


        });
        var is_active = $(this).data('is_active');
        $('#is_active').prop('checked', is_active ? true : false);








        $('#add_edit_restaurant_id').val($(this).data('restaurant_id')).trigger('change');


        $('#add_edit_category_id').val($(this).data('category_id')).trigger('change');

        const imagePreview = $('#' + action + '_image-preview');

        imagePreview.toggle($(this).data('logo')).attr('src', $(this).data('logo') ||
            '#');

        $('.modal-title').text(title)
        $('#kt_modal_' + action).modal('show');
    });

    $('#logo').on('change', function(event) {
        previewImage(event, '#add_edit_image-preview');
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var name_delete = $(this).data('name_delete');
        var ids = $(this).data('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);
        $('#confirmModal').modal('show');
    });
    // Confirm delete action
    $(document).on('click', '.submit_delete', function(e) {
        e.preventDefault();

        var ids = $('#Delete_id').val();
        $('#confirmModal').modal('hide');

        // Perform the AJAX delete request
        $.ajax({
            url: '{{ route('admin.products.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    // Show success notification
                    toastr.success(response.message, 'Success', {
                        timeOut: 3000
                    });

                    // Reload the DataTable
                    $('.data-table').DataTable().ajax.reload();
                } else {
                    // Show error notification
                    toastr.error(response.message, 'Error', {
                        timeOut: 3000
                    });
                }
            },
            error: function() {
                // Show general error notification
                toastr.error('An error occurred. Please try again later.', 'Error', {
                    timeOut: 3000
                });
            }
        });
    });

    function previewImage(event, previewSelector) {
        const output = $(previewSelector);
        output.attr('src', URL.createObjectURL(event.target.files[0])).show();
    }





    function toggleActive(element) {
        var productId = $(element).data('id');
        var isActive = $(element).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route('admin.products.updateStatus') }}', // Laravel route for toggling the status
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                is_active: isActive
            },
            success: function(response) {

                // Handle the response on success
                if (response.success) {
                    toastr.success(response.message, '{{ __('label.success') }}', {
                        timeOut: 3000
                    });


                } else {
                    toastr.error(response.message, '{{ __('messages.error') }}', {
                        timeOut: 3000
                    });

                }
            },
            error: function(xhr) {
                toastr.error('{{ __('messages.An error occurred. Please try again later') }}',
                    '{{ __('messages.error') }}', {
                        timeOut: 3000
                    });


            }

        });
    }
</script>
