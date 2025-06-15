@extends('layouts.front')
@section('title', 'تغير المعلومات الشخصية')
@section('content')




    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل الملف الشخصي الخاص بك</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->
                <h6 class="card-label"></h6>


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">

            <div class="modal-body">
                @csrf

                <form class="needs-validation " id="form" name="form" method="POST" enctype="multipart/form-data"
                    style="margin:auto">
                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    @csrf

                    <div class="row">
                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">
                                <label for="name">الاسم
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}"
                                    name="name">
                                <div class="error name"></div>

                            </div>
                        </div>

                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">
                                <label for="mobile">

                                    رقم الجوال
                                    <span style="color: red">*</span>

                                </label>
                                <input type="tel" class="form-control" id="mobile"
                                    name="mobile"value="{{ auth()->user()->mobile }}">
                                <div class="error mobile"></div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="description">
                                الوصف
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="description" class="form-control description" name="note">{{ auth()->user()->bio }}</textarea>
                            <div class="error bio"></div>

                        </div>
                    </div>

                    <div class="row">


                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">
                                <label for="whatsapp">الواتساب
                                    <span style="color: red">*</span>
                                </label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                    value="{{ auth()->user()->whatsapp }}">
                                <div class="error whatsapp"></div>

                            </div>
                        </div>


                    </div>


                    <div class="row">

                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">
                                <label for="marital_status">الحالة الاجتماعية
                                    <span style="color: red">*</span>
                                </label>
                                <select class="form-control" id="marital_status" name="marital_status">
                                    <option value="">اختر</option>
                                    <option value="أعزب" @if (auth()->user()->marital_status == 'أعزب') selected @endif>أعزب</option>
                                    <option value="متزوج" @if (auth()->user()->marital_status == 'متزوج') selected @endif>متزوج</option>

                                </select>
                                <div class="error marital_status"></div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="workplace_attendance ">طبيعة الدوام

                                </label>
                                <select class="form-control" id="workplace_attendance" name="workplace_attendance">

                                    <option value="">{{ __('label.selected') }}</option>
                                    <option value="full_time" @if (auth()->user()->workplace_attendance == 'full_time') selected @endif>دوام كامل
                                    </option>
                                    <option value="part_time" @if (auth()->user()->workplace_attendance == 'part_time') selected @endif>جزئي
                                    </option>

                                </select>

                            </div>
                        </div>






                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="specialization_id">التخصص
                                    <span style="color: red">*</span>

                                </label>
                                <select class="form-control" name="specialization_id" id="specialization_id">
                                    <option value="">اختر</option>
                                    @foreach ($specializations as $value)
                                        <option value="{{ $value->id }}"
                                            @if (auth()->user()->specialization_id == $value->id) selected @endif>{{ $value->title }} </option>
                                    @endforeach

                                </select>
                                <div class="error specialization_id"></div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="sallary">الراتب اكبر من
                                    <span style="color: red">*</span>

                                </label>
                                <input type="text" class="form-control" id="sallary" name="sallary"
                                    value="{{ auth()->user()->sallary }}">

                                <div class="error sallay"></div>

                            </div>
                        </div>



                    </div>

                    <div class="row">

                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">

                                <label for="original_place">مكان السكن الاصلي
                                    <span style="color: red">*</span>
                                </label>
                                <select class="form-control" id="original_place" name="original_place">
                                    <option value="">اختر</option>
                                    <option value="شمال غزة" @if (auth()->user()->original_place == 'شمال غزة') selected @endif>شمال غزة
                                    </option>
                                    <option value="مدينة غزة" @if (auth()->user()->original_place == 'مدينة غزة') selected @endif>مدينة غزة
                                    </option>
                                    <option value="الوسطى" @if (auth()->user()->original_place == 'الوسطى') selected @endif>الوسطى
                                    </option>
                                    <option value="خانيونس" @if (auth()->user()->original_place == 'خانيونس') selected @endif>خانيونس
                                    </option>
                                    <option value="رفح" @if (auth()->user()->original_place == 'رفح') selected @endif></option>
                                </select>

                                <div class="error original_place"></div>

                            </div>
                        </div>


                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">

                                <label for="displacement_place">مكان النزوح
                                    <span style="color: red">*</span>
                                </label>
                                <select class="form-control" id="displacement_place" name="displacement_place">
                                    <option value="">اختر</option>
                                    <option value="خانيونس" @if (auth()->user()->displacement_place == 'خانيونس') selected @endif>خانيونس
                                    </option>
                                    <option value="دير البلح" @if (auth()->user()->displacement_place == 'دير البلح') selected @endif>دير البلح
                                    </option>
                                    <option value="الزوايدة" @if (auth()->user()->displacement_place == 'الزوايدة') selected @endif>الزوايدة
                                    </option>
                                    <option value="النصيرات" @if (auth()->user()->displacement_place == 'النصيرات') selected @endif>النصيرات
                                    </option>
                                    <option value="اخرى" @if (auth()->user()->displacement_place == 'اخرى') selected @endif>اخرى
                                    </option>
                                </select>


                            </div>

                            <div class="error original_place"></div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group">


                                <label class="required">المهارات</label>
                                <input placeholder="المهارات" class="form-control form-control-lg form-control-solid"
                                    name="skills" value="{{ auth()->user()->skills }}" id="kt_tagify_5" />



                                <span class="error-msg" id="skills-error"></span>



                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="photo">الصورة الشخصية
                                </label>
                                <input type="file" class="form-control" id="photo" name="photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">

                            <img src="{{ auth()->user()->getPhoto() }}" width="100px">
                        </div>


                    </div>






                    <hr>

                    <button disabled class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4 btn-spinner"
                        id="submit">
                        تاكيد
                        <div class="spinner-border"></div>
                    </button>
                </form>



            </div>



        </div>
        </form>

    </div>
    </div>

@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <script>
        // The DOM elements you wish to replace with Tagify
        var input = document.querySelector("#kt_tagify_5");

        // Initialize Tagify script on the above inputs
        new Tagify(input, {
            whitelist: [
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
                maxItems: 24, // <- mixumum allowed rendered suggestions
                classname: "tagify_inline_suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
    </script>
    <script>
        $('#submit').prop('disabled', false);
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'يجيب ان يكون حجم المرفق اقل من 0.5 ميجا بايت');
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'name': {
                    required: true
                },
                // 'email': {
                //     required: true,
                // },
                "mobile": {
                    required: true,

                },

                "whatsapp": {
                    required: true,

                },
                'marital_status': {
                    required: true,

                },
                'sallary': {
                    required: true,
                },

                'specialization_id': {
                    required: true,

                },
                'photo': {
                    filesize: 524288 // 0.5 MB in bytes
                },
                'displacement_place': {
                    required: true,

                },

                'original_place': {
                    required: true,

                },


                // errorClass: "error fail-alert",
                // validClass: "valid success-alert",
            },
            messages: {
                'name': {
                    required: "الرجاء ادخال الاسم"
                },
                'email': {
                    required: "الرجاء ادخال الايميل",
                },

                'mobile': {
                    required: "الرجاء ادخال الجوال",
                },
                'whatsapp': {
                    required: "الرجاء ادخال الواتس اب",
                },
                'marital_status': {
                    required: "الرجاء ادخال الحالة الاجتماعية",

                },
                'sallary': {
                    required: "الرجاء ادخال الراتب",

                },

                'specialization_id': {
                    required: "الرجاء ادخال التخصص",

                },

                'displacement_place': {
                    required: "الرجاء ادخال مكان النزوح",

                },

                'original_place': {
                    required: "الرجاء ادخال مكان الاصلي",

                },

            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data = new FormData(document.getElementById("form"));
                data.append('bio', CKEDITOR.instances['description'].getData());
                var $submitButton = $('#submit');
                var $spinner = $submitButton.find('.spinner-border');
                $submitButton.prop('disabled', true);

                $('#send_form').html('Sending..');
                $.ajax({
                    url: '{{ route('front.profile.update') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {
                        $spinner.hide();
                        $submitButton.prop('disabled', false);

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
                                        '{{ route('front.profile.index') }}')
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
                        $spinner.hide();
                        $submitButton.prop('disabled', false);

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

@endsection
