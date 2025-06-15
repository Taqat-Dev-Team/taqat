@extends('layouts.admin')
@section('title')
    {{ __('label.invoices') }}
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
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.view_all_invoices') }}</h1>
            </div>

            <div class="card-toolbar">

                <a href="#" class="btn btn-dark mr-1 send_sms">
                    <i class="fa fa-sms"></i>
                    ارسال رسالة(SMS)
                </a>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.user_count') }}</label>
                        <span id="user_count"></span>
                    </div>
                </div>

                <div class="col-lg-4 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>{{ __('label.total_invoice') }}</label>
                        <span id="total_invoice"></span>
                    </div>

                </div>

                <div class="col-lg-4 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.total_payment') }}</label>
                        <span id="total_payment"></span>
                    </div>


                </div>

            </div>

            <div class="form-group row m-1">
                <div class="col-lg-3">
                    <label>{{ __('label.users') }}</label>

                    <select id="user_id" name="user_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="0">{{ __('label.selected') }}</option>

                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-3">
                    <label>{{ __('label.from_date') }}</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="start_date" id="start_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <label>{{ __('label.to_date') }}</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="end_date" id="end_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>{{ __('label.status') }}</label>
                    <select id="status_id" name="status_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="4" class="text-danger">غير مدفوع</option>
                        <option value="1" class="text-success">مدفوع</option>
                        <option value="2" class="text-warning">قيد الانتظار</option>
                        <option value="3" class="text-muted">ملغى</option>


                    </select>
                </div>
            </div>

            <div class="form-group row m-1">






                @if (!auth()->user()->branch_id)
                    <div class="col-lg-3">
                        <label>{{ __('label.branch') }}</label>
                        <select id="branch_id" name="branch_id" class="form-control select2">
                            <option value="">{{ __('label.selected') }}</option>
                            <option value="0">{{ __('label.selected') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif


                <div class="col-lg-3">
                    <label>حالات اعفاء</label>
                    <select id="exemption" name="exemption" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="1" class="text-success">طلبات الاعفاء</option>


                    </select>
                </div>

                <div class="col-lg-3">
                    <label>فواتير منتهية</label>
                    <select id="expiration_date" name="expiration_date" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="1" class="text-success">فواتير منتهية</option>


                    </select>
                </div>


            </div>
            <div class="form-group row m-2">
                <div class="col-lg-4">
                    <button class="btn btn-primary submit_serach" id="searchTable"
                        type="button">{{ __('label.search') }}</button>

                    <button class="btn btn-success export_excel" type="submit">{{ __('label.export_excel') }}</button>

                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th></th>

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.mobile') }}</th>

                            <th>{{ __('label.branch') }}</th>
                            <th>{{ __('label.amount') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.created_at') }}</th>
                            <th>{{ __('label.expiration_date') }}</th>
                            <th>{{ __('label.due_date') }}</th>
                            <th>{{ __('label.actions') }}</th>


                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>




        <!-- مودال SendSmsModal -->
        <div class="modal fade" id="sendSmsModal" tabindex="-1" aria-labelledby="sendSmsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendSmsModalLabel">تنبيه للفواتير المستحقة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="send_sms" method="POST" name="send_sms"
                            action="{{ route('admin.invoices.sendInvoiceSms') }}">
                            @csrf
                            <div class="mb-3">
                                <textarea name="message" class="form-control" id="sendSmsMessage"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">تاكيد </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- مودال InvoiceModal -->
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
                    <form class="needs-validation" id="my-invoice" name="my-invoice" method="POST"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="amount" class="form-label">المبلغ</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        min="1" placeholder="أدخل المبلغ">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="amout_type">العملة</label>
                                    <select class="form-control amout_type" name="amout_type" id="amout_type" required
                                        style="width: 100%">
                                        <option value="">اختر</option>
                                        <option value="1">دولار</option>
                                        <option value="2">شيكل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label>تاريخ الاستحقاق</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" readonly="readonly"
                                            name="expiration_date" id="edit_expiration_date" placeholder="" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label>تاريخ الانتهاء</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" readonly="readonly"
                                            name="due_date" id="edit_due_date" placeholder="" />
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

                                    <label for="photo" class="form-label">الصورة</label>
                                    <input type="file" accept="image/*" class="form-control" id="photo"
                                        name="photo" placeholder="">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="status" class="form-label fw-bold">الحالة</label>
                                    <select class="form-control form-select status" id="status" name="status"
                                        required style="width: 100%">
                                        <option value="">اختر</option>
                                        <option value="0" class="text-danger">غير مدفوع</option>
                                        <option value="1" class="text-success">مدفوع</option>
                                        <option value="2" class="text-warning">قيد الانتظار</option>
                                        <option value="3" class="text-muted">ملغى</option>
                                    </select>
                                </div>

                                <input type="hidden" class="form-control" id="invoce_id" name="invoce_id">
                            </div>

                            <div class="row payment_type_block" style="display: none" id="payment_type_block">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="status" class="form-label fw-bold">طريقة الدفع</label>
                                    <select class="form-control form-select status" id="payment_type_id"
                                        name="payment_type_id" required style="width: 100%">
                                        <option value="">اختر</option>
                                        @foreach ($paymentTypes as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span> تاكيد </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- مودال ExemptionModal -->
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



<!-- Photo Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel">صورة الفاتورة</h5>
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

@endsection

@section('scripts')
    @include('admin.invoices.js.js')
@endsection
