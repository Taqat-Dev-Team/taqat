<!-- External Scripts -->
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        // DataTable Initialization
        const table = initializeDataTable();

        // Filter Button Click
        $('#btnFiterSubmitSearch').click(function(e) {
            e.preventDefault();
            table.draw(true);
        });

        // Modal Show for Editing Attendances
        $(document).on('click', '.edit_attendances', function() {
            showModalWithData('#edit_Brand_modal', $(this).data());
        });

        $(document).on('click', '.attendances', function() {
            showModal('#exampleModal', '{{ __('label.registering_employees_departure') }}');
        });


        // AJAX Request for Data Update
        $('.submit').on('click', function(e) {
            e.preventDefault();
            updateData(table);
        });

        // Form Validation and Submission
    });

    function initializeDataTable() {
        return $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.logs.getIndex') }}",
                type: 'GET',
                data: function(d) {
                    d.user_id = $('#user_id').val();
                    d.date = $('.start_at').val();
                    d.company_id = $('.company_id').val();
                    d.branch_id = $('#branch_id').val();
                    d.user_type_cd_id = $('#user_type').val();
                },
            },
            columns: [{
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,

                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: true,

                },
                {
                    data: 'branch',
                    name: 'branch',
                    searchable: true,

                },
                {
                    data: 'completed_invoice',
                    name: 'completed_invoice',
                    searchable: true,

                },

                {
                    data: 'pendding_invoice',
                    name: 'pendding_invoice',
                    searchable: true,

                },

                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time_in',
                    name: 'time_in'
                },
                {
                    data: 'time_out',
                    name: 'time_out'
                },



                {
                    data: 'hours',
                    name: 'hours'
                },


                {
                    data: 'action',
                    name: 'action'
                },


            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
    }

    function showModalWithData(modalId, data) {
        $(modalId).modal('show');

        $('.logout_time').val(data.logout_time);
        $('.login_time').val(data.login_time);
        $('.user_id').val(data.user_id);
        $('.date').val(data.date);
    }

    function showModal(modalId, title) {
        $(modalId).modal('show');
        $('#exampleModalLabel').text(title);
    }

    function updateData(table) {
        const user_id = $('#user_id').val();
        const company_id = $('.company_id').val();
        const date = $('.start_at').val();
        $('#spinner').show();
        $('.btn-primary').attr('disabled', true);
        $('.hiden_icon').hide();
        var branch_id = $('.branch_id').val();

        $.ajax({
            url: '{{ route('admin.logs.getData') }}',
            method: 'POST',
            data: {
                user_id: user_id,
                company_id: company_id,
                date: date,
                branch_id: branch_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();
                updateCounters(response.data);
                table.clear().draw();
                table.rows.add(response.data).draw();
            },
            error: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();
                console.error(response);
            }
        });
    }

    function updateCounters(data) {
        $('#user_count').text("(" + data.user_count + ")");
        $('#absence_count').text("(" + data.absence_count + ")");
        $('#presence_count').text("(" + data.presence_count + ")");
        $('#hours_count').text("(" + data.hours_count + ")");
        $('#log_hours').text("(" + data.log_hours + ")");

    }

    function initializeFormValidation(formId, url) {
        $(formId).validate({
            rules: {
                date: {
                    required: true
                },
                time: {
                    required: true
                },
                // login_time: { required: true },
                // logout_time: { required: true }
            },
            messages: {
                date: {
                    required: "التاريخ مطلوب"
                },
                time: {
                    required: "الوقت مطلوب"
                },
                login_time: {
                    required: "وقت الحضور مطلوب"
                },
                logout_time: {
                    required: "وقت الانصراف مطلوب"
                }
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = new FormData(form);
                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        handleResponse(response, formId);
                    },
                    error: function(response) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        handleError(response);
                    }
                });
            }
        });
    }

    function handleResponse(response, formId) {
        if (response.status) {
            toastr.success(response.message, "نجاح العملية");
            $(formId).closest('.modal').modal('hide');
            $('.data-table').DataTable().ajax.reload();
        } else {
            toastr.error(response.message, "Error!");
        }
    }

    function handleError(response) {
        const errors = response.responseJSON.errors;
        if (errors) {
            let errorText = "";
            $.each(errors, function(key, value) {
                errorText += value + "\n";
                $('.' + key).text(value);
            });
            toastr.error(errorText, "Error!");
        } else {
            toastr.error("{{ __('label.fail_proccess') }}", "Error!");
        }
    }


    $(document).ready(function(e) {
        // e.preventDefault();

        const user_id = $('#user_id').val();
        const company_id = $('.company_id').val();
        const date = $('.start_at').val();
        $('#spinner').show();
        $('.btn-primary').attr('disabled', true);
        $('.hiden_icon').hide();
        var branch_id = $('.branch_id').val();


        $.ajax({
            url: '{{ route('admin.logs.getData') }}',
            method: 'POST',
            data: {
                user_id: user_id,
                company_id: company_id,
                date: date,
                branch_id: branch_id,
                _token: '{{ csrf_token() }}'
            },


            success: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();

                updateCounters(response.data);
            },

            error: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();
                console.error(response);
            }
        });
    });


    $(document).on('click', '.add_user', function(e) {

        e.preventDefault();

        var user_id = $(this).data('user_id');
        var branch_id = $(this).data('branch_id');
        var status = $(this).data('status');

        $('.add_user_branch_id').val(user_id);

        $('#add_branch_id')
            .val(branch_id)
            .trigger('change');
        $('#add_status')
            .val(status)
            .trigger('change');

        if(branch_id){
            $('.branch_id').show();
        }
        $('#exampleModal').modal('show');


    });

    $(document).on('change', '#add_status', function(e) {
        e.preventDefault();
        if ($(this).val() == 1) {
            $('.branch_id').show();
        } else {
            $('.branch_id').hide();

        }

    });

    $(document).on('click', '.invoiceSingleModal', function(e) {
        e.preventDefault();
        $('#invoiceSingleModal').modal('show');
        var user_id = $(this).data('user_id');

        $('#invoce_user_id').val(user_id);


    });
    $("form[name='my-invoice']").validate({
        rules: {

            amount: {
                required: true
            },
            "branch_id[]": {
                required: true
            },


        },
        messages: {

            amount: {
                required: "{{ __('validation.ammount_required') }}"
            },
            "branch_id[]": {
                required: "{{ __('validation.branch_required') }}"
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
                url: '{{ route('admin.users.createInvoice') }}',
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

                    $('#my-invoice')[0].reset();
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

    $("form[name='my-single-invoice']").validate({
        rules: {

            amount: {
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

            var data = new FormData(document.getElementById("my-single-invoice"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.users.storeSingleInvoce') }}',
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
                    $('#invoiceSingleModal').modal('hide')

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


    $("form[name='my-form']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            status: {
                required: true,

            },

            branch_id: {
                required: function() {
                    return $('#add_status').val() == 1;
                },


            }

        },
        messages: {
            status: "الحالة مطلوبة",
            branch_id: "الفرع مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-form"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.addToBranch') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

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

                    $('#exampleModal').modal('hide');

                    $('.data-table').DataTable().ajax.reload();
                },
                error: function(response) {





                    var errors = response.responseJSON.errors;


                    var errorText = "";
                    $.each(errors, function(key, value) {
                        errorText += value + "\n";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: errorText
                    });



                }
            });


        }

    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit', function (e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids=   $('#Delete_id').val();
        $.ajax({
            url: '{{route('admin.logs.delete')}}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                if (data.status) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                }
                else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                }

                $('.data-table').DataTable().ajax.reload();



            },
            error: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload();

            }


        });




    });
</script>
