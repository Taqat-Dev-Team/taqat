<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>

<script>


       table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.activities.getIndex') }}",
            type: 'get',
        },

        columns: [


        { data: 'log_name', name: 'log_name' },
            { data: 'description', name: 'description' },
            { data: 'causer', name: 'causer' },
            { data: 'created_at', name: 'created_at' }




        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


 


</script>
