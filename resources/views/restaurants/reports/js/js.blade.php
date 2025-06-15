<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@if (app()->getLocale() === 'ar')
    <script src="{{ asset('assets/js/message_ar.js') }}"></script>
@endif
<script>
    $(document).ready(function() {




        // Initialize DataTable
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('restaurants.reports.getIndex') }}",
            data: function(q) {
                q.restaurant_id = "{{ auth('restaurant')->id() }}";
                q.start_date = $('#start_date').val();
                q.end_date = $('#end_date').val();
            },
            },
            columns: [
            { data: 'name', name: 'name' },
            { data: 'total_sold', name: 'total_sold' },
            { data: 'total_cost', name: 'total_cost' }
            ],
            order: [
            [0, 'desc']
            ]
        });

        // Search button click event
        $('#searchTable').on('click', function() {
            table.ajax.reload();
        });

        // Export to Excel button click event
        $('#exportExcel').on('click', function() {
            var params = $.param({
            restaurant_id: "{{ auth('restaurant')->id() }}",
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val()
            });
            window.location.href = "{{ route('restaurants.reports.exportExcel') }}?" + params;
        });

        // Optional: trigger search on datepicker change










    });
    // Reset form fields and preview images
</script>
