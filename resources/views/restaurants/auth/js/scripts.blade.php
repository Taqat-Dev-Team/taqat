<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('assets/admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts.bundle.js')}}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
{{-- <script src="{{asset('assets/admin/js/pages/custom/login/login-general.js')}}"></script>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<!--end::Page Scripts-->
<script>




    $("#form").validate({

rules: {
    email: {
        required: true,
        email: true
    },
    password: {
        required: true,
    },
},
messages: {

    email: {
        "required": "الايميل مطلوب",
        "email": "الايميل غير صحيح",

    },

    password: {
        "required": "كلمة المرور مطلوبة",

    },
},
submitHandler: function(form) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data = new FormData(document.getElementById("form"));
    var _url = $('#form').attr('action');
    $.ajax({
        url: _url,
        type: "POST",
        data: data,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            alert('assasa')

            if (response.status) {

                $('.error').text('');
                toastr.success('تم تنفيد العملية بنجاح',
                    "نجاح العملية");

                setTimeout(() => {
                    window.location.href = "{{ route('restaurants.index') }}"

                }, 2000);
            } else {
                toastr.error(response.message,"فشل التسجيل");

            }
        },
        error: function(response) {
            // console.log(response.responseJSON.message);
            $('.error').text('');

            var errors = response.responseJSON.errors;
            if (errors) {
                var errorText = "";
                $.each(errors, function(key, value) {
                    errorText += value + "\n";
                    $('.' + key).text(value);
                });

            } else {

                toastr.error(response.responseJSON.message,
                    "فشل العملية");

            }

        }

    });


}

});

</script>
