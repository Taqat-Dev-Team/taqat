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
            $('.modal-title').text("{{ __('label.add_new_work_space') }}");
            $('#add_edit_room_count').prop('disabled', false);
            $('#add_edit_desk_count').prop('disabled', false);

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.workSpaces.store') }}");
            $('#add_edit_branch_id').val('').trigger('change.select2');




        });


        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,

            searching: false,
            ajax: {
                url: "{{ route('admin.workSpaceManagments.workSpaces.getIndex') }}",
                type: 'get',
                "data": function(d) {
                    d.branch_id = $('#serach_branch_id').val();
                },
            },
            columns: [

                {
                    data: 'name',
                    name: 'name',

                    searchable: true
                },
                {
                    data: 'branch_name',
                    name: 'branch_name',
                    searchable: true
                },
                {
                    data: 'desk_count',
                    name: 'desk_count',
                    searchable: true
                },
                {
                    data: 'room_count',
                    name: 'room_count',
                    searchable: true
                },
                {
                    data: 'free_chairs',
                    name: 'free_chairs',
                    searchable: true
                },

                {
                    data: 'booked_chairs',
                    name: 'booked_chairs',
                    searchable: true
                },

                {
                    data: 'free_rooms',
                    name: 'free_rooms',
                    searchable: true
                },

                {
                    data: 'booked_rooms',
                    name: 'booked_rooms',
                    searchable: true
                },

                {
                    data: 'action',
                    name: 'action',
                },
            ],

            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });





        // Form validation and AJAX submit
        $("#my-form").validate({
            rules: {
                name: {
                    required: true
                },
                branch_id: {
                    required: true
                },


            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

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
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.view_work_spaces') }}' :
                '{{ __('label.edit_work_spaces') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.workSpaces.update') }}");

            // List of fields to populate
            const fields = [
                'name', 'work_space_id', 'code',
                'room_count','desk_count',

            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });
            $('#add_edit_room_count').prop('disabled', true);
            $('#add_edit_desk_count').prop('disabled', true);
            $('#' + action + '_branch_id ').val($(this).data('branch_id')).trigger('change');
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });

        $(document).on('click', '.add_desk_mangment', function(e) {
            e.preventDefault();
            $('#add_work_space_id').val($(this).data('work_space_id'));
            $('#kt_modal_desk_mangment').modal('show');

        });

        $("#add-form").validate({
            rules: {
                room_count: {
                    required: true
                },
                desk_count: {
                    required: true
                },


            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#add-form').attr('action');
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
                            $('#kt_modal_desk_mangment').modal('hide');
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

    });

























    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('show')
        var name_delete = $(this).data('name_delete');
        var ids = $(this).data('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.workSpaceManagments.workSpaces.delete') }}',
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

    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });
</script>
