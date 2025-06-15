<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.wallets.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.status_id = $('select[name="status_id"]').val();



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
                data: 'balance',
                name: 'balance',

                searchable: true
            },







        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    table.on('xhr', function() {
        let json = table.ajax.json();
        if (json.meta) {
            $('#total_payment').text("(" + (json.meta.total_payment ?? 0) + ")");
            $('#user_count').text("(" + (json.meta.user_count ?? 0) + ")");

        }
    });
    $('#searchTable').on('click', function() {

        table.ajax.reload(); // Reload the DataTable with new data
    });










    $(document).on("click", ".edit", function(e) {
        e.preventDefault();
        let wallet_id = $(this).data("wallet_id");
        let amount = $(this).data("amount");
        let status_cd_id=$(this).data('status_cd_id');

        // تعيين القيم في النموذج
        $("#wallet_id").val(wallet_id);
        $("#amount").val(amount);
        $("#status_cd_id").val(status_cd_id).trigger("change");
        $("#walletModal").modal("show");

    });



    $("form[name='my-form']").validate({
        rules: {

            status_cd_id: {
                required: true
            },


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
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.wallets.update') }}',
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
                    $('#walletModal').modal('hide')

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
            url: '{{ route('admin.wallets.delete') }}',
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
