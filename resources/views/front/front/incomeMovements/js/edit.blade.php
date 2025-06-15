<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, ' يجب ان يكون حجم الملف اقل من  {0} bytes');

        $("form[name='my-form']").validate({
            rules: {

                source: {
                    required: true
                },
                amount: {
                    required: true
                },
                date: {
                    required: true
                },

                photo: {
                    // required: true,
                    filesize: 1048576 // 0.5 MB in bytes

                },






            },
            messages: {
                source:{
                    required: "جهه التحويل مطلوبة"
                },

                amount: {
                    required: "الراتب مطلوب"
                },
                date: {
                    required: "التاريخ مطلوب"
                },

                photo: {
                    required: "الصورة مطلوبة",
                    filesize:"يجب ان يكون اقل من 1ميجا"
                },


            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data= new FormData(document.getElementById("my-form"));

                data.append('note', CKEDITOR.instances['description'].getData());

                $.ajax({
                    url: '{{route("front.incomeMovements.update")}}' ,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function( response ) {


                        if (response.status){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout( function(){
                                    window.location.replace('{{route("front.incomeMovements.index")}}')
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
