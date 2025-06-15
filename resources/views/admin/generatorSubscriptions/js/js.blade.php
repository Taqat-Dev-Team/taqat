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
            resetForm('#my-form', "{{ route('admin.generatorSubscriptions.store') }}",
                "{{ __('label.add_generator_subscription') }}");
        });

        $('#add-reading-generators').on('hidden.bs.modal', function() {
            resetForm('#reading-generator', "{{ route('admin.readingGenerators.store') }}",
                "{{ __('label.add_reading_generators') }}");
        });

        $('#add-generator_receipts').on('hidden.bs.modal', function() {
            resetForm('#generator_receipt',
                "{{ route('admin.generatorSubscriptions.generatorReceipt') }}",
                "{{ __('label.add_generator_receipts') }}");
            const tableElement = $('#data-table-generator_receipts');
            if ($.fn.dataTable.isDataTable(tableElement)) {
                tableElement.DataTable().destroy();
                tableElement.html(
                    '<thead><tr><th>Amount</th><th>Date</th></tr></thead>'); // Recreate table header
            }
        });

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
                url: "{{ route('admin.generatorSubscriptions.getIndex') }}",

                cache: true, // Avoid unnecessary repeated requests

                data: function(d) {
                    d.generator_id = $('#search_generator_id').val();
                    d.status = $('#status').val();
                }
            },
            columns: [


                {
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
                    data: 'generator',
                    name: 'generator',
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
        $("#sendSmsForm").validate({
            rules: {

                message: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#sendSmsForm').attr('action');
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
                            $('#sendSmsModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload(null, false);
                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                        search();
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
                        search();

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




        $("#reading-generator").validate({
            rules: {

            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#reading-generator').attr('action');
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
                            $('#add-reading-generators').modal('hide');
                            $('.data-table').DataTable().ajax.reload(null, false);
                            $('.data-table-reading-generators').DataTable().ajax.reload(
                                null, false);


                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                        search();

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

        $("#generator_receipt").validate({
            rules: {

            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#generator_receipt').attr('action');
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
                            $('#add-generator_receipts').modal('hide');
                            $('.data-table').DataTable().ajax.reload(null, false);
                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                        search();

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





        $(document).on('click', '.view, .edit', function(e) {
            e.preventDefault();
            const action = $(this).hasClass('view') ? 'view' : 'add_edit';
            const title = $(this).hasClass('view') ? '{{ __('label.edit_generator_subscription') }}' :
                '{{ __('label.edit_generator_subscription') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.generatorSubscriptions.update') }}");

            // List of fields to populate
            const fields = [
                'name', 'generator_subscription_id', 'mobile', 'initial_reading',
                'killo_watt_cost', 'generator_id'
            ];

            var generator_id = $(this).data('generator_id');
            $('#add_edit_generator_id')
                .val(generator_id)
                .trigger('change');
            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });

        $(document).on('click', '.edit_receipt', function(e) {
            e.preventDefault();
            $('#modal-generator_receipts').modal('hide');



            const receiptId = $(this).data('receipt_id');
            const generatorSubscriptionId = $(this).data('generator_subscription_id');
            $('#modal-reading-generators').modal('hide');

            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getReceiptData') }}",
                method: 'GET',
                data: {
                    "receipt_id": receiptId,
                },
                success: function(response) {
                    if (response.success) {

                        //     // Populate form fields with receipt data
                        $('#add_edit_amount').val(response.data.amount);
                        $('#add_edit_date').val(response.data.date);
                        $('#edit_receipt_id').val(receiptId);
                        $('#cash_paid').val(response.data.cash_paid);
                       $('#bank_paid').val(response.data.bank_paid);
                       $('#date').val(response.data.date)

                        var actionUrl =
                            "{{ route('admin.generatorSubscriptions.updateReceipt') }}";
                        $('#generator_receipt').attr('action', actionUrl);
                                    $('.modal-title').text('بيانات ستد القبض')

                        //     // Show the modal
                        $('#add-generator_receipts').modal('show');
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


        });


        $(document).on('click', '.edit_reding', function(e) {
            e.preventDefault();
            const readingId = $(this).data('reading_id');

            const generatorSubscriptionId = $(this).data('generator_subscription_id');
            alert
            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getReadingData') }}",
                method: 'GET',
                data: {
                    "reading_id": readingId,
                },
                success: function(response) {
                    if (response.success) {
                        // Populate form fields with reading data
                        $('#add_edit_current_reading').val(response.data.current_reading);
                        $('#add_edit_consumption_quantity').val(response.data
                            .consumption_quantity);
                        $('#add_edit_consumption_value').val(response.data
                            .consumption_value);
                        $('#reading_generator_id').val(response.data.reading_generator_id);

                        $('#add_edit_subscription_generator_subscription_id').val(response
                            .data.generator_subscription_id);

                        $('#add_edit_subscription_generator_subscription_id').val(response
                            .data.generator_subscription_id);

                        var actionUrl = "{{ route('admin.readingGenerators.update') }}";
                        $('#reading-generator').attr('action', actionUrl);

                        // Show the modal
                        $('#add-reading-generators').modal('show');
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


            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getKwatPrice') }}",
                method: 'POST',
                data: {
                    "generator_subscription_id": generatorSubscriptionId,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#killo_watt_cost').val(response
                        .data.killo_watt_cost);


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

        $(document).on('click', '.add_reding', function(e) {
            e.preventDefault();
            const generator_subscription_id = $(this).data('generator_subscription_id');

            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getReadingData') }}",
                method: 'GET',
                data: {
                    "generator_subscription_id": generator_subscription_id,
                },
                success: function(response) {
                    if (response.success) {
                        // Populate form fields with reading data
                        $('#add_edit_current_reading').val(response.data.current_reading);
                        $('#add_edit_consumption_quantity').val(response.data
                            .consumption_quantity);
                        $('#add_edit_consumption_value').val(response.data
                            .consumption_value);
                        $('#reading_generator_id').val(response.data.reading_generator_id);
                        // Show the modal
                        $('#add-reading-generators').modal('show');
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
        });
        // $(document).on('click', '.list-reading-generators', function(e) {
        //     e.preventDefault();

        //     const generator_subscription_id = $(this).data('generator_subscription_id');

        //     // افتح المودال أولاً
        //     $('#modal-reading-generators').modal('show');

        //     // بعد عرض المودال، فعّل DataTable
        //     $('#modal-reading-generators').on('shown.bs.modal', function() {
        //         const tableElement = $('.data-table-reading-generators');

        //         // // دمر الجدول السابق إن وجد
        //         // if ($.fn.DataTable.isDataTable(tableElement)) {
        //         //     tableElement.DataTable().clear().destroy();
        //         // }

        //         tableElement.DataTable({
        //             processing: true,
        //             serverSide: true,
        //             deferRender: true,
        //             ajax: {
        //                 url: "{{ route('admin.readingGenerators.getIndex') }}",
        //                 data: {
        //                     generator_subscription_id: generator_subscription_id
        //                 },
        //                 cache: false,
        //             },
        //             columns: [{
        //                     data: 'previous_reading',
        //                     name: 'previous_reading',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'current_reading',
        //                     name: 'current_reading',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'consumption_value',
        //                     name: 'consumption_value',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'consumption_quantity',
        //                     name: 'consumption_quantity',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'actions',
        //                     name: 'actions',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //             ],
        //             order: [
        //                 [1, 'asc']
        //             ],
        //             language: {
        //                 loadingRecords: "الرجاء الانتظار...",
        //             },
        //             lengthMenu: [10, 25, 50, 100],
        //         });
        //     });
        // });

        // $(document).on('click', '.list-reading-generators', function(e) {
        //     e.preventDefault();

        //     const generator_subscription_id = $(this).data('generator_subscription_id');

        //     // افتح المودال أولاً
        //     $('#modal-reading-generators').modal('show');

        //     // بعد عرض المودال، فعّل DataTable
        //     $('#modal-reading-generators').on('shown.bs.modal', function() {
        //         const tableElement = $('.data-table-reading-generators');

        //         // دمر الجدول السابق إن وجد لتفادي التكرار
        //         if ($.fn.DataTable.isDataTable(tableElement)) {
        //             tableElement.DataTable().clear().destroy();
        //         }

        //         tableElement.DataTable({
        //             processing: true,
        //             serverSide: true,
        //             deferRender: true,
        //             ajax: {
        //                 url: "{{ route('admin.readingGenerators.getIndex') }}",
        //                 data: {
        //                     generator_subscription_id: generator_subscription_id
        //                 },
        //                 cache: false,
        //                 error: function(xhr, error, thrown) {
        //                     alert(
        //                         'حدث خطأ أثناء تحميل البيانات. الرجاء المحاولة لاحقًا.');
        //                     console.error('AJAX Error:', error, thrown);
        //                 }
        //             },
        //             columns: [{
        //                     data: 'previous_reading',
        //                     name: 'previous_reading',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'current_reading',
        //                     name: 'current_reading',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'consumption_value',
        //                     name: 'consumption_value',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'consumption_quantity',
        //                     name: 'consumption_quantity',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //                 {
        //                     data: 'actions',
        //                     name: 'actions',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //             ],
        //             order: [
        //                 [1, 'asc']
        //             ],
        //             language: {
        //                 loadingRecords: "الرجاء الانتظار...",
        //                 zeroRecords: "لا توجد بيانات متاحة.",
        //                 processing: "جارٍ المعالجة...",
        //                 infoEmpty: "لا توجد بيانات لعرضها",
        //                 info: "عرض _START_ إلى _END_ من أصل _TOTAL_",
        //                 search: "بحث:",
        //                 lengthMenu: "عرض _MENU_ صفوف",
        //                 paginate: {
        //                     first: "الأول",
        //                     last: "الأخير",
        //                     next: "التالي",
        //                     previous: "السابق"
        //                 }
        //             },
        //             lengthMenu: [10, 25, 50, 100],
        //         });
        //     });
        // });


        let isDataTableInitialized = false;

        $(document).on('click', '.list-reading-generators', function(e) {
            e.preventDefault();

            const generator_subscription_id = $(this).data('generator_subscription_id');

            // خزّنه في خصائص المودال لاستخدامه لاحقًا
            $('#modal-reading-generators').data('generator_subscription_id', generator_subscription_id);

            // افتح المودال
            $('#modal-reading-generators').modal('show');
        });

        // فعّل DataTable عند إظهار المودال مرة واحدة فقط
        $('#modal-reading-generators').on('shown.bs.modal', function() {
            const generator_subscription_id = $(this).data('generator_subscription_id');
            const tableElement = $('.data-table-reading-generators');

            // تدمير الجدول السابق لتفادي التكرار
            if ($.fn.DataTable.isDataTable(tableElement)) {
                tableElement.DataTable().clear().destroy();
            }

            tableElement.DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: "{{ route('admin.readingGenerators.getIndex') }}",
                    data: {
                        generator_subscription_id: generator_subscription_id
                    },
                    cache: false,
                    error: function(xhr, error, thrown) {
                        alert('حدث خطأ أثناء تحميل البيانات. الرجاء المحاولة لاحقًا.');
                        console.error('AJAX Error:', error, thrown);
                    }
                },
                columns: [{
                        data: 'previous_reading',
                        name: 'previous_reading',
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
                        data: 'consumption_value',
                        name: 'consumption_value',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'consumption_quantity',
                        name: 'consumption_quantity',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    loadingRecords: "الرجاء الانتظار...",
                    zeroRecords: "لا توجد بيانات متاحة.",
                    processing: "جارٍ المعالجة...",
                    infoEmpty: "لا توجد بيانات لعرضها",
                    info: "عرض _START_ إلى _END_ من أصل _TOTAL_",
                    search: "بحث:",
                    lengthMenu: "عرض _MENU_ صفوف",
                    paginate: {
                        first: "الأول",
                        last: "الأخير",
                        next: "التالي",
                        previous: "السابق"
                    }
                },
                lengthMenu: [10, 25, 50, 100],
            });
        });


        $('#add_edit_amount').on('input', function() {
            var total = parseFloat($(this).val()) || 0;
            $('#cash_paid').val(total);
            $('#bank_paid').val(0);
        });

        $('#cash_paid').on('input', function() {
            var total = parseFloat($('#add_edit_amount').val()) || 0;
            var cash = parseFloat($(this).val()) || 0;
            if (cash > total) {
                toastr.warning('لا يمكن أن يكون المبلغ النقدي أكبر من الإجمالي');
                cash = total;
                $(this).val(cash);
            }
            var bank = total - cash;
            $('#bank_paid').val(bank >= 0 ? bank : 0);
        });

        $('#bank_paid').on('input', function() {
            var total = parseFloat($('#add_edit_amount').val()) || 0;
            var bank = parseFloat($(this).val()) || 0;
            if (bank > total) {
                toastr.warning('لا يمكن أن يكون المبلغ البنكي أكبر من الإجمالي');
                bank = total;
                $(this).val(bank);
            }
            var cash = total - bank;
            $('#cash_paid').val(cash >= 0 ? cash : 0);
        });

        // 5. تدمير الجدول عند إغلاق المودال
        $('#modal-reading-generators').on('hidden.bs.modal', function() {
            const tableElement = $('.data-table-reading-generators');
            if ($.fn.dataTable.isDataTable(tableElement)) {
                tableElement.DataTable().destroy();
            }
        });
        $(document).on('click', '.add-reading-generators', function(e) {
            e.preventDefault();
            var generator_subscription_id = $(this).data('generator_subscription_id');

            $('#reading_generator_id').val('');
            $('#add_edit_subscription_generator_subscription_id').val(generator_subscription_id);


            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getKwatPrice') }}",
                method: 'POST',
                data: {
                    "generator_subscription_id": generator_subscription_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#killo_watt_cost').val(response
                        .data.killo_watt_cost);


                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred. Please try again later') }}',
                        'Error', {
                            timeOut: 3000
                        });
                }
            });
            $('#add-reading-generators').modal('show');

        });



        $(document).on('click', '.list-generator-receipts', function(e) {
            e.preventDefault();

            const generator_subscription_id = $(this).data('generator_subscription_id');
            const tableElement = $('#data-table-generator_receipts');

            // Ensure the table exists
            if (tableElement.length === 0) {
            console.error('Table with id "data-table-generator_receipts" not found in DOM.');
            return;
            }

            // Ensure thead has correct columns
            if (tableElement.find('thead').length === 0) {
            tableElement.prepend(
                `<thead>
                <tr>
                    <th>{{ __('label.amount') }}</th>
                    <th>{{ __('label.date') }}</th>
                    <th></th>
                </tr>
                </thead>`
            );
            } else {
            tableElement.find('thead').html(
                `<tr>
                <th>{{ __('label.amount') }}</th>
                <th>{{ __('label.date') }}</th>
                <th></th>
                </tr>`
            );
            }

            // Ensure tbody exists
            if (tableElement.find('tbody').length === 0) {
            tableElement.append('<tbody></tbody>');
            }

            // Destroy previous DataTable instance if exists
            if ($.fn.DataTable.isDataTable(tableElement)) {
            tableElement.DataTable().destroy();
            }

            // Initialize DataTable
            tableElement.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.generatorSubscriptions.getReceiptsGenerator') }}",
                data: {
                generator_subscription_id: generator_subscription_id
                },
                cache: false,
            },
            columns: [
                { data: 'amount', name: 'amount' },
                { data: 'date', name: 'date' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']],
            language: {
                loadingRecords: "الرجاء الانتظار...",
            },
            lengthMenu: [10, 25, 50, 100],
            });

            // Show the modal
            $('#modal-generator_receipts').modal('show');
        });






        $(document).on('click', '.add-generator-receipts', function(e) {
            e.preventDefault();
            const generator_subscription_id = $(this).data('generator_subscription_id');
            $('#add_edit_generator_receipt_subscription_id').val(generator_subscription_id);


                                    $('.modal-title').text('بيانات ستد القبض')
            $('#add-generator_receipts').modal('show');
        });


        $(document).on('change', '#add_edit_current_reading,#killo_watt_cost', function(e) {
            e.preventDefault();
            const current_reading = $('#add_edit_current_reading').val();
            const generatorSubscriptionId = $('#add_edit_subscription_generator_subscription_id').val();

            const reading_id = $('#reading_generator_id').val();
            if (current_reading && generatorSubscriptionId) {
                $.ajax({
                    url: "{{ route('admin.generatorSubscriptions.calculateConsumptionValue') }}",
                    method: 'POST',
                    data: {
                        "current_reading": current_reading,
                        "generator_subscription_id": generatorSubscriptionId,
                        'reading_id': reading_id,
                        'killo_watt_cost': $('#killo_watt_cost').val(),

                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#add_edit_consumption_value').val(response
                                .consumption_value);

                            $('#add_edit_consumption_quantity').val(response
                                .consumption_quantity);

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
            }
        });

        $(document).on('click', '#searchTable', function() {
            const generator_id = $('#search_generator_id').val();
            search(generator_id);
            $('.data-table').DataTable().ajax.reload(null, false);

        });




    });



    $(document).ready(function() {
        // عند تحميل الصفحة
        search();
    });

    function search(generator_id = null) {
        $.ajax({
            url: "{{ route('admin.generatorSubscriptions.search') }}",
            type: 'GET',
            data: {
                generator_id: generator_id
            },
            beforeSend: function() {
                $('#searchTable').prop('disabled', true).text('...جارٍ البحث');
            },
            success: function(response) {
                $('#total-subscribers').text(response.total_subscribers);
                $('#total-monthly-readings').text(response.total_monthly_readings);
                $('#total-debts').text(response.total_debts);
                $('#total-collections').text(response.total_collections);
                                $('#total-Expenses').text(response.total_expenses);

            },
            error: function() {
                alert("حدث خطأ أثناء جلب البيانات.");
            },
            complete: function() {
                $('#searchTable').prop('disabled', false).text(
                    '{{ __('label.search') }}');
            }
        });
    }




















    $(document).on('click', '.reading_delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);

        $('#Name_Delete').val(name_delete);
        var actionUrl = "{{ route('admin.readingGenerators.delete') }}";
        $('#delete').attr('action', actionUrl);


    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);
        var actionUrl = "{{ route('admin.generatorSubscriptions.delete') }}";
        $('#delete').attr('action', actionUrl);


    });






    $(document).on('click', '.submit', function(e) {
        e.preventDefault();
        $('#confirmModal').modal('hide');
        var ids = $('#Delete_id').val();
        var _url = $('#delete').attr('action');
        $.ajax({
            url: _url,
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



                $('.data-table-reading-generators').DataTable().ajax.reload(null, false);

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

    $(document).on('click', '.btn-restore', function() {
        restore_id = $(this).data('id');

        $('#add_edit_restore_id').val(restore_id);
        $('#restoreModal').modal('show');
    });

    $('#confirmRestore').on('click', function() {
        $.ajax({
            url: '{{ route('admin.generatorSubscriptions.restore') }}',
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
</script>
