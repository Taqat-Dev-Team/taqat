<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <title>  تسجيل الدخول </title>
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
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15" style="">
                    <a href="#">
                        <img src="{{asset('assets/logo.png')}}" class="max-h-75px" alt="" />
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>لوحة تسجيل الدخول </h3>
                    </div>

                    <div class="mb-20">

                    <div class="button-container">
                        <a  href="{{route('companies.login')}}" class="btn " id="page1-btn">شركات</a>
                        <a href="{{route('login')}}" class="btn active" id="page2-btn">فريلانسر</a>
                    </div>
                    </div>

                    <form class="form"  action="{{route('front.login.postlogin')}}" id="form_login">
                        @csrf

                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="الايميل" name="email" autocomplete="off" />
                            <span class="text-danger error-text email_error" style="color: red"></span>
                            <span class="text-danger error" style="color: red"></span>


                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="كلمة المرور" name="password" />
                            <span class="text-danger error-text password_error"  style="color: red"></span>
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-muted">
                                    <input type="checkbox" name="remember" />
                                    <span></span>تذكرني</label>
                            </div>
                            <a href="{{route('front.register.get')}}" class="text-muted text-hover-primary">تسجيل حساب جديد</a>
                        </div>
                        <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">تسجيل الدخول</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<script src="{{asset('assets/admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/pages/custom/login/login-general.js')}}"></script>
<script>
    $("#form_login").submit(function(e){

        e.preventDefault();

        var all = $(this).serialize();

        $.ajax({
            url:  $(this).attr('action'),
            type: "POST",
            data: all,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data){
                if (data.status==0) {
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }


                if(data.status){

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'تم التسجيل الدخول بنجاح',
                            showConfirmButton: false,
                            timer: 3000
                        });

                    setTimeout( function(){

                        window.location.replace('{{route("front.index")}}')
                    }
                    ,
                        3000 )
                }else if(data.status == 404) {
                    // Show the user authentication error if the

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'الرجاء ادخال البيانات بشكل صحيح',
                    })
                }


                else if(data.status == 422){
                        // Show the user authentication error if the

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'تم تعطيل حسابك راجع الادارة في اسرع وقت',
                        })
                    $("#show_error").hide().html("Invalid login details");
                }

            },


            error: function(data){
                    var errors = data.responseJSON.errors;
                    if(errors){
                    var errorText = "";
                    $.each(errors, function (key, value) {
                        errorText += value + "\n";
                        $('.'+key).text(value);
                    });

                }else{
                    $('.error').text('');
                    $('.error').text(data.responseJSON.message)
                }

                }
        })

    });



</script>
</body>
</html>
