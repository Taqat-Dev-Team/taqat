



    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"><head>
    <head>
        <base href="../../../">
        <title> {{trans('label.register')}}</title>
        <meta charset="utf-8"/>
        <meta name="description" content="طاقات تجيل حساب جديد للشركات "/>
        <meta name="keywords" content="طاقات تسجيل الدخول"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="مرحبا بك في طاقات غزة"/>
        <meta property="og:url" content="{{url('/')}}"/>
        <meta property="og:site_name" content="مرحبا بك في طاقات غزة"/>
        <link rel="canonical" href="{{url('')}}"/>
        <link rel="shortcut icon" href="https://taqat-gaza.com/public//uploads/images/settings//ikPru4BghxIGp9I5.png"/>
        <!--begin::Fonts-->
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <script src="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMUJw5p7CkT+bvYFQuSILyXKkdx5DibkSzVxbr/" crossorigin="anonymous">






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
        </style>
        @if(App::getLocale() == 'ar')
            <link href="https://taqat-gaza.com/dashboard/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
            <style>
                * {
                    direction: rtl;
                    font-family: "Tajawal", sans-serif;
                }
            </style>
        @else
            <link href="https://taqat-gaza.com/dashboard/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        @endif
    </head>

<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="#" class="mb-12">
                <img alt="Logo" src="https://taqat-gaza.com/uploads/images/settings//I99I9XyqKRi8w5sW.png" class="h-80px"/>
            </a>


            <a class="mb-5" style="font-size: 30px" href="#" id="language-toggle">

                <img src="{{asset('assets/language.png')}}">
            </a>


            <!--begin::Alert-->
            <!--begin::Alert-->
            <!--begin::Alert-->
            <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <!--end::Close-->

                <!--begin::Content-->
                <div id="error-messages"></div>
                <!--end::Content-->
            </div>
            <!--end::Alert-->
            <!--end::Alert-->
            <!--end::Alert-->

            <!--end::Alert-->


            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">


                <div id="register-form" class="form-container active">
                    <form id="register-form-ajax" method="post" enctype="multipart/form-data" class="form w-100" novalidate="novalidate">
                        @csrf
                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">{{trans('label.Create_an_Account')}}</h1>
                            <div class="text-gray-400 fw-bold fs-4">
                                {{trans('label.already_have_an_account')}}

                                <a href="{{route('companies.login')}}"  class="link-primary fw-bolder">{{trans('label.login')}}</a>
                            </div>

                        </div>


                        <div class="row fv-row mb-7">
                            <div class="col-6">

                                <label class="form-label fw-bolder text-dark fs-6">{{trans('label.name')}}</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" id="name"
                                       name="name" autocomplete="off"/>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bolder text-dark fs-6">{{trans('label.user_name')}}</label>
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                       name="user_name" autocomplete="off"/>
                            </div>


                        </div>

                        <div class="row mb-7">

                            <div class="col-6">

                                <label class="form-label fw-bolder text-dark fs-6">{{trans('label.mobile')}}</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" name="mobile"
                                       autocomplete="off"/>
                            </div>
                            <div class="col-6">

                                <label class="form-label fw-bolder text-dark fs-6">{{trans('label.email')}}</label>
                                <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                       autocomplete="off"/>
                            </div>


                        </div>





                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label
                                    class="form-label fw-bolder text-dark fs-6">{{trans('label.password')}}</label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                           name="password" autocomplete="off"/>
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-5">
                            <label
                                class="form-label fw-bolder text-dark fs-6">{{trans('label.confirm_password')}}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                   name="password_confirmation" autocomplete="off"/>
                        </div>


                        <div class="row mb-7" >
                            <div class="col-12 text-center">

                                <div class="mb-10">
                                    <label for="exampleFormControlInput1"
                                           class="required form-label">
                                        {{trans('label.photo')}}
                                    </label>

                                </div>

                                <span class="error-msg" id="photo-error"></span>


                                <!--begin::Image input-->
                                <div class="image-input image-input-empty w-125px h-125px"
                                     data-kt-image-input="true"
                                     style="background-image: url('https://hwchamber.co.uk/wp-content/uploads/2022/04/avatar-placeholder.gif')">
                                    <!--begin::Image preview wrapper-->
                                    <div class="img-fluid image-input-wrapper w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title=" {{trans('label.change')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                        </svg>                                        <!--begin::Inputs-->
                                        <input type="file" name="photo" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="avatar_remove"/>
                                        <!--end::Inputs-->


                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title=" {{trans('label.cancel')}}">

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
</svg>                                             </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title=" {{trans('label.delete')}}">
                                                 <i class="bi bi-x fs-2"></i>
                                             </span>
                                    <!--end::Remove button-->
                                </div>


                                <!--end::Image input-->


                            </div>
                            </div>



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
<script>var hostUrl = "assets/";</script>
<script src="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://taqat-gaza.com/dashboard/assets/js/scripts.bundle.js"></script>


<script>
    document.getElementById('language-toggle').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default action

        // Get the current locale from the document's HTML tag or any other source
        var currentLocale = document.documentElement.lang; // Assuming <html lang="en"> or <html lang="ar">

        // Toggle locale
        var newLocale = currentLocale === 'en' ? 'ar' : 'en';

        // Update the language setting
        // Assuming you have a route or URL pattern to handle locale changes
        var newUrl = window.location.href.replace(currentLocale, newLocale);

        // Redirect to the new URL
        window.location.href = newUrl;
    });
</script>


@if(App::getLocale() == 'ar')
    <script>
        @if(Session::has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
        @endif
    </script>
@else
    <script>
        @if(Session::has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
        @endif
    </script>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        $('#register-form-ajax').submit(function(e) {
            e.preventDefault();
            $('#error-alert').hide();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('companies.register.post') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response
                        toastr.success('{{trans('label.Registration_successful')}} !');

                        window.location.href = "{{route('companies.index')}}";


                    },

                error: function(xhr) {

                    toastr.error('{{trans('label.Registration_failed')}}!');
                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = '';

                    $.each(errors, function(key, value) {
                        errorMessages += '<li>' + value[0] + '</li>';
                    });

                    // Insert errors into the alert and show it
                    $('#error-messages').html('<ul>' + errorMessages + '</ul>');
                    $('#error-alert').show();
                }
            });
        });

    });
</script>
</body>
</html>

