<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $("form[name='my-form']").validate({
        rules: {

              name: {
                required: true
            },
            mobile: {
                required: true
            },
            whatsapp: {
                required: true
            },
            marital_status: {
                required: true
            },
            // photo: {
            //     required: true
            // },
            job: {
                required: true
            },
            sallary: {
                required: true
            },
            company_id: {
                required: true
            },
            displacement_place:{
                required: true
            },
            original_place:{
                required: true
            },





        },
        messages: {
            name: {
                "required" :"اسم مطلوب",
            },

            email:{
                "required" :"الايميل مطلوب",
                "email":"ادخل الايميل بشكل صحيح"
            },
            coumpny_id:{
                "required" :" الشركة مطلوبة",

            },
            mobile:"رقم الجوال مطلوب"
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data= new FormData(document.getElementById("my-form"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{route('admin.users.store')}}' ,
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function( response ) {


                    if (response.status==201){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout( function(){
                                window.location.replace('{{route("admin.users.index")}}')
                            }
                            ,
                            2000 );

                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;
          if(errors){
          var errorText = "";
          $.each(errors, function (key, value) {
              errorText += value + "\n";
              $('.'+key).text(value);

          });
        }
                }
            });


        }

    });





</script>
