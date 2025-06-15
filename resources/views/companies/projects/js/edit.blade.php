<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

<script>
        $(document).ready(function () {
            $('.star').on('mouseover', function () {
                var value = $(this).data('value');
                highlightStars(value);
            });

            $('.star').on('mouseout', function () {
                unhighlightStars();
            });

            $('.star').on('click', function () {
                var value = $(this).data('value');
                $('#rating-value').val(value);
                setSelectedStars(value);
            });

            function highlightStars(value) {
                $('.star').each(function () {
                    if ($(this).data('value') <= value) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });
            }

            function unhighlightStars() {
                $('.star').removeClass('hover');
            }

            function setSelectedStars(value) {
                $('.star').each(function () {
                    if ($(this).data('value') <= value) {
                        $(this).addClass('selected');
                    } else {
                        $(this).removeClass('selected');
                    }
                });
            }

            $('.status').on('change', function () {
                var value = $(this).val();

                if(value==3){

                    $('.ratting_block').show();
                    $('.reason_block').hide();
                }
                else if(value==4){

                    $('.ratting_block').hide();
                    $('.reason_block').show();

                }else{

                    $('.ratting_block').hide();
                    $('.reason_block').hide();

                }
            });
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
var uploadedDocumentMap = {}
        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            // maxFilesize: 5, // MB
            maxFilesize: 2, // MB (0.5 MB)

            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{ route('companies.projects.saveProjectImages') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            }
            ,
            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {
                @if(isset($event) && $event->document)
                var files =
                    {!! json_encode($event->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
        $.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, 'يجيب ان يكون حجم المرفق اقل من 0.5 ميجا بايت');
    $("form[name='my-form']").validate({
        rules: {

              title: {
                required: true
            },


            description: {
                required: true
            },

            photo:{
                filesize: 524288 // 0.5 MB in bytes

            }
            ,project_type_id:{
                required:true,
            },
            reason:{
                required:function(){


                   return $('#status').val()==4;
                },
            }







        },
        messages: {
            title: {
                required: "العنوان مطلوب"
            },
            url: {
                required: "الرابط مطلوب"
            },
        description: {
                required: "الوصف مطلوب"
            },
            project_type_id:{
                required:"نوع المشروع مطلوب"
            },
            reason:{
                required:"سبب الغاء المشروع مطلوب"
            }


        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data= new FormData(document.getElementById("my-form"));

            data.append('description', CKEDITOR.instances['description'].getData());

            $.ajax({
                url: '{{route("companies.projects.update")}}' ,
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
                                window.location.replace('{{route("companies.projects.index")}}')
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

                    // var errors = response.responseJSON.errors;

                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        })
                }
            });


        }

    });





    const el=$(".remove-image")
        el.click(function() {
            var element = $(this);
            var parent_div = $(this).closest(".screen_image_attachment");
            var parent_img = $(this).attr('url');
            var image_id = $(this).attr('id');
            var token = '{{csrf_token()}}';
            var result = confirm("هل تريد حذف الصورة؟");
            if (result) {
                //Logic to delete the item
                $.ajax({
                    url: "{{route('front.projects.deleteProjectImages')}}",
                    type: 'post',
                    data: {
                        "id": image_id,
                        "_token": token,
                    },
                    success: function () {
                        parent_div.hide('slow');
                        console.log("it Works");
                    }
                });
            }
        });


</script>
