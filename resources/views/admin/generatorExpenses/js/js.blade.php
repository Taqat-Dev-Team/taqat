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
            resetForm('#my-form', "{{ route('admin.generatorExpenses.store') }}",
                "بيانات مصاريف المولد");

            $('#generator_id').val(generator_id).trigger('change');

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
            deferRender: true,
            ajax: {
                url: "{{ route('admin.generatorExpenses.getIndex') }}",
                cache: true,
                data: function(d) {
                    d.generator_id = $('#search_generator_id').val();
                    d.start_date = $('#search_start_date').val();
                    d.end_date = $('#search_end_date').val();
                }
            },
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'generator',
                    name: 'generator'
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
                [1, 'asc']
            ],
            language: {
                loadingRecords: "Please wait - loading...",
            },
            lengthMenu: [10, 25, 50, 100],
        });

        // Trigger search on button click
        $('#search_expenses').on('click', function() {
            table.ajax.reload();
        });

        // Export to Excel
        $('#export_excel').on('click', function() {
            let params = $.param({
                generator_id: $('#search_generator_id').val(),
                start_date: $('#search_start_date').val(),
                end_date: $('#search_end_date').val()
            });
            window.location.href = "{{ route('admin.generatorExpenses.exportExcel') }}?" + params;
        });
        // Search filter
        $('[data-kt-drivers-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
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
            $('#generator_id').val(generator_id).trigger('change');
            $('#date').val(date);
                var url = $('#my-form').attr('action');

            // Show the modal for editing
            $('#my-form').attr('action',
                "{{ route('admin.generatorExpenses.update') }}");
            $('#kt_modal_add_edit').modal('show');
        });






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











    });
























    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);
        var actionUrl = "{{ route('admin.generatorExpenses.delete') }}";
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

</script>
