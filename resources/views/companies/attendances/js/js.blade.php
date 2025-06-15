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
            showModal('#exampleModal', '{{__('label.registering_employees_departure')}}');
        });


        // AJAX Request for Data Update
        $('.submit').on('click', function(e) {
            e.preventDefault();
            updateData(table);
        });

        // Form Validation and Submission
        initializeFormValidation("#my-form", "{{ route('companies.attendances.attendances') }}");
        initializeFormValidation("#edit-form", "{{ route('companies.attendances.update') }}");
    });

    function initializeDataTable() {
        return $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('companies.attendances.getIndex') }}",
                type: 'GET',
                data: function(d) {
                    d.user_id = $('#user_id').val();
                    d.date = $('.start_at').val();
                    d.company_id = $('.company_id').val();
                },
            },
            columns: [
                { data: 'photo', name: 'photo' },
                { data: 'name', name: 'name', searchable: true },
                { data: 'date', name: 'date' },
                { data: 'login_time', name: 'login_time' },
                { data: 'logout_time', name: 'logout_time' },
                { data: 'hours', name: 'hours' },
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

        $.ajax({
            url: '{{ route('companies.attendances.getData') }}',
            method: 'POST',
            data: {
                user_id: user_id,
                date: date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
                table.clear().draw();
                table.rows.add(response.data).draw();
            },
            error: function(response) {
                console.error(response);
            }
        });
    }

    function updateCounters(data) {
        $('#user_count').text("(" + data.user_count + ")");
        $('#absence_count').text("(" + data.absence_count + ")");
        $('#presence_count').text("(" + data.presence_count + ")");
        $('#hours_count').text("(" + data.hours_count + ")");
    }

    function initializeFormValidation(formId, url) {
        $(formId).validate({
            rules: {
                date: { required: true },
                time: { required: true },
                // login_time: { required: true },
                // logout_time: { required: true }
            },
            messages: {
                date: { required: "التاريخ مطلوب" },
                time: { required: "الوقت مطلوب" },
                login_time: { required: "وقت الحضور مطلوب" },
                logout_time: { required: "وقت الانصراف مطلوب" }
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = new FormData(form);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        handleResponse(response, formId);
                    },
                    error: function(response) {
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
            toastr.error("{{__('label.fail_proccess')}}", "Error!");
        }
    }


    $(document).ready(function(e) {
        // e.preventDefault();

        const user_id = $('#user_id').val();
        const date = $('.start_at').val();

        $.ajax({
            url: '{{ route('companies.attendances.getData') }}',
            method: 'POST',
            data: {
                user_id: user_id,
                date: date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
            },
            error: function(response) {
                console.error(response);
            }
        });
    })
</script>
