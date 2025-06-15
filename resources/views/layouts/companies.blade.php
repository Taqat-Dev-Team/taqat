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
        <a href="{{ route('companies.users.index') }}">


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
                    <a href="{{ route('companies.users.index') }}" class="brand-logo">

                        <img alt="Logo" src="{{ url('assets/logo.png') }}" width="90%" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
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
                        @include('layouts.includes.company_menu')
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


                                <div class="row">
                                    {{-- <a href="{{ route('companies.projects.create') }}"
                                        style="height:60%; margin-top:7%"
                                        class="btn btn-light-warning font-weight-bolder btn-sm mr-2">{{__('label.add_new_project')}}</a>
                                    <a href="{{ route('companies.jobs.create') }}" style="height:60%; margin-top:7%"
                                        class="btn btn-light-success font-weight-bold mr-2">{{__('label.add_new_job')}}</a> --}}

                                        <div class="d-flex align-items-center flex-wrap mr-2">
                                            <!--begin::Page Title-->
                                            <a href="{{route('companies.projects.create')}}" class="btn btn-light-warning font-weight-bolder btn-sm">{{__('label.add_new_project')}}</a>
                                            <!--end::Page Title-->
                                            <!--begin::Actions-->
                                            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                                            <span class="text-muted font-weight-bold mr-4"></span>
                                            <a href="{{route('companies.jobs.create')}}" class="btn btn-light-success font-weight-bolder btn-sm">{{__('label.add_new_job')}}</a>
                                            <!--end::Actions-->
                                        </div>

                                </div>
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                        <!--begin::Topbar-->
                        <div class="topbar">
                            <div class="topbar-item">
                                <a href="{{ route('companies.chats.view') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <!--begin::Svg Icon-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->

                                        <span style="
                                            background-color: red;
                                            color: white;
                                            border-radius: 50%;
                                            padding: 4px 8px;
                                            font-size: 12px;
                                            line-height: 1;
                                            /* position: absolute; */
                                            /* top: -5px; */
                                            /* right: -10px; */
                                            display: inline-block;
                                            text-align: center;
                                            min-width: 20px;">
                                            {{ \App\Models\Chat::query()->where('company_id',auth('company')->id())
                                            ->whereNull('company_read')
                                            ->count() }}
                                        </span>
                                    </span>
                                </a>

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


                            </div>



                            <!--end::Notifications-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span
                                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{__('label.welcome')}}</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth('company')->user()->name }}</span>
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
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a
                                        href="{{ route('companies.users.index') }}">{{__('label.main')}}</a></h5>
                                <!--end::Title-->

                                <p class="text-dark font-weight-bold mt-2 mb-2 mr-5">@yield('sub_page')</p>
                                <p class="text-dark font-weight-bold mt-2 mb-2 mr-5">@yield('title_pages')</p>

                                <!--begin::Separator-->
                                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200">
                                </div>
                                <!--end::Separator-->
                                <!--begin::Search Form-->
                                <div class="d-flex align-items-center" id="kt_subheader_search">
                                    <span class="text-dark-50 font-weight-bold"
                                        id="kt_subheader_total">@yield('total_page')</span>

                                </div>
                                <!--end::Search Form-->
                                <!--begin::Group Actions-->
                                <div class="d-flex- align-items-center flex-wrap mr-2 d-none"
                                    id="kt_subheader_group_actions">
                                    <div class="text-dark-50 font-weight-bold">
                                        <span id="kt_subheader_group_selected_rows">23</span>Selected:
                                    </div>
                                    <div class="d-flex ml-6">
                                        <div class="dropdown mr-2" id="kt_subheader_group_actions_status_change">
                                            <button type="button"
                                                class="btn btn-light-primary font-weight-bolder btn-sm dropdown-toggle"
                                                data-toggle="dropdown">Update Status</button>
                                            <div class="dropdown-menu p-0 m-0 dropdown-menu-sm">
                                                <ul class="navi navi-hover pt-3 pb-4">
                                                    <li
                                                        class="navi-header font-weight-bolder text-uppercase text-primary font-size-lg pb-0">
                                                        Change status to:</li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link"
                                                            data-toggle="status-change" data-status="1">
                                                            <span class="navi-text">
                                                                <span
                                                                    class="label label-light-success label-inline font-weight-bold">Approved</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link"
                                                            data-toggle="status-change" data-status="2">
                                                            <span class="navi-text">
                                                                <span
                                                                    class="label label-light-danger label-inline font-weight-bold">Rejected</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link"
                                                            data-toggle="status-change" data-status="3">
                                                            <span class="navi-text">
                                                                <span
                                                                    class="label label-light-warning label-inline font-weight-bold">Pending</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link"
                                                            data-toggle="status-change" data-status="4">
                                                            <span class="navi-text">
                                                                <span
                                                                    class="label label-light-info label-inline font-weight-bold">On
                                                                    Hold</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <button class="btn btn-light-success font-weight-bolder btn-sm mr-2"
                                            id="kt_subheader_group_actions_fetch" data-toggle="modal"
                                            data-target="#kt_datatable_records_fetch_modal">Fetch Selected</button>
                                        <button class="btn btn-light-danger font-weight-bolder btn-sm mr-2"
                                            id="kt_subheader_group_actions_delete_all">Delete All</button>
                                    </div>
                                </div>
                                <!--end::Group Actions-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center">
                                <!--begin::Button-->
                                <a href="#" class=""></a>
                                <!--end::Button-->
                                <!--begin::Button-->

                                @yield('add_elements')


                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->

                        <div class="container">

                            @yield('content')

                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>

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
            <h3 class="font-weight-bold m-0">{{__('label.manger_system')}}
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
                        class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ auth('company')->user()->name }}</a>
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
                                    class="navi-text text-muted text-hover-primary">{{ auth('company')->user()->email }}</span>
                            </span>
                        </a>
                        <a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                            href="{{ route('companies.logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                            {{__('label.logout')}}
                        </a>

                        <form id="logout-form" action="{{ route('companies.logout') }}" method="get"
                            class="d-none">
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

                <a href="{{ route('companies.profile.index') }}" class="navi-item">
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
                            <div class="font-weight-bold">{{__('label.profile')}}</div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('companies.profile.changePassword') }}" class="navi-item">
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
                            <div class="font-weight-bold">{{__('label.change_password')}}</div>
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


    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/datatables/advanced/column-rendering.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}"></script> --}}

    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // $('.ckeditor').each(function() {

        //     CKEDITOR.replace(this, {

        //         extraPlugins: 'colorbutton',


        //     });
        // });
        $('.select').select2({
            'dir': 'rtl',
            placeholder: "{{__('label.selected')}}",
        });
        $(".datepicker").datepicker({
            format: "mm/dd/yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            gotoCurrent: true,
            orientation: "bottom"
        });
    </script>


    @yield('scripts')

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('3d1daf32367492d9ffa6', {
        cluster: 'ap2'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
      });
    </script>
</body>
<!--end::Body-->

</html>
