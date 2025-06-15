<script>
    var languageUrl =
        "{{ app()->getLocale() === 'ar' ? '//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json' : '' }}";

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: "{{ route('admin.branchs.getIndex') }}",
            type: 'GET',
        },
        columns: [
            {
                data: 'branch_name',
                name: 'branch_name',
                searchable: true
            },
            {
                data: 'name',
                name: 'name',
                searchable: true
            },


            {
                data: 'total_income',
                name: 'total_income',
                searchable: true
            },

            {
                data: 'total_contracts',
                name: 'total_contracts',
                searchable: true
            },
            {
                data: 'max_capacity',
                name: 'max_capacity',
                searchable: true
            },
            {
                data: 'registered_count',
                name: 'registered_count',
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

    table.columns(1).visible(false);
    $(document).on('click', '.check_status', function(event) {

        event.preventDefault();

        if (confirm("{{ __('label.do_you_want_to_change_the_status') }}")) {
            var status;
            var _this = $(this)
            var ids = _this.data('id');
            if (_this.prop('checked')) {
                status = 1;
            } else {
                status = 0;

            }
            $.ajax({
                url: '{{ route('admin.branchs.updateStatus') }}',
                method: 'POST',
                data: {
                    "id": ids,
                    "status": status,
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
                    }
                    $('.data-table').DataTable().ajax.reload()



                },
                error: function(response) {
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });

                }


            });


        } else {
            return false;
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
            url: '{{ route('admin.branchs.delete') }}',
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


    $(document).on('click', '.add_branchs', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('{{ __('label.add_branchs') }}');

        let _url = "{{ route('admin.branchs.store') }}";

        $('#my-form').attr('action', _url);
        $('#name').val('');
        $('#code').val('');
        $('#status').prop('checked', true);



    });




    $(document).on('click', '.edit_branch', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text("{{ __('label.edit_branch') }}");
        var name= $(this).data('name');
        var code= $(this).data('code');

        var branch_id =$(this).data('branch_id');
        var status = $(this).data('status');
        let _url = "{{ route('admin.branchs.update') }}";

        $('#my-form').attr('action', _url);
        $('#name').val(name);
        $('#code').val(code);

        $('#branch_id').val(branch_id);
        if (status != 0) {
            $('#status').prop('checked', true);

        } else {
            $('#status').prop('checked', false);
        }

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





        },

        messages: {

            name: {
                "required": "اسم مطلوب",

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
