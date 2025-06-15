<script>
$(document).ready(function() {
    // Enable/Disable based on payment method selection

    if ($('#method_cheque').is(':checked')) {
            $('#cheque_number, #bank_name').prop('disabled', false); // Enable cheque fields
        } else {
            $('#cheque_number, #bank_name').prop('disabled', true); // Disable cheque fields
        }
    $('#method_cheque').change(function() {
        if ($(this).is(':checked')) {
            $('#cheque_number, #bank_name').prop('disabled', false); // Enable cheque fields
        } else {
            $('#cheque_number, #bank_name').prop('disabled', true); // Disable cheque fields
        }
    });

    if ($(this).is(':checked')) {
            $('#other_method').prop('disabled', false); // Enable other method field
        } else {
            $('#other_method').prop('disabled', true); // Disable other method field
        }
    $('#method_other').change(function() {
        if ($(this).is(':checked')) {
            $('#other_method').prop('disabled', false); // Enable other method field
        } else {
            $('#other_method').prop('disabled', true); // Disable other method field
        }
    });

    // Initialize the state of the fields
    if ($('#method_cheque').is(':checked')) {
        $('#cheque_number, #bank_name').prop('disabled', false);
    } else {
        $('#cheque_number, #bank_name').prop('disabled', true);
    }

    if ($('#method_other').is(':checked')) {
        $('#other_method').prop('disabled', false);
    } else {
        $('#other_method').prop('disabled', true);
    }
});
    var languageUrl =
        "{{ app()->getLocale() === 'ar' ? '//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json' : '' }}";

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: "{{ route('admin.billExchages.getIndex') }}",
            type: 'get',
            "data":function(d){
                d.start_date=$('#start_date').val();
                d.end_date=$('#end_date').val();

            },

        },

        columns: [

            {
                data: 'name',
                name: 'name',
                searchable: true
            },

            {
                data: 'mobile',
                name: 'mobile',
                searchable: true
            },

            {
                data: 'amount',
                name: 'amount',
                searchable: true
            },

            {
                data: 'date',
                name: 'date',
                searchable: true
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        language: {
            "url": languageUrl
        }
    });


    $('#searchTable').on('click', function() {

table.ajax.reload(); // Reload the DataTable with new data
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
            url: '{{ route('admin.billExchages.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
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
                    toastr.error(response.message, "Error!");

                }
                $('.data-table').DataTable().ajax.reload()



            },
            error: function(data) {
                Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });


            }


        });




    });


    $(document).on('click', '.add_bill_exchage', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('{{ __('label.add_bill_exchage') }}');

        let _url = "{{ route('admin.billExchages.store') }}";

        $('#my-form').attr('action', _url);
        $('#status').prop('checked', true);



    });




    $(document).on('click', '.edit_bill_exchange', function () {
    const data = $(this).data();
    let _url = "{{ route('admin.billExchages.update') }}";

$('#my-form').attr('action', _url);

    $('#bill_exchange_id').val(data.bill_exchange_id);
    $('#name').val(data.name);
    $('#id_number').val(data.id_number);
    $('#mobile').val(data.mobile);
    $('#amount').val(data.amount);
    $('#amount_letter').val(data.amount_letter);
    $('#date').val(data.date);
    $('#cheque_number').val(data.cheque_number || '');
    $('#bank_name').val(data.bank_name || '');
    $('#other_method').val(data.other_method || '');

    // Handle payment method checkboxes
    $('input[name="payment_method"]').prop('checked', false); // Uncheck all
    if (data.payment_method) {
        $(`input[value="${data.payment_method}"]`).prop('checked', true);
    }

    $('#exampleModal').modal('show');
});
</script>

<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $("#my-form").validate({

        rules: {
            name: {
                required: true,

            },

            mobile: {
                required: true,

            },
            amount: {
                required: true,

            },
            amount_letter: {
                required: true,

            },
            date:{
                required: true,

            },








        },

        messages: {

            name: {
                "required": "اسم مطلوب",

            },

            mobile: {
                "required": "رقم الجوال مطلوب",

            },

            amount:{
                "required": " المبلغ المطلوب",

            },
            amount_letter:{
                "required": "المبلغ بالحروف مطلوب",

            },
            date:{
                "required": "التاريخ مطلوب",

            },








        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-form"));
            var _url = $('#my-form').attr('action');
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();

            $.ajax({
                url: _url,
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    if (response.status) {


                        toastr.success(response.message,
                            "{{ __('message.successfully_process') }}");

                            $('#exampleModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload()

                    } else {
                        toastr.error(response.message, "Error!");

                    }

                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();

                },
                error: function(response) {
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();

                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });

                    } else {
                        if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                    }

                }


            });


        }

    });
</script>
