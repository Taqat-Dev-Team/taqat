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



        // Form Validation and Submission
    });

    $("form[name='my-form']").validate({
        rules: {







        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data = new FormData(document.getElementById("my-form"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.joinBranches.update') }}',
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

                        $('#addToBranchModal').modal('hide');

                        $('.data-table').DataTable().ajax.reload();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);

                        });
                    }
                }
            });


        }

    });


    function initializeDataTable() {
        return $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.joinBranches.getIndex') }}",
                type: 'GET',
                data: function(d) {
                    d.branch_id = $('#branch_id').val();
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
                    data: 'current_branch',
                    name: 'current_branch',
                    searchable: true,

                },

                {
                    data: 'branch',
                    name: 'branch',
                    searchable: true,

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





    $(document).on('click', '.add_branch', function(e) {
        e.preventDefault();
        var branch_name = $(this).data('branch_name');
        var user_name = $(this).data('user_name');
        var user_id = $(this).data('user_id');
        var branch_id = $(this).data('branch_id');
        $('.user_name').text(user_name);
        $('.branch_name').text(branch_name);
        $('#user_id').val(user_id);
        $('#add_branch_id').val(branch_id);
        $('#addToBranchModal').modal('show')

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
            url: '{{ route('admin.joinBranches.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else {
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
            error: function(data) {
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
