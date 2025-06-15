
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>


            $("form[name='my-form']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name: {
                        required: true,

                    },
                    email: {
                        required: true,
                        email: true,

                    },

                    mobile: {
                        required: true,

                    },
                    password: {
                        required: true,
                        // min:6,
                    },
                    role_id: {
                        required: true,

                    },
                    image:{
                        required: true,

                    },
                    // branch_id:{
                    //     required: true,

                    // }

                },
                messages: {
                    name: {
                        "required" :"اسم مطلوب",
                    },

                    email:{
                        "required" :"الايميل مطلوب",
                        "email":"ادخل الايميل بشكل صحيح"
                    },
                    image: "الصورة مطلوب",
                    role_id:"الصلاحية مطلوبة",
                    password:"كلمة المرور مطلوبة",
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
                        url: '{{route('admin.admins.store')}}' ,
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
                                        window.location.replace('{{route("admin.admins.index")}}')
                                    }
                                    ,
                                    2000 );

                            }else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'error',
                                    text: response.message,
                                })
                            }
                        },
                        error: function(response) {


                            if (response.status==500){

                                Swal.fire({
                                    icon: 'error',
                                    title: 'error',
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

            $("form[name='edit_admin']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name: {
                        required: true,

                    },
                    email: {
                        required: true,
                        email: true,

                    },

                    mobile: {
                        required: true,

                    },

                    role_id: {
                        required: true,

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
                    // image: "الصورة مطلوب",
                    role_id:"الصلاحية مطلوبة",
                    // password:"كلمة المرور مطلوبة",
                    phone:"رقم الجوال مطلوب"
                },

                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // var my_form=$('#my-form');
                    var data= new FormData(document.getElementById("edit_admin"));

                    $('#send_form').html('Sending..');
                    $.ajax({
                        url: '{{route('admin.admins.update')}}' ,
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
                                        window.location.replace('{{route("admin.admins.index")}}')
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
</script>
