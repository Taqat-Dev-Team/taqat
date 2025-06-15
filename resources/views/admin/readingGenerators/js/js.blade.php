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
            const form = $('#my-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-form')[0].reset();
            $('.modal-title').text("{{ __('label.add_reading_generator') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.readingGenerators.store') }}");

            $('#add_edit_generator_subscription_id')
                .val('')
                .trigger('change');


        });


        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: {
                url: "{{ route('admin.readingGenerators.getIndex') }}",
                type: 'GET',
                cache: true,
                data: function(d) {
                    d.generator_id = $('#search_generator_id').val();
                    d.generator_subscription_id = $('#search_generator_subsription_id').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.status = $('#status').val();


                }
            },
            columns: [{
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
                    data: 'generator_name',
                    name: 'generator_name',
                    orderable: false,
                    searchable: false
                },


                {
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
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

        // Search filter
        $('[data-kt-drivers-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });





        // Form validation and AJAX submit
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
            const title = $(this).hasClass('view') ? '{{ __('label.add_reading_generator') }}' :
                '{{ __('label.edit_reading_generator') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.readingGenerators.update') }}");

            var generator_subscription_id = $(this).data('generator_subscription_id');
            // List of fields to populate
            const fields = [
                'reading_generator_id', 'generator_subscription_id', 'consumption_value',
                'current_reading', 'consumption_quantity',
            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });

            $('#add_edit_generator_subscription_id')
                .val(generator_subscription_id)
                .trigger('change');
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });



    });
























    $(document).on('click', '.btn-restore', function() {
        restore_id = $(this).data('id');

        $('#add_edit_restore_id').val(restore_id);
        $('#restoreModal').modal('show');
    });

    $('#confirmRestore').on('click', function() {
        $.ajax({
            url: '{{ route('admin.readingGenerators.restore') }}',
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
            url: '{{ route('admin.readingGenerators.delete') }}',
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



    function fetchGeneratorStats() {
        let generator_id = $('#search_generator_id').val();
        let generator_subscription_id = $('#search_generator_subsription_id').val();
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        $.ajax({
            url: "{{ route('admin.readingGenerators.search') }}",
            type: 'GET',
            data: {
                generator_id: generator_id,
                generator_subscription_id: generator_subscription_id,
                start_date: start_date,
                end_date: end_date
            },
            beforeSend: function() {
                $('#searchTable').prop('disabled', true).text('...جارٍ البحث');
            },
            success: function(response) {
                $('#total-subscribers').text(response.total_subscribers ?? '0');
                $('#total-monthly-readings').text(response.total_monthly_readings ?? '0');
                $('#consumption_quantity').text(response.consumption_quantity ?? '0');
                $('#consumption_value').text(response.consumption_value ?? '0');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("حدث خطأ أثناء جلب البيانات.");
            },
            complete: function() {
                $('#searchTable').prop('disabled', false).text('{{ __('label.search') }}');
            }
        });
    }

    $(document).ready(function() {
        // عند تحميل الصفحة
        fetchGeneratorStats();
    });

    // عند الضغط على زر البحث
    $(document).on('click', '#searchTable', function() {
        fetchGeneratorStats();
        $('.data-table').DataTable().ajax.reload(null, false);
    });

    $(document).on('change', '#add_edit_current_reading', function(e) {
        e.preventDefault();
        const current_reading = $(this).val();
        const generatorSubscriptionId = $('#add_edit_generator_subscription_id').val();

        const reading_id = $('#reading_generator_id').val();
        if (current_reading && generatorSubscriptionId) {
            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.calculateConsumptionValue') }}",
                method: 'POST',
                data: {
                    "current_reading": current_reading,
                    "generator_subscription_id": generatorSubscriptionId,
                    'reading_id': reading_id,
                    'killo_watt_cost': $('#add_edit_killo_watt_cost').val(),
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

    $(document).on('change', '#add_edit_generator_subscription_id', function(e) {
        e.preventDefault();
        const generator_subscription_id = $(this).val();

            $.ajax({
                url: "{{ route('admin.generatorSubscriptions.getKwatPrice') }}",
                method: 'POST',
                data: {
                    "generator_subscription_id": generator_subscription_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        $('#add_edit_killo_watt_cost').val(response
                            .data.killo_watt_cost);


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
    );

</script>
