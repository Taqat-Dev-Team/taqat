<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>


<script>
    $.validator.addMethod("greaterThan", function(value, element, param) {
        var expirationDate = $(param).val();
        return expirationDate && new Date(value) > new Date(expirationDate);
    }, "يجب أن يكون تاريخ الاستحقاق أكبر من تاريخ الانتهاء");

    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).ready(function() {
        $(document).on('click', '.show_id_photo', function(e) {
            e.preventDefault();
            var photoUrl = $(this).data('photo');
            $('#modalIdPhoto').attr('src', photoUrl);
            $('#idPhotoModal').modal('show');
        });

        $('.verification-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.users.getVerification') }}",
                type: 'get',

            },
            columns: [{
                    data: 'photo',
                    name: 'photo',
                    orderable: false
                },
                {
                    data: 'full_name',
                    name: 'full_name',
                    orderable: false
                },
                {
                    data: 'id_number',
                    name: 'id_number',
                    orderable: false
                },
                {
                    data: 'birth_date',
                    name: 'birth_date',
                    orderable: false
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },








            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.users.getIndex') }}",
                type: 'get',
                data: function(d) {
                    d.status = $('#status').val();
                    d.company_id = $('#company_id').val();
                    d.displacement_place = $('#displacement_place').val();
                    d.branch_id = $('#branch_id').val();
                    d.user_type_cd_id = $('#user_type_cd_id').val();
                    d.workplace_attendance = $('#search_workplace_attendance').val();




                },
            },
            columns: [{
                    data: 'photo',
                    name: 'photo',
                    orderable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    orderable: false
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    orderable: false
                },

                {
                    data: 'branch_name',
                    name: 'branch_name',
                    orderable: false
                },


                {
                    data: 'total_invoice',
                    name: 'total_invoice',
                    orderable: true
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: true

                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                // {
                //     data: 'total_contracts',
                //     name: 'total_contracts',
                //     orderable: true
                // },
                // {
                //     data: 'total_movements',
                //     name: 'total_movements',
                //     orderable: true
                // },
                {
                    data: 'Whatsapp',
                    name: 'Whatsapp',
                    orderable: false
                },
                {
                    data: 'total_work_hours',
                    name: 'total_work_hours',
                    orderable: true
                },
                {
                    data: 'placement_date',
                    name: 'placement_date',
                    orderable: true
                },
                {
                    data: 'account_id',
                    name: 'account_id',
                    orderable: true
                },
                {
                    data: 'code_internet',
                    name: 'code_internet',
                    orderable: true
                },

                {
                    data: 'call_whatsapp_count',
                    name: 'call_whatsapp_count',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });


        $(document).on('click', '.edit_verification_user', function(e) {
            e.preventDefault();
            var user_id = $(this).data('user_id');
            $('#edit_verification_user_id').val(user_id);
            $('#acceptStatusModal').modal('show');
        });
        // table.column(4).visible(false); // Hides the "office" column
        table.column(5).visible(false); // Hides the "office" column
        table.column(6).visible(false); // Hides the "office" column
        table.column(7).visible(false);

        $('#addWorkSpaceModal').on('hidden.bs.modal', function() {
            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#add-work-space')[0].reset();
            $('.modal-title').text("{{ __('label.work_space') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.users.addToWorkSpace') }}");
            $('#add_work_desk_mangment_id').val('').trigger('change.select2');
            $('#add_work_space_type').val('').trigger('change.select2');
            $('#add_work_room_id').val('').trigger('change.select2');



        });
        $('#invoiceSingleModal').on('hidden.bs.modal', function() {
            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-single-invoice')[0].reset();
            $('.my-single-invoice').text("{{ __('label.export_invoice_monthly') }}")
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.users.storeSingleInvoce') }}");
            $('#add_work_desk_mangment_id').val('').trigger('change.select2');
            $('#add_work_space_type').val('').trigger('change.select2');
            $('#add_work_room_id').val('').trigger('change.select2');



        });


        $('#exemptionModal').on('hidden.bs.modal', function() {
            const form = $('#exemption-form'); // The form you want to set the action for
            $('.error').text('');
            $('#exemption-form')[0].reset();
            $('.modal-title').text("اشعار (Sms)");
            form.attr('action', "{{ route('admin.invoices.SendSms') }}");



        });

        $("form[name='exemption-form']").validate({
            rules: {
                message: {
                    required: true
                },


            },
            messages: {



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

                var data = new FormData(document.getElementById("exemption-form"));
                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                $.ajax({
                    url: '{{ route('admin.invoices.SendSms') }}',
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
                        // $('.data-table').DataTable().draw(true);
                        $('#exemptionModal').modal('hide')

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
        $("form[name='exemption-form']").validate({
            rules: {
                message: {
                    required: true
                },


            },
            messages: {



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

                var data = new FormData(document.getElementById("exemption-form"));
                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                $.ajax({
                    url: '{{ route('admin.invoices.SendSms') }}',
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
                        // $('.data-table').DataTable().draw(true);
                        $('#exemptionModal').modal('hide')

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

        acceptStatusForm

        $('#addServiceModal').on('hidden.bs.modal', function() {

            const form = $('#addServiceForm'); // The form you want to set the action for
            $('.error').text('');
            $('#addServiceForm')[0].reset();
            $('.add-service').text("{{ __('label.add_service') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.users.addService') }}");
            $('#add_edit_service_id').val('').trigger('change.select2');
            $('#add_edit_send_sms').val('').trigger('change.select2');

            $('.service-amount').text('');


        });
        $('#addInvoiceModal').on('hidden.bs.modal', function() {

            const form = $('#my-invoice'); // The form you want to set the action for
            form.attr('action', "{{ route('admin.users.storeSingleInvoce') }}");

            $('.error').text('');
            $('#my-invoice')[0].reset();
            $('.add-invoice').text("{{ __('label.add_invoice') }}");
            // Set the action attribute of the form
            $('#add_edit_amount_type').val('').trigger('change.select2');
            $('.service-amount').text('');
            $('#payment_type_block').hide();

            $("#add_edit_invocie_status").val('').trigger("change");


        });


        $('#exampleModal').on('hidden.bs.modal', function() {

            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-form')[0].reset();
            $('.status_user').text("{{ __('label.status_user') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.users.addToBranch') }}");

            $('#user_type_id')
                .val('')
                .trigger('change');
            $('#add_user_branch_id').val('');
            $('#add_branch_id')
                .val('')
                .trigger('change');
            $('#add_status')
                .val('')
                .trigger('change');
            $('.branch_id').hide();


        });

        $(document).on("click", ".edit_invoice", function(e) {
            e.preventDefault();
            $('.add-invoice').text("{{ __('label.edit_invoice') }}");

            let invoiceId = $(this).data("invoice_id");
            let amount = $(this).data("amount");
            let amountType = $(this).data("amount_type");
            let dueDate = $(this).data("due_date");
            let payment_type_id = $(this).data("payment_type_id");

            let expirationDate = $(this).data("expiration_date");
            let status = $(this).data("status");

            // Set form values
            $("#invoce_id").val(invoiceId);
            $("#add_edit_amount").val(amount);
            $("#add_edit_amount_type").val(amountType).trigger("change"); // Fix ID mismatch
            $("#add_edit_payment_type_id").val(payment_type_id).trigger("change"); // Fix ID mismatch



            if (dueDate) {
                $("#add_edit_due_date").datepicker("setDate", dueDate);
            }
            if (expirationDate) {
                $("#add_edit_expiration_date").datepicker("setDate", expirationDate);
            }
            if (status == 1) {
                $('#payment_type_block').show();
            } else {
                $('#payment_type_block').hide();

            }
            $("#add_edit_invocie_status").val(status).trigger("change");
            const form = $('#my-single-invoice'); // The form you want to set the action for
            form.attr('action', "{{ route('admin.invoices.update') }}");

            $("#invoiceSingleModal").modal("show");

        });

        $(document).on('change', '#add_edit_invocie_status', function() {
            var status = $(this).val();
            if (status == 1) {
                $('#payment_type_block').show();
            } else {
                $('#payment_type_block').hide();
            }
        });



        let desk_mangment_id = null;
        let room_id = null;

        $(document).on('click', '.add_to_work_space', function(e) {
            e.preventDefault();
            $('#addWorkSpaceModal').modal('show');

            let user_id = $(this).data('user_id'),
                branch_id = $(this).data('branch_id'),
                work_space_id = $(this).data('work_space_id'),
                work_space_type = $(this).data('work_space_type');
            room_id = $(this).data('room_id'),
                desk_mangment_id = $(this).data('desk_mangment_id');

            $('#add_work_space_user_id').val(user_id);
            $('#add_work_space_type').val(work_space_type).trigger('change');
            $('#add_work_room_id').val(room_id).trigger('change');
            $('#add_work_desk_mangment_id').val(desk_mangment_id).trigger('change');

            fetchWorkSpaces(branch_id, work_space_id);
            if (work_space_type === 1) fetchDeskManagement(work_space_id, desk_mangment_id);
            if (work_space_type === 2) fetchRooms(work_space_id, room_id);
        });


        $('#add_work_space_type').change(function() {
            let work_space_type = $(this).val();
            let work_space_id = $('#add_work_space_id').val();

            $('.desk_mangment').toggle(work_space_type == 1);
            $('.room_mangment').toggle(work_space_type == 2);

            if (work_space_type == 1) fetchDeskManagement(work_space_id, desk_mangment_id);
            if (work_space_type == 2) fetchRooms(work_space_id, room_id);

        });

        function fetchWorkSpaces(branch_id, selected_id) {
            $.ajax({
                url: '{{ route('admin.users.getByBranch') }}',
                type: 'GET',
                data: {
                    branch_id
                },
                success: function(response) {
                    populateSelect('#add_work_space_id', response.workSpaces, selected_id);
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        }

        function fetchDeskManagement(work_space_id, selected_id) {
            $.ajax({
                url: '{{ route('admin.users.getByDeskMangments') }}',
                type: 'GET',
                data: {
                    work_space_id
                },
                success: function(response) {
                    populateSelect('#add_work_space_desk_mangment_id', response
                        .deskMangments,
                        selected_id);
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        }

        function fetchRooms(work_space_id, selected_id) {
            $.ajax({
                url: '{{ route('admin.users.getByRooms') }}',
                type: 'GET',
                data: {
                    work_space_id
                },
                success: function(response) {
                    populateSelect('#add_work_space_room_id', response.rooms, selected_id);
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        }

        function populateSelect(selector, items, selected_id) {
            let select = $(selector);
            select.empty();
            $.each(items, function(key, value) {
                select.append(
                    `<option value="${value.id}">${value.code || value.name}</option>`);
            });
            select.val(selected_id).trigger('change');
        }
    });






    $(document).on('click', '.internet_subscription', function(e) {
        e.preventDefault();
        var user_id = $(this).data('user_id');
        $('#internet_user_id').val(user_id);
        $('#internetSubscriptionModal').modal('show')
    });


    $(document).on('click', '.add_all_invoiceModal', function(e) {
        e.preventDefault();
        $('#addInvoiceModal').modal('show')
    });
    $(document).on('click', '.invoiceSingleModal', function(e) {
        e.preventDefault();
        $('#invoiceSingleModal').modal('show');

        var user_id = $(this).data('user_id');
        $('#invoce_user_id').val(user_id);

        // الحصول على تاريخ اليوم باستخدام moment.js (تاريخ اليوم بتنسيق ISO 8601)
        const currentDate = moment().format('YYYY-MM-DD');
        const expirationDate = currentDate;

        // الحصول على تاريخ بعد شهر باستخدام moment.js
        const dueDate = moment().add(1, 'months').format('YYYY-MM-DD');

        // تعيين القيم في الحقول
        $("#expiration_date").val(expirationDate); // تاريخ اليوم
        $("#due_date").val(dueDate); // تاريخ بعد شهر
    });


    $('.excel').on('click', function(e) {
        e.preventDefault(); // Prevent the default action of the link

        // Get the values from the input fields
        var status = $('#status').val();
        var company_id = $('#company_id').val();
        var displacement_place = $('#displacement_place').val();
        var branch_id = $('#branch_id').val();
        var user_type_cd_id = $('#user_type_cd_id').val();


        // Construct the URL with query parameters
        var url = '{{ route('admin.users.exports') }}' + '?status=' + status + '&company_id=' +
            company_id +
            '&displacement_place=' + displacement_place + '&branch_id=' + branch_id + '&user_type_cd_id=' +
            user_type_cd_id;


        // Redirect to the URL (this will trigger the export)
        window.location.href = url;
    });


    $(document).on('change', '#add_status', function(e) {
        e.preventDefault();
        if ($(this).val() == 1) {
            $('.branch_id').show();
        } else {
            $('.branch_id').hide();

        }

    });



    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.users.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status === 201) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('.data-table').DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }



            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload(null, false);

            }


        });




    });


    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });






    // Hides the "office" column
    // التأكد من أن الـ Dropdown يظهر بشكل صحيح فوق الـ Modal
    document.addEventListener("DOMContentLoaded", function() {
        $('#invoiceModal').on('shown.bs.modal', function() {
            $('.dropdown-toggle').dropdown();
        });

        // تعديل الـ z-index يدويًا عند ظهور الـ Dropdown
        $(document).on('show.bs.dropdown', '.dropdown', function() {
            var $dropdownMenu = $(this).find('.dropdown-menu');
            $dropdownMenu.css('z-index', 1080);
        });
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
            columns: [{
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    searchable: true
                },
                {
                    data: 'amount',
                    name: 'amount',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'expiration_date',
                    name: 'expiration_date',
                    searchable: true,
                    orderable: false
                },

                {
                    data: 'due_date',
                    name: 'due_date',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: true,
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true
                }
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

    $(document).on('click', '.verification_user', function(e) {
        var user_id = $(this).data('user_id');
        e.preventDefault();
        $.ajax({
            url: '{{ route('admin.users.showDetails') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: user_id
            },
            success: function(data) {
                $('#user_detail_user_id').val(data.user_id || '');
                $('#user_first_name').text(data.first_name || '');
                $('#user_second_name').text(data.second_name || '');
                $('#user_third_name').text(data.third_name || '');
                $('#user_last_name').text(data.last_name || '');
                $('#user_birth_date').text(data.birth_date || '');
                $('#user_id_number').text(data.id_number || '');


                $('#user_identity_image').attr('src', data.identity_image_url ||
                    '{{ asset('assets/default-user.png') }}');
                let statusText = '';
                switch (parseInt(data.is_verifivation)) {
                    case 0:
                        statusText = 'لم يتم ارسال طلب';
                        break;
                    case 1:
                        statusText = 'مقبول';
                        break;
                    case 2:
                        statusText = 'قيد الانتظار';
                        break;
                    case 3:
                        statusText = 'مرفوض';
                        break;
                    default:
                        statusText = 'غير معروف';
                }
                $('#user_verification_status').text(statusText);
                $('#userDetailsModal').modal('show');
            },
            error: function() {
                alert('حدث خطأ أثناء جلب بيانات المستخدم');
            }
        });

        $('#userDetailsModal').modal('show');
    });



    $(document).on('click', '.show-photo-modal', function() {
        var photo = $(this).data('photo');
        $('#modalPhoto').attr('src', photo);
        $('#photoModal').modal('show');
    });

    let isProgrammaticChange = false;

    $(document).on('click', '.add_user', function(e) {
        e.preventDefault();

        isProgrammaticChange = true;

        var user_id = $(this).data('user_id');
        var branch_id = $(this).data('branch_id');
        var status = $(this).data('status');
        var user_type_id = $(this).data('user_type_cd_id');
        var work_space_id = $(this).data('work_space_id');
        var desk_mangment_id = $(this).data('desk_mangment_id');

        $('#user_type_id').val(user_type_id).trigger('change');
        $('#add_user_branch_id').val(user_id);
        $('#add_branch_id').val(branch_id).trigger('change');
        $('#add_status').val(status).trigger('change');

        if (branch_id) {
            $('.branch_id').show();
        }

        if (branch_id) {
            $.ajax({
                url: '{{ route('admin.users.getByBranch') }}',
                type: 'GET',
                data: {
                    branch_id: branch_id
                },
                success: function(response) {
                    var $workSpace = $('#add_work_space');
                    $workSpace.empty();
                    $workSpace.append('<option value="">{{ __('label.select') }}</option>');
                    $.each(response.workSpaces, function(i, ws) {
                        $workSpace.append('<option value="' + ws.id + '"' + (ws.id ==
                            work_space_id ? ' selected' : '') + '>' + (ws.code || ws
                            .name) + '</option>');
                    });
                    $workSpace.trigger('change');

                    if (work_space_id) {
                        $.ajax({
                            url: '{{ route('admin.users.getByDeskMangments') }}',
                            type: 'GET',
                            data: {
                                work_space_id: work_space_id
                            },
                            success: function(response) {
                                console.log(response);
                                var $desk = $('#desk_mangment_id');
                                $desk.empty();
                                $desk.append(
                                    '<option value="">{{ __('label.select') }}</option>'
                                );
                                $.each(response.deskMangments, function(i, d) {
                        let userName = d.users ? d.users.name : ' ';

                                    $desk.append('<option value="' + d.id +
                                        '"' +
                                        (d.id == desk_mangment_id ?
                                            ' selected' : '') +
                                        '>' + (d.code || d.name) + (
                                            userName ? ' - ' + userName : ''
                                        ) + '</option>');
                                });

                                $desk.trigger('change');
                                isProgrammaticChange = false;
                            }
                        });
                    } else {
                        isProgrammaticChange = false;
                    }
                }
            });
        } else {
            isProgrammaticChange = false;
        }

        $('#exampleModal').modal('show');
    });

    // تغيير الفرع يدويًا
    $(document).on('change', '#add_branch_id', function(e) {
        if (isProgrammaticChange) return;
        e.preventDefault();
        var branch_id = $(this).val();

        $.ajax({
            url: '{{ route('admin.users.getByBranch') }}',
            type: 'GET',
            data: {
                branch_id: branch_id
            },
            success: function(response) {
                var $workSpace = $('#add_work_space');
                $workSpace.empty();
                $workSpace.append('<option value="">{{ __('label.select') }}</option>');
                $.each(response.workSpaces, function(i, ws) {
                    $workSpace.append('<option value="' + ws.id + '">' + (ws.code || ws
                        .name) + '</option>');
                });
                $workSpace.trigger('change');
            }
        });
    });

        $(document).on('change', '#add_user_branch_id', function(e) {

            branch_id=$(this).val();
         if (branch_id) {
            $.ajax({
                url: '{{ route('admin.users.getByBranch') }}',
                type: 'GET',
                data: {
                    branch_id: branch_id
                },
                success: function(response) {
                    var $workSpace = $('#add_work_space');
                    $workSpace.empty();
                    $workSpace.append('<option value="">{{ __('label.select') }}</option>');
                    $.each(response.workSpaces, function(i, ws) {
                        $workSpace.append('<option value="' + ws.id + '"' + (ws.id ==
                            work_space_id ? ' selected' : '') + '>' + (ws.code || ws
                            .name) + '</option>');
                    });
                    $workSpace.trigger('change');

                    if (work_space_id) {
                        $.ajax({
                            url: '{{ route('admin.users.getByDeskMangments') }}',
                            type: 'GET',
                            data: {
                                work_space_id: work_space_id
                            },
                            success: function(response) {
                                console.log(response);
                                var $desk = $('#desk_mangment_id');
                                $desk.empty();
                                $desk.append(
                                    '<option value="">{{ __('label.select') }}</option>'
                                );
                                $.each(response.deskMangments, function(i, d) {
                                                          let userName = d.users ? d.users.name : ' ';

                                    $desk.append('<option value="' + d.id +
                                        '"' +
                                        (d.id == desk_mangment_id ?
                                            ' selected' : '') +
                                        '>' + (d.code || d.name) + (
                                            userName ? ' - ' + userName : ''
                                        ) + '</option>');
                                });

                                $desk.trigger('change');
                                isProgrammaticChange = false;
                            }
                        });
                    } else {
                        isProgrammaticChange = false;
                    }
                }
            });


        }
    });

    // تغيير مساحة العمل يدويًا
    $(document).on('change', '#add_work_space', function(e) {
        if (isProgrammaticChange) return;
        e.preventDefault();
        var work_space_id = $(this).val();

        if (work_space_id) {
            $.ajax({
                url: '{{ route('admin.users.getByDeskMangments') }}',
                type: 'GET',
                data: {
                    work_space_id: work_space_id
                },
                success: function(response) {
                    var $desk = $('#desk_mangment_id');
                    $desk.empty();
                    $desk.append('<option value="">{{ __('label.select') }}</option>');

                    $.each(response.deskMangments, function(i, d) {

                        let userName = d.users ? d.users.name : ' ';
                        $desk.append('<option value="' + d.id + '">' +
                            (d.code || d.name) + ' - ' + userName +
                            '</option>');
                    });

                    $desk.trigger('change');
                }
            });
        }
    });




    $(document).on('click', '.expense_list', function(e) {
        e.preventDefault();
        var user_id = $(this).data('user_id');
        $('#expenseModal').modal('show');
        loadExpenseTable(user_id);
    });

    function loadExpenseTable(user_id) {
        $('#expense_table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true, // Reinitialize the table
            ajax: {
                url: "{{ route('admin.users.expenses') }}", // Your route to get expenses by user
                type: "GET",
                data: {
                    user_id: user_id
                },
                dataSrc: function(response) {
                    // Update total amounts
                    $('#total_invoice').text(response.total_expense);
                    $('#total_payment').text(response.total_payment);
                    return response.data;
                }
            },
            columns: [{
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/{{ app()->getLocale() }}.json"
            }
        });
    }



    $(document).on('click', '.add_expense', function(e) {

        e.preventDefault();

        var user_id = $(this).data('user_id');

        $('#add_edit_expense_user_id').val(user_id);
        $('#addexpenseModal').modal('show');


    });

    $('#expense_id').change(function() {
        var expense_id = $(this).val();
        $('#child_expense_id').html(
            '<option value="">{{ __('label.selected') }}</option>'); // Reset child options

        if (expense_id) {
            $.ajax({
                url: "{{ route('admin.users.getChildExpenses') }}", // Adjust this URL based on your route
                type: "GET",
                data: {
                    expense_id: expense_id
                },
                success: function(response) {
                    if (response.success) {
                        $.each(response.child_expenses, function(key, value) {
                            $('#child_expense_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    } else {
                        alert('No child expenses found.');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    });





    $("form[name='userDetails-form']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            status: {
                required: true,

            },



        },
        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("userDetails-form"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.postVerification') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });



                    $('#userDetailsModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;


                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });
    $("form[name='my-form']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            status: {
                required: true,

            },

            branch_id: {
                required: function() {
                    return $('#add_status').val() == 1;
                },


            }

        },
        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-form"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addToBranch') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });



                    $('#exampleModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;


                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });


    $("form[name='acceptStatusForm']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            status: {
                required: true,

            },

            branch_id: {
                required: function() {
                    return $('#add_status').val() == 1;
                },


            }

        },
        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("acceptStatusForm"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.postVerification') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });



                    $('#acceptStatusModal').modal('hide');

                    $('.verification-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;


                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });
    $("form[name='add-expense']").validate({
        // Specify validation rules


        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("add-expense"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addExpense') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });



                    $('#addexpenseModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;


                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });


    $("#addServiceForm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            service_id: {
                required: true,

            },

            quantity: {
                required: true,


            },





        },
        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("addServiceForm"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addService') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });


                    $('#addServiceModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {




                    let errorText = "";

                    if (response.responseJSON && response.responseJSON.errors) {
                        // Handling validation errors
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                        });
                    } else if (response.responseJSON && response.responseJSON.message) {
                        // Handling general error messages
                        errorText = response.responseJSON.message;
                        $('#addServiceModal').modal('hide');

                    } else {
                        // Fallback for unknown errors
                        errorText = "An unknown error occurred. Please try again.";
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText
                    });



                }
            });


        }

    });


    $("form[name='add-work-space']").validate({
        // Specify validation rules
        rules: {



        },


        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("add-work-space"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addToWorkSpace') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });

                    }

                    $('#addWorkSpaceModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;
                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });



    $("form[name='my-invoice']").validate({
        rules: {

            amount: {
                required: true
            },
            "branch_id[]": {
                required: true
            },

            expiration_date: {
                required: true,


            },

            due_date: {
                required: true,

            }



        },
        messages: {

            amount: {
                required: "{{ __('validation.ammount_required') }}"
            },
            "branch_id[]": {
                required: "{{ __('validation.branch_required') }}"
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

            var data = new FormData(document.getElementById("my-invoice"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.users.createInvoice') }}',
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
                    $('#addInvoiceModal').modal('hide')

                    $('#my-invoice')[0].reset();
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

    $(document).on('click', '.service_list', function(e) {
        e.preventDefault();
        let userId = $(this).data('user_id');
        // Open the modal for service list
        $('#serviceListModal').modal('show');
        // You can use AJAX here to fetch and display the services for the user
        $.ajax({
            url: '{{ route('admin.users.getServices') }}',
            type: 'GET',
            data: {
                user_id: userId
            },
            success: function(response) {
                let tableContent =
                    '<table class="table table-bordered"><thead><tr><th>{{ __('label.name') }}</th><th>{{ __('label.quantity') }}</th><th>{{ __('label.amount') }}</th><th>{{ __('label.delete') }}</th</tr></thead><tbody>';
                response.services.forEach(service => {

                    tableContent += `<tr>
                            <td>${service.name}</td>
                            <td>${service.quantity}</td>
                            <td>${service.amount}</td>
            <td>
                <button class="btn btn-danger delete-service" data-service_id="${service.id}">
                    {{ __('label.delete') }}
                </button>
            </td>
                            <td>`;



                    tableContent += `</td></tr>`;
                });
                $('#serviceListModal .modal-body').html(tableContent);
            },
            error: function(response) {
                console.error('Error fetching services:', response);
            }
        });

        $(document).on('click', '.delete-service', function(e) {
            e.preventDefault();
            let serviceId = $(this).data(
                'service_id'); // Get the service id from the data attribute of the button
            let row = $(this).closest('tr'); // Get the table row (tr) that contains this button

            // Show confirmation modal
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.users.deleteService') }}',
                        type: 'POST',
                        data: {
                            service_id: serviceId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                            // Remove the row from the table
                            row.remove();
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.responseJSON.message,
                            });
                        }
                    });
                }
            });
        });

    });

    $(document).on('click', '.add_service', function(e) {
        e.preventDefault();
        let userId = $(this).data('user_id');
        // Open the modal for adding a service
        $('#add_edit_service_user_id').val(userId);
        $('#addServiceModal').modal('show');
        // You can use AJAX here to pre-fill data or handle form submission
        console.log('Add Service for User ID:', userId);
    });




    $(document).on('change', '#add_edit_service_id', function() {
        let selectedOption = $(this).find('option:selected');
        let isMonthly = selectedOption.data('is-monthly');

        if (isMonthly) {
            $('.show_date').show();
        } else {
            $('.show_date').hide();
        }

    });

    $(document).on('change', '#add_edit_quantity', function(e) {
        e.preventDefault();
        let serviceId = $('#add_edit_service_id').val();
        let quantity = $(this).val();
        let start_date = $('#add_edit_service_start_date').val();
        let end_date = $('#add_edit_service_end_date').val();

        $.ajax({
            url: '{{ route('admin.users.getAmount') }}',
            type: 'POST',
            data: {
                service_id: serviceId,
                quantity: quantity,
                _token: '{{ csrf_token() }}',
                start_date: start_date,
                end_date: end_date,
            },
            success: function(response) {
                if (response.status === 200) {


                    $('#add_edit_service_amount').val(response.total_amount);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while calculating the amount.',
                });
            }
        });
    });

    $("form[name='my-single-invoice']").validate({
        rules: {

            amount: {
                required: true
            },


            expiration_date: {
                required: true,

            },

            due_date: {
                required: true,

            }

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
            var actionUrl = form.getAttribute(
                "action"); // الحصول على الرابط من الخاصية action في الفورم


            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: actionUrl,
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

    $(document).on('click', '.notification_modal', function(e) {
        e.preventDefault();
        const form = $('#subscription-form'); // The form you want to set the action for

        // Set the action attribute of the form
        form.attr('action', "{{ route('admin.users.sendNotification') }}");

        // List of fields to populate
        const fields = [
            'user_id',

        ];

        // Populate form fields with data
        fields.forEach(field => {
            $('#' + field).val($(this).data(field));
        });
        $('#open_add_subscription_Modal').modal('show');

    });

    $(document).on('click', '.sendSms', function() {
        // Optionally, set dynamic values if needed
        var userId = $(this).data('user_id'); // Get dynamic invoice ID

        $('#invoice_user_id').val(userId); // Set invoice ID to the hidden input field

        $('#exemptionModal').modal('show');
    });

    $("#send_notification").validate({
        rules: {
            user_id: {
                required: true
            },



        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            var url = $('#send_notification').attr('action');
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
                    toastr.success(response.message,
                        '{{ __('label.success') }}', {
                            timeOut: 3000
                        });
                    $('#open_add_subscription_Modal').modal('hide');
                    $('.data-table').DataTable().ajax.reload();

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

    $("form[name='add_subscription']").validate({
        // Specify validation rules
        rules: {
            subscription_type_id: {
                required: true,
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("add_subscription"));

            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addSubscription') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }

                    $('#internetSubscriptionModal').modal('hide');
                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(response) {
                    if (response.status === 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.responseJSON.message
                        });
                    } else {
                        var errors = response.responseJSON.errors;
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Failed',
                            text: errorText
                        });
                    }
                }
            });
        }
    });


    $(document).on('click', '.btn-restore', function() {
        userIdToRestore = $(this).data('id');

        $('#restore_user_id').val(userIdToRestore);
        $('#restoreModal').modal('show');
    });

    $('#confirmRestore').on('click', function() {
        $.ajax({
            url: '{{ route('admin.users.restoreUsers') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: $('#restore_user_id').val()
            },
            success: function(response) {
                $('#restoreModal').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000
                });
                $('.data-table').DataTable().ajax.reload(null, false);


            },
            error: function() {
                alert('حدث خطأ أثناء استرجاع المستخدم.');
            }
        });
    });


    $(document).on("click", '.release', function() {
        let deskMagmentId = $(this).data("id");


        $('#release_desk_mangement_id').val(deskMagmentId);

        code = $(this).data("code"); // Note: data- should be replaced with data-code in the button
        $("#deskCode").text(code);
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
</script>
