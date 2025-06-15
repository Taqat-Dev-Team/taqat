@extends('layouts.companies')
@section('title')
    {{ __('label.show_job') }}
@endsection

@section('sub_page')
    |<a href="{{ route('companies.jobs.index') }}">{{ __('label.jobs') }}</a>
@endsection
@section('title_pages')
    |{{ __('label.show_job') }}
@endsection
@section('total_page')
    {{ __('label.jobs_count') }}({{ $job_count }})
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header card-header-tabs-line">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                <span class="nav-text">{{ __('label.job_details') }}</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                <span class="nav-text">{{ __('label.job_requirements') }}</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                <span class="nav-text">{{ __('label.apply_requests') }}</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="nav-text">{{ __('label.employee') }}</span>
                            </a>
                        </li>

                    </ul>
                    <div class="card-toolbar">




                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title=""
                            data-placement="left">
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">

                                    <li class="navi-item">
                                        <a href="{{ route('companies.jobs.edit', $job->id) }}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-pen"></i>
                                            </span>
                                            <span class="navi-text">{{ __('label.edit') }}</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="https://taqat-gaza.com/ar/job/{{ $job->slug }}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon-eye"></i>
                                            </span>
                                            <span class="navi-text">{{ __('label.show') }}</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="" class="navi-link  delete" name_delete="{{ $job->title }}"
                                            data-delete_id="{{ $job->id }}">
                                            <span class="navi-icon">
                                                <i class="flaticon-delete"></i>
                                            </span>
                                            <span class="navi-text">{{ __('label.delete') }}</span>
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
                <div class="card-body px-0">
                    <div class="tab-content pt-5">
                        <!--begin::Tab Content-->
                        <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                            <div class="container">

                                <h5>{{ $job->title }}</h5>
                                <div class="separator separator-dashed my-10"></div>

                                {!! $job->description !!}


                                <span class="font-weight-bolder mb-4">{{ __('label.count_apply_requests') }}</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                    <span class="font-weight-bold text-dark-50">({{ $job->applyJobCount() }})</span>

                                    <div class="separator separator-dashed my-10"></div>

                                    <span class="font-weight-bolder mb-4">{{ __('label.name') }}</span>
                                    <span class="font-weight-bolder font-size-h5 pt-1">
                                        <span
                                            class="font-weight-bold text-dark-50">{{ $job->users ? $job->users->name : '-' }}</span>
                                        <div class="separator separator-dashed my-10"></div>

                                        <span class="font-weight-bolder mb-4">{{ __('label.sallary') }}</span>
                                        <span class="font-weight-bolder font-size-h5 pt-1">
                                            <span class="font-weight-bold text-dark-50">{{ $job->sallary }}</span>
                                            <div class="separator separator-dashed my-10"></div>


                                            <span class="font-weight-bolder mb-4">{{ __('label.permanent_type') }}</span>
                                            <span class="font-weight-bolder font-size-h5 pt-1">
                                                <span
                                                    class="font-weight-bold text-dark-50">{{ $job->permanent_type }}</span>
                                                <div class="separator separator-dashed my-10"></div>
                                                <span class="font-weight-bolder mb-4">{{ __('label.status') }}</span>
                                                <span class="font-weight-bolder font-size-h5 pt-1">
                                                    <span class="font-weight-bold text-dark-50">
                                                        {!! $job->getStatus() !!}</span>

                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                            <div class="container">

                                {!! $job->job_requirements !!}
                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                            <div class="container">

                                @foreach ($job->applyJobs as $value)
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
                                                            <a href="https://taqat-gaza.com/talents/{{ $value->users?$value->users->slug:'' }}"
                                                                target="__blank"
                                                                class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $value->users->name }}
                                                                <i
                                                                    class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                                            <!--end::Name-->
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

                                                    </div>
                                                    <div <!--end::Content-->
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.total_income') }}</span>
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.min_income') }}
                                                            </span>
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.max_income') }}
                                                            </span>
                                                            <span class="font-weight-bolder font-size-h5">
                                                                <span
                                                                    class="text-dark-50 font-weight-bold">$</span>{{ $value->users ? $value->users->maxIncome() : 0 }}</span>
                                                        </div>
                                                    </div>
                                                    <!--end: Item-->
                                                    <!--begin: Item-->
                                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                        <span class="mr-4">
                                                            <i
                                                                class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                                                        </span>
                                                        <div class="d-flex flex-column text-dark-75">
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.projects_count') }}</span>
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
                                                <div class="dropdown dropdown-inline" data-toggle="tooltip"
                                                    title="" data-placement="left">
                                                    <a href="#"
                                                        class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ki ki-bold-more-hor"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                        <!--begin::Navigation-->
                                                        <ul class="navi navi-hover">
                                                            <li class="navi-item">


                                                                <a href="#"
                                                                    class="navi-link font-weight-bolder text-uppercase chat_room"
                                                                    data-user_id="{{ $value->user_id }}"
                                                                    data-job_id="{{ $value->job_id }}"
                                                                    data-company_id="{{ auth('company')->id() }}"
                                                                    data-toggle="modal" data-target="#messageModal"
                                                                    id="chats">
                                                                    {{ __('label.chat') }}
                                                                </a>

                                                                <a href="#"
                                                                    class="navi-link font-weight-bolder text-uppercase accept_users"
                                                                    data-user_id="{{ $value->user_id }}"
                                                                    data-job_id="{{ $value->job_id }}"
                                                                    data-company_id="{{ auth('company')->id() }}"
                                                                    data-toggle="modal" data-target="#contractModal"
                                                                    data-user_id="{{ $value->user_id }}"
                                                                    data-job_id="{{ $value->job_id }}" id="chats">
                                                                    {{ __('label.accept_users') }}
                                                                </a>


                                                                <a href="#"
                                                                    class="navi-link font-weight-bolder text-uppercase zoom_interview"
                                                                    data-user_id="{{ $value->user_id }}"
                                                                    data-job_id="{{ $value->job_id }}"
                                                                    data-company_id="{{ auth('company')->id() }}"
                                                                    data-toggle="modal" data-target="#zoomInterviewModal">
                                                                    {{ __('label.interview') }}
                                                                </a>




                                                            </li>

                                                        </ul>
                                                        <!--end::Navigation-->
                                                    </div>
                                                </div>
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



                                @foreach ($job->contracts as $value)
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
                                                            <a href="https://taqat-gaza.com/talents/{{ $value->users?$value->users->slug:'' }}"
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

                                                    </div>
                                                    <div <!--end::Content-->
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.total_income') }}</span>
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.min_income') }}
                                                            </span>
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
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.max_income') }}
                                                            </span>
                                                            <span class="font-weight-bolder font-size-h5">
                                                                <span
                                                                    class="text-dark-50 font-weight-bold">$</span>{{ $value->users ? $value->users->maxIncome() : 0 }}</span>
                                                        </div>
                                                    </div>
                                                    <!--end: Item-->
                                                    <!--begin: Item-->
                                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                        <span class="mr-4">
                                                            <i
                                                                class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                                                        </span>
                                                        <div class="d-flex flex-column text-dark-75">
                                                            <span
                                                                class="font-weight-bolder font-size-sm">{{ __('label.projects_count') }}</span>
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
                                    </div>
                                @endforeach

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


    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">{{ __('label.chat') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Messages will be loaded here -->
                    <!-- Chat form -->
                    <form id="chatForm" class="chat" name="chat" method="POST" action="#">
                        @csrf
                        <h5> {{ __('label.do_you_want_to_open_a_chat_with_the_presenter') }}?</h5>
                        <input value="" name="job_id" type="hidden" id="job_id">
                        <input value="" name="user_id" type="hidden" id="user_id">



                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col col-lg-6">
                            <button type="submit" class="btn btn-primary submit_chat">{{ __('label.submit') }}</button>

                        </div>
                        <div class="col col-lg-6">

                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl"" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contractModalLabel"{{ __('label.Contract_details') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <!-- Form or content for the modal goes here -->
                    <form id="my-form" name="my-form" method="POST" action="" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="user_id" class="form-control" id="contract_user_id">
                        <input type="hidden" name="job_id" class="form-control" id="contract_job_id">



                        <div class="row">
                            <!-- Date Input -->
                            <div class="col-lg-6 col-sm-12">
                                <label for="start_date">
                                    {{ __('label.start_date') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                        <input type="text" class="form-control datepicker" value=""
                                            name="start_date" placeholder=" " data-target="#kt_datetimepicker_10" />
                                        <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Time Input -->
                            <div class="col-lg-6 col-sm-12">
                                <label for="end_date">
                                    {{ __('label.end_date') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                                        <input type="text" class="form-control datepicker" value=""
                                            name="end_date" placeholder=" " data-target="#kt_datetimepicker_10" />
                                        <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">

                                <label for="requirements">{{ __('label.job_requirements') }}</label>
                                <textarea class="form-control ckeditor" id="requirements" name="requirements" rows="3" required></textarea>

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-6 col-sm-12">

                                <label for="salary">{{ __('label.salary') }}
                                    <span class="text-danger">*</span>

                                </label>
                                <input type="number" step="0.01" class="form-control" id="salary" name="salary"
                                    required>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <label for="attachment">{{ __('label.attachments') }}</label>
                                <input type="file" class="form-control " id="attachment" name="attachment">
                            </div>
                        </div>
                        <div class="row ">

                            <div class="col-lg-6 col-sm-12">
                                <label for="specialization_id">
                                    {{ __('label.specializations') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <select class="form-control select_2" name="specialization_id" id="specialization_id">
                                    <option value="">{{ __('label.seleted') }}</option>

                                    @foreach ($specializations as $value)
                                        <option value="{{ $value->id }}"
                                            @if ($value->id == $job->specialization_id) selected @endif>{{ $value->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('label.submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>




    <div class="modal fade" id="zoomInterviewModal" tabindex="-1" aria-labelledby="zoomInterviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="zoomInterviewModalLabel">{{ __('label.interview') }}</h5>
                </div>
                <div class="modal-body">
                    <form id="form-zoom" name="form-zoom" method="post">

                        @csrf
                        <div class="row">
                            <!-- Date Input -->
                            <div class="col-lg-12 col-sm-12">
                                <label for="date">
                                    {{ __('label.date') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker start_at" readonly="readonly"
                                        name="date" placeholder="" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12 col-sm-12">
                                <label for="time">
                                    {{ __('label.time') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group timepicker">
                                    <input type="time" class="form-control"
                                           name="time"

                                           placeholder=""/>

                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="user_id" id="userId">
                        <input type="hidden" name="job_id" id="jobId">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary meet_submit"><span class="hidden_class"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></span>
                        {{__('label.submit')}}
                        <div id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </div>
                    </button>

                </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>



    <script>
        $(document).ready(function() {

            $('.zoom_interview').on('click', function(e) {
                var userId = $(this).data('user_id');

                var job_id = $(this).data('job_id');
                $('#jobId').val(job_id);
                $('#userId').val(userId);

            });
            $('.chat_room').click(function() {
                var userId = $(this).data('user_id');

                var job_id = $(this).data('job_id');
                $('#job_id').val(job_id);
                $('#user_id').val(userId);


            });


            $('.submit_chat').click(function() {
                var job_id = $('#job_id').val();
                var userId = $('#user_id').val();

                $.ajax({
                    url: '{{ route('companies.chats.store') }}', // Adjust URL as necessary
                    method: 'POST',
                    data: {
                        user_id: userId,
                        job_id: job_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {


                        $('#messageModal').hide();
                        window.location.replace(response.data)

                    }

                });
            });



            $('.accept_users').click(function() {
                var userId = $(this).data('user_id');
                var job_id = $(this).data('job_id');
                $('#contract_job_id').val(job_id);
                $('#contract_user_id').val(userId);


            });
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "{{ __('validation.the_attachment_size_must_be_less_than_5_MB') }}");
            $("form[name='my-form']").validate({
                rules: {

                    start_date: {
                        required: true
                    },


                    end_date: {
                        required: true
                    },



                    sallary: {
                        required: true,
                    },
                    attachment: {
                        filesize: 5 * 1024 * 1024
                    }




                },
                messages: {
                    start_date: {
                        required: "{{ __('vaildation.start_date_required') }}"
                    },

                    end_date: {
                        required: "{{ __('vaildation.end_date_required') }}"
                    },
                    sallary: {
                        required: "{{ __('vaildation.salary_required') }}"

                    },




                },

                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



                    var data = new FormData(document.getElementById("my-form"));

                    $('.ckeditor').each(function() {
                        var editorId = $(this).attr('id');
                        var editorName = $(this).attr('name');
                        if (CKEDITOR.instances[editorId]) {
                            data.append(editorName, CKEDITOR.instances[editorId].getData());
                        }
                    });


                    $('#spinner').show();
                    $.ajax({
                        url: '{{ route('companies.jobs.appetUsers') }}',
                        type: "POST",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function(response) {
                            $('#spinner').hide();


                            if (response.status) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#contractModal').hide();
                                setTimeout(function() {
                                        window.location.reload()
                                    },
                                    2000);

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            }
                        },
                        error: function(response) {
                            $('#spinner').hide();

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



            $("form[name='form-zoom']").validate({
                rules: {

                    date: {
                        required: true
                    },


                    time: {
                        required: true
                    },








                },
                messages: {
                    date: {
                        required: "{{ __('vaildation.date_required') }}"
                    },

                    time: {
                        required: "{{ __('vaildation.time_required') }}"
                    },




                },

                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



                    var data = new FormData(document.getElementById("form-zoom"));


                    $('#spinner').show()
                    $('#hidden_class').hide()
                    $('.btn-primary').attr('disabled', true);


                    $.ajax({
                        url: '{{ route('companies.jobs.interview') }}',
                        type: "POST",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function(response) {

                            $('#zoomInterviewModal').hide();
                            $('#hidden_class').show()
                            $('.btn-primary').attr('disabled', false);

                            $('#spinner').hide();
                            if (response.status) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#contractModal').hide();
                                setTimeout(function() {
                                        window.location.reload()
                                    },
                                    2000);

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            }
                        },
                        error: function(response) {
                            $('#spinner').hide();
                            $('#hidden_class').show()

                            $('.btn-primary').attr('disabled', false);

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
        });
    </script>
@endsection
