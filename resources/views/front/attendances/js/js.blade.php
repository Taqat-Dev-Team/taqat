<script>
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{route('front.attendances.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.user_id="{{auth()->id()}}";
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();

            },

        },

        columns: [
            {data: 'date', name: 'date'},
            {data: 'login_time', name: 'login_time'},
            {data: 'logout_time', name: 'logout_time'},
            {data: 'hours', name: 'hours'},
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    $('#searchTable').on('click', function() {
        table.ajax.reload(); // Reload the DataTable with new data
        updateData();

    });

    // Function to update data
    // $('#searchTable').on('click', function(e) {
    //     e.preventDefault();
    // });

    // Function to get and update counters
    function updateData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const user_id = $('#user_id').val();
        const branch_id = $('#branch_id').val();

        $.ajax({
            url: '{{ route('front.attendances.getData') }}',
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

    // Update counters display
    function updateCounters(data) {
        $('#presence_count').text("(" + data.presence_count + ")");
        $('#hours_count').text("(" + data.hours_count + ")");
    }

</script>
