<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).on('click', '.sendSms', function() {
        // Optionally, set dynamic values if needed
        var userId = $(this).data('user_id'); // Get dynamic invoice ID

        $('#invoice_user_id').val(userId); // Set invoice ID to the hidden input field

        $('#exemptionModal').modal('show');
    });





    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.invoices.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.branch_id = $('#branch_id').val();
                d.status_id = $('select[name="status_id"]').val();

                d.exemption = $('select[name="exemption"]').val();

                d.expiration_date = $('#expiration_date').val();


            },

        },




        columns: [{
                data: 'photo',
                name: 'photo',
                searchable: false,
                orderable: false,

            },
            {
                data: 'user_name',
                name: 'user_name',

                searchable: true
            },
            {
                data: 'mobile',
                name: 'mobile',

                searchable: true
            },

            {
                data: 'branch',
                name: 'branch',
                searchable: true,
                orderable: false,
            },

            {
                data: 'amount',
                name: 'amount',
                searchable: true,
                orderable: false,
            },



            {
                data: 'status',
                name: 'status',
                searchable: true,
                orderable: false,
            },

            {
                data: 'created_at',
                name: 'created_at',
                orderable: true
            },

            {
                data: 'expiration_date',
                name: 'expiration_date',
                orderable: true
            },

            {
                data: 'due_date',
                name: 'due_date',
                orderable: true
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
    $('#searchTable').on('click', function() {

        table.ajax.reload(); // Reload the DataTable with new data
    });



    $('.submit_serach').on('click', function(e) {
        e.preventDefault();
        updateData();
    });

    function updateData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const user_id = $('#user_id').val();
        const status_id = $('#status_id').val();

        const expiration_date = $('#expiration_date').val();
        const branch_id = $('#branch_id').val();
        $.ajax({
            url: '{{ route('admin.invoices.getInvoicesData') }}',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                branch_id: branch_id,
                user_id: user_id,
                expiration_date: expiration_date,
                status_id: status_id,

                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
            },
            error: function(response) {
                console.error(response);
            }
        });
    }

    function updateCounters(data) {
        $('#user_count').text("(" + data.user_count + ")");
        $('#total_invoice').text("(" + data.total_invoice + ")");
        $('#total_payment').text("(" + data.total_payment + ")");
    }

    $(document).ready(function() {
        updateData();
    });

    $(document).on('click', '.show-photo-modal', function() {
        var photo = $(this).data('photo');
        $('#modalPhoto').attr('src', photo);
        $('#photoModal').modal('show');
    });

    $(document).on('click', '.export_excel', function(e) {
        e.preventDefault();

        // Get the values of the search form
        var user_id = $('#user_id').val();
        var company_id = $('#company_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var branch_id = $('#branch_id').val();
        var status_id = $('#status_id').val();
        var exemption = $('#exemption').val(); // Added the exemption field
        var expiration_date = $('#expiration_date').val(); // Added the exemption field


        // Construct the URL with query parameters for the export request
        var exportUrl = "{{ route('admin.invoices.getIndex') }}" +
            "?export=excel" +
            "&user_id=" + (user_id ? user_id : '') +
            "&company_id=" + (company_id ? company_id : '') +
            "&start_date=" + (start_date ? start_date : '') +
            "&end_date=" + (end_date ? end_date : '') +
            "&branch_id=" + (branch_id ? branch_id : '') +
            "&status_id=" + (status_id ? status_id : '') +
            "&exemption=" + (exemption ? exemption : '');
        "&expiration_date=" + (expiration_date ? exemption : '');

        // Redirect to the URL to download the Excel file
        window.location.href = exportUrl;

    });





    $(document).on("click", ".send_sms", function(e) {

        $("#sendSmsModal").modal("show");
    });

    $(document).on("click", ".edit_invoice", function(e) {
        e.preventDefault();

        let invoiceId = $(this).data("invoice_id");
        let amount = $(this).data("amount");
        let amountType = $(this).data("amount_type");
        let dueDate = $(this).data("due_date");
        let expirationDate = $(this).data("expiration_date");
        let payment_type_id = $(this).data("payment_type_id");
        let status = $(this).data("status");

        $("#invoiceModal").modal("show");

        // تعيين القيم في النموذج
        $("#invoce_id").val(invoiceId);
        $("#amount").val(amount);
        $("#amout_type").val(amountType).trigger("change");
        $("#payment_type_id").val(payment_type_id).trigger("change");

        // ضبط تواريخ Datepicker
        if (dueDate) {
            $('#edit_due_date').val(dueDate); // تعيين التاريخ بشكل مباشر
            $('#edit_due_date').datepicker("update", dueDate); // التأكد من تحديث الـ Datepicker
        } else {
            $('#edit_due_date').val("");
        }

        if (expirationDate) {
            $('#edit_expiration_date').val(expirationDate);
            $('#edit_expiration_date').datepicker("update", expirationDate);
        } else {
            $('#edit_expiration_date').val("");
        }

        // التحكم في ظهور طريقة الدفع بناءً على الحالة
        if (status == 1) {
            $('#payment_type_block').show();
        } else {
            $('#payment_type_block').hide();
        }

        $("#status").val(status).trigger("change");
    });


    $(document).on('change', '#status', function() {
        var status = $(this).val();
        if (status == 1) {
            $('#payment_type_block').show();
        } else {
            $('#payment_type_block').hide();
        }
    });
    $("form[name='my-invoice']").validate({
        rules: {

            status: {
                required: true
            },
            amount: {
                required: true

            },
            payment_type_id: {
                required: function(element) {
                    return $('#status').val() == 1;
                }
            }

        },
        messages: {

            amount: {
                required: "{{ __('validation.status_required') }}"
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
                url: '{{ route('admin.invoices.update') }}',
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
                    $('.data-table').DataTable().draw(true);
                    $('#invoiceModal').modal('hide')

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



    $("form[name='send_sms']").validate({
        rules: {

            message: {
                required: true
            }

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

            var data = new FormData(document.getElementById("send_sms"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.invoices.sendInvoiceSms') }}',
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
                    $('.data-table').DataTable().draw(true);
                    $('#sendSmsModal').modal('hide')

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
            url: '{{ route('admin.invoices.delete') }}',
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
