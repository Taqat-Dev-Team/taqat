<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script>
       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('companies.interveiws.getIndex') }}",
            type: 'get',



        },

        columns: [


        {
                data: 'user_name',
                name: 'user_name',
                searchable: true
            },
            {
                data: 'jobs',
                name: 'jobs',
                searchable: true
            },


            {
                data: 'date',
                name: 'date',
                searchable: true
            },
            {
                data: 'time',
                name: 'time',
                searchable: true
            },
            {
                data: 'zoom_url',
                name: 'zoom_url',
                searchable: true
            },


        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


</script>
