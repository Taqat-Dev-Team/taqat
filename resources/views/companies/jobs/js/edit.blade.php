<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

<script>
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


    $.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, "{{__('validation.the_attachment_size_must_be_less_than_5_MB')}}");
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


            skills:{
                required:true,

            },
            job_requirements:{
                required:true
            },
            duration:{
                required:true,

            },
            permanent_type:{
                required:true,
            },



        },
        messages: {
            title: {
                required: "{{__('vaildation.title_required')}}"
            },

            description: {
                required: "{{__('vaildation.description_required')}}"
            },
            duration:{
                required: "{{__('vaildation.duration_required')}}"

            },
            permanent_type:{
                required: "{{__('vaildation.permanent_type_required')}}"

            },


            specialization_id:{
                required: "{{__('vaildation.specialization_required')}}"
            },
            expected_budget:{
            required:"{{__('vaildation.expected_budget_required')}}",
            },
            skills:{
                required:"{{__('vaildation.skills_required')}}",

            },
            job_requirements:{
                required:"{{__('vaildation.job_requirements_required')}}",

            }

        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            var data = new FormData(document.getElementById("my-form"));

            $('.ckeditor').each(function() {
                var editorId = $(this).attr('id');
                var editorName = $(this).attr('name');
                if (CKEDITOR.instances[editorId]) {
                    data.append(editorName, CKEDITOR.instances[editorId].getData());
                }
            });


            $.ajax({
                url: '{{ route('admin.jobs.update') }}',
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
                                    '{{ route('companies.jobs.index') }}')
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
