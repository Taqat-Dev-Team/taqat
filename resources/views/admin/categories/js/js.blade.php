<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
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
            form.attr('action', "{{ route('admin.categories.store') }}");

            $('#add_edit_image-preview').hide();
            $('#add_edit_is_parent_category').attr('checked', false);
            $('#add_edit_image-preview').attr('src', '#');
            $('.error').text('');
            $('.modal-title').text('{{ __('label.add_category') }}');
            parentCategories($('#add_edit_is_parent_category'));

        });


        $('#kt_modal_view').on('hidden.bs.modal', function() {
            $('.error').text('');
            $('#my-form')[0].reset();
            $('#add_edit_image-preview').hide();
            $('#add_edit_is_parent_category').attr('checked', false);
            $('#add_edit_image-preview').attr('src', '#');
            $('.error').text('');
            $('.modal-title').text('{{ __('label.add_category') }}');
            parentCategories($('#add_edit_is_parent_category'));

        });


        // Initialize DataTable
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.categories.getIndex') }}", // Correcting quotes around URL
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
            form.attr('action', "{{ route('admin.categories.store') }}");
            $('.modal-title').text('{{ __('label.add_category') }}');
            $('#add_edit_image-preview').hide();
            $('#add_edit_is_parent_category').attr('checked', false);
            $('#add_edit_image-preview').attr('src', '#');
            $('.error').text('');
            $('#kt_modal_add_edit').modal('show');
        });
    });
    // Reset form fields and preview images

    $('#my-form').validate({
        rules: {
            name: {
                required: true
            },
            name_en: {
                required: true
            },

            parent_category_id: {
                required: function() {
                    return $('#is_parent_category').is('checked');

                }
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
    // View button click

    // Edit button click
    $(document).on('click', '.view, .edit', function() {
        const action = $(this).hasClass('view') ? 'view' : 'add_edit';
        const title = $(this).hasClass('view') ? '{{ __('label.view_category') }}' :
            '{{ __('label.edit_category') }}';
        const form = $('#my-form'); // The form you want to set the action for


        // Set the action attribute of the form
        form.attr('action', "{{ route('admin.categories.update') }}");

        const fields = [
            'category_id', 'name',
        ];
        fields.forEach(field => {

            $('#' + action + '_' + field).val($(this).data(field));


        });
        var is_active = $(this).data('is_active');
        $('#is_active').prop('checked', is_active ? true : false);













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
            url: '{{ route('admin.categories.delete') }}',
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



    function parentCategories(selected) {
        if (selected.prop('checked')) {
            $('.parent_category_id').show();

        } else {
            $('.parent_category_id').hide();

        }
    }

    function toggleActive(element) {
        var categoryId = $(element).data('id');
        var isActive = $(element).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route('admin.categories.updateStatus') }}', // Laravel route for toggling the status
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: categoryId,
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
                // Hide the spinner and enable the submit button

                // For other errors, display a general error message
                toastr.error('{{ __('messages.An error occurred. Please try again later') }}',
                    '{{ __('messages.error') }}', {
                        timeOut: 3000
                    });


            }

        });
    }
</script>
