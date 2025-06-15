<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title> تسجيل حساب جديد </title>
    <meta name="description" content="Login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/admin/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/icon.png') }}" />

    <style>
        .button-container {
            text-align: center;
            margin-top: 50px;
        }

        .btn {
            background-color: #f0f0f0;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn.active {
            border-color: #187dba;
            background-color: #fdc14a;
            color: white;
        }

        .btn:hover {
            background-color: #ddd;
            color: black;
        }
        .error{
            color:red !important;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{asset('assets/admin/media/bg/bg-3.jpg')}}');">
                <div class="login-form  p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15" style="">
                        <a href="#">
                            <img src="{{asset('assets/logo.png')}}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">



                    @csrf

                    <form class="needs-validation " id="form" name="form" method="POST"
                        enctype="multipart/form-data" style="margin:auto">

                        @csrf

                        <div class="row">
                            <div class="col-lg-12  col-sm-12">
                                <div class="form-group">
                                    <label for="name">الاسم
                                        <span style="color: red">*</span>

                                    </label>
                                    <input type="text" class="form-control" id="name" value=""
                                        name="name">
                                    <div class="error name"></div>

                                </div>
                            </div>
                            <div class="col-lg-12  col-sm-12">
                                <div class="form-group">
                                    <label for="email">
                                        الايميل
                                        <span style="color: red">*</span>

                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value=""required>
                                </div>
                                <div class="error email"></div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">

                                        رقم الجوال
                                        <span style="color: red">*</span>

                                    </label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"value="">
                                    <div class="error mobile"></div>

                                </div>
                            </div>
                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="whatsapp">الواتساب
                                        <span style="color: red">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                        value="">
                                    <div class="error whatsapp"></div>

                                </div>
                            </div>


                        </div>



                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="job">المسمى الوظيفي
                                        <span style="color: red">*</span>

                                    </label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">اختر</option>
                                        @foreach ($specializations as $value )
                                        <option value="{{$value->title}}">{{$value->title}}</option>
                                        @endforeach


                                    </select>

                                    <div class="error job"></div>

                                </div>
                            </div>
                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">

                                    <label for="gender">نوع الجنس
                                        <span style="color: red">*</span>
                                    </label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">اختر</option>
                                        <option value="ذكر">ذكر
                                        </option>
                                        <option value="انتى">انتى
                                        </option>

                                    </select>


                                </div>

                                <div class="error gender"></div>

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
                                        <option value="شمال غزة">شمال غزة
                                        </option>
                                        <option value="مدينة غزة">مدينة غزة
                                        </option>
                                        <option value="الوسطى">الوسطى</option>
                                        <option value="خانيونس">خانيونس
                                        </option>
                                        <option value="رفح"></option>
                                    </select>

                                    <div class="error original_place"></div>

                                </div>
                            </div>


                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">

                                    <label for="displacement_place">مكان الحالي
                                        <span style="color: red">*</span>
                                    </label>
                                    <select class="form-control" id="displacement_place" name="displacement_place">
                                        <option value="">اختر</option>
                                        <option value="خانيونس">خانيونس
                                        </option>
                                        <option value="دير البلح">دير البلح
                                        </option>
                                        <option value="الزوايدة">الزوايدة
                                        </option>
                                        <option value="النصيرات">النصيرات
                                        </option>
                                        <option value="اخرى">اخرى
                                        </option>
                                    </select>


                                </div>

                                <div class="error original_place"></div>

                            </div>

                        </div>




                        <div class="row">

                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="password">كلمة المرور
                                        <span style="color: red">*</span>
                                    </label>

                                    <input class="form-control" type="password" name="password" id="password">
                                    <div class="error password"></div>

                                </div>

                            </div>
                            <div class="col-lg-6  col-sm-12">

                            <div class="form-group">
                                <label for="password">تاكيد كلمة المرور
                                    <span style="color: red">*</span>
                                </label>

                                <input class="form-control" type="password" name="confirm_password">
                                <div class="error confirm_password"></div>

                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="photo">
                                   الصورة الشخصية
                                   <span style="color: red">*</span>

                                </label>
                                <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                                <div class="" style="color:gray">يجيب ان يكون الصور اقل من 0.5ميجا </div>

                                <div class="error photo">

                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12">


                                <img src="{{asset('assets/default.png')}}" style="width: 100px"
                                     class="img-thumbnail img-preview"  id="imagePreview" alt="">

                            </div>

                        </div>






                        <div class="flex-center">
                        <button id="kt_login_signin_submit"
                            class="btn active">تسجيل </button>
                        </div>
                    </form>



                </div>




            </div>
        </div>

        </div>

<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<script src="{{asset('assets/admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/pages/custom/login/login-general.js')}}"></script>

<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script>
    $.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param);
}, 'يجيب ان يكون حجم المرفق اقل من 0.5 ميجا بايت');


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
    $('#form').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        // initialize the plugin
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true,
            },
            "mobile": {
                required: true,

            },

            "whatsapp": {
                required: true,

            },
            'gender': {
                required: true,

            },


            'job': {
                required: true,

            },

            'displacement_place': {
                required: true,

            },

            'original_place': {
                required: true,

            },
            'password': {
            required: true,
        },
        'confirm_password': {
            required:true,
            equalTo: "#password" // corrected to equalTo and added id selector
        },
        photo:{
            required:true,
            filesize: 524288 // 0.5 MB in bytes
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

            'confirm_password':{
                required:"تاكيد كلمة المرور مطلوبة",
                equalTo:"كلمة المرور غير متطابقة"
            },

            'job': {
                required: "الرجاء ادخال المسمى الوظيفي",

            },
            'gender':{
required:"نوع الجنس مطلوب",
            },


            'password':{
                required: "كلمة المرور مطلوبة",

            },

            'original_place': {
                required: "الرجاء ادخال مكان الاصلي",

            },
            'photo':{
                required:"الصورة مطلوبة",

            },

            displacement_place:{
                required: "الرجاء ادخال مكان الحالي",

            }


        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data = new FormData(document.getElementById("form"));

            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('front.register.post') }}',
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
                                    '{{ route('front.index') }}')
                            },
                            2000);
                    }else{
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


</body>
</html>
