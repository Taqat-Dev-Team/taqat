@extends('layouts.front')
@section('title')
    {{ __('label.invoices') }}
@endsection

@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* This makes the element circular */
            overflow: hidden; /* Ensures content inside the circle stays within bounds */
        }
        img {
            width: 100%; /* Ensures the image fills the circular container */
            height: auto; /* Maintains aspect ratio */
            display: block; /* Removes any extra space below the image */
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.view_all_invoices') }}</h1>
            </div>

        </div>
        <div class="card-body">
            <div class="row">


                <div class="col-lg-6 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>{{__('label.total_invoice')}}</label>
                        <span id="total_invoice"></span>
                    </div>

                </div>
                <div class="col-lg-6 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.total_payment')}}</label>
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
                    <button class="btn btn-primary submit" id="searchTable" type="button">{{ __('label.search') }}</button>

                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th ></th>

                            <th >{{ __('label.name') }}</th>
                            <th >{{ __('label.amount') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.created_at') }}</th>
                            <th>{{ __('label.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


    </div>


    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">مرفق الخاص بالفاتورة الشهرية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="my-invoice" name="my-invoice" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 row">
                            <label for="amount" class="form-label fw-bold">المبلغ</label>
                            <input type="number" min="1" readonly name="amount" class="form-control" id="amount">
                        </div>
                        <div class="mb-3 ">
                            <label for="photo" class="form-label">الصورة</label>
                            <input type="file" accept="image/*" class="form-control" id="photo" name="photo" placeholder="">
                        </div>
                        <input type="hidden" class="form-control" id="invoce_id" name="invoce_id" placeholder="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                            تاكيد
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Exemption Modal -->
    {{-- <div class="modal fade" id="exemptionModal" tabindex="-1" aria-labelledby="exemptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exemptionModalLabel">طلب اعفاء من الرسوم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content dynamically added here -->
                    <form id="exemptionForm" method="POST" action="{{route('front.invoices.exemption')}}">
                        @csrf
                        <input type="hidden" name="invoice_id" id="invoice_id">

                        <div class="mb-3">
                            <p><strong>تنبيه:</strong> يسمح لك باستخدام هذه الخاصية فقط 3 مرات فقط ولا يمكن استخدامها بعد ذلك.</p>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">إرسال الطلب</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}



@endsection

@section('scripts')
    @include('front.invoices.js.js')
@endsection
