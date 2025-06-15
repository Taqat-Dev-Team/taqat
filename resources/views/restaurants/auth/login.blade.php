<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <base href="../../../">
    <title>طاقات | تسجيل الدخول</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Setting not found"/>
    <meta name="keywords" content="طاقات تسجيل الدخول"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="نصنع الأمل"/>
    <meta property="og:url" content="https://taqat-gaza.com"/>
    <meta property="og:site_name" content="طاقات | نصنع الأمل"/>
    <link rel="canonical" href="https://taqat-gaza.com"/>
    <link rel="shortcut icon" href="https://taqat-gaza.com/public//uploads/images/settings//ikPru4BghxIGp9I5.png"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://taqat-gaza.com/dashboard/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <script src="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.js"></script>
    <style>
        h1, * {
            font-family: "Tajawal", sans-serif;
        }

        .error-msg, .error-update {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        * {
            direction: rtl;
            font-family: "Tajawal", sans-serif;
        }
    </style>
</head>
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{asset('assets/logo.svg')}}" class="h-80px"/>
            </a>

            <a class="mb-5" style="font-size: 30px" href="#" id="language-toggle">
                <img src="{{asset('assets/language.png')}}">
            </a>
            <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <!--end::Close-->

                <!--begin::Content-->
                <div id="error-messages"></div>
                <!--end::Content-->
            </div>
            <!--end::Logo-->

            <!--begin::Wrapper-->
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Forms-->
                <div  class="form-container active">
                    <form class="form w-100"  name="login-form" id="login-form" method="post" action="{{route('admin.login.post')}}">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">{{__('label.login')}}</h1>
                            <div class="text-gray-400 fw-bold fs-4">

                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{__('label.email')}}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" id="email" placeholder="{{__('label.email')}}" name="email" autocomplete="off"/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('label.password')}}</label>
                            <input placeholder="***********" class="form-control form-control-lg form-control-solid" id="password" type="password" name="password" autocomplete="off"/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">{{trans('label.register')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Forms-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->

<!--begin::Javascript-->
<script src="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://taqat-gaza.com/dashboard/assets/js/scripts.bundle.js"></script>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>

<script>
    document.getElementById('language-toggle').addEventListener('click', function (event) {
        event.preventDefault();

        var currentLocale = document.documentElement.lang;
        var newLocale = currentLocale === 'en' ? 'ar' : 'en';
        var newUrl = window.location.href.replace(currentLocale, newLocale);

        window.location.href = newUrl;
    });

    $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();
            $('#error-alert').hide();
            var formElement = this;  // 'this' refers to the form element
            var formData = new FormData(formElement);  // Pass the form element to FormData

            $.ajax({
                url: "{{ route('restaurants.login.post') }}", // Ensure this route is correct
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    // On success, redirect or show a success message
                    toastr.success('{{trans('label.Registration_successful')}}!');

                    window.location.href = "{{route('restaurants.index')}}"; // Adjust the redirection if needed
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message,
                    "{{trans('label.Registration_failed')}}!");
                    // Handle validation errors
                    var errors = xhr.responseJSON.errors || {};
                    var errorMessages = '';

                    $.each(errors, function(key, value) {
                        errorMessages += '<li>' + value[0] + '</li>';
                    });

                    // Display errors
                    $('#error-messages').html('<ul>' + errorMessages + '</ul>');
                    $('#error-alert').show();
                }
            });
        });
    });

</script>
</body>
</html>

