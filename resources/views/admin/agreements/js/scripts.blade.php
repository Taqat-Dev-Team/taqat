<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    var languageUrl =
        "{{ app()->getLocale() === 'ar' ? '//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json' : '' }}";

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: "{{ route('admin.agreements.getIndex') }}",
            type: 'GET',
        },
        columns: [

            {
                data: 'value',
                name: 'value',
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
            url: '{{ route('admin.agreements.delete') }}',
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


    $(document).on('click', '.add_agreement', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('بيانات شروط الاتفاقية');

        let _url = "{{ route('admin.agreements.store') }}";

        $('#my-form').attr('action', _url);
       $('#my-form')[0].reset();



    });




    $(document).on('click', '.edit_agreement', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text("بيانات شروط الاتفاقية");
        var value = $(this).data('value');
        var value_en = $(this).data('value_en');
        var agreement_id = $(this).data('agreement_id');
        let _url = "{{ route('admin.agreements.update') }}";

        $('#my-form').attr('action', _url);
        $('#agreement_id').val(agreement_id);

        // Set Arabic value
        if (CKEDITOR.instances['value']) {
            CKEDITOR.instances['value'].setData(value);
        } else {
            $('#value').val(value);
        }

        // Set English value
        if (CKEDITOR.instances['value_en']) {
            CKEDITOR.instances['value_en'].setData(value_en);
        } else {
            $('#value_en').val(value_en);
        }
    });
</script>

<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $("#my-form").validate({
        ignore: [],
        rules: {
            value: {
                required: function(textarea) {
                    if (CKEDITOR.instances['value']) {
                        return CKEDITOR.instances['value'].getData().trim().length === 0;
                    }
                    return $(textarea).val().trim().length === 0;
                }
            },
            value_en: {
                required: function(textarea) {
                    if (CKEDITOR.instances['value_en']) {
                        return CKEDITOR.instances['value_en'].getData().trim().length === 0;
                    }
                    return $(textarea).val().trim().length === 0;
                }
            }
        },
        messages: {
            value: {
                "required": "الرجاء إدخال شروط الاتفاقية",
            },
            value_en: {
                "required": "Please enter the agreement terms in English",
            }
        },
        errorPlacement: function(error, element) {
            if ((element.attr("id") == "value" && CKEDITOR.instances['value']) ||
                (element.attr("id") == "value_en" && CKEDITOR.instances['value_en'])) {
                error.insertAfter(element.next());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            // Update textarea with CKEditor data before submit
            if (CKEDITOR.instances['value']) {
                CKEDITOR.instances['value'].updateElement();
            }
            if (CKEDITOR.instances['value_en']) {
                CKEDITOR.instances['value_en'].updateElement();
            }

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
                        toastr.success(response.message, "{{ __('message.successfully_process') }}");
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
                            $('#' + key).text(value);
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
