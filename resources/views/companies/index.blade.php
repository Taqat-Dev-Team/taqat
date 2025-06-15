@extends('layouts.companies')

@section('title', __('label.main'))
@section('content')

    <div class="row col-12">

        <div class="col-lg-4 ">


            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5 bg-light">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('label.job_constrancts_apply') }}</span>

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
                                    <th class="p-0"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apply_Jobs as $value)
                                    <tr>
                                        <td class="pl-0 py-4 d-flex align-items-center">
                                            <!-- User Profile Link -->
                                            <a href="https://taqat-gaza.com/talents/{{ $value->users?$value->users->slug:'' }}"
                                                class="d-inline-block mr-3">
                                                <img src="{{ $value->users->photo }}" alt="User Photo"
                                                    class="rounded-circle"
                                                    style="object-fit: cover; width: 50px; height: 50px;">
                                            </a>

                                            <!-- User Details -->
                                            <div class="d-flex flex-column">
                                                <!-- User Name -->
                                                <span class="text-muted font-size-sm">
                                                    {{ $value->users->name ?? 'Unknown User' }}
                                                </span>

                                                <a href="{{ route('companies.jobs.views', $value->id) }}"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">

                                                    {{ $value->jobs ? $value->jobs->title : 'No Project Assigned' }}
                                                </a>
                                                <!-- Optional: Add more details or a short description -->

                                            </div>
                                        </td>

                                        <td class="pl-0">

                                            {{ $value->cost }}
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

        <div class="col-lg-4 ">


            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5 bg-light">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('label.dispaly_last_offers') }}</span>

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
                                    <th class="p-0"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offers as $value)
                                    <tr>
                                        <td class="pl-0 py-4 d-flex align-items-center">
                                            <!-- User Profile Link -->
                                            <a href="https://taqat-gaza.com/talents/{{ $value->users?$value->users->slug:'' }}"
                                                class="d-inline-block mr-3">
                                                <img src="{{ $value->users->photo }}" alt="User Photo"
                                                    class="rounded-circle"
                                                    style="object-fit: cover; width: 50px; height: 50px;">
                                            </a>

                                            <!-- User Details -->
                                            <div class="d-flex flex-column">
                                                <!-- User Name -->
                                                <span class="text-muted font-size-sm">
                                                    {{ $value->users->name ?? 'Unknown User' }}
                                                </span>

                                                <a href="{{ route('companies.projects.views', $value->project_id) }}"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">

                                                    {{ $value->project ? $value->project->title : 'No Project Assigned' }}
                                                </a>
                                                <!-- Optional: Add more details or a short description -->

                                            </div>
                                        </td>

                                        <td class="pl-0">

                                            {{ $value->cost }}
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

        <div class="col-lg-4">


            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom shadow-sm">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5 bg-light">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ __('label.interviews') }}</span>
                        <span class="text-muted mt-3 font-weight-normal font-size-sm">
                            <!-- Optional subtitle or additional information -->
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
                                @foreach (App\Models\JobInterView::query()->where('company_id', auth('company')->id())->take(5)->get() as $value)
                                    <tr>

                                        <td class="p-2">
                                            <a href="https://taqat-gaza.com/ar/talents/{{ $value->users?$value->users->slug:'' }}"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $value->users?->name }}</a>
                                            <div><a class="text-muted font-weight-bold text-hover-primary"
                                                    href="#">{{ $value->company->name }}</a></div>
                                            <div><a class="text-muted font-weight-bold text-hover-primary"
                                                    href="#">{{ $value->created_at->format('Y-m-d') }}</a></div>


                                        </td>


                                        <td class="p-2">
                                            <a href="{{ $value->zoom_url }}" class="btn btn-success btn-sm"
                                                target="_blank">
                                                {{ __('label.url_meet') }}
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

            <!--end::Advance Table Widget 2-->
        </div>

    </div>

</br>
    {{-- <div class="row col-12"> --}}
        <div class="row col-12">

    <div class="card card-custom row col-12">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5 bg-light">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('label.display_all_attendance_departure') }}</span>

            </h3>

        </div>

    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">
                    <th></th>

                    <th>{{ __('label.name') }}</th>
                    <th>{{ __('label.date') }}</th>
                    <th>{{ __('label.presence_date') }}</th>
                    <th>{{ __('label.absence_date') }}</th>
                    <th>{{ __('label.work_hours_count') }}</th>


                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    </div>
@endsection
@section('scripts')





@include('companies.attendances.js.js')




@endsection
