<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script>
       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('companies.mystone.getIndex') }}",
            type: 'get',



        },

        columns: [

            {
                data: 'title',
                name: 'title',
                searchable: true

            },
            {
                data: 'project_title',
                name: 'project_title',
            },
            {
                data: 'amount',
                name: 'amount',
            },


            {
                data: 'date',
                name: 'date',
            },
            {
                data: 'status',
                name: 'status',
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                searchable: true
            },


        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


</script>
