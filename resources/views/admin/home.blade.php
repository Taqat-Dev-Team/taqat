@extends('layouts.admin')

@section('title', 'لوحة الرئيسية')
@section('content')



    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            <!--begin::Mixed Widget 1-->
            <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title font-weight-bolder text-white">{{ __('label.General_statistics') }}</h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-header pb-1">
                                        <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add
                                            new:</span>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-shopping-cart-1"></i>
                                            </span>
                                            <span class="navi-text">Order</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-calendar-8"></i>
                                            </span>
                                            <span class="navi-text">Event</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-graph-1"></i>
                                            </span>
                                            <span class="navi-text">Report</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-rocket-1"></i>
                                            </span>
                                            <span class="navi-text">Post</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-writing"></i>
                                            </span>
                                            <span class="navi-text">File</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger"
                        style="height: 200px; min-height: 200px;">
                        <div id="apexchartsqjr222qc" class="apexcharts-canvas apexchartsqjr222qc apexcharts-theme-light"
                            style="width: 413px; height: 200px;"><svg id="SvgjsSvg1418" width="413" height="200"
                                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                transform="translate(0, 0)" style="background: transparent;">
                                <g id="SvgjsG1420" class="apexcharts-inner apexcharts-graphical"
                                    transform="translate(0, 0)">
                                    <defs id="SvgjsDefs1419">
                                        <clipPath id="gridRectMaskqjr222qc">
                                            <rect id="SvgjsRect1423" width="420" height="203" x="-3.5" y="-1.5"
                                                rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectMarkerMaskqjr222qc">
                                            <rect id="SvgjsRect1424" width="417" height="204" x="-2" y="-2"
                                                rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <filter id="SvgjsFilter1431" filterUnits="userSpaceOnUse" width="200%"
                                            height="200%" x="-50%" y="-50%">
                                            <feFlood id="SvgjsFeFlood1432" flood-color="#d13647" flood-opacity="0.5"
                                                result="SvgjsFeFlood1432Out" in="SourceGraphic"></feFlood>
                                            <feComposite id="SvgjsFeComposite1433" in="SvgjsFeFlood1432Out"
                                                in2="SourceAlpha" operator="in" result="SvgjsFeComposite1433Out">
                                            </feComposite>
                                            <feOffset id="SvgjsFeOffset1434" dx="0" dy="5"
                                                result="SvgjsFeOffset1434Out" in="SvgjsFeComposite1433Out"></feOffset>
                                            <feGaussianBlur id="SvgjsFeGaussianBlur1435" stdDeviation="3 "
                                                result="SvgjsFeGaussianBlur1435Out" in="SvgjsFeOffset1434Out">
                                            </feGaussianBlur>
                                            <feMerge id="SvgjsFeMerge1436" result="SvgjsFeMerge1436Out"
                                                in="SourceGraphic">
                                                <feMergeNode id="SvgjsFeMergeNode1437" in="SvgjsFeGaussianBlur1435Out">
                                                </feMergeNode>
                                                <feMergeNode id="SvgjsFeMergeNode1438" in="[object Arguments]">
                                                </feMergeNode>
                                            </feMerge>
                                            <feBlend id="SvgjsFeBlend1439" in="SourceGraphic" in2="SvgjsFeMerge1436Out"
                                                mode="normal" result="SvgjsFeBlend1439Out"></feBlend>
                                        </filter>
                                        <filter id="SvgjsFilter1441" filterUnits="userSpaceOnUse" width="200%"
                                            height="200%" x="-50%" y="-50%">
                                            <feFlood id="SvgjsFeFlood1442" flood-color="#d13647" flood-opacity="0.5"
                                                result="SvgjsFeFlood1442Out" in="SourceGraphic"></feFlood>
                                            <feComposite id="SvgjsFeComposite1443" in="SvgjsFeFlood1442Out"
                                                in2="SourceAlpha" operator="in" result="SvgjsFeComposite1443Out">
                                            </feComposite>
                                            <feOffset id="SvgjsFeOffset1444" dx="0" dy="5"
                                                result="SvgjsFeOffset1444Out" in="SvgjsFeComposite1443Out"></feOffset>
                                            <feGaussianBlur id="SvgjsFeGaussianBlur1445" stdDeviation="3 "
                                                result="SvgjsFeGaussianBlur1445Out" in="SvgjsFeOffset1444Out">
                                            </feGaussianBlur>
                                            <feMerge id="SvgjsFeMerge1446" result="SvgjsFeMerge1446Out"
                                                in="SourceGraphic">
                                                <feMergeNode id="SvgjsFeMergeNode1447" in="SvgjsFeGaussianBlur1445Out">
                                                </feMergeNode>
                                                <feMergeNode id="SvgjsFeMergeNode1448" in="[object Arguments]">
                                                </feMergeNode>
                                            </feMerge>
                                            <feBlend id="SvgjsFeBlend1449" in="SourceGraphic" in2="SvgjsFeMerge1446Out"
                                                mode="normal" result="SvgjsFeBlend1449Out"></feBlend>
                                        </filter>
                                    </defs>
                                    <g id="SvgjsG1450" class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g id="SvgjsG1451" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                        </g>
                                    </g>
                                    <g id="SvgjsG1453" class="apexcharts-grid">
                                        <g id="SvgjsG1454" class="apexcharts-gridlines-horizontal"
                                            style="display: none;">
                                            <line id="SvgjsLine1456" x1="0" y1="0" x2="413"
                                                y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1457" x1="0" y1="20" x2="413"
                                                y2="20" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1458" x1="0" y1="40" x2="413"
                                                y2="40" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1459" x1="0" y1="60" x2="413"
                                                y2="60" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1460" x1="0" y1="80" x2="413"
                                                y2="80" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1461" x1="0" y1="100" x2="413"
                                                y2="100" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1462" x1="0" y1="120" x2="413"
                                                y2="120" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1463" x1="0" y1="140" x2="413"
                                                y2="140" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1464" x1="0" y1="160" x2="413"
                                                y2="160" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1465" x1="0" y1="180" x2="413"
                                                y2="180" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1466" x1="0" y1="200" x2="413"
                                                y2="200" stroke="#e0e0e0" stroke-dasharray="0"
                                                class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1455" class="apexcharts-gridlines-vertical" style="display: none;">
                                        </g>
                                        <line id="SvgjsLine1468" x1="0" y1="200" x2="413"
                                            y2="200" stroke="transparent" stroke-dasharray="0"></line>
                                        <line id="SvgjsLine1467" x1="0" y1="1" x2="0"
                                            y2="200" stroke="transparent" stroke-dasharray="0"></line>
                                    </g>
                                    <g id="SvgjsG1426" class="apexcharts-area-series apexcharts-plot-series">
                                        <g id="SvgjsG1427" class="apexcharts-series" seriesName="NetxProfit"
                                            data:longestSeries="true" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath1430"
                                                d="M 0 200L 0 125C 24.091666666666665 125 44.74166666666666 87.5 68.83333333333333 87.5C 92.925 87.5 113.57499999999999 120 137.66666666666666 120C 161.75833333333333 120 182.40833333333333 25 206.5 25C 230.59166666666667 25 251.24166666666665 100 275.3333333333333 100C 299.42499999999995 100 320.075 100 344.16666666666663 100C 368.2583333333333 100 388.9083333333333 100 413 100C 413 100 413 100 413 200M 413 100z"
                                                fill="transparent" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                class="apexcharts-area" index="0"
                                                clip-path="url(#gridRectMaskqjr222qc)" filter="url(#SvgjsFilter1431)"
                                                pathTo="M 0 200L 0 125C 24.091666666666665 125 44.74166666666666 87.5 68.83333333333333 87.5C 92.925 87.5 113.57499999999999 120 137.66666666666666 120C 161.75833333333333 120 182.40833333333333 25 206.5 25C 230.59166666666667 25 251.24166666666665 100 275.3333333333333 100C 299.42499999999995 100 320.075 100 344.16666666666663 100C 368.2583333333333 100 388.9083333333333 100 413 100C 413 100 413 100 413 200M 413 100z"
                                                pathFrom="M -1 200L -1 200L 68.83333333333333 200L 137.66666666666666 200L 206.5 200L 275.3333333333333 200L 344.16666666666663 200L 413 200">
                                            </path>
                                            <path id="SvgjsPath1440"
                                                d="M 0 125C 24.091666666666665 125 44.74166666666666 87.5 68.83333333333333 87.5C 92.925 87.5 113.57499999999999 120 137.66666666666666 120C 161.75833333333333 120 182.40833333333333 25 206.5 25C 230.59166666666667 25 251.24166666666665 100 275.3333333333333 100C 299.42499999999995 100 320.075 100 344.16666666666663 100C 368.2583333333333 100 388.9083333333333 100 413 100"
                                                fill="none" fill-opacity="1" stroke="#d13647" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="3" stroke-dasharray="0"
                                                class="apexcharts-area" index="0"
                                                clip-path="url(#gridRectMaskqjr222qc)" filter="url(#SvgjsFilter1441)"
                                                pathTo="M 0 125C 24.091666666666665 125 44.74166666666666 87.5 68.83333333333333 87.5C 92.925 87.5 113.57499999999999 120 137.66666666666666 120C 161.75833333333333 120 182.40833333333333 25 206.5 25C 230.59166666666667 25 251.24166666666665 100 275.3333333333333 100C 299.42499999999995 100 320.075 100 344.16666666666663 100C 368.2583333333333 100 388.9083333333333 100 413 100"
                                                pathFrom="M -1 200L -1 200L 68.83333333333333 200L 137.66666666666666 200L 206.5 200L 275.3333333333333 200L 344.16666666666663 200L 413 200">
                                            </path>
                                            <g id="SvgjsG1428" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                <g class="apexcharts-series-markers">
                                                    <circle id="SvgjsCircle1474" r="0" cx="0" cy="0"
                                                        class="apexcharts-marker wldg3zzud no-pointer-events"
                                                        stroke="#d13647" fill="#ffe2e5" fill-opacity="1"
                                                        stroke-width="3" stroke-opacity="0.9" default-marker-size="0">
                                                    </circle>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1429" class="apexcharts-datalabels" data:realIndex="0"></g>
                                    </g>
                                    <line id="SvgjsLine1469" x1="0" y1="0" x2="413"
                                        y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                        class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine1470" x1="0" y1="0" x2="413"
                                        y2="0" stroke-dasharray="0" stroke-width="0"
                                        class="apexcharts-ycrosshairs-hidden"></line>
                                    <g id="SvgjsG1471" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG1472" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG1473" class="apexcharts-point-annotations"></g>
                                </g>
                                <g id="SvgjsG1452" class="apexcharts-yaxis" rel="0"
                                    transform="translate(-18, 0)"></g>
                                <g id="SvgjsG1421" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;">
                                </div>
                                <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker"
                                        style="background-color: transparent;"></span>
                                    <div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-label"></span><span
                                                class="apexcharts-tooltip-text-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n25">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3"
                                                height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11"
                                                rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9"
                                                rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7"
                                                rx="1.5"></rect>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="{{ route('admin.users.index') }}"
                                    class="text-warning font-weight-bold font-size-h6">{{ __('label.affiliates') }}
                                    ({{ \App\Models\User::all()->count() }})</a>
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path
                                                d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="{{ route('admin.companies.index') }}"
                                    class="text-primary font-weight-bold font-size-h6 mt-2">
                                    {{ __('label.running') }}
                                    ({{ App\Models\Company::all()->count() }})</a>
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                fill="#000000" fill-rule="nonzero"></path>
                                            <path
                                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="{{ route('admin.attendances.index') }}"
                                    class="text-danger font-weight-bold font-size-h6 mt-2">{{ __('label.working_hours') }}
                                    ({{ App\Models\Attendance::all()->sum('hours') }})</a>
                            </div>
                            <div class="col bg-light-success px-6 py-8 rounded-xl">
                                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"
                                                fill="#000000" opacity="0.3"></path>
                                            <path
                                                d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"
                                                fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <a href="{{ route('admin.incomeMovements.index') }}"
                                    class="text-success font-weight-bold font-size-h6 mt-2">{{ __('label.total_income') }}
                                    ({{ App\Models\IncomeMovement::all()->sum('amount') . ' $' }})</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 414px; height: 462px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 1-->
        </div>

        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6 ">


                    <!--begin::Advance Table Widget 2-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5 bg-light">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{ __('label.new_members') }}</span>

                            </h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-3 pb-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 50px"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\User::orderBy('id', 'DESC')->take(5)->with('specialization')->get() as $user)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <a
                                                        href="https://team.taqat-gaza.com/admin/users/view/{{ $user->id }}"><img
                                                            src="{{ $user->photo }}" class="circle"
                                                            style="object-fit:contain;width:50px;height:50px;border-radius: 50%;"></a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="https://team.taqat-gaza.com/admin/users/view/{{ $user->id }}"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $user->name }}</a>
                                                    <div>
                                                        <a class="text-muted font-weight-bold text-hover-primary"
                                                            href="#">{{ $user->specialization->title }}</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>

                </div>

                <div class="col-lg-6">


                    <!--begin::Advance Table Widget 2-->
                    <div class="card card-custom shadow-sm">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5 bg-light">
                            <h3 class="card-title align-items-start flex-column">

                                <span class="text-muted mt-3 font-weight-normal font-size-sm">



                                    <span class="card-label font-weight-bolder text-dark">فواتير منتهية</span>



                                </span>
                            </h3>

                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-3 pb-0">
                            <!--begin::Table-->
                            <div class="table-responsive">

                                <table class="table table-borderless table-hover interview-table">

                                    <tbody>
                                        @foreach ($expirationInvoices as $value)
                                            <tr>

                                                <td class="p-2">
                                                    <a href="{{ route('admin.users.views', $value->user_id) }}"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->users?->name }}</a>
                                                    <div><a class="text-muted font-weight-bold text-hover-primary"
                                                            href="#">{{ $value->expiration_date }}</a></div>


                                                </td>



                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>

                    <!--end::Advance Table Widget 2-->
                </div>

            </div>
        </div>

    </div>

    @if(auth('admin')->user()->can('view_expired_internet_subscription'))
    <div class="row">
        <div class="col-lg-12">

            <div class="card card-custom">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h1 class="card-label">{{ __('label.dispaly_all_expired_internet_subscription') }}</h1>
                    </div>

                    <div class="card-toolbar">

                    </div>

                </div>
                <div class="card-body">

                    <div class="row">

                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-head-custom table-vertical-center expired-table">
                            <thead>
                                <tr class="text-left">
                                    <th>{{ __('label.user_name') }}</th>
                                    <th>{{ __('label.work_hours') }}</th>
                                    <th>{{ __('label.internet_code') }}</th>
                                    <th>{{ __('label.internet_password') }}</th>
                                    <th>{{ __('label.subscription_type') }}</th>
                                    <th>{{ __('label.duration') }}</th>
                                    <th>{{ __('label.price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

    <div class="row mt-2">
        <div class="col-xl-4">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="{{ route('admin.users.index') }}"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">
                            {{ __('label.associates_within_the_workspace') }}
                        </a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::where('status', 1)->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                    <img src="https://www.iconpacks.net/icons/1/free-user-group-icon-296-thumb.png" alt=""
                        class="align-self-end h-100px">
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 5-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="{{ route('admin.users.index', ['status' => 'non-hub']) }}"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.members_registered_through_the_Taqat') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::where('status', 3)->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                    <img src="https://simpleicon.com/wp-content/uploads/multy-user.png" alt=""
                        class="align-self-end h-100px">
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 5-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 6-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="{{ route('admin.jobConstrancts.index') }}"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.job_constrancts') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\jobContract::all()->count() }}
                            {{ __('label.contract_worth') }}
                            {{ App\Models\jobContract::all()->sum('sallary') }}$</span>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/8912/8912992.png" alt=""
                        class="align-self-end h-100px">
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 6-->
        </div>
    </div>
    <h2>{{ __('label.original_place') }}</h2>
    <hr>
    <div class="row">
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.gaza') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['مدينة غزة', 'gaza'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.north_gaza') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['شمال غزة', 'north'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.khan_Younes') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['خانيونس', 'khn'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.alwasta') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['الوسطى', 'central'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.rafah') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['rafah', 'رفح'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.other') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('original_place', ['other', 'اخرى'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
    </div>
    <h2>{{ __('label.displacement_place') }}</h2>
    <hr>
    <div class="row">
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.gaza') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['مدينة غزة', 'gaza'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.north_gaza') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['شمال غزة', 'north'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.khan_Younes') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['خانيونس', 'khn'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.alwasta') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['الوسطى', 'central', 'دير البلح', 'النصيرات', 'الزوايدة'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.rafah') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['rafah', 'رفح'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ __('label.other') }}</a>
                        <span
                            class="font-weight-bold text-muted font-size-lg">{{ App\Models\User::whereIn('displacement_place', ['other', 'اخرى'])->get()->count() }}
                            {{ __('label.affiliate') }} </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
        </div>
    </div>








@endsection

@section('scripts')

    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}"></script>


    <script>
        let table = $('.expired-table').DataTable({
            processing: true,
            serverSide: true,

            searching: false,
            ajax: {
                url: "{{ route('admin.internetSubscriptions.getExpired') }}",
                type: 'get',
                "data": function(d) {
                    d.branch_id = $('#serach_branch_id').val();
                },
            },
            columns: [

                {
                    data: 'user_name',
                    name: 'user_name',
                    searchable: true
                },
                {
                    data: 'total_duration',
                    name: 'total_duration',
                    searchable: true
                },

                {
                    data: 'internet_code',
                    name: 'internet_code',
                    searchable: true
                },
                {
                    data: 'internet_password',
                    name: 'internet_password',
                    searchable: true
                },
                {
                    data: 'subscription_type',
                    name: 'subscription_type',
                    searchable: true
                },
                {
                    data: 'duration',
                    name: 'duration',
                    searchable: true
                },
                {
                    data: 'price',
                    name: 'price',
                    searchable: true
                },

            ],

            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
    </script>
    @include('admin.users.js.js')



@endsection
