<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        dom: 'Bfrtip', // إضافة الـ DOM لـ Buttons
        buttons: [], // إزالة زر التصدير الافتراضي
        ajax: {
            url: "{{ route('admin.expenses.getIndex') }}",
            type: "GET",
            data: function(d) {
                d.user_id = $('#user_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            dataSrc: function(response) {
                $('#total_invoice').text(response.total_expense);
                $('#total_payment').text(response.total_payment);
                return response.data;
            }
        },
        columns: [{
                data: 'user_name',
                name: 'user_name'
            },
            {
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
                data: 'payment_types',
                name: 'payment_types'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/{{ app()->getLocale() }}.json"
        }
    });

    // البحث المتقدم
    $('#searchTable').on('click', function() {
        table.ajax.reload();
    });

    // تصدير Excel
    $('#exportExcel').on('click', function() {
        // تحميل بيانات التصدير بنفس شروط البحث
        var user_id = $('#user_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        window.location.href = "{{ route('admin.expenses.exportExcel') }}?user_id=" + user_id + "&start_date=" +
            start_date + "&end_date=" + end_date;
    });


    $(document).ready(function() {
        $('#add_edit_account_id').change(function() {
            var expense_id = $(this).val();
            $('#add_edit_child_account_id').html(
                '<option value="">{{ __('label.selected') }}</option>'
            ); // Reset child options

            if (expense_id) {
                $.ajax({
                    url: "{{ route('admin.users.getChildExpenses') }}",
                    type: "GET",
                    data: {
                        expense_id: expense_id
                    },
                    success: function(response) {
                        if (response.success && response.child_expenses.length > 0) {
                            $.each(response.child_expenses, function(key, value) {
                                $('#add_edit_child_account_id').append(
                                    `<option value="${value.id}">${value.name}</option>`
                                );
                            });
                        } else {
                            $('#add_edit_child_account_id').html(
                                '<option value="">{{ __('label.no_child_expenses') }}</option>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('حدث خطأ أثناء تحميل المصروفات الفرعية.');
                    }
                });
            }
        });
    });


    $(document).on('click', '.add_expense', function(e) {

        e.preventDefault();


        $('#addexpenseModal').modal('show');


    });




    $("form[name='my-form']").validate({
        rules: {

            status: {
                required: true
            },
            amount: {
                required: true

            },
            payment_type_id: {
                required: true
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

            var data = new FormData(document.getElementById("my-form"));
            var actionUrl = form.getAttribute("action");

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
                    $('.data-table').DataTable().draw(true);
                    $('#addexpenseModal').modal('hide')

                    if (response.success) {
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

    $(document).on('click',  '.edit_expense', function(e) {
        e.preventDefault();

        const action = $(this).hasClass('view') ? 'view' : 'add_edit';
        const title = $(this).hasClass('view') ? '{{ __('label.view_service') }}' :
            '{{ __('label.edit_service') }}';

        const form = $('#my-form');
        form.attr('action', "{{ route('admin.expenses.update') }}");
        $('.modal-title').text(title);
        $('#addexpenseModal').modal('show');

        // تعبئة الحقول بناءً على البيانات من الزر
        $('#add_edit_expense_id').val($(this).data('expense_id'));


        $('#add_edit_account_id').val($(this).data('account_id'));

        alert($(this).data('account_id'));
        $('#add_edit_child_account_id').val($(this).data('child_account_id')).trigger('change');
        $('#add_edit_user_id').val($(this).data('user_id')).trigger('change');
        $('#add_edit_payment_method_id').val($(this).data('payment_method_id')).trigger('change');
        $('#add_edit_amount').val($(this).data('amount'));
        $('#add_edit_currency_cd_id').val($(this).data('currency_cd_id')).trigger('change');
        $('#add_edit_is_monthly').prop('checked', $(this).data('is_monthly'));
        $('#expiration_date').val($(this).data('start_date'));
        $('#end_date').val($(this).data('end_date'));

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
            url: '{{ route('admin.expenses.delete') }}',
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
