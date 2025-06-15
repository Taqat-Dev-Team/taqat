<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Page with empty content" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @if (app()->getlocale() == 'ar')
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        html,
        body {
            direction: rtl;
        }
        #kt_advance_table_widget_1_filter{
            text-align: left;
        }
    </style>
    @else
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    @endif



    <style>
        html,body {
            font-family: 'Cairo', sans-serif;
        }

        label.error {
            color: red;
        }



        .dir-ltr {
            direction: ltr;
        }

        .order-status a {
            margin-right: 10px;
        }

        .span-slash {
            margin-left: 6px;
            margin-right: 6px;
        }

        .order-status-active {
            color: black;
            font-weight: 600;
        }

        .error {
            color: red !important;
        }

        .error {

            color: red;
        }
    </style>


    @yield('styles')


    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/icon.png') }}" />

</head>
