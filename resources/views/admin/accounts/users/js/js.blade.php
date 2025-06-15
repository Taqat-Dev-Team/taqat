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
            // $('.error').text('');
            $('#my-form')[0].reset();
            $('.modal-title').text("{{ __('messages.add_new_user') }}");
            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.accounts.users.store') }}");
            $('#add_edit_parent_id').val('').trigger('change.select2');
            $('#add_edit_balance_type_id').val('').trigger('change.select2');
            $('#add_edit_city').val('').trigger('change.select2');




        });

        $('#add_edit_user_id').select2({
                            ajax: {
                                url: '{{ route("admin.accounts.users.search") }}',
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        q: params.term // search term
                                    };
                                },
                                processResults: function(data) {
                                    return {
                                        results: $.map(data, function(item) {
                                            return {
                                                id: item.id,
                                                text: item.name
                                            };
                                        })
                                    };
                                },
                                cache: true
                            },
                            placeholder: '{{ __("label.select_user") }}',
                            minimumInputLength: 1
                        });

        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            // Improves speed by deferring the rendering of rows
            searching: true,
            ajax: {
                url: "{{ route('admin.accounts.users.getIndex') }}",

                cache: true, // Avoid unnecessary repeated requests
            },
            columns: [
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email',
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
                    data: 'parnent',
                    name: 'parnent',
                    orderable: false,

                },

                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'asc']
            ], // Ensure proper default ordering
            language: {
                loadingRecords: "Please wait - loading...",
            },
            lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
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
                balance_type_id: {
                    required: true
                },
                parent_id: {
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
                            $('.data-table').DataTable().ajax.reload();
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
            const title = $(this).hasClass('view') ? '{{ __('messages.view_user') }}' :
                '{{ __('messages.view_user') }}';

            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.accounts.users.update') }}");

            // List of fields to populate
            const fields = [
                'name', 'account_id','email', 'mobile', 'country', 'city', 'address','fax_number'

            ];

            // Populate form fields with data
            fields.forEach(field => {
                $('#' + action + '_' + field).val($(this).data(field));
            });

            $('#' + action + '_city ').val($(this).data('city')).trigger('change');

            $('#' + action + '_balance_type_id ').val($(this).data('balance_type_id')).trigger('change');
            $('.modal-title').text(title);
            $('#kt_modal_' + action).modal('show');

        });













    });







    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.accounts.users.getIndex') }}",
            type: 'get',
            "data": function(d) {

            },

        },




        columns: [

            {
                data: 'name',
                name: 'name',
                searchable: true
            },
            {
                data: 'parnent',
                name: 'parnent',
                searchable: true
            },
            {
                data: 'mobile',
                name: 'mobile',
                searchable: true

            },

            {
                data: 'email',
                name: 'email',
                searchable: true

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
            url: '{{ route('admin.accounts.assets.delete') }}',
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
