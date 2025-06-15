<script>





    $(document).ready(function () {

        var table = $('.data-table').DataTable({
            processing: false,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{route('admin.roles.getIndex')}}",
                type: 'get',

            },

            columns: [
                {data: 'name', name: 'name'},
             
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ],

            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });


        $(document).on('click', '.delete', function (e) {
            e.preventDefault();

            $('#confirmModal').modal('show')
            var user_name = $(this).attr('user_name');
            var ids = $(this).attr('id');
            $('#Delete_id').val(ids);
            $('#Name_Delete').val(user_name);

        });


        $(document).on('click', '.check_status', function (event) {

            event.preventDefault();

            if (confirm("هل انت متاكد  من تغير حالة الصلاحية ؟")) {
                var status;
                var _this = $(this)
                var ids = _this.attr('data-id');
                if (_this.prop('checked')) {
                    status = 1;
                } else {
                    status = 0;

                }
                $.ajax({
                    url: '{{route('admin.roles.updateStatus')}}',
                    method: 'POST',
                    data: {
                        "id": ids,
                        "status": status,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {

                        if (data.status == 201) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 3000
                            });

                        } else if (data.status == 422) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
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
                        $('.data-table').DataTable().ajax.reload()


                    },
                    error: function (data) {
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


            } else {
                return false;
            }
        });


    });

</script>

