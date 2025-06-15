<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>


<script>
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
            url: '{{ route('admin.jobConstrancts.delete') }}',
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

                    $('.data-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }



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


    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.jobConstrancts.getIndex') }}",
            type: 'get',
            "data":function(d){
                d.user_type=$('#user_type').val();
            },

        },

        columns: [{
                data: 'photo',
                name: 'photo',
                searchable: false,
                orderable:false,

            },
            {
                data: 'name',
                name: 'name',

                searchable: true
            },

            {
                data: 'company_name',
                name: 'company_name',
                searchable: true,
                orderable:false,
            },
            {
                data: 'branch_name',
                name: 'branch_name',

                searchable: true
            },
            {
                data: 'sallary',
                name: 'sallary',
                searchable: true,

            },
            {
                data: 'duration',
                name: 'duration',
                searchable: true,
                orderable:false,

            },

            {
                data: 'job_type',
                name: 'job_type',
                searchable: true,
                orderable:false,

            },
            {
                data: 'date',
                name: 'date',
                searchable: true
            },
            {
                data: 'created_at',
                name: 'created_at',
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                searchable: true,
                orderable:false,

            },

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    $(document).ready(function() {
        $('#btnFiterSubmitSearch').on('click', function() {

            getData();
        });
    });


    function getData() {
        $.ajax({
            url: '{{ route('admin.jobConstrancts.getData') }}', // Update with your actual route
            type: 'GET', // or 'POST' based on your route
            data: {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                user_type: $('#user_type').val()
            },
            success: function(response) {
                // Handle the data here, e.g., display in HTML
                $('#count_income').text(response.data.count_contracts);
                $('#count_user').text(response.data.count_user);

                $('#min_income').text(response.data.min_contracts);
                $('#total_income').text(response.data.total_contracts);
                $('#max_income').text(response.data.max_contracts);

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    getData();




</script>
