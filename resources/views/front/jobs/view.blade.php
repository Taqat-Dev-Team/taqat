@extends('layouts.front')
@section('title')
    {{ __('label.show_job') }}
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
                                <span class="nav-text">وصف الوظيفة</span>
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
                                <span class="nav-text">متطلبات الوظيفة</span>
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
                                <span class="nav-text">تقديم عرض</span>
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

                                <form id="my-form" name="my-form" class="my-form" method="POST" action="#">
                                    @csrf

                                        <input type="hidden" name="job_id" value="{{$job->id}}">
                                        <div class="col-lg-12 col-sm-12">

                                            <label for="description">
                                                الوصف
                                            </label>

                                            <textarea class="form-control" name="description"></textarea>
                                        </div>

                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><span><i
                                                        class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                                تاكيد
                                                <div id="spinner" style="display: none;">
                                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                                </div>
                                            </button>


                                        </div>

                                </form>

                            </div>
                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Tab Content-->



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
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>



    <script>
           function handleAjaxFormSubmission(form, url, successCallback) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(form);

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: successCallback,
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.responseJSON.message || 'An error occurred',
                    });
                }
            });
        }

        $('#my-form').validate({
            rules: {
                description: {
                    required: true
                },

            },
            messages: {
                description: "الوصف  مطلوب",

            },
            submitHandler: function(form) {
                handleAjaxFormSubmission(form, '{{ route('front.jobs.store') }}', function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });

                    // $('#my-form').['0'].reset();

                });
            }
        });
    </script>
@endsection
