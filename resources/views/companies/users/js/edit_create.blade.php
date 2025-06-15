<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
// alert('asas');

$(document).ready(function() {
    $("form[name='my-form']").validate({
        // Specify validation rules
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
            specialization_id: {
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
                required: "اسم مطلوب"
            },
            marital_status: {
                required: "الحالة الاجتماعية مطلوبة"
            },
            mobile: {
                required: "رقم الجوال مطلوب"
            },
            whatsapp: {
                required: "رقم الواتس اب مطلوب"
            },
            email: {
                email: "ادخل الايميل بشكل صحيح",
                required: "الايميل مطلوب"
            },
            company_id: {
                required: "اسم الشركة مطلوب"
            },
            specialization_id: {
                required: "المسمى الوظيفي مطلوب"
            },
            sallary: {
                required: "الراتب الشهري مطلوب"
            },
            displacement_place:{
                required:"مكان النزوح مطلوب"
            },
            original_place:{
                required:"مكان النزوح مطلوب"
            },

        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-form"));

            $('#spinner').show();
            $.ajax({
                url: '{{route("companies.users.update")}}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#spinner').hide();

                    if (response.status) {
                        Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                        setTimeout(() => {
                            window.location.href="{{route('companies.users.index')}}"

                        }, 3000);
                        // win
                        // $("#my-form")[0].reset();
                    } else {
                        Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                    }
                },
                error: function(xhr) {
                    $('#spinner').hide();

                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
                }
            });
        }
    });

    // Custom method to validate file size
    $.validator.addMethod('filesize', function(value, element, param) {
        var files = element.files;
        if (files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                if (files[i].size > param) {
                    return false;
                }
            }
        }
        return true;
    }, 'حجم الملف لا يجب أن يتجاوز {0}');
});




</script>
