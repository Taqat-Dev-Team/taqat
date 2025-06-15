<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script>


    $(document).ready(function () {

        $("form[name='form']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name: {
                    required: true,

                },
                permissions:{
                    array:true,
                    required:true,
                }

            },
            messages: {
                name: {
                    "required" :"اسم مطلوب",
                },

            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#spinner").show();

                var data= new FormData(document.getElementById("form"));
                $.ajax({
                    url: '{{route('admin.roles.store')}}' ,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function( response ) {

                        $("#spinner").hide();

                        if (response.status==201){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout( function(){
                                    window.location.replace('{{route("admin.roles.index")}}')
                                }
                                ,
                                2000 );

                        }else {
                            Swal.fire({
                                icon: 'error',
                                title: 'رسالة خطا',
                                text: response.message,
                            })
                        }
                    },
                    error: function(response) {

                        $("#spinner").hide();

                        if (response.status==500){

                            Swal.fire({
                                icon: 'error',
                                title: 'رسالة خطا',
                                text: response.message,

                            });
                        }else{

                            var errors = response.responseJSON.errors;


                            var errorText = "";
                            $.each(errors, function (key, value) {
                                errorText += value + "\n";
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Failed',
                                text: errorText
                            });
                        }


                    }
                });


            }

        });



        $("form[name='edit_form']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name: {
                    required: true,

                },
                permissions:{
                    array:true,
                    required:true,
                }

            },
            messages: {
                name: {
                    "required" :"اسم مطلوب",
                },

            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data= new FormData(document.getElementById("edit_form"));
                $.ajax({
                    url: '{{route('admin.roles.update')}}' ,
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
                                    window.location.replace('{{route("admin.roles.index")}}')
                                }
                                ,
                                2000 );

                        }else {
                            Swal.fire({
                                icon: 'error',
                                title: 'رسالة خطا',
                                text: response.message,
                            })
                        }
                    },
                    error: function(response) {


                        if (response.status==500){

                            Swal.fire({
                                icon: 'error',
                                title: 'رسالة خطا',
                                text: response.message,

                            });
                        }else{

                            var errors = response.responseJSON.errors;


                            var errorText = "";
                            $.each(errors, function (key, value) {
                                errorText += value + "\n";
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Failed',
                                text: errorText
                            });
                        }


                    }
                });


            }

        });

    })



</script>
