<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

<script>
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
                    url: "{{route('companies.projects.deleteProjectImages')}}",
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
  var input = document.querySelector("#kt_tagify_5");

        // Initialize Tagify script on the above inputs
        new Tagify(input, {
            whitelist:[
                "Software Engineering",
                "Web Development",
                "Front-End Development",
                "Back-End Development",
                "Full-Stack Development",
                "Mobile App Development",
                "Game Development",
                "Embedded Systems Programming",
                "Graphic Design",
                "UI/UX Design",
                "Interaction Design",
                "Product Design",
                "Motion Graphics",
                "Video Editing",
                "3D Animation",
                "2D Animation",
                "VFX (Visual Effects)",
                "Typography",
                "Branding",
                "Illustration",
                "Photography",
                "Print Design",
                "Ada",
                "Adenine",
                "Agda",
                "Agilent VEE",
                "Python",
                "JavaScript",
                "TypeScript",
                "C++",
                "C#",
                "Java",
                "Ruby",
                "PHP",
                "Swift",
                "Kotlin",
                "R",
                "MATLAB",
                "HTML",
                "CSS",
                "Sass",
                "Less",
                "React",
                "Angular",
                "Vue.js",
                "Ember.js",
                "Backbone.js",
                "jQuery",
                "Bootstrap",
                "Tailwind CSS",
                "Node.js",
                "Express.js",
                "Django",
                "Flask",
                "Spring",
                "ASP.NET",
                "Ruby on Rails",
                "Laravel",
                "Symfony",
                "Golang",
                "Rust",
                "Scala",
                "Perl",
                "Elixir",
                "GraphQL",
                "SQL",
                "NoSQL",
                "MongoDB",
                "Firebase",
                "PostgreSQL",
                "MySQL",
                "SQLite",
                "Oracle Database",
                "Redis",
                "Apache Kafka",
                "Docker",
                "Kubernetes",
                "Adobe Photoshop",
                "Adobe Illustrator",
                "Adobe After Effects",
                "Adobe Premiere Pro",
                "Final Cut Pro",
                "Blender",
                "Cinema 4D",
                "Figma",
                "Sketch",
                "InVision",
                "Adobe XD",
                "Microsoft Word",
                "Microsoft Excel",
                "Microsoft PowerPoint",
                "Google Docs",
                "Google Sheets",
                "Google Slides",
                "PDF Editing",
                "Document Management",
                "Office Administration",
                "Business Communication",
                "Project Management",
                "Agile Methodologies",
                "Scrum",
                "Kanban",
                "Software Testing",
                "Quality Assurance",
                "Systems Analysis",
                "Network Engineering",
                "Database Administration",
                "Artificial Intelligence",
                "Machine Learning",
                "Deep Learning",
                "Data Science",
                "Big Data",
                "Computer Vision",
                "Natural Language Processing",
                "Robotics",
                "Automation",
                "Technological Entrepreneurship",
                "Startup Development",
                "IT Management",
                "Cybersecurity",
                "Blockchain",
                "Cloud Computing",
                "Internet of Things (IoT)",
                "Augmented Reality (AR)",
                "Virtual Reality (VR)",
                "DevOps",
                "Digital Marketing",
                "E-commerce",
                "Product Management",
                "Business Intelligence",
                "js"
            ],

            maxTags: 100,
            dropdown: {
                maxItems: 24,           // <- mixumum allowed rendered suggestions
                classname: "tagify_inline_suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
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
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: "{{ route('companies.projects.saveProjectImages') }}", // Set the url
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
}, 'يجيب ان يكون حجم المرفق اقل من 0.5 ميجا بايت');
    $("form[name='my-form']").validate({
        rules: {

            title: {
                required: true
            },


            description: {
                required: true
            },



            specialization_id:{
                required:true,
            },

            expected_budget:{
                required:true,

            },
            skills:{
                required:true,

            },




        },
        messages: {
            title: {
                required: "العنوان مطلوب"
            },

            description: {
                required: "الوصف مطلوب"
            },


            specialization_id:{
                required: "نوع التخصص مطلوب"
            },
            expected_budget:{
            required:"السعر المتوقع مطلوب",
            },
            skills:{
                required:"قائمة المهارات مطلوبة",

            },


        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');


            var data = new FormData(document.getElementById("my-form"));

            $('.ckeditor').each(function() {
                var editorId = $(this).attr('id');
                var editorName = $(this).attr('name');
                if (CKEDITOR.instances[editorId]) {
                    data.append(editorName, CKEDITOR.instances[editorId].getData());
                }
            });


            $.ajax({
                url: '{{ route('companies.projects.store') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout(function() {
                                window.location.replace(
                                    '{{ route('companies.projects.index') }}')
                            },
                            2000);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);

                        });
                    }
                }
            });


        }

    });





</script>
