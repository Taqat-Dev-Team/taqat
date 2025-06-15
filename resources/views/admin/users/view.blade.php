@extends('layouts.admin')
@section('title')
    {{ __('label.user') }}
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
                                    <div class="symbol-label" style="background-image:url('{{ $user->getPhoto() }}')"></div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                                    <div class="text-muted">{{ $user->job }}</div>
                                    <div class="mt-2">
                                        {{-- {{$user}} --}}
                                        <a target="_blank" href="https://taqat-gaza.com/ar/talents/{{ $user->slug }}"
                                            class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">
                                            {{ __('label.profile_details') }}
                                        </a>
                                    </div>
                                </div>



                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{ __('label.email') }}:</span>
                                    <a href="mailto:{{ $user->email }}"
                                        class="text-muted text-hover-primary">{{ $user->email }}</a>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{ __('label.mobile') }}:</span>
                                    <span class="text-muted">{{ $user->mobile }}</span>
                                </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{ __('نوع المستخدم') }}:</span>
                                    <span class="text-muted">{{ $user->userTypes?->value??'غير محدد' }}</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{ __('label.original_place') }}:</span>
                                    <span class="text-muted">{{ $user->original_place }}</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('رصيد المحفظة')}}:</span>
                                    <span class="text-muted">{{ $user->wallet?->balance?? 0}}</span>
                                </div>
                            </div>
                            <!--end::Contact-->
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
                                <span class="card-label font-weight-bolder text-dark">{{ __('label.project_list') }}</span>
                                <span
                                    class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.total_projects') }}
                                    ({{ $user->projects->count() }})</span>
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
                                        @foreach ($user->projects as $project)
                                            <tr>
                                                <td class="p-0 py-4">
                                                    <div class="symbol symbol-50 symbol-light mr-5">
                                                        <span class="symbol-label">
                                                            <img src="{{ $project->getAttachment() }}" class="circle"
                                                                style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $project->title }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                        <span
                                                            class="font-weight-bolder text-dark-75">{{ $project->specializations ? $project->specializations->title : '-' }}</span>
                                                    </span>
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
                                <span
                                    class="card-label font-weight-bolder text-dark">{{ __('label.course_trining_menu') }}</span>
                                <span
                                    class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.course_trining_count') }}
                                    ({{ $user->courses->count() }})</span>
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
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->title }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                </td>

                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->start_date }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->end_date }}</a>
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
                                <span
                                    class="card-label font-weight-bolder text-dark">{{ __('label.scientific_certificates_menu') }}</span>
                                <span
                                    class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.scientific_certificates_count') }}
                                    ({{ $user->scientificCertificate->count() }})</span>
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
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->title }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>

                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->specialization }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->country }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->graduation_year }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
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
                                <span
                                    class="card-label font-weight-bolder text-dark">{{ __('label.work_experiences_list') }}</span>
                                <span
                                    class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.work_experiences_count') }}({{ $user->workExperiences->count() }})</span>
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
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->company_name }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>

                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->location }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->start_date }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->end_date }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                    </span>
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


                    @if (auth('admin')->user()->can('view_job_constrancts'))
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label font-weight-bolder text-dark">{{ __('label.job_contracts_list') }}</span>
                                    <span
                                        class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.job_contracts_count') }}
                                        ({{ $user->jobContracts->count() }})</span>
                                </h3>

                                <button href="#"
                                    class="btn btn-primary add_experience">{{ __('label.add_job_construct') }}</button>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-2">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-borderless table-vertical-center">
                                        <thead>
                                            <tr>
                                                <th> {{ __('label.name') }}</th>
                                                <th>{{ __('label.company_name') }}</th>
                                                <th>{{ __('label.value_employment_contract') }}</th>
                                                <th>{{ __('label.duration') }}</th>
                                                <th>{{ __('label.job_type') }}</th>
                                                <th>{{ __('label.date') }}</th>
                                                <th>{{ __('label.action') }}</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($user->jobContracts as $value)
                                                <tr>

                                                    <td class="p-0 py-4">

                                                        <div class="symbol symbol-50 symbol-light mr-5">
                                                            {{-- <span class="symbol-label"> --}}

                                                            <?php

                                                            $attachments = $value->getAttachment();
                                                            $extension = pathinfo($attachments, PATHINFO_EXTENSION);
                                                            $attachment = '';
                                                            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                                $attachment .= '<a href="' . $attachments . '" target="_blank"><img src="' . $attachments . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt=""></a>';
                                                            } elseif (in_array($extension, ['pdf'])) {
                                                                $attachment .=
                                                                    '<a href="' .
                                                                    $attachments .
                                                                    '" target="_blank">
                                                                                                                                                                                                                                                                                                             <i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius: 50%;font-size: 70px; color: red;"></i>
                                                                                                                                                                                                                                                                                                             </a>';
                                                            } else {
                                                                $attachment .= '<img src="' . asset('assets/default.png') . '" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;" class="img-thumbnail img-preview" id="imagePreview" alt="">';
                                                            }

                                                            echo $attachment;

                                                            ?>
                                                            <a href="#"
                                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->name }}</a>
                                                            <div><a class="text-muted font-weight-bold text-hover-primary"
                                                                    href="#">{{ $value->email }}</a></div>'

                                                        </div>
                                                        </a>
                                                    </td>

                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->company_name }}</a>
                                                        <span class="text-muted font-weight-bold d-block">

                                                        </span>
                                                    </td>



                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->sallary }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->duration }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>

                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->job_type }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->date }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>
                                                    </td>

                                                    <td class="pl-0">

                                                        {{--                                       <a  href="#"   class="edit_job_contract"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a> --}}

                                                        <a type="button" class="edit-btn edit_experience"
                                                            data-company_name="{{ $value->company_name }}"
                                                            data-sallary="{{ $value->sallary }}"
                                                            data-duration="{{ $value->duration }}"
                                                            data-job_type="{{ $value->job_type }}"
                                                            data-note="{{ $value->note }}"
                                                            data-date="{{ $value->date }}"
                                                            data-id="{{ $value->id }}"
                                                            data-photo="{{ $value->photo }}" data-toggle="modal"
                                                            data-target="#JobContractModal">
                                                            <span><i style="color: #66afe9"
                                                                    class="fas fa-edit"></i></span>
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
                    @endif

                    @if (auth('admin')->user()->can('view_income_movements'))
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label font-weight-bolder text-dark">{{ __('label.financial_transactions_menu') }}</span>
                                    <span
                                        class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.financial_transactions_count') }}
                                        ({{ $user->incomeMovements->count() }})</span>
                                </h3>

                            </div>
                            <div class="card-body py-2">

                                <!--end::Header-->
                                <div class="row">
                                    <div class="col-lg-3 col-sm6">
                                        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                            <label>{{ __('label.financial_transactions_count') }}</label>
                                            <span id="count_income">({{ $user->incomeMovements->count() }})</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm6">
                                        <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                            <label>{{ __('label.total_financial_transactions') }}</label>
                                            <span id="total_income">({{ $user->incomeMovements->sum('amount') }})</span>
                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-sm6">
                                        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                            <label>{{ __('label.max_financial_transactions') }}</label>
                                            <span id="max_income">({{ $user->incomeMovements->max('amount') }})</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-3 col-sm6">
                                        <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                                            <label>{{ __('label.min_financial_transactions') }}</label>
                                            <span id="min_income">({{ $user->incomeMovements->min('amount') }})</span>
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


                                                <th>{{ __('label.source') }}</th>
                                                <th>{{ __('label.amount') }}</th>
                                                <th>{{ __('label.date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($user->incomeMovements as $value)
                                                <tr>

                                                    <td class="p-0 py-4">
                                                        <div class="symbol symbol-50 symbol-light mr-5">
                                                            <span class="symbol-label">
                                                                <a href="{{ $value->getAttachment() }}" target="_blank">
                                                                    <img src="{{ $value->getAttachment() }}"
                                                                        class="circle"
                                                                        style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">
                                                            </span>

                                                            </a>
                                                        </div>
                                                    </td>

                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->source }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->amount }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->date }}</a>
                                                        <span class="text-muted font-weight-bold d-block">
                                                        </span>
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
                    @endif



                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h1 class="card-label">{{ __('label.display_all_attendance_logs') }}</h1>
                            </div>
                            <div class="card-toolbar">
                                <a class="btn btn-success export_excel">
                                    {{ __('label.export_excel') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6 col-sm6">
                                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                        <label>{{ __('label.total_work_hours') }}</label>
                                        <span id="total_work_hours"></span>
                                    </div>
                                </div>





                            </div>

                        </div>
                        <div class="form-group row m-1">











                            <div class="col-lg-6">
                                <label> {{ __('label.start_date') }}:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker start_date" readonly="readonly"
                                        name="start_date" placeholder="" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <label> {{ __('label.end_date') }}:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker end_date" readonly="readonly"
                                        name="end_date" placeholder="" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="form-group row m-2">
                            <div class="col-lg-4">
                                <button class="btn btn-primary" id="btnFiterSubmitSearch">بحث</button>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-head-custom table-vertical-center log-table">
                                <thead>

                                    <tr class="text-left">
                                        {{-- <th></th>
                                        <th>{{ __('label.name') }}</th>
                                        <th>{{ __('label.mobile') }}</th> --}}
                                        <th>{{ __('label.date') }}</th>
                                        <th>{{ __('label.time_in') }}</th>
                                        <th>{{ __('label.time_out') }}</th>
                                        <th>{{ __('label.Duration_of_work') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">{{ __('label.invoices') }}</span>
                                <span
                                    class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.view_all_invoices') }}
                                    ({{ $user->invoices->count() }})</span>
                            </h3>

                        </div>
                        <div class="card-body py-2">

                            <!--end::Header-->

                            <div class="row">


                                <div class="col-lg-6 col-sm6">
                                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                        <label>{{ __('label.total_invoice') }}</label>
                                        <span id="total_invoice"></span>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-sm6">
                                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                        <label>{{ __('label.total_payment') }}</label>
                                        <span id="total_payment"></span>
                                    </div>


                                </div>

                            </div>

                            <div class="form-group row m-1">


                                <div class="col-lg-6">
                                    <label>{{ __('label.from_date') }}</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" value=""
                                            readonly="readonly" name="start_date" id="start_date" placeholder="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('label.to_date') }}</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" value=""
                                            readonly="readonly" name="end_date" id="end_date" placeholder="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <div class="col-lg-4">
                                    <button class="btn btn-primary invocie_submit" id="searchOrderTable"
                                        type="button">{{ __('label.search') }}</button>

                                </div>
                            </div>


                            <!--begin::Body-->
                            <!--begin::Table-->
                            <table class="table table-head-custom table-vertical-center invoice_table" id="invoice_table">
                                <thead>
                                    <tr class="text-left">
                                        <th></th>
                                        <th>{{ __('label.name') }}</th>
                                        <th>{{ __('label.amount') }}</th>
                                        <th>{{ __('label.status') }}</th>
                                        <th>{{ __('label.created_at') }}</th>
                                        <th>{{ __('label.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <br>
                    @if ($user->userLogWhatsappClicks->count() > 0)
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label font-weight-bolder text-dark">{{ __('label.whatsapp') }}</span>
                                    <span
                                        class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.view_call_whatsapp') }}
                                        ({{ $user->userLogWhatsappClicks->count() }})</span>
                                </h3>

                            </div>
                            <div class="card-body py-2">

                                <!--end::Header-->



                                <div class="form-group row m-1">





                                    <!--begin::Body-->
                                    <!--begin::Table-->
                                    <table class="table table-head-custom table-vertical-center ">
                                        <thead>
                                            <tr class="text-left">
                                                <th>{{ __('label.browser') }}</th>
                                                <th>{{ __('label.os') }}</th>
                                                <th>{{ __('label.device') }}</th>
                                                <th>{{ __('label.country') }}</th>
                                                <th>{{ __('label.ip_address') }}</th>
                                                <th>{{ __('label.city') }}</th>
                                                <th>{{ __('label.region') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->userLogWhatsappClicks as $value)
                                                <tr>
                                                    <td>{{ $value->browser }}</td>
                                                    <td>{{ $value->os }}</td>
                                                    <td>{{ $value->device }}</td>
                                                    <td>{{ $value->country }}</td>
                                                    <td>{{ $value->ip_address }}</td>
                                                    <td>{{ $value->city }}</td>
                                                    <td>{{ $value->region }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Body-->
                            </div>
                    @endif

                    <br>
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h1 class="card-label">عرض كافة الطلبات</h1>
                            </div>

                        </div>
                        <div class="card-body">






                            <div class="table-responsive mt-3">
                                <table class="table table-head-custom table-vertical-center orders_table">
                                    <thead>

                                        <tr class="text-left">
                                            <th></th>

                                            <th>{{ __('label.name') }}</th>
                                            <th>{{ __('label.restaurant_name') }}</th>
                                            <th>{{ __('label.price') }}</th>
                                            <th>{{ __('label.quantity') }}</th>
                                            <th>{{ __('label.total_price') }}</th>
                                            <th>{{ __('label.date') }}</th>
                                            <th>{{ __('label.status') }}</th>

                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>






                    </div>
                    <br>


                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h1 class="card-label">سجل الحركات المحفظة </h1>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-primary" id="addWalletBalanceBtn"
                                    data-toggle="modal" data-target="#addWalletBalanceModal">
                                    <i class="fa fa-plus"></i> إضافة رصيد إلى المحفظة
                                </button>
                            </div>
                        </div>
                        <div class="card-body">




                            <h6><h


                            <div class="table-responsive mt-3">
                                <table class="table table-head-custom table-vertical-center wallet-table">
                                    <thead>

                                        <tr class="text-left">
                                            <th></th>
                                            <th>{{ __('label.amount') }}</th>
                                            <th>{{ __('label.status') }}</th>
                                            <th>{{ __('label.date') }}</th>
                                            <th></th>

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

        </div>


        <!-- Add Wallet Balance Modal -->
        <div class="modal fade" id="addWalletBalanceModal" tabindex="-1" role="dialog"
            aria-labelledby="addWalletBalanceModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWalletBalanceModalLabel">{{ __('إضافة رصيد إلى المحفظة') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addWalletBalanceForm" name="addWalletBalanceForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user->id}}" required>

                                <label for="wallet_amount">{{ __('المبلغ') }}</label>
                                <input type="number" class="form-control" id="wallet_amount" name="amount" min="0" required>
                            </div>
                            <input type="hidden" value="{{$user->id}}" name="user_id" >
                            <div class="form-group">
                                <label for="wallet_photo">{{ __('المرفق') }}</label>
                                <input type="file" class="form-control" id="wallet_photo" name="photo"  accept="image/*,.pdf">
                                <div class="text-muted" style="color:gray">يجب أن يكون المرفق أقل من 2 ميجا</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('إضافة الرصيد') }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('إغلاق') }}</button>
                        </div>
                    </form>
                </div>
                <div>
                    <div>
                    </div>
                </div>
            </div>
        </div>

                        <div class="modal fade" id="JobContractModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ __('label.Contract_details') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Include the form you posted here -->
                                        <form class="needs-validation" id="my-form" name="my-form" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="alert alert-danger" style="display:none"></div>

                                            <!-- Your form fields go here -->
                                            <!-- (Form as you posted) -->
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <input type="hidden" name="job_construct_id" class="form-control"
                                                        id="job_construct_id" value="{{ old('job_constranct_id') }}">
                                                    <input type="hidden" name="user_id" class="form-control"
                                                        id="user_id" value="{{ $user->id }}">

                                                    <label for="company_name">
                                                        {{ __('label.company_name') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="company_name" class="form-control"
                                                        id="company_name" value="{{ old('company_name') }}"
                                                        placeholder="">

                                                    <div class="company_name error"></div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">

                                                    <label for="sallary">
                                                        {{ __('label.salary') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" min="0" name="sallary"
                                                        class="form-control" id="sallary"
                                                        value="{{ old('sallary') }}" placeholder="">

                                                    {{-- <div  --}}
                                                    <div class="sallary error"></div>

                                                </div>


                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-6 col-sm-12">


                                                    <label for="date">
                                                        {{ __('label.date') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control datepicker start_at "
                                                            readonly="readonly" name="date" placeholder="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="date error"></div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">


                                                    <label for="duration">
                                                        {{ __('label.duration') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="duration" class="form-control"
                                                        id="duration" value="{{ old('duration') }}" placeholder="">
                                                    <div class="duration error"></div>



                                                </div>


                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="job_type">
                                                        نوع العقد
                                                        <span class="text-danger">*</span>

                                                    </label>


                                                    <select class="form-control job_type" name="job_type" id="job_type"
                                                        style="width: 100%">
                                                        <option value="">اختر</option>

                                                        <option value="عقد شركة">عقد شركة</option>
                                                        <option value="عقد مشروع">عقد مشروع</option>

                                                    </select>
                                                    {{-- <div  --}}
                                                    <div class="sallary error"></div>


                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="photo">
                                                        المرفق

                                                    </label>
                                                    <input class="form-control photo" type="file"
                                                        accept="image/*,.pdf" name="photo" id="photo">
                                                    <div class="" style="color:gray">يجيب ان يكون المرفق اقل من 2
                                                        ميجا </div>

                                                    <div class="error photo">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-12 col-sm-12">

                                                    <label for="note">

                                                        {{ __('label.note') }}
                                                        <span class="text-danger">*</span>
                                                    </label>






                                                    <textarea id="description" class="form-control" name="description"></textarea>
                                                    <div class="description error"></div>




                                                </div>
                                            </div>



                                            <div class="modal-footer">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ __('label.invocie_submit') }}</button>
                                                <div id="spinner" style="display: none;">
                                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="invoiceModalLabel">حالة الفاتورة الشهرية</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>
                                    <form class="needs-validation " id="my-invoice" name="my-invoice" method="POST"
                                        enctype="multipart/form-data">

                                        <div class="modal-body">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="amount" class="form-label">المبلغ</label>
                                                    <input type="number" class="form-control" id="amount"
                                                        name="amount" min="1" placeholder="أدخل المبلغ">
                                                </div>


                                                <div class="col-lg-6 col-sm-12">
                                                    <label for="amout_type">
                                                        العملة
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-control amout_type" name="amout_type"
                                                        id="amout_type" required style="width: 100%">
                                                        <option value="">{{ __('label.amount_type') }}</option>
                                                        @foreach ($currencies as $value)
                                                            <option value="{{ $value->id }}">{{ $value->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="amout_type error"></div>
                                                </div>
                                            </div>
                                            <div class="row">



                                                <div class="col-lg-6 col-sm-12">
                                                    <label>{{ __('label.start_date') }}</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control datepicker"
                                                            value="" readonly="readonly" name="expiration_date"
                                                            id="expiration_date" placeholder="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label>{{ __('label.end_date') }}</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control datepicker"
                                                            value="" readonly="readonly" name="due_date"
                                                            id="due_date" placeholder="" required />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">


                                                <div class="col-lg-6 col-sm-12">

                                                    <label for="status" class="form-label fw-bold">الحالة</label>
                                                    <select class="form-control form-select status" id="status"
                                                        name="status" aria-label="اختر الحالة" required
                                                        style="width: 100%">
                                                        <option value="">اختر</option>
                                                        <option value="0" class="text-danger">غير مدفوع</option>
                                                        <option value="1" class="text-success">مدفوع</option>
                                                        <option value="2" class="text-warning">قيد الانتظار</option>
                                                        <option value="3" class="text-muted">ملغى</option>
                                                    </select>
                                                    <div class="invalid-feedback">يرجى اختيار الحالة</div>
                                                </div>
                                                <input type="hidden" class="form-control" id="invoce_id"
                                                    name="invoce_id" placeholder="">


                                            </div>





                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><span><i
                                                        class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                                تاكيد

                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">إغلاق</button>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('Shared.delete')


                        <div class="modal fade" id="exemptionModal" tabindex="-1" aria-labelledby="exemptionModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exemptionModalLabel">اشعار (Sms)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Content dynamically added here -->
                                        <form id="exemptionForm" method="POST"
                                            action="{{ route('admin.invoices.SendSms') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" id="invoice_user_id">

                                            <div class="mb-3">

                                                <textarea name="message" class="form-control" id="message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">تاكيد </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Edit Wallet Modal -->
                        <div class="modal fade" id="editWalletModal" tabindex="-1" role="dialog"
                            aria-labelledby="editWalletModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editWalletModalLabel">{{ __('تعديل حركة المحفظة') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="editWalletForm" name="editWalletForm" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="wallet_id" id="edit_wallet_id">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_wallet_amount">{{ __('المبلغ') }}</label>
                                                <input type="number" class="form-control" id="edit_wallet_amount"
                                                    name="amount" min="0" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_wallet_status">{{ __('الحالة') }}</label>
                                                <select class="form-control" id="edit_wallet_status" name="status_cd_id"
                                                    style="width: 100%" required>
                                                    <option value="">{{ __('اختر الحالة') }}</option>
                                                    <option value="0">{{ __('غير مدفوع') }}</option>
                                                    <option value="1">{{ __('تم الدفع') }}</option>
                                                    <option value="2">{{ __('قيد الانتظار') }}</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_wallet_attachment">{{ __('المرفق') }}</label>
                                                <input type="file" class="form-control" id="edit_wallet_attachment"
                                                    name="attachment" accept="image/*,.pdf">
                                                <div id="edit_wallet_attachment_preview" class="mt-2"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('حفظ التعديلات') }}</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('إغلاق') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        @include('admin.orders.modal.view')



                    @endsection
                    @section('scripts')
                        @include('admin.users.js.view')
                    @endsection
