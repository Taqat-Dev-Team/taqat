<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script>
       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('front.withdraws.getIndex') }}",
            type: 'get',
        },

        columns: [


        {
                data: 'photo',
                name: 'photo',
                searchable: true

            },
            {
                data: 'withdraw_transaction',
                name: 'withdraw_transaction',
            },


            {
                data: 'iban',
                name: 'iban',
            },

            {
                data: 'bank_name',
                name: 'bank_name',
            },

            {
                data: 'account_number',
                name: 'account_number',
            },

            {
                data: 'status',
                name: 'status',
                searchable: true
            },

            {
                data: 'message',
                name: 'message',
            },






        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


    $(document).on('click', '.edit_withdraw', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('طلب سحب');

        var withdraw_id=$(this).data('withdraw_id');
        $('#withdraw_id').val(withdraw_id);





        $('#my-form').validate({

            rules: {

                "status":{
                    required:true,
                },
                "message":{
                    required:function(){
                        return $('#status').val()==3;
                    },
                }
            }
            ,messages : {
                "status":{
                    "required":"الحقل مطلوب"
                },

            }
            ,                submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data= new FormData(document.getElementById("my-form"));
                $.ajax({
                    url: '{{route('admin.withdraws.update')}}' ,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function( response ) {

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                            $('#exampleModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload();

                    },
                    error: function(response) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        });

                        $('.data-table').DataTable().ajax.reload();

                    }
                });


            }

        });

    });


</script>
