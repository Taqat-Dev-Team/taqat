<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#btnFiterSubmitSearch').on('click', function() {

            getData();
        });
    });


    function getData() {
        $.ajax({
            url: '{{ route('admin.incomeMovements.getData') }}', // Update with your actual route
            type: 'GET', // or 'POST' based on your route
            data: {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                user_type: $('#user_type').val()
            },
            success: function(response) {
                // Handle the data here, e.g., display in HTML
                $('#count_income').text(response.data.count_income);
                $('#min_income').text(response.data.min_income);
                $('#total_income').text(response.data.total_income);
                $('#max_income').text(response.data.max_income);

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    getData();


    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.incomeMovements.delete') }}',
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
            url: "{{ route('admin.incomeMovements.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_type = $('#user_type').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },


        },

        columns: [{
                data: 'attachment',
                name: 'attachment',
                searchable: true
            },
            {
                data: 'name',
                name: 'name',
                searchable: true
            },
            {
                data: 'source',
                name: 'source',
                searchable: true
            },
            {
                data: 'amount',
                name: 'amount',
                searchable: true
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
                searchable: true
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


    get
</script>
