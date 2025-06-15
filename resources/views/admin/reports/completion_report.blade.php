@extends('layouts.admin')
@section('title')
    {{ __('label.completion_report') }}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.completion_report') }}</h1>
            </div>
            <div class="card-toolbar">
                <!-- Additional toolbar options if needed -->
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.user_count')}}</label>
                        <span id="user_count"></span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>{{__('label.total_employment_contracts')}}</label>
                        <span id="total_employment_contracts"></span>
                    </div>

                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.total_financial_transactions')}}</label>
                        <span id="total_financial_transactions"></span>
                    </div>


                </div>
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.work_hours_count')}}</label>
                        <span id="hours_count"></span>
                    </div>

                </div>
            </div>


                <div class="form-group row m-1">
                    <div class="col-lg-3">
                        <label>{{ __('label.users') }}</label>

                        <select id="user_id" name="user_id" class="form-control select2">
                            <option value="">{{ __('label.selected') }}</option>
                            <option value="0">{{__('label.selected')}}</option>

                            @foreach ($users as $value)
                                <option value="{{ $value->id }}" @if($value->id==$user_id) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-lg-3">
                        <label>{{ __('label.from_date') }}</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker" value="{{ $start_date }}"
                                   readonly="readonly" name="start_date" id="start_date" placeholder="" />
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
                            <input type="text" class="form-control datepicker" value="{{ $end_date }}"
                                   readonly="readonly" name="end_date" id="end_date" placeholder="" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    @if(!auth('admin')->user()->branch_id)
                    <div class="col-lg-3">
                        <label>{{ __('label.branch') }}</label>
                        <select id="branch_id" name="branch_id" class="form-control select2">
                            <option value="">{{ __('label.selected') }}</option>
                            <option value="0">{{__('label.selected')}}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}" >{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>

                <div class="form-group row m-2">
                    <div class="col-lg-4">
                        <button class="btn btn-primary submit" id="searchTable" type="button">{{ __('label.search') }}</button>

                        <button class="btn btn-success export_excel" type="submit">{{ __('label.export_excel') }}</button>

                    </div>
                </div>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table">
                    <thead>
                    <tr class="text-left">
                        <th style="width: 10% !important;"></th>
                        <th>{{ __('label.name') }}</th>
                        <th>{{__('label.work_hours')}}</th>
                        <th>{{__('label.total_employment_contracts')}}</th>
                        <th>{{__('label.total_financial_transactions')}}</th>
                        <th>{{__('label.financial_transactions_count')}}</th>

                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="mt-3">
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.reports.js.completion_report')
@endsection

