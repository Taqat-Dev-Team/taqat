<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        // Global variables
        let roomId, roomCode, global_work_space_id = null;
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.workSpaceManagments.deskManagments.getIndex') }}",
                type: 'get',
                "data": function(d) {
                    d.work_space_id = $('#serach_work_space_id').val();
                    d.branch_id = $('#serach_branch_id').val();
                },
            },
            columns: [
                { data: 'photo', name: 'photo', searchable: false, orderable: false },
                { data: 'user_name', name: 'user_name', searchable: true, orderable: true },
                { data: 'code', name: 'code', searchable: true, orderable: true },
                { data: 'branch_name', name: 'branch_name', searchable: true, orderable: true },
                { data: 'work_space_name', name: 'work_space_name', searchable: true, orderable: true },
                { data: 'invoice_not_paid', name: 'invoice_not_paid', searchable: true, orderable: true },
                { data: 'internet_code', name: 'internet_code', searchable: true, orderable: true },
                { data: 'internet_password', name: 'internet_password', searchable: true, orderable: true },
                { data: 'action', name: 'action', searchable: false, orderable: false }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });

        // Event Handlers
        $('#add_edit_send_invoice').on('change', function() {
            $('#add_edit_send_invoice_row').css('display', $(this).val() == 1 ? 'flex' : 'none');
        });

        $(document).on("click", '.release', function() {
            var desk_mangement_id = $(this).data("id");
            $('#release_desk_mangement_id').val(desk_mangement_id);
            roomCode = $(this).data("code");
            $("#deskMangementCode").text(roomCode);
            $("#releaseModal").modal("show");
        });

        $(document).on('click', '.invoiceSingleModal', function(e) {
            e.preventDefault();
            $('#invoiceSingleModal').modal('show');
            var user_id = $(this).data('user_id');
            $('#invoce_user_id').val(user_id);
        });

        $(document).on('click', '.view-invoice', function(e) {
            var user_id = $(this).data('user_id');
            e.preventDefault();

            if ($.fn.DataTable.isDataTable('.invoice_table')) {
                $('.invoice_table').DataTable().clear().destroy();
            }

            $('.invoice_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('admin.invoices.getIndex') }}",
                    type: 'get',
                    "data": function(d) {
                        d.user_id = user_id;
                    },
                },
                columns: [
                    { data: 'photo', name: 'photo', searchable: false, orderable: false },
                    { data: 'user_name', name: 'user_name', searchable: true },
                    { data: 'amount', name: 'amount', searchable: true, orderable: false },
                    { data: 'status', name: 'status', searchable: true, orderable: false },
                    { data: 'created_at', name: 'created_at', orderable: true }
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                }
            });

            $.ajax({
                url: '{{ route('admin.invoices.getInvoicesData') }}',
                method: 'POST',
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#total_invoice').text("(" + response.data.total_invoice + ")");
                    $('#total_payment').text("(" + response.data.total_payment + ")");
                },
                error: function(response) {
                    console.error(response);
                }
            });
            $('#invoiceModal').modal('show');
        });

        $(document).on('click', '.desk_histories', function(e) {
            var desk_mangment_id = $(this).data('desk_mangment_id');

            $.ajax({
                url: "{{ route('admin.workSpaceManagments.deskManagments.geDeskHistories') }}",
                type: 'GET',
                data: { desk_mangment_id: desk_mangment_id },
                success: function(response) {
                    var histories = response.histories;
                    var tableBody = $('#DeskHistoriesTable tbody');
                    tableBody.empty();

                    $.each(histories, function(index, history) {
                        var row = '<tr>' +
                            '<td>' + history.users.name + '</td>' +
                            '<td>' + history.users.email + '</td>' +
                            '<td>' + history.start_date + '</td>' +
                            '<td>' + (history.end_date ? history.end_date : 'غير محدد') + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                    $('#RoomHistoryModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred. Please try again later') }}',
                        'Error', { timeOut: 3000 }
                    );
                }
            });
        });

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.view_desk_mangment') }}' : '{{ __('label.edit_desk_mangment') }}';
            const form = $('#my-form');

            $('.desk_mnangment_hide').show();
            $('#add_edit_code').prop('disabled', true);
            form.attr('action', "{{ route('admin.workSpaceManagments.deskManagments.update') }}");

            const fields = ['desk_mangment_id', 'code', 'start_date', 'end_date'];
            fields.forEach(field => $('#' + action + '_' + field).val($(this).data(field)));

            $('#' + action + '_work_space_id').val($(this).data('work_space_id')).trigger('change');
            $('#' + action + '_subscription_type_id').val($(this).data('subscription_type_id')).trigger('change');
            $('#add_edit_work_space_id').prop('disabled', true);
            getUsers($(this).data('work_space_id'), $(this).data('user_id'));
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');
        });

        $(document).on('click', '.issue-internet-card', function(e) {
            e.preventDefault();
            const deskMangmentId = $(this).data('desk_mangment_id');
            $('#kt_modal_internet').modal('show');

            var internet_subscription_id = $(this).data('internet_subscription_id');
            var subscription_type_id = $(this).data('subscription_type_id');
            var work_space_id = $(this).data('work_space_id');
            var code = $(this).data('code');
            var user_id = $(this).data('user_id');
            var start_date = $(this).data('start_date');
            var end_date = $(this).data('end_date');

            $('#add_edit_internet_desk_mangment_id').val(deskMangmentId);
            $('#add_edit_internet_start_date').val(start_date);
            $('#add_edit_internet_end_date').val(end_date);
            $('#add_edit_internet_subscription_type_id').val($(this).data('subscription_type_id')).trigger('change');
            $('#add_edit_subscription_internet_id').val(internet_subscription_id);
        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            $('#confirmModal').modal('show');
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
                url: '{{ route('admin.workSpaceManagments.deskManagments.delete') }}',
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

        $(document).on('click', '.notification_modal', function(e) {
            e.preventDefault();
            const form = $('#send_notification');
            form.attr('action', "{{ route('admin.users.sendNotification') }}");

            const fields = ['user_id'];
            fields.forEach(field => {
                $('#' + field).val($(this).data(field));
            });
            $('#open_add_subscription_Modal').modal('show');
        });

        $('#btnFiterSubmitSearch').click(function(e) {
            e.preventDefault();
            $('.data-table').DataTable().draw(true);
        });

        $('#add_edit').on('click', function(e) {
            e.preventDefault();
            $('#kt_modal_add_edit').modal('show');
        });

        // Form Initialization and Validation
        initializeForms();
        initializeSearchFunctionality();
    });

    // Helper Functions
    function getUsers(workSpaceId, selectedUserId = null, triggerChange = false) {
        $.ajax({
            url: "{{ route('admin.workSpaceManagments.deskManagments.getUsers') }}",
            type: "GET",
            data: { work_space_id: workSpaceId },
            success: function(response) {
                let userSelect = $('#add_edit_user_id');
                userSelect.empty().append('<option value="">{{ __('label.selected') }}</option>');

                $.each(response.users, function(key, user) {
                    let isSelected = selectedUserId && selectedUserId == user.id ? 'selected' : '';
                    userSelect.append('<option value="' + user.id + '" ' + isSelected + '>' + user.name + '</option>');
                });

                if (triggerChange) {
                    userSelect.val(selectedUserId).trigger('change');
                } else {
                    userSelect.val(selectedUserId);
                }
            }
        });
    }

    function initializeForms() {
        // Release Form
        $("#release-form").validate({
            submitHandler: function(form) {
                handleFormSubmission(form, '#release-form', '#releaseModal');
            }
        });

        // Internet Form
        $("#internet-form").validate({
            rules: {
                subscription_type_id: { required: true },
                start_date: { required: true },
                end_date: { required: true }
            },
            submitHandler: function(form) {
                handleFormSubmission(form, '#internet-form', '#kt_modal_internet');
            }
        });

        // Main Form
        $("#my-form").validate({
            rules: {
                name: { required: true },
                branch_id: { required: true },
                subscription_type_id: {
                    required: function() { return $('#add_edit_user_id').val() != ''; }
                },
                start_date: {
                    required: function() { return $('#add_edit_user_id').val() != ''; }
                },
                end_date: {
                    required: function() { return $('#add_edit_user_id').val() != ''; }
                }
            },
            submitHandler: function(form) {
                handleFormSubmission(form, '#my-form', '#kt_modal_add_edit');
            }
        });

        // Single Invoice Form
        $("form[name='my-single-invoice']").validate({
            rules: { amount: { required: true } },
            messages: { amount: { required: "{{ __('validation.ammount_required') }}" } },
            submitHandler: function(form) {
                handleFormSubmission(form, '#my-single-invoice', '#invoiceSingleModal');
            }
        });

        // Notification Form
        $("#send_notification").validate({
            rules: { user_id: { required: true } },
            submitHandler: function(form) {
                handleFormSubmission(form, '#send_notification', '#open_add_subscription_Modal');
            }
        });
    }

    function handleFormSubmission(form, formSelector, modalSelector) {
        var $form = $(form);
        var $button = $form.find('button[type="submit"]');
        var $spinner = $button.find('.spinner-border');

        $spinner.show();
        $button.prop('disabled', true);
        $('.error').hide();

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(response) {
                $spinner.hide();
                $button.prop('disabled', false);

                if (response.success || response.status) {
                    toastr.success(response.message, '{{ __('label.success') }}', { timeOut: 3000 });
                    $(modalSelector).modal('hide');
                    $('.data-table').DataTable().ajax.reload(null, false);
                } else {
                    toastr.error(response.message, 'Error', { timeOut: 3000 });
                }
            },
            error: function(xhr) {
                $spinner.hide();
                $button.prop('disabled', false);

                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $('#' + field + '_error').text(messages.join(', ')).show();
                    });
                } else {
                    toastr.error(xhr.responseJSON['message'], 'Error', { timeOut: 3000 });
                }
            }
        });
    }

    function initializeSearchFunctionality() {
        var serach_branch_id = $('#serach_branch_id').val();
        if (serach_branch_id) {
            var work_space_id = $('#serach_work_space_value_id').val();
            $.ajax({
                url: "{{ route('admin.workSpaceManagments.deskManagments.getWorkSpaces') }}",
                type: 'GET',
                data: { branch_id: serach_branch_id },
                success: function(response) {
                    var workSpaces = response.workSpaces;
                    var select = $('#serach_work_space_id');
                    select.empty();
                    select.append('<option value="">{{ __('label.select') }}</option>');

                    $.each(workSpaces, function(key, value) {
                        select.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    if (work_space_id) {
                        select.val(work_space_id).trigger('change');
                    }
                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error('{{ __('messages.An error occurred. Please try again later') }}', 'Error', { timeOut: 3000 });
                }
            });
        }

        $('#serach_branch_id').on('change', function() {
            var branch_id = $(this).val();
            if (branch_id) {
                $.ajax({
                    url: "{{ route('admin.workSpaceManagments.deskManagments.getWorkSpaces') }}",
                    type: 'GET',
                    data: { branch_id: branch_id },
                    success: function(response) {
                        var workSpaces = response.workSpaces;
                        var select = $('#serach_work_space_id');
                        select.empty();
                        select.append('<option value="">{{ __('label.select') }}</option>');

                        $.each(workSpaces, function(key, value) {
                            select.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        toastr.error('{{ __('messages.An error occurred. Please try again later') }}', 'Error', { timeOut: 3000 });
                    }
                });
            } else {
                $('#add_edit_code').val('');
            }
        });
    }

    // Modal Reset Handlers
    $('#releaseModal').on('hidden.bs.modal', function() {
        resetModal('#release-form', "{{ route('admin.workSpaceManagments.deskManagments.release') }}", "{{ __('تأكيد التحرير') }}");
    });

    $('#invoiceSingleModal').on('hidden.bs.modal', function() {
        resetModal('#my-single-invoice', "{{ route('admin.users.storeSingleInvoce') }}", "{{ __('إصدار فاتورة شهرية') }}");
    });

    $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
        const form = $('#my-form');
        resetModal('#my-form', "{{ route('admin.workSpaceManagments.deskManagments.store') }}", "{{ __('label.add_new_desk_mangment') }}");

        $('.desk_mnangment_hide').hide();
        $('#add_edit_user_id').val('').trigger('change.select2');
        $('#add_edit_work_space_id').val('').trigger('change.select2');
        $('#add_edit_subscription_type_id').val('').trigger('change.select2');
        $('#add_edit_send_invoice').val(0).trigger('change.select2');
        $('#add_edit_send_internet').val(0).trigger('change.select2');
        $('#add_edit_send_invoice_row').css('display', 'none');
        $('#add_edit_code').prop('disabled', false);
        $('#add_edit_work_space_id').prop('disabled', false);
        global_work_space_id = null;
    });

    function resetModal(formSelector, action, title) {
        $(formSelector)[0].reset();
        $('.error').text('');
        $(formSelector).attr('action', action);
        $('.modal-title').text(title);
    }

    // User Interaction Handlers
    $('#add_edit_work_space_id').on('change', function() {
        var workSpaceId = $(this).val();
        if (workSpaceId) {
            $.ajax({
                url: "{{ route('admin.workSpaceManagments.deskManagments.getCode') }}",
                type: 'GET',
                data: { work_space_id: workSpaceId },
                success: function(response) {
                    if (response.success) {
                        $('#add_edit_code').val(response.new_code);
                    } else {
                        toastr.error(response.message, 'Error', { timeOut: 3000 });
                    }
                },
                error: function(xhr) {
                    toastr.error('{{ __('label.An error occurred. Please try again later') }}', 'Error', { timeOut: 3000 });
                }
            });
        } else {
            $('#add_edit_code').val('');
        }
    });

    $('#add_edit_user_id').on('change', function() {
        let userId = $(this).val();
        if (userId) {
            $.ajax({
                url: "{{ route('admin.workSpaceManagments.deskManagments.getUserDeskInfo') }}",
                type: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'info',
                            title: 'معلومات المستخدم',
                            text: 'رقم المكتب ' + response.desk_code + ' في ' + response.branch_name,
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __('label.error_occurred') }}',
                        text: '{{ __('label.try_again_later') }}',
                        showConfirmButton: true
                    });
                }
            });
        }
    });
</script>
