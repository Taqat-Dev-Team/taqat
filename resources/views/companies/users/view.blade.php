@extends('layouts.companies')
@section('title')
الموظف -عرض
@endsection
@section('sub_page')
|<a href="{{route('companies.users.index')}}">الموظفين</a>
@endsection
@section('title_pages')
|اضافةبيانات الموظف
@endsection
@section('total_page')
عدد الموظفين({{$employee_count}})
@endsection

@section('content')
    <!--end::Header-->
    <!--begin::Content-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>

                                </div>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                    <div class="symbol-label" style="background-image:url('{{$user->getPhoto()}}')">
                                    </div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$user->name}}</a>
                                    <div class="text-muted">{{ $user->job }}</div>
                                    <div class="mt-2">
                                        {{-- <a href="#"
                                            class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                                        <a href="#"
                                            class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a> --}}
                                    </div>
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('label.email')}}:</span>
                                    <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('label.mobile')}}:</span>
                                    <span class="text-muted">{{ $user->mobile }}</span>
                                </div>


                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('label.original_place')}}:</span>
                                    <span class="text-muted">{{ $user->original_place }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2 ">
                                    <span class="font-weight-bold mr-2">{{__('label.displacement_place')}}:</span>
                                    <span class="text-muted">{{ $user->displacement_place }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2 ">
                                    <span class="font-weight-bold mr-2">{{__('label.marital_status')}}:</span>
                                    <span class="text-muted">{{ $user->marital_status }}</span>
                                </div>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <!--begin::Row-->
                <div class="col-lg-8">

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.projects_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.projects_count')}}  ({{$user->projects->count()}})</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 50px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 160px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->projects as $value)

                                        <tr>
                                            <td class="p-0 py-4">
                                                <div class="symbol symbol-50 symbol-light mr-5">
                                                    <span class="symbol-label">
                                                        <img src="{{$value->getAttachment()}}" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->title}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                                <span class="font-weight-bolder text-dark-75">{{$value->specializations?$value->specializations->title:''}}</span>
                                            </td>

                                            <td class="p-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>

                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
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


                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.course_trining_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.course_trining_count')}} ({{$user->courses->count()}})</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 170px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->courses as $value)

                                        <tr>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->title}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->start_date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->end_date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="p-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>

                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
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


                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.scientific_certificates_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.scientific_certificates_count')}} ({{$user->scientificCertificate->count()}})</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 170px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->scientificCertificate as $value)

                                        <tr>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->title}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->specialization}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->country}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->graduation_year}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="p-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>

                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
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


                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.work_experiences_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.work_experiences_count')}}  ({{$user->workExperiences->count()}})</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 170px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>
                                            <th class="p-0" style="min-width: 120px"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->workExperiences as $value)

                                        <tr>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->company_name}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->location}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->start_date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->end_date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="p-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>

                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
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


                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.employment_contracts_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.employment_contracts_count')}}  ({{$user->jobContracts->count()}})</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 170px"></th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.company_name')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.permanent_type')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.date')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.duration')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.sallary')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->jobContracts as $value)

                                        <tr>

                                            <td class="p-0 py-4">
                                                <a href="{{$value->getPhoto()}}" target="_blank">

                                                <div class="symbol symbol-50 symbol-light mr-5">
                                                    <span class="symbol-label">
                                                        <img src="{{$value->getPhoto()}}" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">                                                    </span>
                                                </div>
                                                </a>
                                            </td>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->company_name}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->job_type}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->duration}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->sallary}}</a>
                                                <span class="text-muted font-weight-bold d-block">
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


                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{__('label.financial_transactions_menu')}}</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">{{__('label.financial_transactions_count')}}  ({{$user->incomeMovements->count()}})</span>
                            </h3>

                        </div>
                        <div class="card-body py-2">

                        <!--end::Header-->
                        <div class="row">
                            <div class="col-lg-3 col-sm6">
                                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                    <label>{{__('label.financial_transactions_count')}}</label>
                                    <span id="count_income">({{$user->incomeMovements->count()??0}})</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm6">
                                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                    <label>{{__('label.total_financial_transactions')}}</label>
                                    <span id="total_income">({{$user->incomeMovements->sum('amount')??0}})</span>
                                </div>

                            </div>

                            <div class="col-lg-3 col-sm6">
                                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                    <label>{{__('label.max_financial_transactions')}}</label>
                                    <span id="max_income">({{$user->incomeMovements->max('amount')??0}})</span>
                                </div>


                            </div>
                            <div class="col-lg-3 col-sm6">
                                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                                    <label>{{__('label.min_financial_transactions')}}</label>
                                    <span id="min_income">({{$user->incomeMovements->min('amount')??0}})</span>
                                </div>

                            </div>
                        </div>

                        <!--begin::Body-->
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="p-0" style="width: 170px"></th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.name')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.transfer_value')}}</th>
                                            <th class="p-0" style="min-width: 120px">{{__('label.date')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->incomeMovements as $value)

                                        <tr>

                                            <td class="p-0 py-4">
                                                <div class="symbol symbol-50 symbol-light mr-5">
                                                    <span class="symbol-label">
                                                        <a href="{{$value->getPhoto()}}" target="_blank">
                                                        <img src="{{$value->getPhoto()}}" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">                                                    </span>

                                                        </a>
                                                    </div>
                                            </td>

                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->source}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->amount}}</a>
                                                <span class="text-muted font-weight-bold d-block">
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$value->date}}</a>
                                                <span class="text-muted font-weight-bold d-block">
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

            </div>

        </div>

    </div>



@endsection
@section('scripts')
{{-- @include('admin.users.js.view') --}}
@endsection
