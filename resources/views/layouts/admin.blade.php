<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

@include('layouts.includes.head')
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->


    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <!--begin::Logo-->
        <a href="{{ route('admin.users.index') }}">


            <img alt="Logo" src="{{ url('assets/logo.png') }}" width="30%" style="width: 150px" />
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
                    <a href="{{ route('admin.users.index') }}" class="brand-logo">

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
                        @include('layouts.includes.admin_menu')
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
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

                            </div>
                            <!--end::Header Menu-->
                        </div>

                        <div class="topbar">

                            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">

                                    <i
                                        class="flag-icon flag-icon-{{ LaravelLocalization::getCurrentLocale() === 'ar' ? 'sa' : 'us' }}"></i>
                                    <span
                                        class="selected-language">{{ LaravelLocalization::getCurrentLocaleName() }}</span>

                                    {{-- <img class="h-20px w-20px rounded-sm" src="assets/media/svg/flags/226-united-states.svg" alt="" /> --}}
                                </div>
                            </div>


                            <!--end::Toggle-->
                            <!--begin::Dropdown-->
                            <div
                                class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Nav-->
                                <ul class="navi navi-hover py-4">
                                    <!--begin::Item-->

                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li class="navi-item">

                                            <a class="dropdown-item"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <i
                                                    class="flag-icon flag-icon-{{ $localeCode === 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>

                                        {{-- <li class="navi-item">
                                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }" class="navi-link">
                                            <span class="symbol symbol-20 mr-3">
                                                <img src="assets/media/svg/flags/226-united-states.svg" alt="" />
                                            </span>
                                            <span class="navi-text">English</span>
                                        </a>
                                    </li> --}}
                                    @endforeach



                                </ul>
                                <!--end::Nav-->
                            </div>


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

                                //                            $notification_users=\App\Models\Notification::orderby('created_at','desc')->where('type','new_user')->paginate(14);
                                //                            $notification_new_order=\App\Models\Notification::orderby('created_at','desc')->where('type','new_order')->paginate(14);
                                //                            $notification_balance_withdrawal=\App\Models\Notification::orderby('created_at','desc')->where('type','balance_withdrawal')->paginate(14);
                                //                            $notification_objection=\App\Models\Notification::orderby('created_at','desc')->where('type','objection')->paginate(14);
                                //                            $notification_report=\App\Models\Notification::orderby('created_at','desc')->where('type','report')->paginate(14);
                                //                            $notification_contact_us=\App\Models\Notification::orderby('created_at','desc')->where('type','coutact_us')->paginate(14)
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
                                                        href="#topbar_orders_notifications">طلبات جديدة</a>
                                                </li>


                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#topbar_objection_notifications">اعتراضات</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                        href="#topbar_report_notifications">تبليغات</a>
                                                </li>

                                            </ul>
                                            <!--end::Tabs-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Content-->
                                        <div class="tab-content">
                                            <div class="tab-pane active show p-8" id="topbar_orders_notifications"
                                                role="tabpanel">

                                                {{--                                        <div class="tab-pane" id="" role="tabpanel"> --}}
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    <!--begin::Item-->
                                                    {{--                                                @if (isset($notification_new_order) && count($notification_new_order) > 0) --}}
                                                    {{--                                                    @foreach ($notification_new_order as $value) --}}
                                                    {{--                                                        <a href="{{route('admin.order.details',$value->type_id)}}" class="navi-item"> --}}
                                                    {{--                                                            <div class="navi-link"> --}}
                                                    {{--                                                                <div class="navi-icon mr-2"> --}}
                                                    {{--                                                                    <i class="flaticon-safe-shield-protection text-primary"></i> --}}
                                                    {{--                                                                </div> --}}
                                                    {{--                                                                <div class="navi-text"> --}}
                                                    {{--                                                                    <div class="font-weight-bold"> --}}
                                                    {{--                                                                        <label>طلب جديد</label> --}}
                                                    {{--                                                                    </div> --}}
                                                    {{--                                                                    <div class="text-muted">{{$value->created_at->diffForHumans()}}</div> --}}
                                                    {{--                                                                </div> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                        </a> --}}
                                                    {{--                                                    @endforeach --}}
                                                    {{--                                                @else --}}
                                                    <div class="d-flex flex-center text-center text-muted min-h-200px">
                                                        لايوجد اشعارات جديدة
                                                        <br />
                                                    </div>
                                                    {{--                                            @endif --}}


                                                    <!--end::Item-->
                                                </div>

                                                <!--end::Nav-->
                                            </div>


                                            <div class="tab-pane" id="topbar_objection_notifications"
                                                role="tabpanel">
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    {{--                                            @if (isset($notification_objection) && count($notification_objection) > 0) --}}
                                                    {{--                                                @foreach ($notification_objection as $value) --}}
                                                    {{--                                                    <a href="{{route('admin.objection.replay',$value->type_id)}}" class="navi-item"> --}}
                                                    {{--                                                        <div class="navi-link"> --}}
                                                    {{--                                                            <div class="navi-icon mr-2"> --}}
                                                    {{--                                                                <i class="flaticon-safe-shield-protection text-primary"></i> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                            <div class="navi-text"> --}}
                                                    {{--                                                                <div class="font-weight-bold"> --}}
                                                    {{--                                                                    <label>اعتراض جديد</label> --}}
                                                    {{--                                                                </div> --}}
                                                    {{--                                                                <div class="text-muted">{{$value->created_at->diffForHumans()}}</div> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                        </div> --}}
                                                    {{--                                                    </a> --}}
                                                    {{--                                                @endforeach --}}
                                                    {{--                                            @else --}}
                                                    <div class="d-flex flex-center text-center text-muted min-h-200px">
                                                        لايوجد اشعارات جديدة
                                                        <br />
                                                    </div>
                                                    {{--                                        @endif --}}
                                                    <!--end::Nav-->
                                                </div>
                                            </div>


                                            <div class="tab-pane" id="topbar_report_notifications" role="tabpanel">
                                                <!--begin::Nav-->
                                                <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                    data-height="300" data-mobile-height="200">
                                                    {{--                                            @if (isset($notification_report) && count($notification_report) > 0) --}}
                                                    {{--                                                @foreach ($notification_report as $value) --}}
                                                    {{--                                                    <a href="{{route('admin.reports.replay',$value->type_id)}}" class="navi-item"> --}}
                                                    {{--                                                        <div class="navi-link"> --}}
                                                    {{--                                                            <div class="navi-icon mr-2"> --}}
                                                    {{--                                                                <i class="flaticon-safe-shield-protection text-primary"></i> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                            <div class="navi-text"> --}}
                                                    {{--                                                                <div class="font-weight-bold"> --}}
                                                    {{--                                                                    تبليغ جديد --}}
                                                    {{--                                                                </div> --}}
                                                    {{--                                                                <div class="text-muted">{{$value->created_at->diffForHumans()}}</div> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                        </div> --}}
                                                    {{--                                                    </a> --}}
                                                    {{--                                                @endforeach --}}
                                                    {{--                                            @else --}}
                                                    <div class="d-flex flex-center text-center text-muted min-h-200px">
                                                        لايوجد اشعارات جديدة
                                                        <br />
                                                    </div>
                                                    {{--                                        @endif --}}
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
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth('admin')->user()->name }}</span>
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
                                    <h5 class="text-dark font-weight-bold my-1 mr-5">@yield('content-title')</h5>
                                    <!--end::Page Title-->

                                </div>
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
            <h3 class="font-weight-bold m-0">مدير النظام
                {{--            <small class="text-muted font-size-sm ml-2">12 messages</small></h3> --}}
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
                    <div class="symbol-label" {{--                     style="background-image:url('{{auth('admin')->user()->getAdminAvatar()}}')" --}}>

                    </div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <a href="#"
                        class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ auth('admin')->user()->name }}</a>
                    <div class="text-muted mt-1">مدير</div>
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
                                    class="navi-text text-muted text-hover-primary">{{ auth('admin')->user()->email }}</span>
                            </span>
                        </a>
                        <a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                            href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                            تسجيل خروج
                        </a>


                        <form id="logout-form" action="{{ route('admin.logout') }}" method="get" class="d-none">
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

                <a href="{{ route('admin.profile.index') }}" class="navi-item">
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
                <a href="{{ route('admin.profile.changePassword') }}" class="navi-item">
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


    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
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

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script src="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/column-rendering.js') }}"></script>

    <!--end::Page Scripts-->
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}"></script>


    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/admin/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}

    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}"></script>


    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.16.1/echo.js"
        integrity="sha512-wGqDposamaADDdR/lXykxN/FS3rEgrbA7s0F5f8hgQkHbHc/2rDfAA609BjgzFgqbl2D4Drbnxyr5kR2vKxBCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <script>
        var pusher = new Pusher('3d1daf32367492d9ffa6', {
            cluster: 'ap2',
            authEndpoint: '{{ url('/broadcasting/auth') }}', // نقطة التوثيق الافتراضية في Laravel
            auth: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        });

        var channel = pusher.subscribe('private-App.Models.Admin.1');


        channel.bind('NewOrderCreated', function(data) {
            console.log('📦 طلب جديد:', data);
            alert(`طلب جديد من ${data.customer_name}`);
        });


        $('textarea.description').each(function() {

            CKEDITOR.replace(this, {

                extraPlugins: 'colorbutton',


            });
        });

        $(document).ready(function() {
            $('#add_edit_start_time').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss', // تنسيق التاريخ والوقت
                icons: {
                    time: "fa fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-calendar-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            });
        });

        $('select').select2({
            'dir': 'rtl',
            placeholder: "{{ __('label.selected') }}", // The placeholder option text
            allowClear: true // Allow clearing the selection

        });

        $('.kt_select2_1').select2({
            width: '100%',
            dir: "rtl",
            placeholder: "اختر",

        });



        $(function() {
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


        });
    </script>


    @yield('scripts')
</body>
<!--end::Body-->

</html>
