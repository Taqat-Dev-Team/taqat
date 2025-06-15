@extends('layouts.front')
@section('title')

@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">عرض بيانات الحضور والانصراف</h1>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="bg-light-success px-6 py-8 rounded-2 mb-7 text-center">
                    <label class="d-block font-weight-bold mb-2">عدد أيام الحضور</label>
                    <span id="presence_count" class="h4 text-dark">({{$presence_count}})</span>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="bg-light-danger px-6 py-8 rounded-2 mb-7 text-center">
                    <label class="d-block font-weight-bold mb-2">عدد ساعات العمل</label>
                    <span id="hours_count" class="h4 text-dark">({{$hours_count}})</span>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="bg-light-warning px-6 py-8 rounded-2 mb-7 text-center">
                    <label class="d-block font-weight-bold mb-2">ساعات عمل هذا الشهر</label>
                    <span id="current_month_hours" class="h4 text-dark">({{$hours_current_month_count}})</span>
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
                      <th>تاريخ</th>
                    <th>موعد الحضور</th>
                    <th>موعد الانصراف</th>
                    <th>مدة الدوام بالساعات</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

@section('scripts')
@include('front.attendances.js.js')
@endsection
