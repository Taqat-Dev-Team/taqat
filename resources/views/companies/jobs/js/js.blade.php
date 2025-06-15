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
            url: '{{route('companies.jobs.delete')}}',
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
            url: "{{route('companies.jobs.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.slug=$('#slug').val();
            },

        },

        columns: [

            {data: 'title_tag', name: 'title_tag',searchable: true},

            {data: 'title', name: 'title',searchable: true},
            {data: 'apply_count', name: 'apply_count',searchable: true},
            {data: 'status', name: 'status',searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

        language: {
            "url": url,
        }
    });
    table.column(1).visible(false);  // Hides the "office" column

    // table.columns(1).header().to$().hide();






</script>
