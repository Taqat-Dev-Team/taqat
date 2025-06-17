<!DOCTYPE html>

<html lang="en" direction="rtl" style="direction: rtl;">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Page with empty content" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @yield('styles')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        label.error {
            color: red;
        }

        #kt_advance_table_widget_1_filter {
            margin-right: 60%;
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

        .spinner-border {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0, 0, 0, .1);
            border-left-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-spinner {
            position: relative;
            padding-right: 40px;
            /* Adjust based on spinner size */
        }

        .btn-spinner:disabled {
            cursor: not-allowed;
        }
    </style>

    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/icon.png') }}" />

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->


    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <a href="{{ route('front.index') }}">


            <img alt="Logo" src="{{ url('assets/logo.png') }}" width="90%" style="width: 150px" />
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->
            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                        version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <a href="{{ route('front.index') }}" class="brand-logo">

                        <img alt="Logo" src="{{ url('assets/logo.png') }}" width="90%" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside Menu-->
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <!--begin::Menu Container-->
                    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                        data-menu-dropdown-timeout="500">
                        <!--begin::Menu Nav-->
                        @include('layouts.includes.front_meun')
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                </div>

                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu"
                                class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                        <!--begin::Topbar-->
                        <div class="topbar" style="align-items:center">


                            <div>

                                <a href="{{ route('front.chats.view') }}">
                                    <span
                                        class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z"
                                                    fill="#000000" />
                                            </g>
                                            <span class="badge badge-success chat_count"
                                                style="font-size: 41%">{{ \App\Models\Chat::query()->where('user_id', auth()->id())->whereNull('user_read')->count() }}</span>
                                        </svg>
                                        <!--end::Svg Icon--></span>
                                </a>
                            </div>
                            {{-- @if (!auth()->user()->last_attendance_date == Carbon\Carbon::now()->format('Y-m-d'))

                            <div class="topbar-item clock-in">
                                <a title="تسجيل حضور">

                                <span class="svg-icon svg-icon-xl svg-icon-primary">
                                    <!--begin::Svg Icon | clock-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 Z M12,20 C7.59,20 4,16.41 4,12 C4,7.59 7.59,4 12,4 C16.41,4 20,7.59 20,12 C20,16.41 16.41,20 12,20 Z"
                                                fill="#000000" />
                                            <path
                                                d="M13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 L11,12 C11,12.5522847 11.4477153,13 12,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L13,11 L13,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="pulse-ring"></span>
                                </a>
                            </div>

                            @else
                                <div style="margin-top:5%;">

                                <a class="topbar-item clock-out " title="مغادرة" ata-offset="10px,0px">


                                <span class="svg-icon svg-icon-xl svg-icon-primary">
                                    <!--begin::Svg Icon | clock out-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 Z M12,20 C7.59,20 4,16.41 4,12 C4,7.59 7.59,4 12,4 C16.41,4 20,7.59 20,12 C20,16.41 16.41,20 12,20 Z"
                                                fill="#000000" />
                                            <path
                                                d="M11,16 C10.4477153,16 10,15.5522847 10,15 L10,8 C10,7.44771525 10.4477153,7 11,7 C11.5522847,7 12,7.44771525 12,8 L12,14.5857864 L15.2928932,11.2928932 C15.6834175,10.9023689 16.3165825,10.9023689 16.7071068,11.2928932 C17.0976311,11.6834175 17.0976311,12.3165825 16.7071068,12.7071068 L12.7071068,16.7071068 C12.3165825,17.0976311 11.6834175,17.0976311 11.2928932,16.7071068 L11,16 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="pulse-ring"></span>
                                </a>
                                </div>
                            @endif --}}

                            <div class="dropdown">


                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">

                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                        fill="#000000" opacity="0.3" />
                                                    <path
                                                        d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="pulse-ring"></span>
                                    </div>
                                </div>
                                <!--end::Toggle-->
                                <!--begin::Dropdown-->
                                <?php

                                $jobs = \App\Models\Notification::orderby('created_at', 'desc')
                                    ->whereNotNull('job_id')
                                    ->where('notifiable_id', auth()->id())
                                    ->paginate(8);
                                $projects = \App\Models\Notification::orderby('created_at', 'desc')
                                    ->whereNotNull('project_id')
                                    ->where('notifiable_id', auth()->id())
                                    ->paginate(8);
                                $chats = \App\Models\Notification::orderby('created_at', 'desc')->where('type', 'chats')->paginate(8);
                                ?>
                                <div
                                    class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                                    <form>
                                        <!--begin::Header-->
                                        <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                            style="background-image: url({{ url('assets/media/misc/bg-1.jpg') }})">

                                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                                role="tablist">

                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#topbar_projects_notifications">المشاريع</a>
                                                </li>


                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#topbar_jobs_notifications">الوظائف</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#topbar_chat_notifications">الدردشات</a>
                                                </li>

                                            </ul>
                                            <!--end::Tabs-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Content-->
                                        <div class="tab-content">
                                            <div class="tab-pane active show p-8" id="topbar_projects_notifications"
                                                role="tabpanel">

                                                {{--                                        <div class="tab-pane" id="" role="tabpanel"> --}}
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    @if (isset($projects) && count($projects) > 0)
                                                        @foreach ($projects as $value)
                                                            <a href="{{ route('front.companyProjects.views', $value->projects ? $value->projects->title : '-') }}"
                                                                class="navi-item">
                                                                <div class="navi-link">
                                                                    <div class="navi-icon mr-2">
                                                                        <i
                                                                            class="flaticon-safe-shield-protection text-primary"></i>
                                                                    </div>
                                                                    <div class="navi-text">
                                                                        <div class="font-weight-bold">
                                                                            <label>{{ $value->projects ? $value->projects->title : '-' }}</label>
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            {{ $value->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <div
                                                            class="d-flex flex-center text-center text-muted min-h-200px">
                                                            لايوجد اشعارات جديدة
                                                            <br />
                                                        </div>

                                                    @endif
                                                    <!--end::Nav-->
                                                </div>

                                                <!--end::Nav-->
                                            </div>


                                            <div class="tab-pane" id="topbar_jobs_notifications" role="tabpanel">
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    @if (isset($jobs) && count($jobs) > 0)
                                                        @foreach ($jobs as $value)
                                                            <a href="" class="navi-item">
                                                                <div class="navi-link">
                                                                    <div class="navi-icon mr-2">
                                                                        <i
                                                                            class="flaticon-safe-shield-protection text-primary"></i>
                                                                    </div>
                                                                    <div class="navi-text">
                                                                        <div class="font-weight-bold">
                                                                            <label>{{ $value->jobs ? $value->jobs->title : '-' }}</label>
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            {{ $value->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <div
                                                            class="d-flex flex-center text-center text-muted min-h-200px">
                                                            لايوجد اشعارات جديدة
                                                            <br />
                                                        </div>

                                                    @endif
                                                    <!--end::Nav-->
                                                </div>
                                            </div>


                                            <div class="tab-pane" id="topbar_chat_notifications" role="tabpanel">
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    @if (isset($chats) && count($chats) > 0)
                                                        @foreach ($chats as $value)
                                                            <a href="" class="navi-item">
                                                                <div class="navi-link">
                                                                    <div class="navi-icon mr-2">
                                                                        <i
                                                                            class="flaticon-safe-shield-protection text-primary"></i>
                                                                    </div>
                                                                    <div class="navi-text">
                                                                        <div class="font-weight-bold">
                                                                            تبليغ جديد
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            {{ $value->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <div
                                                            class="d-flex flex-center text-center text-muted min-h-200px">
                                                            لايوجد اشعارات جديدة
                                                            <br />
                                                        </div>
                                                    @endif
                                                    <!--end::Nav-->
                                                </div>
                                            </div>

                                            <!--end::Tabpane-->
                                            <!--begin::Tabpane-->
                                            {{--                                        <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel"> --}}
                                            {{--                                            <!--begin::Nav--> --}}
                                            {{--                                            <div class="d-flex flex-center text-center text-muted min-h-200px">All --}}
                                            {{--                                                caught up! --}}
                                            {{--                                                <br/>No new notifications. --}}
                                            {{--                                            </div> --}}
                                            {{--                                            <!--end::Nav--> --}}
                                            {{--                                        </div> --}}
                                            <!--end::Tabpane-->
                                        </div>
                                        <!--end::Content-->
                                    </form>
                                </div>
                                <!--end::Dropdown-->
                            </div>


                            <!--end::Notifications-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span
                                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">مرحبا</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth()->user()->name }}</span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <!--begin::Page Heading-->
                                <div class="d-flex align-items-baseline flex-wrap mr-5">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold my-1 mr-5">
                                        اهلا بك {{ auth()->user()->name }}
                                        @if (auth()->user()->branch)
                                            انت الان مسجل في {{ auth()->user()->branch->name }}
                                        @endif
                                    </h5>
                                    <!--end::Page Title-->

                                    @yield('content-main')


                                </div>

                                <!-- Modal -->


                                {{-- <script>
                                    document.getElementById('saveBranch').addEventListener('click', function() {
                                        var form = document.getElementById('branchForm');
                                        var formData = new FormData(form);
                                        fetch('', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: formData
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                location.reload();
                                            } else {
                                                alert('حدث خطأ، يرجى المحاولة مرة أخرى.');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    });
                                </script> --}}
                                <!--end::Page Heading-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center">
                                <!--begin::Actions-->
                                <!--end::Actions-->
                                <!--begin::Dropdown-->
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->

                        <div class="container">

                            @yield('content')

                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                {{--            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer"> --}}
                {{--                <!--begin::Container--> --}}
                {{--                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between"> --}}
                {{--                    <!--begin::Copyright--> --}}
                {{--                    <div class="text-dark order-2 order-md-1"> --}}
                {{--                        <span class="text-muted font-weight-bold mr-2">2021©</span> --}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" --}}
                {{--                           class="text-dark-75 text-hover-primary">Keenthemes</a> --}}
                {{--                    </div> --}}
                {{--                    <!--end::Copyright--> --}}
                {{--                    <!--begin::Nav--> --}}
                {{--                    <div class="nav nav-dark"> --}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">About</a> --}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">Team</a> --}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-0">Contact</a> --}}
                {{--                    </div> --}}
                {{--                    <!--end::Nav--> --}}
                {{--                </div> --}}
                {{--                <!--end::Container--> --}}
                {{--            </div> --}}
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">




                {{-- {{?'موظف شركة':'فريلانسر'}} --}}
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <div class="symbol-label" style="background-image:url('{{ auth()->user()->getPhoto() }}')">

                    </div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <a href="#"
                        class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ auth()->user()->name }}</a>
                    <div class="text-muted mt-1">
                        @if (auth()->user())

                            @if (auth()->user()->company_id)
                                موظف شركة
                            @else
                                فريلانسر
                            @endif
                        @endif


                    </div>
                    <div class="navi mt-2">
                        <a href="#" class="navi-item">
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5"
                                                    r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span
                                    class="navi-text text-muted text-hover-primary">{{ auth()->user()->email }}</span>
                            </span>
                        </a>
                        <a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                            href="{{ route('front.logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                            تسجيل خروج
                        </a>

                        <form id="logout-form" action="{{ route('front.logout') }}" method="get" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->
            <!--begin::Nav-->
            <div class="navi navi-spacer-x-0 p-0">
                <!--begin::Item-->

                <a href="{{ route('front.profile.index') }}" class="navi-item">
                    {{--                <a href="" class="navi-item"> --}}

                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5"
                                                r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">الملف الشخصي</div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('front.profile.changePassword') }}" class="navi-item">

                    <div class="navi-link">
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5"
                                                r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">تغير كلمة المرور</div>
                        </div>
                    </div>
                </a>

            </div>
            <!--end::Content-->
        </div>

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                    version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10"
                            rx="1" />
                        <path
                            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                            fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>


        <!--end::Scrolltop-->
    </div>
    <div class="modal fade" id="noSurveyModal" tabindex="-1" role="dialog" aria-labelledby="noSurveyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noSurveyModalLabel">حصر بيانات مشتركين طاقات</h5>
                </div>
                <form name="survey-form" id="survey-form" method="POST" action="">


                    @csrf
                    <div class="modal-body">

                        <p>
                    طاقات وفّرت لي بيئة عمل مريحة ومثالية، تناسب طموحات وتخصصات العمل الحر، وتدعمنا لنبدع ونتميّز بثقة.


                        </p>

                        @foreach (App\Models\Survey::query()->whereNull('parent_id')->get() as $key => $value)
                            <div class="mb-4">
                                <h6 class="mb-2"> {{ $key + 1 }}-{{ $value->title }}</h6>
                                @foreach ($value->children as $val)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="survey[{{ $value->id }}]" id="survey{{ $val->id }}"
                                            value="{{ $val->id }}">
                                        <label class="form-check-label" for="survey{{ $val->id }}">
                                            {{ $val->title }}
                                        </label>
                                    </div>
                                @endforeach
                                <hr>
                        @endforeach
                        <div class="mb-4">
                            <h6 class="mb-2">السيرة الذاتية</h6>

                            <input class="form-control" type="file" name="cv_file" id="cv_name">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    @if ($showSurveyModal)
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                $('#noSurveyModal').modal('show');
            });
        </script>
    @endif
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/widgets.js') }}"></script>

    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script src="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/column-rendering.js') }}"></script>

    <!--end::Page Scripts-->
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}"></script>


    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>

    <script src="{{ asset('assets/admin/js/pages/crud/forms/editors/tinymce.js') }}"></script>

    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/features/calendar/background-events.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>



    <script>
        $('#description').each(function() {

            CKEDITOR.replace(this, {

                extraPlugins: 'colorbutton',


            });
        });
        $('.select2').select2({
            'dir': 'rtl'
        });

        $('.kt_select2_1').select2({
            width: '100%',
            dir: "rtl",

        });
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            gotoCurrent: true,
            orientation: "bottom"
        });





        $("form[name='survey-form']").validate({
            rules: {


                @foreach (App\Models\Survey::query()->whereNull('parent_id')->get() as $value)
                    "survey[{{ $value->id }}]": {
                        required: true
                    },
                @endforeach







            },
            messages: {


            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data = new FormData(document.getElementById("survey-form"));

                // data.append('note', CKEDITOR.instances['description'].getData());

                //     var $button = $(form).find('button[type="submit"]');
                // var $spinner = $button.find('.spinner-border');

                $.ajax({
                    url: '{{ route('front.survey') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {
                        // $spinner.hide();


                        if (response.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                            $('#noSurveyModal').modal('hide');


                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
                        }
                    },
                    error: function(response) {
                        // $spinner.hide();

                        var errors = response.responseJSON.errors;
                        if (errors) {
                            var errorText = "";
                            $.each(errors, function(key, value) {
                                errorText += value + "\n";
                                $('.' + key).text(value);

                            });
                        }
                    }
                });


            }

        });
    </script>




    @yield('scripts')
</body>
<!--end::Body-->

</html>
