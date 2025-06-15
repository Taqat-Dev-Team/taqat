<script>
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{route('front.users.getAttendance')}}",
            type: 'get',
            "data":function(d){
                d.user_id="{{auth()->id()}}";
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

    </script>
