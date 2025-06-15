@extends('layouts.admin')
@section('title')
    {{ __('label.attendance_logs') }}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.display_all_attendance_logs') }}</h1>
            </div>
            <div class="card-toolbar">


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
                        <label>{{ __('label.presence_count') }}</label>
                        <span id="presence_count"></span>
                    </div>

                </div>
                <div class="col-lg-4 col-sm6">

                    <div class="col bg-light-danger px-6 py-8 rounded-2 mb-7">
                        <label>{{ __('label.work_hours_count') }}</label>
                        <span id="log_hours"></span>
                    </div>
                </div>


                {{-- <div class="col-lg-4 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.absence_count') }}</label>
                        <span id="absence_count"></span>
                    </div>


                </div> --}}

            </div>

        </div>
        <div class="form-group row m-1">


            <div class="col-lg-3">
                <label>{{ __('label.users') }}:</label>
                <select class="form-control select2" name="user_id[]" id="user_id" multiple>
                    <option value="">{{ __('label.selected') }}</option>

                    @foreach ($users as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label>{{ __('label.permanent_type') }}:</label>
                <select class="form-control select2" name="user_type" id="user_type" >
                    <option value="">{{ __('label.selected') }}</option>

                    @foreach ($userTypes as $value)
                        <option value="{{ $value->id }}">{{ $value->value }}</option>
                    @endforeach
                </select>
            </div>









            <div class="col-lg-3">
                <label> {{ __('label.date') }}:</label>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker start_at" readonly="readonly" name="start_at"
                        placeholder="" />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>

            </div>


            <div class="col-lg-3">
                <label>{{ __('label.branches') }}</label>




                <select name="branch_id" class="form-control select2 branch_id" id="branch_id">
                    <option value="">{{ __('label.selected') }}</option>

                    @foreach ($branches as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group row m-2">
            <div class="col-lg-4">
                <button class="btn btn-primary submit" id="btnFiterSubmitSearch">بحث</button>
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
                        <th>{{ __('label.completed_invoice') }}</th>
                        <th>{{ __('label.pendding_invoice') }}</th>
                        <th>{{ __('label.date') }}</th>

                        <th>{{ __('label.time_in') }}</th>
                        <th>{{ __('label.time_out') }}</th>
                        <th>{{ __('label.Duration_of_work') }}</th>

                        <th>{{ __('label.actions') }}</th>


                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>


    <div class="modal fade" id="invoiceSingleModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">إصدار فاتورة شهرية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="my-single-invoice" name="my-single-invoice" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="single_amount" class="form-label">المبلغ</label>
                                <input type="number" class="form-control" id="single_amount" name="amount"
                                    placeholder="أدخل المبلغ">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="amout_type">
                                    العملة
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control amout_type" name="amout_type" id="amout_type" required
                                    style="width: 100%">
                                    <option value="">{{ __('label.selected') }}</option>

                                    @foreach ($currencies as $value)
                                        <option value="{{ $value->id }}">{{ $value->value }}</option>
                                    @endforeach

                                </select>
                                <div class="amout_type error"></div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="invoce_user_id" name="user_id" placeholder="">
                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <label>{{ __('label.expiration_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" value=""
                                        readonly="readonly" name="expiration_date" id="expiration_date"
                                        placeholder="" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label>{{ __('label.due_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" value=""
                                        readonly="readonly" name="due_date" id="due_date" placeholder="" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تاكيد
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('admin.users.modal.add');

    @include('Shared.delete')
@endsection

@section('scripts')
    @include('admin.logs.js.js')
@endsection
