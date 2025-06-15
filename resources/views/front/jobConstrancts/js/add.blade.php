<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    // alert('asas');
    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, 'File size must be less than {0} bytes');

$.validator.addMethod('mimetype', function (value, element, param) {
    var allowedMimeTypes = param.split(',');
    if (element.files && element.files[0]) {
        var mimeType = element.files[0].type;
        return allowedMimeTypes.includes(mimeType);
    }
    return true;
}, 'Please enter a value with a valid mimetypes');

    $("form[name='my-form']").validate({
        rules: {

              company_name: {
                required: true
            },
            sallary: {
                required: true
            },
            date: {
                required: true
            },
            job_type:{
                required: true
            },
            duration: {
                required: true
            },
            photo: {
            //  mimetype: "image/jpeg,image/png,application/pdf",
            filesize: 2097152 // 2 MB in bytes

            },






        },
        messages: {
            job_type:{
                required: "نوع العقد مطلوب"
            },
            company_name: {
                required: "اسم الشركة مطلوبة"
            },
            sallary: {
                required: "الراتب مطلوب"
            },
            date: {
                required: "التاريخ مطلوب"
            },
            duration: {
                required: "المدة مطلوبة"
            },
            photo: {
                required: "الصورة مطلوبة",
                filesize:"يجب ان يكون اقل من 2 ميجا"
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

            // data.append('note', CKEDITOR.instances['description'].getData());

        //     var $button = $(form).find('button[type="submit"]');
        // var $spinner = $button.find('.spinner-border');

            $.ajax({
                url: '{{route("front.jobConstrancts.store")}}' ,
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function( response ) {
                    // $spinner.hide();


                    if (response.status){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout( function(){
                                window.location.replace('{{route("front.jobConstrancts.index")}}')
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
                    // $spinner.hide();

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
