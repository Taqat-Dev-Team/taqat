<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>


<script>

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
            url: '{{route('companies.users.delete')}}',
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

                    $('.data-table').DataTable().ajax.reload();
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


    $('#btnFiterSubmitSearch').click(function (e) {
        e.preventDefault();
        $('.data-table').DataTable().draw(true);
    });

    url="";
    var locale = "{{ app()->getLocale() }}";

    if (locale == 'ar') {
     url=    "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json";
    } else {
        url= "//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json"; // Default to English
    }
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{route('companies.users.getIndex')}}",
            type: 'get',

        },

        columns: [
            {data: 'photo', name: 'photo',serable:true},
            {data: 'name', name: 'name',searchable: true},
            {data: 'email', name: 'email'},
            {data: 'company_name', name: 'company_name'},
            {data: 'job', name: 'job'},
            {data: 'displacement_place', name: 'displacement_place'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        language: {
            "url":url,
        }
    });






</script>
