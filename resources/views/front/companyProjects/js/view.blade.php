<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script>
    // Reusable function to handle Ajax requests
    function handleAjaxFormSubmission(form, url, successCallback) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = new FormData(form);

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: successCallback,
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.responseJSON.message || 'An error occurred',
                });
            }
        });
    }

    // Form validation and submission for 'mystone-form'
    $('#mystone-form').validate({
        rules: {
            title: {
                required: true
            },
            date: {
                required: true
            },
            amount: {
                required: true
            }
        },
        messages: {
            title: "العنوان مطلوب",
            date: {
                required: "اليوم المطلوب"
            },
            amount: {
                required: "المبلغ مطلوب"
            }
        },
        submitHandler: function(form) {
            handleAjaxFormSubmission(form, '{{ route('front.mystone.store') }}', function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000
                });

                $('#mystone-form').trigger('reset');
                $('#mystoneModal').modal('hide');
                var rowId = response.data['id'];
                var newRow = '<tr id="row-' + rowId + '">' +
                    '<td>' + response.data['title'] + '</td>' +
                    '<td>' + response.data['amount'] + '</td>' +
                    '<td>' + response.data['date'] + '</td>' +
                    '<td><span class="badge badge-danger">Pending</span></td>' +
                    '</tr>';

                // Check if the row with the given ID already exists
                if ($('#row-' + rowId).length === 0) {
                    $('.kt_advance_table_widget_1 tbody').append(newRow);
                }
            });
        }
    });

    $('#mystoneModal').modal('hide');

    // Star rating logic
    $('#star-rating .star').on('click', function() {
        var value = $(this).data('value');
        $('#rating').val(value);

        $('#star-rating .star').each(function(index) {
            $(this).toggleClass('filled', index < value);
        });
    });

    // Reusable function for form validation and submission
    function setupFormValidation(formName, url, messages) {
        $("form[name='" + formName + "']").validate({
            rules: {
                rating: {
                    required: true
                },
                duration: {
                    required: true
                },
                cost: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: messages,
            submitHandler: function(form) {
                handleAjaxFormSubmission(form, url, function(response) {
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
    }

    // Setting up form validation and submission for 'review-form' and 'my-form'
    setupFormValidation('review-form', '{{ route('front.companyProjects.addReviews') }}', {
        rating: {
            required: "التقيم مطلوب"
        }
    });

    setupFormValidation('my-form', '{{ route('front.offers.store') }}', {
        description: {
            required: "العرض مطلوب"
        },
        cost: {
            required: "تكلفة مطلوبة"
        },
        duration: {
            required: "المدة الزمنية مطلوبة"
        }
    });

    // Handle button click event to trigger form submission
    $('#save-button').click(function() {
        $('#mystone-form').submit();
    });
</script>
