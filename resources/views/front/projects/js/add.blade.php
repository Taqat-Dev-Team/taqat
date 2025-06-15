<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

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
    var uploadedDocumentMap = {}
    Dropzone.options.dpzMultipleFiles = {
        paramName: "dzfile", // The name that will be used to transfer the file
        //autoProcessQueue: false,
        // maxFilesize: 5, // MB

        maxFilesize: 5, // MB (0.5 MB)
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
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: "{{ route('front.projects.images.store') }}", // Set the url
        success: function(file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
        init: function() {
            @if (isset($event) && $event->document)
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
}, 'يجيب ان يكون حجم المرفق اقل من 5 ميجا بايت');

$("form[name='my-form']").validate({
    rules: {
        title: { required: true },
        description: { required: true },
        photo: { filesize: 5 * 1024 * 1024  }, // 0.5 MB in bytes
        project_type_id: { required: true }
    },
    messages: {
        title: { required: "العنوان مطلوب" },
        description: { required: "الوصف مطلوب" },
        photo: { required: "الصورة مطلوبة" },
        project_type_id: { required: "نوع المشروع مطلوب" }
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = new FormData(document.getElementById("my-form"));
        data.append('description', CKEDITOR.instances['description'].getData());

        // Show the spinner
        $("#spinner").show();

        $.ajax({
            url: '{{ route('front.projects.store') }}',
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $("#spinner").hide();
                if (response.status) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        window.location.replace('{{ route('front.projects.index') }}');
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function(response) {
    // Hide the spinner
    $("#spinner").hide();

    var errors = response.responseJSON?.errors;
    if (errors) {
        var errorText = "";
        $.each(errors, function(key, value) {
            errorText += value + "\n";
            $('.' + key).text(value);
        });

        // Show the error message (you can use a modal, alert, or an error div)
        alert("Error:\n" + errorText); // Or use a modal for a better UI
    } else {
        // Handle case where there is no 'errors' field in the JSON response
        alert("An unexpected error occurred. Please try again.");
    }
}

        });
    }
});





</script>
