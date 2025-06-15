<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {



        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true, // Improves speed by deferring the rendering of rows
            ajax: {
                url: "{{ route('admin.accounts.transactions.getIndex') }}",

                cache: true, // Avoid unnecessary repeated requests
            },
            columns: [{
                    data: 'date',
                    name: 'date',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'form_account',
                    name: 'form_account',
                    orderable: false,

                },

                {
                    data: 'to_account',
                    name: 'to_account',
                    orderable: false,

                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: false,

                },

                {
                    data: 'balance_type',
                    name: 'balance_type',
                    orderable: false,

                },

            ],
            order: [
                [1, 'asc']
            ], // Ensure proper default ordering
            language: {
                loadingRecords: "Please wait - loading...",
            },
            lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
        });
        // Search filter
        $('[data-kt-drivers-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });


    });















</script>
