@extends('layouts.companies')
@section('title')
{{__('label.attendance_departure')}}
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_attendance_departure')}}</h1>
        </div>
        <div class="card-toolbar">
                <a href="#" class="btn btn-primary mr-1 attendances"> {{__('label.attendance_departure')}} </a>

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
                    <label>{{__('label.presence_count')}}</label>
                    <span id="presence_count"></span>
                </div>

            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.absence_count')}}</label>
                    <span id="absence_count"></span>
                </div>


            </div>
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.work_hours_count')}}</label>
                    <span id="hours_count"></span>
                </div>

            </div>
        </div>

    </div>
    <div class="form-group row m-1">


        <div class="col-lg-3">
            <label>{{__('label.users')}}:</label>
            <select class="form-control select2" name="user_id[]" id="user_id" multiple>
                <option value="">{{__('label.selected')}}</option>

                @foreach ($users as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>








        <div class="col-lg-3">
            <label> {{__('label.date')}}:</label>
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




    </div>

    <div class="form-group row m-2">
        <div class="col-lg-4">
            <button class="btn btn-primary submit" id="btnFiterSubmitSearch">{{__('label.search')}}</button>
        </div>
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

                    <th>{{__('label.actions')}}</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>

@include('companies.attendances.Modal.edit')
@include('companies.attendances.Modal.add')

@endsection

@section('scripts')
@include('companies.attendances.js.js')
@endsection
