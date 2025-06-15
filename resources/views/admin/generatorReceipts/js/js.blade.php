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
            form.attr('action', "{{ route('admin.generatorReceipts.store') }}");

            $('#add_edit_generator_subscription_id')
                .val('')
                .trigger('change');


        });


        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: {
                url: "{{ route('admin.generatorReceipts.getIndex') }}",
                type: 'GET',
                cache: true,
                data: function(d) {
                    d.generator_id = $('#search_generator_id').val();
                    d.generator_subscription_id = $('#search_generator_subsription_id').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.status = $('#add_edit_status').val();

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
                    data: 'amount',
                    name: 'amount',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'date',
                    name: 'date',
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
            form.attr('action', "{{ route('admin.generatorReceipts.update') }}");

            var generator_subscription_id = $(this).data('generator_subscription_id');
            // List of fields to populate
            const fields = [
                'receipt_id', 'generator_subscription_id', 'amount',
                'date',
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
                url: '{{ route('admin.generatorReceipts.delete') }}',
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
    });

    function fetchGeneratorStats() {
        let generator_id = $('#search_generator_id').val();
        let generator_subscription_id = $('#search_generator_subsription_id').val();
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        $.ajax({
            url: "{{ route('admin.generatorReceipts.search') }}",
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
                $('#total_collections').text(response.total_collections ?? '0');
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


    $(document).on('click', '.btn-restore', function() {
        restore_id = $(this).data('id');

        $('#add_edit_restore_id').val(restore_id);
        $('#restoreModal').modal('show');
    });

    $('#confirmRestore').on('click', function() {
        $.ajax({
            url: '{{ route('admin.generatorReceipts.restore') }}',
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
</script>
