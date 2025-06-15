@extends('layouts.admin')
@section('title')
    {{ __('label.attendance_departure') }}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.attendance_departure_report') }}</h1>
            </div>
            <div class="card-toolbar">
                <!-- Additional toolbar options if needed -->
            </div>
        </div>
        <div class="card-body">



            <form method="GET" action="{{ route('admin.reports.getAattendances') }}">

                <div class="form-group row m-1">
                    <div class="col-lg-4">
                        <label>{{ __('label.users') }}</label>

                        <select id="user_id" name="user_id" class="form-control select2">
                            <option value="">{{ __('label.selected') }}</option>
                            <option value="0">{{__('label.selected')}}</option>

                            @foreach ($users as $value)
                                <option value="{{ $value->id }}" @if($value->id==$user_id) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-lg-4">
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

                    <div class="col-lg-4">
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
                </div>

                <div class="form-group row m-2">
                    <div class="col-lg-4">
                        <button class="btn btn-primary submit" type="submit">{{ __('label.search') }}</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th>{{ __('label.user') }}</th>
                            <th>{{ __('label.date') }}</th>

                            <th>{{ __('label.start_time') }}</th>
                            <th>{{ __('label.end_time') }}</th>
                            <th>{{ __('label.work_hours') }}</th>
                        </tr>
                    </thead>
                    <tbody>


                         @foreach ($attendances as $value )
                         <tr>
                         <td>{{$value->user?$value->user->name:'-'}}</td>
                         <td>{{$value->date}}</td>

                         <td>{{ $value->login_time ? \Carbon\Carbon::parse($value->login_time)->format('h:i') : '-' }}</td>
                         <td>{{ $value->logout_time ? \Carbon\Carbon::parse($value->logout_time)->format('h:i') : '-' }}</td>
                         <td>{{$value->hours}}</td>
                         </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <strong>{{ __('label.total_work_hours') }}: {{ $overallTotalHours }}</strong>
            </div>
        </div>
    </div>
@endsection
