<!-- External Scripts -->
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {






        // AJAX Request for Data Update
        $('.submit').on('click', function(e) {
            e.preventDefault();
            updateData();
        });








    function updateData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();

        $.ajax({
            url: '{{ route('admin.reports.getData') }}',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
            },
            error: function(response) {
                console.error(response);
            }
        });
    }

    function updateCounters(data) {
        $('#user_count').text("(" + data.user_count + ")");
        $('#absence_count').text("(" + data.absence_count + ")");
        $('#presence_count').text("(" + data.presence_count + ")");
        $('#hours_count').text("(" + data.hours_count + ")");
    }


        const end_date = $('#end_date').val();
        const start_date = $('#start_date').val();
        $.ajax({
            url: '{{ route('admin.reports.getData') }}',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date:end_date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
            },
            error: function(response) {
                console.error(response);
            }
        });
    });
</script>
