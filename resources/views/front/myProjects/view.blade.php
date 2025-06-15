@extends('layouts.front')
@section('title')
    المشروع -عرض تفاصيل
@endsection
@section('styles')
    <style>
        .project-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 20px;
        }

        .project-header {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .project-status {
            color: green;
            font-weight: bold;
        }

        .project-details,
        .project-owner,
        .project-description {
            margin-top: 20px;
        }

        .tags span {
            margin-right: 5px;
        }

        .modal-body textarea {
            width: 100%;
        }

        .rating-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            width: 100%;
        }

        .rating-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .rating-item {
            margin-bottom: 15px;
        }

        .rating-item label {
            display: block;
            margin-bottom: 5px;
        }

        .stars {
            display: inline-block;
        }

        .star {
            font-size: 24px;
            /* Adjust size as needed */
            color: #ddd;
            /* Unfilled star color */
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.filled {
            color: #f39c12;
            /* Filled star color */
        }
    </style>
@endsection
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
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
                                    </span>
                                    <span class="nav-text">تفاصيل المشروع</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path
                                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text">مواصفات التسليم</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z"
                                                        fill="#000000" opacity="0.3" />
                                                    <path
                                                        d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text">العروض المقدمة</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="10"
                                                        r="6" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text">منفذ المشروع</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_5">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Cooking\Dishes.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3,16 L21,16 C21,18.209139 19.209139,20 17,20 L7,20 C4.790861,20 3,18.209139 3,16 Z M3,11 L21,11 L21,12 C21,13.1045695 20.1045695,14 19,14 L5,14 C3.8954305,14 3,13.1045695 3,12 L3,11 Z" fill="#000000"/>
                                                <path d="M3,5 L21,5 L21,7 C21,8.1045695 20.1045695,9 19,9 L5,9 C3.8954305,9 3,8.1045695 3,7 L3,5 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                        </span>
                                    </span>
                                    <span class="nav-text">تقديم عرض </span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_6">
                                    <span class="nav-icon mr-2">
                                        <span
                                            class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path
                                                        d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                    </span>
                                    <span class="nav-text">عرض التقيمات </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body px-0">
                    <div class="tab-content pt-5">
                        <!--begin::Tab Content-->
                        <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                            <div class="container">

                                <h5>{{ $project->title }}</h5>
                                <div class="separator separator-dashed my-10"></div>

                                {!! $project->description !!}
                                {{-- <div class="separator separator-dashed my-10"></div> --}}
                                {{-- <h5>منفذ المشروع</h5> --}}
                                <span class="font-weight-bolder mb-4">متوسط العروض</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                    <span class="font-weight-bold text-dark-50">(${{ $project->avgOffer() }})</span>
                                    <div class="separator separator-dashed my-10"></div>

                                    <span class="font-weight-bolder mb-4">تكلفة المشروع</span>
                                    <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span
                                            class="font-weight-bold text-dark-50">(${{ $project->offers ? $project->cost : '-' }})</span>

                                        <div class="separator separator-dashed my-10"></div>

                                        <span class="font-weight-bolder mb-4">منفذ المشروع</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                            <span
                                                class="font-weight-bold text-dark-50">{{ $project->users ? $project->users->name : '-' }}</span>

                                            <div class="separator separator-dashed my-10"></div>
                                            <span class="font-weight-bolder mb-4">حالة المشروع</span>
                                            <span class="font-weight-bolder font-size-h5 pt-1">
                                                <span class="font-weight-bold text-dark-50">
                                                    {!! $project->getStatus() !!}</span>

                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                            <div class="container">

                                {!! $project->received_required !!}
                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                            <div class="container">
                                @foreach ($project->offers as $value)
                                    <div class="card mb-3 shadow-sm projects">
                                        <div class="card-body">

                                            <div class="d-flex">
                                                <!--begin::Pic-->
                                                <div class="flex-shrink-0 mr-7">
                                                    <div class="symbol symbol-50 symbol-lg-120">
                                                        <img alt="Pic" src="{{ $value->users->getPhoto() }}" />
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                                <!--begin: Info-->
                                                <div class="flex-grow-1">
                                                    <!--begin::Title-->
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                                        <!--begin::User-->
                                                        <div class="mr-3">
                                                            <!--begin::Name-->
                                                            <a href="http://taqat-gaza.com/talent/{{ $value->user_id }}"
                                                                target="__blank"
                                                                class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $value->users->name }}
                                                                <i
                                                                    class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                                            <!--end::Name-->
                                                            <!--begin::Contacts-->
                                                            {!! $value->users->rattings() !!}

                                                            <div class="d-flex flex-wrap my-2">
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24"
                                                                                    height="24" />
                                                                                <path
                                                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                                    fill="#000000" />
                                                                                <circle fill="#000000" opacity="0.3"
                                                                                    cx="19.5" cy="17.5"
                                                                                    r="2.5" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $value->users->email }}</a>
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <mask fill="white">
                                                                                    <use xlink:href="#path-1" />
                                                                                </mask>
                                                                                <g />
                                                                                <path
                                                                                    d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                                                    fill="#000000" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $value->users ? ($value->users->specialization ? $value->users->specialization->title : '-') : '-' }}</a>
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24"
                                                                                    height="24" />
                                                                                <path
                                                                                    d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z"
                                                                                    fill="#000000" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $value->users->displacement_place }}</a>
                                                            </div>
                                                            <!--end::Contacts-->
                                                        </div>
                                                        <!--begin::User-->
                                                        <!--begin::Actions-->
                                                        <div class="my-lg-0 my-1">



                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                    <!--end::Title-->
                                                    <!--begin::Content-->
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <!--begin::Description-->
                                                        <div
                                                            class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                                            {{ $value->description }}</div>
                                                        <!--end::Description-->


                                                        <!--begin::Progress-->
                                                        {{-- <div class="d-flex mt-4 mt-sm-0">
                                                <span class="font-weight-bold mr-4">Progress</span>
                                                <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="font-weight-bolder text-dark ml-4">78%</span>
                                            </div> --}}
                                                        <!--end::Progress-->
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                                        السعر :{{ $value->cost }} $</div>

                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Info-->
                                            </div>

                                            <div class="separator separator-solid my-7"></div>
                                            <!--end::Separator-->
                                            <!--begin::Bottom-->
                                            <div class="d-flex align-items-center flex-wrap">
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">اجمالي الدخل</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $value->users ? $value->users->totalIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">قيمة اقل مشروع</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $value->users ? $value->users->minIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">قيمة اعلى
                                                            مشروع</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $value->users ? $value->users->maxIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">عدد المشاريع
                                                            المنفذة</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold"></span>{{ $value->users->countProjects() }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->

                                                <!--end: Item-->

                                                <!--end: Item-->
                                            </div>
                                        </div>



                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                            <div class="container">


                                @if (isset($project->users))
                                    <div class="card mb-3 shadow-sm projects">
                                        <div class="card-body">

                                            <div class="d-flex">
                                                <!--begin::Pic-->
                                                <div class="flex-shrink-0 mr-7">
                                                    <div class="symbol symbol-50 symbol-lg-120">
                                                        <img alt="Pic" src="{{ $project->users->getPhoto() }}" />
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                                <!--begin: Info-->
                                                <div class="flex-grow-1">
                                                    <!--begin::Title-->
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                                        <!--begin::User-->
                                                        <div class="mr-3">
                                                            <!--begin::Name-->
                                                            <a href="http://taqat-gaza.com/talent/{{ $project->user_id }}"
                                                                target="__blank"
                                                                class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $project->users->name }}
                                                                <i
                                                                    class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                                            <!--end::Name-->
                                                            <!--begin::Contacts-->
                                                            {!! $project->users->rattings() !!}

                                                            <div class="d-flex flex-wrap my-2">
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24"
                                                                                    height="24" />
                                                                                <path
                                                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                                    fill="#000000" />
                                                                                <circle fill="#000000" opacity="0.3"
                                                                                    cx="19.5" cy="17.5"
                                                                                    r="2.5" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $project->users ? $project->users->email : '-' }}</a>
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <mask fill="white">
                                                                                    <use xlink:href="#path-1" />
                                                                                </mask>
                                                                                <g />
                                                                                <path
                                                                                    d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                                                    fill="#000000" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $project->users ? ($project->users->specialization ? $project->users->specialization->title : '-') : '-' }}</a>
                                                                <a href="#"
                                                                    class="text-muted text-hover-primary font-weight-bold">
                                                                    <span
                                                                        class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px" height="24px"
                                                                            viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24"
                                                                                    height="24" />
                                                                                <path
                                                                                    d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z"
                                                                                    fill="#000000" />
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>{{ $project->users ? $project->users->displacement_place : '-' }}</a>
                                                            </div>
                                                            <!--end::Contacts-->
                                                        </div>
                                                        <!--begin::User-->
                                                        <!--begin::Actions-->
                                                        <div class="my-lg-0 my-1">

                                                            <a href="#"
                                                                class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-2">منفذ
                                                                المشروع</a>



                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                    <!--end::Title-->
                                                    <!--begin::Content-->
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">

                                                    </div>
                                                    <div
                                                        class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                                        السعر :{{ $project->cost }} $</div>

                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Info-->
                                            </div>

                                            <div class="separator separator-solid my-7"></div>
                                            <!--end::Separator-->
                                            <!--begin::Bottom-->
                                            <div class="d-flex align-items-center flex-wrap">
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">اجمالي الدخل</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $project->users ? $project->users->totalIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">قيمة اقل مشروع</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $project->users ? $project->users->minIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i
                                                            class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">قيمة اعلى
                                                            مشروع</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold">$</span>{{ $project->users ? $project->users->maxIncome() : 0 }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                    <span class="mr-4">
                                                        <i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">عدد المشاريع
                                                            المنفذة</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                            <span
                                                                class="text-dark-50 font-weight-bold"></span>{{ $project->users->countProjects() }}</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->

                                                <!--end: Item-->

                                                <!--end: Item-->
                                            </div>
                                        </div>



                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane" id="kt_apps_contacts_view_tab_5" role="tabpanel">
                            <div class="container">
                                <form id="my-form" name="my-form" class="my-form" method="POST" action="#">
                                    @csrf

                                    <input type="hidden" name="project_id" class="form-control" id="project_id"
                                        value="{{ $project->id }}" placeholder="">

                                    <div class="form-group row">
                                        <div class="col-lg-6 col-sm-12">

                                            <label for="cost">
                                                تكلفة ($)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="cost" class="form-control" id="cost"
                                                value="" placeholder="">

                                            <div class="title cost"></div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">

                                            <label for="duration">
                                                مدة الزمنية
                                            </label>
                                            <input type="number" min="1" name="duration" class="form-control"
                                                id="duration" value="{{ old('duration') }}" placeholder="">

                                            <div class="duration error"></div>

                                        </div>


                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-sm-12">

                                            <label for="description">
                                                الوصف
                                            </label>

                                            <textarea class="form-control" name="description"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><span><i
                                                        class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                                تاكيد

                                            </button>


                                        </div>
                                </form>
                            </div>


                        </div>
                    </div>

                    <div class="tab-pane" id="kt_apps_contacts_view_tab_6" role="tabpanel">
                        <div class="container">

                            @if ($ratings)
                                <h5>تقييم صاحب المشروع</h5>
                                <div class="rating-container">
                                    <!-- Professional Dealing Rating -->
                                    <div class="rating-item">
                                        <label>التعامل الاحترافي</label>
                                        <div class="stars" data-rating-type="professional_dealing">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->professional_dealing ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="professional_dealing" id="professional_dealing"
                                                value="{{ $ratings->professional_dealing ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Communication Assistance Rating -->
                                    <div class="rating-item">
                                        <label>التواصل بالاحترافية</label>
                                        <div class="stars" data-rating-type="communication_assistance">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->communication_assistance ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="communication_assistance"
                                                id="communication_assistance"
                                                value="{{ $ratings->communication_assistance ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Quality Delivered Work Rating -->
                                    <div class="rating-item">
                                        <label>جودة العمل المسلم</label>
                                        <div class="stars" data-rating-type="quality_delivered_work">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->quality_delivered_work ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="quality_delivered_work"
                                                id="quality_delivered_work"
                                                value="{{ $ratings->quality_delivered_work ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Experience in Project Field Rating -->
                                    <div class="rating-item">
                                        <label>الخبرة في مجال المشروع</label>
                                        <div class="stars" data-rating-type="experience_in_project_field">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->experience_in_project_field ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="experience_in_project_field"
                                                id="experience_in_project_field"
                                                value="{{ $ratings->experience_in_project_field ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Delivery on Time Rating -->
                                    <div class="rating-item">
                                        <label>التسليم في موعد</label>
                                        <div class="stars" data-rating-type="delivery_on_time">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->delivery_on_time ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="delivery_on_time" id="delivery_on_time"
                                                value="{{ $ratings->delivery_on_time ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Deal With Again Rating -->
                                    <div class="rating-item">
                                        <label>التعامل معه مرة اخرى</label>
                                        <div class="stars" data-rating-type="deal_with_again">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="star{{ $ratings && $i <= $ratings->deal_with_again ? ' filled' : '' }}"
                                                    data-value="{{ $i }}">&#9733;</span>
                                            @endfor
                                            <input type="hidden" name="deal_with_again" id="deal_with_again"
                                                value="{{ $ratings->deal_with_again ?? 0 }}">
                                        </div>
                                    </div>

                                    <!-- Display Message -->
                                    <div class="rating-item">
                                        <label>الرسالة</label>
                                        {{ $ratings->message ?? '' }}
                                    </div>
                            @endif

                            @if($project->status==3 &&$project->user_id==auth()->id())
                            <h5>تقيمك لصاحب المشروع</h5>
                            <form id="review-form" name="review-form" class="review-form" method="POST" action="#">
                                @csrf

                                <div id="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="star{{ $userRattings && $i <= $userRattings->rate ? ' filled' : '' }}"
                                            data-value="{{ $i }}">&#9733;</span>
                                    @endfor
                                </div>

                                <input type="hidden"name="project_id" value="{{$project->id}}">

                                <input type="hidden" name="rating" id="rating" value="{{$userRattings->rating??0}}">
                                <label for="message">الرسالة :</label>
                                <textarea name="message" id="message" class="form-control" required>{{$userRattings->message}}</textarea>
                             <hr>
                                <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                            aria-hidden="true"></i></span>
                                    تاكيد

                                </button>
                            </form>
                            @endif
                        </div>


                    </div>
                </div>
                <!--end::Tab Content-->
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <script>
        $('#star-rating .star').on('click', function() {
            var value = $(this).data('value');
            $('#rating').val(value);

            $('#star-rating .star').each(function(index) {
                if (index < value) {
                    $(this).addClass('filled');
                } else {
                    $(this).removeClass('filled');
                }
            });
        });



        $("form[name='review-form']").validate({
            rules: {



                ratting: {
                    required: true,

                },





            },
            messages: {
                rating: {
                    "required": "التقيم مطلوب",
                },

            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data = new FormData(document.getElementById("review-form"));


                $.ajax({
                    url: '{{ route('front.influencesProjects.addReviews') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {


                        if (response.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                    location.reload();
                                },
                                2000);

                        } else {

                        }
                    },
                    error: function(response) {

                        console.log

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        })
                        // var errors = response.responseJSON.errors;

                    }
                });


            }

        });
        $("form[name='my-form']").validate({
            rules: {



                duration: {
                    required: true,

                },
                cost: {
                    required: true,

                },
                description: {
                    required: true,

                },




            },
            messages: {
                description: {
                    "required": "العرض مطلوب",
                },
                cost: {
                    "required": "تكلفة مطلوبة",
                },
                duration: {
                    "required": "المدة الزمنية مطلوبة",
                },

            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data = new FormData(document.getElementById("my-form"));


                $.ajax({
                    url: '{{ route('front.offers.store') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {


                        if (response.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                    location.reload();
                                },
                                2000);

                        } else {

                        }
                    },
                    error: function(response) {

                        console.log

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        })
                        // var errors = response.responseJSON.errors;

                    }
                });


            }

        });
    </script>
@endsection
