<!-- External Scripts -->
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.contrancts.getIndex') }}",
            type: 'get',


        },

        columns: [

        {
                data: 'attachment',
                name: 'attachment',
                searchable: true
            },

            {
                data: 'user_name',
                name: 'user_name',
                searchable: true
            },

            {
                data: 'company_name',
                name: 'company_name',
                searchable: true
            },
            {
                data: 'specializations',
                name: 'specializations',
                // searchable: true
            },
            {
                data: 'start_date',
                name: 'start_date',
                // searchable: true
            },
            {
                data: 'end_date',
                name: 'end_date',
                // searchable: true
            },
            {
                data: 'years',
                name: 'years',
                // searchable: true
            },
            // {
            //     data: 'action',
            //     name: 'action',
            //     searchable: true
            // },

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    });



</script>
