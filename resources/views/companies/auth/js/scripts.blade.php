

<script src="https://taqat-gaza.com/dashboard/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://taqat-gaza.com/dashboard/assets/js/scripts.bundle.js"></script>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

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

    $("#login-form").validate({

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
            var _url = $('#login-form').attr('action');
            $.ajax({
                url: _url,
                type: "POST",

                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    if (response.status) {

                        toastr.success('تم تنفيد العملية بنجاح',
                            "نجاح العملية");

                        setTimeout(() => {
                            window.location.href = "{{ route('companies.index') }}"

                        }, 2000);
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


