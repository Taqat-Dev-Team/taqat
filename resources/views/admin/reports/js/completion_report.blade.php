
{{--<script>--}}




<script>
    $(document).ready(function() {
        // Initialize DataTable
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('admin.reports.getCompletionReport') }}",
                type: 'get',
                data: function(d) {
                    d.user_id = $('#user_id').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.branch_id = $('#branch_id').val();
                },
            },
            columns: [
                {
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true, // Allow sorting on name column
                },
                {
                    data: 'total_hours',
                    name: 'total_hours',
                    searchable: true,
                    orderable: true, // Allow sorting on total_hours
                },
                {
                    data: 'total_contracts',
                    name: 'total_contracts',
                    searchable: true,
                    orderable: true, // Allow sorting on total_contracts
                },
                {
                    data: 'total_movements',
                    name: 'total_movements',
                    searchable: true,
                    orderable: true, // Allow sorting on total_movements
                },
                {
                    data: 'movements_count',
                    name: 'movements_count',
                    searchable: true,
                    orderable: true, // Allow sorting on movements_count
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });

        // Reload the DataTable on search button click
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
                url: '{{ route('admin.reports.getCompletionData') }}',
                method: 'POST',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    branch_id: branch_id,
                    user_id: user_id,
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
            $('#user_count').text("(" + data.user_count + ")");
            $('#total_employment_contracts').text("(" + data.total_employment_contracts + ")");
            $('#total_financial_transactions').text("(" + data.total_financial_transactions + ")");
            $('#hours_count').text("(" + data.hours_count + ")");
        }

        // Initial update data call on document ready

        // Handle Excel export
        $(document).on('click', '.export_excel', function(e) {
            e.preventDefault();

            // Get the values from the search form
            var user_id = $('#user_id').val();

            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var branch_id = $('#branch_id').val();

            // Construct the URL with query parameters for the export request
            var exportUrl = "{{ route('admin.reports.getCompletionReport') }}" +
                "?export=excel" +
                "&user_id=" + (user_id ? user_id : '') +
                "&start_date=" + (start_date ? start_date : '') +
                "&end_date=" + (end_date ? end_date : '') +
                "&branch_id=" + (branch_id ? branch_id : '');

            // Redirect to the URL to download the Excel file
            window.location.href = exportUrl;
        });

        updateData();

    });
</script>








{{--function updateData() {--}}
{{--    const start_date = $('#start_date').val();--}}
{{--    const end_date = $('#end_date').val();--}}
{{--    const user_id=$('#user_id').val();--}}

{{--    const branch_id=$('#branch_id').val();--}}
{{--    $.ajax({--}}
{{--        url: '{{ route('admin.reports.getCompletionData') }}',--}}
{{--        method: 'POST',--}}
{{--        data: {--}}
{{--            start_date: start_date,--}}
{{--            end_date: end_date,--}}
{{--            branch_id: branch_id,--}}
{{--            user_id: user_id,--}}

{{--            _token: '{{ csrf_token() }}'--}}
{{--        },--}}
{{--        success: function(response) {--}}
{{--            updateCounters(response.data);--}}
{{--        },--}}
{{--        error: function(response) {--}}
{{--            console.error(response);--}}
{{--        }--}}
{{--    });--}}
{{--}--}}

{{--function updateCounters(data) {--}}
{{--    $('#user_count').text("(" + data.user_count + ")");--}}
{{--    $('#total_employment_contracts').text("(" + data.total_employment_contracts + ")");--}}
{{--    $('#total_financial_transactions').text("(" + data.total_financial_transactions + ")");--}}
{{--    $('#hours_count').text("(" + data.hours_count + ")");--}}
{{--}--}}

{{--$( document ).ready(function() {--}}
{{--    updateData();--}}
{{--});--}}

{{--$(document).on('click', '.export_excel', function (e) {--}}
{{--    e.preventDefault();--}}

{{--    // Get the values of the search form (assuming you have input fields with these names)--}}
{{--    var user_id = $('input[name="user_id"]').val();--}}
{{--    var company_id = $('input[name="company_id"]').val();--}}
{{--    var start_date = $('input[name="start_date"]').val();--}}
{{--    var end_date = $('input[name="end_date"]').val();--}}
{{--    var branch_id = $('select[name="branch_id"]').val();--}}

{{--    // Construct the URL with query parameters for the export request--}}
{{--    var exportUrl = "{{ route('admin.reports.getCompletionReport') }}" +--}}
{{--        "?export=excel" +--}}
{{--        "&user_id=" + (user_id ? user_id : '') +--}}
{{--        "&company_id=" + (company_id ? company_id : '') +--}}
{{--        "&start_date=" + (start_date ? start_date : '') +--}}
{{--        "&end_date=" + (end_date ? end_date : '') +--}}
{{--        "&branch_id=" + (branch_id ? branch_id : '');--}}

{{--    // Redirect to the URL to download the Excel file--}}
{{--    window.location.href = exportUrl;--}}
{{--});--}}

{{--</script>--}}
