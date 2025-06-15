<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).on('click', '.exemption-icon', function() {
        // Optionally, set dynamic values if needed
        var invoiceId = $(this).data('invoice-id'); // Get dynamic invoice ID
        $('#invoice_id').val(invoiceId); // Set invoice ID to the hidden input field
        $('#exemptionModal').modal('show');
    });


    $(document).ready(function() {
        // Handle form submission using AJAX
        $('#exemptionForm').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission

            var formData = new FormData(this); // Gather form data

            $.ajax({
                url: $(this).attr('action'), // Get the action URL from the form
                method: 'POST',
                data: formData, // Send the form data
                processData: false, // Don't process the data
                contentType: false, // Don't set content type manually
                success: function(response) {
                    // On success, handle the response
                    if (response.status) {
                        // SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'تم إرسال الطلب بنجاح!',
                            text: 'تم تقديم طلب الإعفاء بنجاح.',
                            confirmButtonText: 'موافق'
                        });

                        // Close the modal
                        $('#exemptionModal').modal('hide');
                    } else {
                        // Handle errors with SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'حدث خطأ!',
                            text: 'لم يتم تقديم الطلب بنجاح، حاول مرة أخرى.',
                            confirmButtonText: 'موافق'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error with SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'حدث خطأ غير متوقع!',
                        text: 'يرجى المحاولة مرة أخرى لاحقاً.',
                        confirmButtonText: 'موافق'
                    });
                }
            });
        });
    });


    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('front.invoices.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();

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


    $('.submit').on('click', function(e) {
        e.preventDefault();
        updateData();
    });

    $(document).on('click', '.invoice', function(e) {
        e.preventDefault();
        $('#invoiceModal').modal('show');


        var invoce_id = $(this).data('invoce_id');
        var amount = $(this).data('amount');
        $('#amount').val(amount);

        $('#invoce_id').val(invoce_id);


    });







    function updateData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();

        $.ajax({
            url: '{{ route('front.invoices.getInvoicesData') }}',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
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


    $("form[name='my-invoice']").validate({
        rules: {

            photo: {
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

            var data = new FormData(document.getElementById("my-invoice"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('front.invoices.update') }}',
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
                        {{-- setTimeout(function() { --}}
                        {{--    window.location.replace( --}}
                        {{--        '{{ route('admin.incomeMovements.index') }}'); --}}
                        {{-- }, 2000); --}}
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
</script>
