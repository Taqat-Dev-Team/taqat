
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>



    $("#my-form").validate({
        rules: {
            type: {
                required: true
            },
            message: {
                required: true
            },
            "branch_id[]": {
                required: function() {
                    return $('#add_edit_type').val() == 2;
                }
            },
        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('.error').hide(); // Hide previous error messages
            $('#submit-button').prop('disabled',
            true); // Disable submit button to prevent multiple submissions
            // Use FormData to collect form data
            var formData = new FormData(form);

            $.ajax({
                url: '{{ route('admin.notifications.store') }}',
                type: "POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false); // Re-enable submit button

                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });

                        $('#my-form')[0].reset();
                        $('#add_edit_branch_id').val(null).trigger('change');
                        $('#add_edit_user_id').val(null).trigger('change');

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                error: function(response) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false); // Re-enable submit button
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(
                            value); // Display validation error next to the input
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorText,
                        });
                    }
                }
            });
        }
    });

    $(document).ready(function() {

        $('#add_edit_user_id').select2({
            placeholder: "اختر", // Placeholder text
            allowClear: true, // Allows clearing the selection
            ajax: {
                url: "{{ route('admin.notifications.getUsers') }}", // Laravel route for fetching users
                dataType: 'json',
                delay: 250, // Debounce for search requests
                data: function(params) {
                    return {
                        search: params.term // Search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(user => ({
                            id: user.id,
                            text: user.name
                        }))
                    };
                },
                cache: true
            }
        });


$('#add_edit_type').on('change', function() {

    var value = $(this).val();
    if (value == 3) {
        $('.branch_block').hide();
        $('.user_block').show();

    } else if (value == 2) {
        $('.branch_block').show();
        $('.user_block').hide();

    } else {
        $('.user_block').hide();
        $('.branch_block').hide();

    }
});









});
</script>
