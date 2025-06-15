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
                <h1 class="card-label">{{ __('label.dispaly_all_expense') }}</h1>
            </div>

            <div class="card-toolbar">

                <a href="#" class="btn btn-success mr-1 add_expense">
                    <i class="fa fa-plus"></i>
                اضافة سند صرف جديد
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
                <div class="col-lg-4">
                    <label>{{ __('label.users') }}</label>

                    <select id="user_id" name="user_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="0">{{ __('label.selected') }}</option>

                        @foreach ($users as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-4">
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

                <div class="col-lg-4">
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

            </div>

            <div class="form-group row m-2">
                <div class="col-lg-3 d-flex align-items-end">
                    <button class="btn btn-primary me-2 m-1" id="searchTable">{{ __('label.search') }}</button>
                    <button class="btn btn-success me-2 m-1" id="exportExcel">{{ __('label.export_excel') }}</button>
                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.amount') }}</th>
                            <th>{{ __('label.start_date') }}</th>
                            <th>{{ __('label.end_date') }}</th>
                            <th>{{ __('label.payment_method') }}</th>
                            <th>{{ __('label.actions') }}</th>


                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>



        @include('admin.expenses.modal.add')

        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.expenses.js.js')
    @endsection
