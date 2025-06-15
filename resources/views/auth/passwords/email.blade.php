<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <title>نسيت كلمة المرور</title>
    <meta name="description" content="Login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{asset('assets/admin/css/pages/login/classic/login-4.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('assets/admin/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('assets/admin/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/icon.png') }}" />

    <style>
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
        .spinner-border {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0, 0, 0, .1);
            border-left-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-spinner {
            position: relative;
            padding-right: 40px; /* Adjust based on spinner size */
        }

        .btn-spinner:disabled {
            cursor: not-allowed;
        }
    </style>
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{asset('assets/admin/media/bg/bg-3.jpg')}}');">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{asset('assets/logo.png')}}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">



                        <form class="form" action="{{route('password.email')}}" id="forget_password">
                            @csrf

                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="الايميل" name="email" autocomplete="off" />
                                <span class="text-danger error-text email_error" style="color: red"></span>
                                <span class="text-danger error" style="color: red"></span>
                            </div>

                            <button  id="kt_forget_password_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4 btn-spinner">
                                تاكيد
                                <div class="spinner-border"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/admin/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/admin/js/pages/custom/login/login-general.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        $(document).ready(function() {
            $("#forget_password").submit(function(e) {
                e.preventDefault();

                var all = $(this).serialize();
                var $submitButton = $('#kt_forget_password_submit');
                var $spinner = $submitButton.find('.spinner-border');
                $spinner.show();
                $submitButton.prop('disabled', true);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: all,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        $spinner.hide();
                        $submitButton.prop('disabled', false);


                        if (data.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'تم تنفيد العملية بنحاخ',
                                showConfirmButton: false,
                                timer: 3000
                            });



                        }
                    },
                    error: function(data) {
                        $spinner.hide();
                        $submitButton.prop('disabled', false);
                        var errors = data.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                $('.' + key).text(value);
                            });
                        } else {
                            $('.error').text('');
                            $('.error').text(data.responseJSON.message);
                        }
                    }
                });
            });


            // $('#kt_forget_password_submit').prop('disabled', false);
        });
    </script>
</body>
</html>
