<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {

        var serach_branch_id = $('#serach_branch_id').val();

        if (serach_branch_id) {
            var work_space_id = $('#serach_work_space_value_id').val();
            $.ajax({
                url: "{{ route('admin.workSpaceManagments.rooms.getWorkSpaces') }}",
                type: 'GET',
                data: {
                    branch_id: serach_branch_id
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
                    if (work_space_id) {
                        select.val(work_space_id).trigger('change');
                    }

                    $('.data-table').DataTable().ajax.reload(null, false);

                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred. Please try again later') }}',
                        'Error', {
                            timeOut: 3000
                        });
                }
            });
        }
        let roomId, roomCode;

        $(document).on("click", '.release', function() {
            roomId = $(this).data("id");


            $('#release_room_id').val(roomId);

            roomCode = $(this).data("-"); // Note: data- should be replaced with data-code in the button
            $("#roomCode").text(roomCode);
            $("#releaseModal").modal("show");
        });


        $("#release-form").validate({
            rules: {



            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#release-form').attr('action');
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
                            $('#releaseModal').modal('hide');
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


        $('#releaseModal').on('hidden.bs.modal', function() {
            const form = $('#release-form'); // The form you want to set the action for
            $('.error').text('');
            $('#release-form')[0].reset();
            $('.modal-title').text("{{ __('تأكيد التحرير') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.rooms.release') }}");




        });

        $('#invoiceSingleModal').on('hidden.bs.modal', function() {
            const form = $('#my-single-invoice'); // The form you want to set the action for
            $('.error').text('');
            $('#my-single-invoice')[0].reset();
            $('.modal-title').text("{{ __('إصدار فاتورة شهرية') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.rooms.release') }}");

        });

        $('#add_edit').on('click', function(e) {
            e.preventDefault(); // منع السلوك الافتراضي للـ href
            $('#kt_modal_add_edit').modal('show'); // إظهار الـ modal
        });
        // Reset form and hide previews when modal is closed
        $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-form')[0].reset();
            $('.modal-title').text("{{ __('label.add_room') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.rooms.store') }}");
            $('#add_edit_user_id').val('').trigger('change.select2');
            $('#add_edit_work_space_id').val('').trigger('change.select2');
            $('#add_edit_room_count').prop('disabled', false);

            $('#add_edit_subscription_type_id').val('').trigger('change');
            $('#add_edit_work_space_id').prop('disabled', false);
            $('#add_edit_attendance_status').val('').trigger('change');

            $('.room_hide').hide();



        });




        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,

            searching: false,
            ajax: {
                url: "{{ route('admin.workSpaceManagments.rooms.getIndex') }}",
                type: 'get',
                "data": function(d) {
                    d.work_space_id = $('#serach_work_space_id').val();
                    d.branch_id = $('#serach_branch_id').val();

                },
            },
            columns: [

                {
                    data: 'code',
                    name: 'code',

                    searchable: true
                },
                {
                    data: 'branch_name',
                    name: 'branch_name',
                    searchable: true
                },
                {
                    data: 'work_space_name',
                    name: 'work_space_name',
                    searchable: true
                },

                {
                    data: 'capacity',
                    name: 'capacity',
                    searchable: true
                },
                {
                    data: 'user_count',
                    name: 'user_count',
                    searchable: true
                },
                {
                    data: 'user_name',
                    name: 'user_name',
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

                subscription_type_id: {
                    required: function() {
                        return $('#add_edit_user_id').val() != '';
                    }
                },
                attendance_status: {
                    required: function() {
                        return $('#add_edit_user_id').val() != '';
                    }
                }


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
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.view_work_spaces') }}' :
                '{{ __('label.edit_work_spaces') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.workSpaceManagments.rooms.update') }}");

            // List of fields to populate
            const fields = [
                'capacity',
                'room_id',
                'code',
                'start_date',
                'end_date',
                'amount',


            ];
            $('.room_hide').show();

            $('#add_edit_code').prop('disabled', true);


            $('#' + action + '_subscription_type_id').val($(this).data('subscription_type_id')).trigger(
                'change');

            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });

            $('#' + action + '_user_id').val($(this).data('user_id')).trigger('change');
            $('#' + action + '_work_space_id').val($(this).data('work_space_id')).trigger('change');
            $('#' + action + '_attendance_status').val($(this).data('attendance_status')).trigger(
                'change');


            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');
            $('#add_edit_work_space_id').prop('disabled', true);

        });


        $('#add_edit_work_space_id').on('change', function() {
            var workSpaceId = $(this).val();
            if (workSpaceId) {
                $.ajax({
                    url: "{{ route('admin.workSpaceManagments.rooms.getCode') }}",
                    type: 'GET',
                    data: {
                        work_space_id: workSpaceId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#add_edit_code').val(response.new_code);
                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
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



        $('#serach_branch_id').on('change', function() {
            var branch_id = $(this).val();
            if (branch_id) {
                $.ajax({
                    url: "{{ route('admin.workSpaceManagments.rooms.getWorkSpaces') }}",
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





        $(document).on('click', '.users', function(e) {

            var workSpaceId = $(this).data('work_space_id');
            var userIds = $(this).data('user_ids');
            var room_id = $(this).data('room_id');

            $('#add_room_users').val(room_id);
            $.ajax({
                url: "{{ route('admin.workSpaceManagments.rooms.getUsers') }}",
                type: "GET",
                data: {
                    work_space_id: workSpaceId,
                    room_id:room_id,

                },
                success: function(response) {
                    let userSelect = $('#add_user_room');
                    userSelect.empty().append(
                        '<option value="">{{ __('label.selected') }}</option>');

                    $.each(response.users, function(key, user) {
                        let isSelected = userIds.includes(user.id) ? 'selected' :
                            '';
                        userSelect.append('<option value="' + user.id + '" ' +
                            isSelected +
                            '>' + user.name + '</option>');
                    });

                    userSelect.val(userIds).trigger('change');
                }
            });


            $('#addUsersModal').modal('show')
        });


        $(document).on('click', '.issue-internet-card', function(e) {
            e.preventDefault(); // لمنع تنفيذ الرابط بشكل افتراضي
            $('#kt_modal_internet').modal('show');
            const room_id = $(this).data('room_id'); // الحصول على معرّف إدارة المكتب
            var internet_subscription_id = $(this).data('internet_subscription_id');
            var subscription_type_id = $(this).data('subscription_type_id');
            var work_space_id = $(this).data('work_space_id');
            var code = $(this).data('code');
            var user_id = $(this).data('user_id');
            var start_date = $(this).data('start_date');
            var end_date = $(this).data('end_date');
            $('#add_edit_internet_room_id').val(room_id);

            // تعيين معرّف إدارة المكتب في الحقل الخفي
            $('#add_edit_internet_start_date').val(
            start_date); // تعيين معرّف إدارة المكتب في الحقل الخفي
            $('#add_edit_internet_end_date').val(end_date); // تعيين معرّف إدارة المكتب في الحقل الخفي
            $('#add_edit_internet_subscription_type_id').val($(this).data('subscription_type_id'))
                .trigger('change');
        });


        $(document).on('click', '.room_histories', function(e) {
            var room_id = $(this).data('room_id'); // الحصول على room_id من العنصر الذي تم النقر عليه

            $.ajax({
                url: "{{ route('admin.workSpaceManagments.rooms.getRoomHistories') }}", // المسار في الخادم لجلب البيانات
                type: 'GET',
                data: {
                    room_id: room_id
                },
                success: function(response) {
                    var histories = response.histories; // الحصول على التاريخ من الاستجابة
                    var tableBody = $(
                    '#roomHistoriesTable tbody'); // تحديد جسم الجدول لإضافة البيانات
                    tableBody.empty(); // مسح الجدول أولاً


                    // التكرار عبر البيانات لإضافتها في الجدول
                    $.each(histories, function(index, history) {
                        var row = '<tr>' +
                            '<td>' + history.users.name + '</td>' +
                            // عرض اسم المستخدم
                            '<td>' + history.users.email + '</td>' +
                            // عرض البريد الإلكتروني
                            '<td>' + history.start_date + '</td>' +
                            // عرض تاريخ البدء
                            '<td>' + (history.end_date ? history.end_date :
                                'غير محدد') + '</td>' +
                            // عرض تاريخ النهاية أو نص إذا لم يتم تحديده
                            '</tr>';
                        tableBody.append(row); // إضافة الصف إلى الجدول
                    });

                    $('#RoomHistoryModal').modal(
                        'show'); // إظهار المودال بعد إضافة البيانات

                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred. Please try again later') }}',
                        'Error', {
                            timeOut: 3000
                        });
                }
            });
        });




        $("#internet-form").validate({
            rules: {

                subscription_type_id: {

                    required: true
                },

                start_date: {
                    required: true

                },

                end_date: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#internet-form').attr('action');
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
                            $('#kt_modal_internet').modal('hide');
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
                                '{{ __('label.An error occurred. Please try again later') }}',
                                'Error', {
                                    timeOut: 3000
                                });
                        }
                    }
                });
            }
        });


        $("#users-form").validate({
            rules: {
                user_ids: {
                    required: true
                },





            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#users-form').attr('action');
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
                            $('#addUsersModal').modal('hide');
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
            url: '{{ route('admin.workSpaceManagments.rooms.delete') }}',
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

                $('.data-table').DataTable().ajax.reload(null, false);




            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload(null, false);

            }


        });




    });

    $(document).on('click', '.invoiceSingleModal', function(e) {
        e.preventDefault();
        $('#invoiceSingleModal').modal('show');
        var user_id = $(this).data('user_id');
        $('#invoce_user_id').val(user_id);


    });

    $("form[name='my-single-invoice']").validate({
        rules: {

            amount: {
                required: true
            },



        },
        messages: {

            amount: {
                required: "{{ __('validation.ammount_required') }}"
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

            var data = new FormData(document.getElementById("my-single-invoice"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.users.storeSingleInvoce') }}',
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
                    $('.data-table').DataTable().ajax.reload(null, false);
                    $('#invoiceSingleModal').modal('hide')

                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });

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

    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });


    $(document).on('click', '.add_room', function(e) {
            e.preventDefault();
            $('#add_room_id').val($(this).data('room_id'));
            $('#kt_modal_room').modal('show');

        });

        $("#add-form").validate({
            rules: {
                room_count: {
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
                            $('#kt_modal_room').modal('hide');
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
</script>
