<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script>
       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('front.mystone.getIndex') }}",
            type: 'get',



        },

        columns: [

            {
                data: 'title',
                name: 'title',
                searchable: true

            },
            {
                data: 'project_title',
                name: 'project_title',
            },
            {
                data: 'amount',
                name: 'amount',
            },


            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'status',
                name: 'status',
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


    $(document).on('click', '.withdraw', function() {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('طلب سحب');

        var my_stone_id=$(this).data('my_stone_id');
        $('#my_stone_id').val(my_stone_id);



        $('#name').val('');
        $('#banck_name').val('');
        $('#iban').val('');
        $('#mobile').val('');


        $('#my-form').validate({

            rules: {
                'name': {
                    required: true
                },
                'mobile': {
                    required: true,

                },
                "iban":{
                    required: true,

                },
                "bank_name":{
                    required: true,

                },
                "account_number":{
                    required: true,

                },
            }
            ,messages : {
                'name': {
                    required:"الاسم مطلوب"
                },
                'mobile':  {
                    required: "رقم الجوال مطلوب",

                },

                'iban':  {
                    required: "رقم الايبان مطلوب",

                },

                'bank_name':  {
                    required: "اسم البنك مطلوب",

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
                    url: '{{route('front.mystone.withdraws')}}' ,
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
