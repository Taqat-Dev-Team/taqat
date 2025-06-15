<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script>
$(document).ready(function () {
    // Initialize datepicker


    $('.datepicker').datepicker();

    // Zoom interview click event
    $('.zoom_interview').click(function () {

        alert('assa');
        const userId = $(this).data('user_id');
        const projectId = $(this).data('project_id');
        $('#interview_project_id').val(projectId);
        $('#interview_user_id').val(userId);
    });

    // Form validation and submission
    $('#mystone-form').validate({
        rules: {
            title: { required: true },
            date: { required: true },
            amount: { required: true }
        },
        messages: {
            title: { required: "{{ __('validation.title_required') }}" },
            date: { required: "{{ __('validation.date_required') }}" },
            amount: { required: "{{ __('validation.amount_required') }}" }
        },
        submitHandler: function (form) {
            $.ajax({
                url: '{{ route('companies.mystone.store') }}',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                },
                success: function (response) {
                    $('#mystone-form')[0].reset();
                    Swal.fire({ position: 'center', icon: 'success', title: response.message, showConfirmButton: false, timer: 1000 });
                    $('#mystoneModal').modal('hide');

                    const newRow = `<tr>
                        <td>${response.data['title']}</td>
                        <td>${response.data['amount']}</td>
                        <td>${response.data['date']}</td>
                        <td><span class="badge badge-danger">Pending</span></td>
                        <td><a class="btn btn-primary" target="_blank" href="${'{{ route('companies.mystone.paymentMystone', ['my_stone_id' => ':id']) }}'.replace(':id', response.data['id'])}">
                            {{ __('label.payment_now') }}
                        </a></td>
                    </tr>`;
                    $('#kt_advance_table_widget_1 tbody').append(newRow);
                },
                error: function (response) {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: response.responseJSON.message || 'An error occurred' });
                }
            });
        }
    });

    // Handle form submission button click
    $('#save-button').click(function () {
        $('#mystone-form').submit();
    });

    // Delete button click event
    $('.delete').click(function (e) {
        e.preventDefault();
        const projectId = $(this).data('delete_id');

        Swal.fire({
            title: '{{ __('label.are') }}',
            text: "{{ __('label.are_you_sure_delete') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __('label.yes') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('companies.projects.delete') }}",
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', id: projectId },
                    success: function () {
                        Swal.fire('Deleted!', 'تم الحذف بنجاح.', 'success').then(() => {
                            window.location.href = '{{ route('companies.projects.index') }}';
                        });
                    },
                    error: function () {
                        Swal.fire('Error!', 'There was an error deleting the item.', 'error');
                    }
                });
            }
        });
    });

    // Star rating interaction
    $('.stars').on('mouseover', '.star', function () {
        const ratingValue = $(this).data('value');
        $(this).siblings().addBack().each(function () {
            $(this).toggleClass('filled', $(this).data('value') <= ratingValue);
        });
    }).on('mouseleave', function () {
        const currentRating = $('#' + $(this).data('rating-type')).val();
        $(this).find('.star').each(function () {
            $(this).toggleClass('filled', $(this).data('value') <= currentRating);
        });
    }).on('click', '.star', function () {
        const ratingValue = $(this).data('value');
        $('#' + $(this).closest('.stars').data('rating-type')).val(ratingValue);
    });

    // Rating form submission
    $('#rating-form').click(function (e) {
        e.preventDefault();
        const data = {
            professional_dealing: $('#professional_dealing').val(),
            communication_assistance: $('#communication_assistance').val(),
            experience_in_project_field: $('#experience_in_project_field').val(),
            quality_delivered_work: $('#quality_delivered_work').val(),
            delivery_on_time: $('#delivery_on_time').val(),
            project_id: $('#project_id').val(),
            deal_with_again: $('#deal_with_again').val(),
            message: $('#message').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '{{ route('companies.projects.submitRating') }}',
            type: 'POST',
            data: data,
            success: function (response) {
                Swal.fire({ position: 'center', icon: 'success', title: response.message, showConfirmButton: false, timer: 1000 });
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                let errorText = '';
                if (errors) {
                    $.each(errors, function (key, value) {
                        errorText += value + "\n";
                    });
                }
                Swal.fire({ position: 'center', icon: 'error', title: errorText, showConfirmButton: false, timer: 1000 });
            }
        });
    });

    // Accept offer
    let offerId;
    $('.accept_offer').click(function () {
        offerId = $(this).data('offer_id');
        $('#confirmModal').modal('show');
    });

    $('#confirmButton').click(function () {
        $.ajax({
            url: "{{ route('companies.projects.accepOffers') }}",
            type: 'POST',
            data: { id: offerId, _token: '{{ csrf_token() }}' },
            success: function (response) {
                Swal.fire({ position: 'center', icon: 'success', title: response.message, showConfirmButton: false, timer: 1000 });
                setTimeout(() => location.reload(), 2000);
            }
        });
        $('#confirmModal').modal('hide');
    });

    // Chat room interaction
    $('.chat_room').click(function () {
        const userId = $(this).data('user_id');
        const projectId = $(this).data('project_id');
        $('#chat_project_id').val(projectId);
        $('#chat_user_id').val(userId);
    });

    // Chat submission
    $('.submit_chat').click(function () {
        const data = {
            user_id: $('#chat_user_id').val(),
            project_id: $('#chat_project_id').val(),
            _token: "{{ csrf_token() }}"
        };

        $.ajax({
            url: '{{ route('companies.chats.store') }}',
            type: 'POST',
            data: data,
            success: function (response) {
                $('#messageModal').hide();
                window.location.replace(response.data);
            }
        });
    });

    // Zoom form validation
    $("form[name='form-zoom']").validate({
        rules: {
            date: { required: true },
            time: { required: true }
        },
        messages: {
            date: { required: "{{ __('validation.date_required') }}" },
            time: { required: "{{ __('validation.time_required') }}" }
        },
        submitHandler: function (form) {
            const data = new FormData(form);
            $('#spinner').show();
            $('#hidden_class').hide();
            $('.btn-primary').attr('disabled', true);

            $.ajax({
                url: '{{ route('companies.projects.interview') }}',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#spinner').hide();
                    $('#hidden_class').show();
                    $('.btn-primary').attr('disabled', false);

                    if (response.status) {
                        Swal.fire({ position: 'center', icon: 'success', title: response.message, showConfirmButton: false, timer: 1000 });
                        setTimeout(() => window.location.reload(), 2000);
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: response.message });
                    }
                },
                error: function (response) {
                    $('#spinner').hide();
                    $('#hidden_class').show();
                    $('.btn-primary').attr('disabled', false);
                    const errors = response.responseJSON.errors;
                    if (errors) {
                        let errorText = '';
                        $.each(errors, function (key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });
                        Swal.fire({ icon: 'error', title: errorText });
                    }
                }
            });
        }
    });
});
</script>
