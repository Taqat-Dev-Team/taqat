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
            resetForm('#my-form', "{{ route('admin.generators.store') }}",
                "{{ __('label.add_generator_subscription') }}");
        });

        $('#add-reading-generators').on('hidden.bs.modal', function() {
            resetForm('#reading-generator', "{{ route('admin.readingGenerators.store') }}",
                "{{ __('label.add_reading_generators') }}");
        });


        $('#addGeneratorExpenseModal').on('hidden.bs.modal', function() {
            resetForm('#addGeneratorExpenseForm',
                "{{ route('admin.generators.storeGeneratorExpenses') }}",
                "{{ __('label.generator_expense') }}");
        });

        // (The modal HTML should not be inside the <script> tag. Move it to your Blade template outside <script>.)

        $(document).on('click', '.list-generator-expenses', function(e) {
            e.preventDefault();
            var generator_id = $(this).data('generator_id');
            $('#generatorExpensesModal').modal('show');

            // Initialize or reload DataTable for expenses
            if ($.fn.DataTable.isDataTable('#generator-expenses-table')) {
                $('#generator-expenses-table').DataTable().destroy();
            }
            $('#generator-expenses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.generators.getgeneratorExpenses') }}",
                    data: {
                        generator_id: generator_id
                    }
                },

                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'cash_paid',
                        name: 'cash_paid'
                    },
                    {
                        data: 'bank_paid',
                        name: 'bank_paid'
                    },
                       {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ],
                order: [
                    [6, 'desc']
                ],
                destroy: true,
                language: {
                    loadingRecords: "Please wait - loading...",
                }
            });
        });

        // Show add generator expense modal and set generator_id
        $(document).on('click', '.add-generator-expense', function(e) {
            e.preventDefault();
            var generator_id = $(this).data('generator_id');
            $('#expense_generator_id').val(generator_id);
            $('#addGeneratorExpenseModal').modal('show');
        });

        // Handle edit expense button click
        $(document).on('click', '.edit_expense', function(e) {
            e.preventDefault();
            // Get data attributes from the clicked button
            var expense_id = $(this).data('expense_id');
            var title = $(this).data('title');
            var total_amount = $(this).data('total_amount');
            var price = $(this).data('price');
            var quantity = $(this).data('quantity');
            var cash_paid = $(this).data('cash_paid');
            var bank_paid = $(this).data('bank_paid');
            var generator_id = $(this).data('generator_id');
            var date = $(this).data('date');

            // Fill the form fields in the modal
            $('#expense_id').val(expense_id);
            $('#expense_title').val(title);
            $('#expense_total_price').val(total_amount);
            $('#expense_price').val(price);
            $('#expense_quantity').val(quantity);
            $('#expense_cash_paid').val(cash_paid);
            $('#expense_bank_paid').val(bank_paid);
            $('#expense_generator_id').val(generator_id);
            $('#date').val(date);

            // Show the modal for editing
            $('#addGeneratorExpenseForm').attr('action', "{{ route('admin.generators.updateGeneratorExpenses') }}");
            $('#addGeneratorExpenseModal').modal('show');
        });



        // Auto-calculate total_paid field
        // Auto-calculate total and handle cash/bank logic
        $('#expense_price, #expense_quantity').on('input', function() {
            var price = parseFloat($('#expense_price').val()) || 0;
            var quantity = parseFloat($('#expense_quantity').val()) || 0;
            var total = price * quantity;
            $('#expense_total_price').val(total);

            // Default: cash = total, bank = 0
            $('#expense_cash_paid').val(total);
            $('#expense_bank_paid').val(0);
        });

        // When cash changes, update bank to keep sum = total
        $('#expense_cash_paid').on('input', function() {
            var total = parseFloat($('#expense_total_price').val()) || 0;
            var cash = parseFloat($(this).val()) || 0;
            if (cash > total) {
                toastr.warning('لا يمكن أن يكون المبلغ النقدي أكبر من الإجمالي');
                cash = total;
                $(this).val(cash);
            }
            var bank = total - cash;
            $('#expense_bank_paid').val(bank >= 0 ? bank : 0);
        });

        // When bank changes, update cash to keep sum = total
        $('#expense_bank_paid').on('input', function() {
            var total = parseFloat($('#expense_total_price').val()) || 0;
            var bank = parseFloat($(this).val()) || 0;
            if (bank > total) {
                toastr.warning('لا يمكن أن يكون المبلغ البنكي أكبر من الإجمالي');
                bank = total;
                $(this).val(bank);
            }
            var cash = total - bank;
            $('#expense_cash_paid').val(cash >= 0 ? cash : 0);
        });
        // Validate and submit add expense form via AJAX



        function resetForm(formSelector, actionUrl, modalTitle) {
            const form = $(formSelector);
            $('.error').text('');
            form[0].reset();

            $('.modal-title').text(modalTitle);
            form.attr('action', actionUrl);
        }

        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true, // Improves speed by deferring the rendering of rows
            ajax: {
                url: "{{ route('admin.generators.getIndex') }}",
                data: function(d) {
                    d.status = $('#status').val();
                },
                cache: true, // Avoid unnecessary repeated requests
            },
            columns: [
            {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: false
                },

                   {
                    data: 'subscribers_count',
                    name: 'subscribers_count',
                    orderable: false,
                    searchable: false
                },


                   {
                    data: 'total_receipt',
                    name: 'total_receipt',
                    orderable: false,
                    searchable: false
                },

                   {
                    data: 'total_expenses',
                    name: 'total_expenses',
                    orderable: false,
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







        $(document).on('click', '.view, .edit', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.edit_generator_subscription') }}' :
                '{{ __('label.edit_generator_subscription') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.generators.update') }}");

            // List of fields to populate
            const fields = [
                'name', 'generator_id',

            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });



        $(document).on('click', '.list-generator-subscription', function(e) {
            e.preventDefault();

            // 1. تحديد العنصر والبيانات المطلوبة
            const generator_id = $(this).data('generator_id');
            const tableElement = $('.data-table-subscriptions-generators');


            // 3. تهيئة الجدول الجديد
            const table = tableElement.DataTable({
                destroy: true, // للتأكد من تدمير النسخة السابقة
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: "{{ route('admin.generatorSubscriptions.getIndex') }}",
                    data: {
                        generator_id: generator_id
                    },
                    cache: false, // تعطيل الكاش لضمان بيانات حديثة
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false
                    },


                    {
                        data: 'mobile',
                        name: 'mobile',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'current_reading',
                        name: 'current_reading',
                        orderable: false,
                        searchable: false
                    },




                    {
                        data: 'paid_amount',
                        name: 'paid_amount',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'remaining_amount',
                        name: 'remaining_amount',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    loadingRecords: "الرجاء الانتظار...",
                },
                lengthMenu: [10, 25, 50, 100],
            });

            // 4. إظهار المودال
            $('#modal-subscriptions-generators').modal('show');
        });

        // 5. تدمير الجدول عند إغلاق المودال
        $('#modal-reading-generators').on('hidden.bs.modal', function() {
            const tableElement = $('.data-table-reading-generators');
            if ($.fn.dataTable.isDataTable(tableElement)) {
                tableElement.DataTable().destroy();
                tableElement.empty(); // تنظيف المحتوى (اختياري)
            }
        });
        $(document).on('click', '.add-generator-subscription', function(e) {
            e.preventDefault();
            var generator_id = $(this).data('generator_id');

            $('#add-generator-subscription_id').val(generator_id);
            $('#add-generator-subscription').modal('show');

        });


        $(document).on('click', '.btn-restore', function() {
            restore_id = $(this).data('id');

            $('#add_edit_restore_id').val(restore_id);
            $('#restoreModal').modal('show');
        });

        $('#confirmRestore').on('click', function() {
            $.ajax({
                url: '{{ route('admin.generators.restore') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    restore_id: $('#add_edit_restore_id').val()
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


    });






    $("#my-form").validate({
        rules: {
            name: {
                required: true
            },

            amount: {
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

    $("#addGeneratorExpenseForm").validate({
        rules: {
            title: {
                required: true
            },
            price: {
                required: true,
                min: 0
            },
            quantity: {
                required: true,
                min: 1
            },
            total_amount: {
                required: true,
                min: 0
            },
            cash_paid: {
                required: true,
                min: 0
            },
            bank_paid: {
                required: true,
                min: 0
            },
            generator_id: {
                required: true
            }
        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            var url = $('#addGeneratorExpenseForm').attr('action');
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
                        $('#addGeneratorExpenseModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload(null, false);
                $('.generator-expenses-table').DataTable().ajax.reload(null, false);

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





    $(document).on('click', '.import-generator-subscription', function(e) {
        e.preventDefault();
        var generator_id = $(this).data('generator_id');
        $('#importExcelForm').attr('action', "{{ route('admin.generators.importExcel') }}");
        $('#importExcelForm').find('#generator_id').val(generator_id);
        $('#importExcelModal').modal('show');
    });

    $("#importExcelForm").validate({
        rules: {
            excel_file: {
                required: true,
            }

        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            var url = $('#importExcelForm').attr('action');
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
                        $('#importExcelModal').modal('hide');
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



    $("#add-generator-Subscriptions").validate({
        rules: {
            name: {
                required: true
            },

            mobile: {
                required: true
            },
            password: {
                required: true
            },
            initial_reading: {
                required: true
            },
            killo_watt_cost: {
                required: true
            },
            generator_id: {
                required: true
            },

        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages

            $('#submit-button').prop('disabled',
                true); // Disable submit button to prevent multiple submissions

            var url = $('#add-generator-Subscriptions').attr('action');
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
                        $('#add-generator-subscription_id').val('');
                        $('#add_edit_name').val('');
                        $('#add_edit_mobile').val('');
                        $('#add_edit_password').val('');
                        $('#add_edit_killo_watt_cost').val('');
                        $('#add_edit_initial_reading').val('');
                        $('.error').text('');
                        $('#add-generator-subscription').modal('hide');

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
        let url = $('#generatorExpensesModal').hasClass('show')
            ? '{{ route('admin.generators.deletegeneratorExpenses') }}'
            : '{{ route('admin.generators.delete') }}';

        $.ajax({
            url: url,
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
                $('.generator-expenses-table').DataTable().ajax.reload(null, false);




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
    $(document).on('click', '.excel-generator-subscription', function(e) {
        e.preventDefault();

        const generator_id = $(this).data('generator_id');
        const url = "{{ route('admin.generators.exportExcel') }}";

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                generator_id: generator_id
            },
            xhrFields: {
                responseType: 'blob' // Expect a binary response
            },
            success: function(response) {
                const blob = new Blob([response], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'generator_subscriptions.xlsx';
                link.click();
                toastr.success('{{ __('label.excel_export_success') }}',
                    '{{ __('label.success') }}', {
                        timeOut: 3000
                    });
            },
            error: function(xhr) {
                toastr.error('{{ __('messages.An error occurred while exporting to Excel') }}',
                    'Error', {
                        timeOut: 3000
                    });
            }
        });
    });
</script>
