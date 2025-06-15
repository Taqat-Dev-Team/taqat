@extends('layouts.admin')
@section('title')
    {{ __('label.users') }}
@endsection

@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* This makes the element circular */
            overflow: hidden;
            /* Ensures content inside the circle stays within bounds */
        }

        img {
            width: 100%;
            /* Ensures the image fills the circular container */
            height: auto;
            /* Maintains aspect ratio */
            display: block;
            /* Removes any extra space below the image */
        }


        .modal {
            overflow: visible !important;
        }

        /* تحسين ظهور الـ Dropdown فوق الـ Modal */
        .dropdown-menu {
            z-index: 1080 !important;
            position: absolute !important;
            will-change: transform;
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.view_all_users') }}</h1>
            </div>
            <div class="card-toolbar">

                @if (auth()->user()->can('add_users'))
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-1"> {{ __('label.add_new_user') }}
                    </a>
                @endif


                @if (auth()->user()->can('export_excel_user'))
                    <a href="#" target="_black" class="btn btn-success excel ">
                        {{ __('label.export_excel') }}
                    </a>
                @endif

                @if (auth()->user()->can('add_invoice'))
                    <button type="button" class="btn btn-warning ml-1 mr-1 add_all_invoiceModal">
                        {{ __('label.add_invoice') }}


                    </button>
                @endif

            </div>


        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <label for="coumpny_id">
                        {{ __('label.companies') }}
                    </label>
                    <select class="form-control select2" name="company_id" id="company_id">
                        <option value="">{{ __('label.select') }}</option>
                        @foreach ($companies as $value)
                            <option value="{{ $value->id }}" @if ($value->id == $company_id) selected @endif>
                                {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-3 col-sm-12">
                    <label for="displacement_place">
                        {{ __('label.displacement_place') }}
                    </label>
                    <select class="form-control select2" name="displacement_place" id="displacement_place">
                        <option value="">{{ __('label.select') }}</option>
                        <option value="['مدينة غزة', 'gaza']">{{ __('label.gaza') }}</option>
                        <option value=" ['شمال غزة', 'north']">{{ __('label.north_gaza') }}</option>
                        <option value=" ['خانيونس', 'khn']">{{ __('label.khan_Younes') }}</option>
                        <option value="['الوسطى', 'central', 'دير البلح', 'النصيرات', 'الزوايدة']">
                            {{ __('label.alwasta') }}</option>

                        <option value="['rafah', 'رفح']">{{ __('label.rafah') }} </option>


                    </select>
                </div>

                @if (!auth('admin')->user()->branch_id)
                    <div class="col-lg-3 col-sm-12">
                        <label for="branch_id">
                            {{ __('label.branches') }}
                        </label>
                        <select class="form-control select2" name="branch_id" id="branch_id">
                            <option value="">{{ __('label.select') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}" @if ($value->id == $branch_id) selected @endif>
                                    {{ $value->name }}</option>
                            @endforeach
                            <option></option>
                        </select>
                    </div>
                @endif


                <div class="col-lg-3 col-sm-12">
                    <label for="status">
                        {{ __('label.status') }}
                    </label>
                    <select class="form-control select2" name="status" id="status">
                        <option value="">{{ __('label.select') }}</option>
                        <option value="inside-hub" @if ($status == 'inside-hub') selected @endif>
                            {{ __('label.users_inside_hub_menu') }}</option>
                        <option value="non-hub" @if ($status == 'non-hub') selected @endif>
                            {{ __('label.users_no_hub_menu') }}</option>
                        <option value="non-active" @if ($status == 'non-active') selected @endif>
                            {{ __('label.users_not_avtive') }}</option>
                        <option value="under-verification" @if ($status == 'under-verification') selected @endif>
                            {{ __('label.users_under_verification') }}</option>

                        <option value="delete-hub" @if ($status == 'delete-hub') selected @endif>
                            {{ __('label.delete_users') }}</option>



                    </select>
                </div>



                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="permanent_type ">{{ __('label.permanent_type') }}

                        </label>
                        <select class="form-control" id="user_type_cd_id" name="user_type_cd_id">

                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($userTypes as $value)
                                <option value="{{ $value->id }}">{{ $value->value }} </option>
                            @endforeach

                        </select>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <label for="workplace_attendance ">{{ __('label.workplace_attendance') }}

                        </label>
                        <select class="form-control" id="search_workplace_attendance" name="workplace_attendance">

                            <option value="">{{ __('label.selected') }}</option>
                            <option value="full_time">
                                {{ __('label.full_time') }}</option>
                            <option value="part_time">
                                {{ __('label.part_time') }}</option>

                        </select>

                    </div>
                </div>


            </div>

            <div class="row mt-1">
                <div class="col-lg-4">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">{{ __('label.search') }}</button>
                </div>
            </div>

        </div>
        <!--begin::Table-->

        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <th style="width: 7%;"></th>
                        <th style="width: 10%;">{{ __('label.name') }} ({{ $user_count }})</th>
                        <th style="width: 10%;">{{ __('label.mobile') }}</th>


                        <th style="width: 10%;">{{ __('label.branch') }}</th>
                        <th style="width: 15%;">{{ __('label.total_invoice_not_paid') }}</th>
                        <th style="display: none;">{{ __('label.mobile') }}</th>
                        <th style="display: none;">{{ __('label.email') }}</th>
                        <th style="display: none;">{{ __('label.name') }}</th>
                        <th style="width: 10%;">{{ __('label.whatsapp') }}</th>

                        <th style="width: 7%;">{{ __('label.total_work_hours') }}</th>
                        <th style="width: 9%;">{{ __('label.placement_date') }}</th>
                        <th style="width: 9%;">رقم الحساب</th>
                        <th style="width: 9%;">{{ __('label.code_internet') }}</th>


                        <th style="width: 10%;">{{ __('label.call_whatsapp_count') }}</th>

                        <th style="width: 30%;">{{ __('label.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>

        <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تأكيد الاسترجاع</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        هل أنت متأكد أنك تريد استرجاع هذا المستخدم؟
                        <input type="hidden" id="restore_user_id" name="user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-success" id="confirmRestore">استرجاع</button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.users.modal.internet_subscription')

        @include('admin.users.modal.invoice')

        @include('admin.users.modal.notifications')

        @include('admin.users.modal.single_invoice')

        @include('admin.users.modal.add_work_space')

        <!-- Service List Modal -->
        @include('admin.users.modal.services')

        <!-- Add Service Modal -->

        @include('admin.users.modal.add_service')


        @include('admin.users.modal.expense')
        @include('admin.users.modal.add_expense')
        @include('admin.users.modal.add_invoice')
        @include('admin.users.modal.release')



    </div>

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
                    <form id="exemption-form" name="exemption-form" method="POST"
                        action="{{ route('admin.invoices.SendSms') }}">
                        @csrf
                        <input type="hidden" name="user_id" id="invoice_user_id">
                        <div class="mb-3">
                            <textarea name="message" class="form-control" id="exemptionMessage"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">تاكيد </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- User Details Modal -->
    <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel">بيانات المستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userDetails-form" name="userDetails-form" method="POST" action="">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" id="user_detail_user_id" name="user_id">

                        <div class="row mb-3">
                            <div class="col-md-3 text-center">
                                <div class="circle mx-auto mb-2" style="width:120px;height:120px;">
                                    <img id="user_identity_image" src="" alt="صورة الهوية"
                                        style="object-fit:cover;width:100%;height:100%;">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <strong>الاسم الأول:</strong>
                                        <span id="user_first_name"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>الاسم الثاني:</strong>
                                        <span id="user_second_name"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>الاسم الثالث:</strong>
                                        <span id="user_third_name"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>اسم العائلة:</strong>
                                        <span id="user_last_name"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>تاريخ الميلاد:</strong>
                                        <span id="user_birth_date"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>:رقم الهوية</strong>
                                        <span id="user_id_number"></span>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>حالة التحقق:</strong>
                                        <span id="user_verification_status"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 mb-2">
                                <label for="user_request_status"><strong>حالة الطلب:</strong></label>
                                <select id="user_request_status" name="is_verification" class="form-control"
                                    style="width: 100%">
                                    <option value="">اختر</option>

                                    <option value="3">مكتمل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> حفظ التغييرات
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                id="userDetailsSpinner"></span>
                        </button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">صورة الهوية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalPhoto" style="max-width:100%;max-height:400px;" />
                </div>
            </div>
        </div>
    </div>


    @include('Shared.delete')

    @include('admin.users.modal.add')
@endsection

@section('scripts')
    @include('admin.users.js.js')
@endsection
