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

        $('#assignSubscriptionModal').on('hidden.bs.modal', function() {
            $('#assignSubscriptionForm')[0].reset();

        });


        $('#serach_branch_id').on('change', function() {
            var branch_id = $(this).val();
            if (branch_id) {
                $.ajax({
                    url: "{{ route('admin.workSpaceManagments.deskManagments.getWorkSpaces') }}",
                    type: 'GET',
                    data: {
                        branch_id: branch_id
                    },
                    success: function(response) {
                        var workSpaces = response.workSpaces;
                        var select = $('#serach_work_space_id');
                        select.empty();
                        select.append(
                            '<option value="">{{ __('label.select') }}</option>');
                        $.each(workSpaces, function(key, value) {
                            select.append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        toastr.error(
                            '{{ __('messages.An error occurred. Please try again later') }}',
                            'Error', {
                                timeOut: 3000
                            });
                    }
                });
            } else {
                $('#add_edit_code').val('');
            }
        });
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,

            searching: true,
            ajax: {
                url: "{{ route('admin.internetSubscriptions.getIndex') }}",
                type: 'get',
                "data": function(d) {
                    d.branch_id = $('#serach_branch_id').val();
                    d.work_space_id = $('#serach_work_space_id').val();
                    d.subscription_type_id = $('#serach_subscription_type_id').val();
                    d.status = $('#serach_status_id').val();

                },
            },
            columns: [



                {
                    data: 'internet_code',
                    name: 'internet_code',
                    searchable: true
                },
                {
                    data: 'internet_password',
                    name: 'internet_password',
                    searchable: true
                },
                {
                    data: 'subscription_type',
                    name: 'subscription_type',
                    searchable: true
                },
                {
                    data: 'branch_name',
                    name: 'branch_name',
                    searchable: true
                },
                {
                    data: 'duration',
                    name: 'duration',
                    searchable: true
                },
                {
                    data: 'price',
                    name: 'price',
                    searchable: true
                },


                {
                    data: 'user_name',
                    name: 'user_name',
                    searchable: true
                },


                {
                    data: 'status',
                    name: 'status',
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
                            $('.data-table').DataTable().ajax.reload(null, false);
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
        $("#assignSubscriptionForm").validate({
            rules: {
                name: {
                    required: true
                },
                branch_id: {
                    required: true
                },
                mobile: {
                    required: true
                },


            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#assignSubscriptionForm').attr('action');
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
                            $('#assignSubscriptionModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload(null, false);
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


        $("#subscription-form").validate({
            rules: {
                branch_id: {
                    required: true
                },
                subscription_type_id: {
                    required: true
                },



            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#subscription-form').attr('action');
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
                            $('#open_add_subscription_Modal').modal('hide');
                            $('#subscription-form')[0].reset(); // Clear all inputs in the form
                            $('#subscription-form select').val('').trigger('change'); // Reset all select elements
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
            const title = $(this).hasClass('view') ? '{{ __('label.edit_internet_subscription') }}' :
                '{{ __('label.edit_internet_subscription') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.internetSubscriptions.update') }}");

            // List of fields to populate
            const fields = [
                'internet_subscription_id',

            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });
            $('#' + action + '_status ').val($(this).data('status')).trigger('change');
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });
        $(document).on('click', '.users', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.edit_internet_subscription') }}' :
                '{{ __('label.edit_internet_subscription') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.internetSubscriptions.update') }}");

            // List of fields to populate
            const fields = [
                'internet_subscription_id',

            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });
            $('#' + action + '_status ').val($(this).data('status')).trigger('change');
            $('.modal-title').text(title);
            $('#assignSubscriptionModal').modal('show');

        });


        $(document).ready(function () {
    // عند إدخال البريد الإلكتروني
    $("#userEmail").on("blur", function () {
        let email = $(this).val();
        if (email.length > 0) {
            $.ajax({
                url: "{{route('admin.internetSubscriptions.checkUsers')}}", // مسار API للتحقق
                type: "GET",
                data: { email: email },
                success: function (response) {
                    if (response.exists) {
                        // إذا كان المستخدم موجودًا، عرض القائمة المنسدلة وإخفاء نموذج الإضافة
                        $("#existingUserSection").show();
                        $("#newUserSection").hide();
                        let userDropdown = $("#existingUser");
                        userDropdown.empty().append('<option value="">-- اختر مستخدم --</option>');

                        response.users.forEach(user => {
                            userDropdown.append(`<option value="${user.id}">${user.name}</option>`);
                        });
                    } else {
                        // إذا لم يكن موجودًا، إظهار نموذج إضافة مستخدم جديد
                        $("#existingUserSection").hide();
                        $("#newUserSection").show();
                    }
                }
            });
        }
    });

    // تعيين الاشتراك عبر AJAX


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
