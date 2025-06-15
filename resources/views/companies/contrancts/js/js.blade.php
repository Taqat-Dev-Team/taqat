<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script>
       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('companies.contrancts.getIndex') }}",
            type: 'get',



        },

        columns: [

            {
                data: 'attachment',
                name: 'attachment',
            },
            {
                data: 'user_name',
                name: 'user_name',
                searchable: true
            },
            {
                data: 'specializations',
                name: 'specializations',
                searchable: true
            },
            {
                data: 'start_date',
                name: 'start_date',
                searchable: true
            },
            {
                data: 'end_date',
                name: 'end_date',
                searchable: true
            },


        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


</script>
