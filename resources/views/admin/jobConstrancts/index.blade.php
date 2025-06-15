@extends('layouts.admin')
@section('title')
    {{__('label.job_constrancts')}}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{__('label.display_all_job_constrancts')}}</h1>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->

            <div class="row">
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.employment_contracts_count')}}</label>

                        <span id="count_income"></span>

                        <br>
                        عدد الافراد<span id="count_user"></span>

                    </div>
                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>{{__('label.total_income')}}</label>
                        <span id="total_income"></span>
                    </div>

                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.max_income')}}</label>
                        <span id="max_income"></span>
                    </div>


                </div>
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{__('label.min_income')}}</label>
                        <span id="min_income"></span>
                    </div>

                </div>
            </div>

            <div class="col-12 p-3" style="overflow:auto">

                <div class="col-12 p-0" style="width: 100%;">
                        @csrf

                        <div class="form-group row m-1">
                            <div class="col-lg-4">
                                <label>{{__('label.users')}}:</label>
                                <select class="form-control select_2 " id="user_type"

                                        name="user_type">

                                    <option value="">{{__('label.selected')}}</option>
                                    <option value="0">{{__('label.selected')}}</option>

                                    <option value="1">{{__('label.users_inside_hub_menu')}}</option>
                                    <option value="3">{{__('label.users_outside_hub_menu')}}</option>

                                </select>
                            </div>

                            <div class="col-lg-4">
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

                            <div class="col-lg-4">
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

                        <div class="form-group row" style="margin: 10px 3px 10px 0px">
                            <div class="col-lg-4">
                                <button class="btn btn-primary " id="btnFiterSubmitSearch">{{__('label.search')}}</button>
                            </div>
                        </div>



                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th> </th>

                            <th> {{__('label.name')}}</th>
                            <th>{{__('label.company_name')}}</th>
                            <th>{{__('label.branch')}}</th>

                            <th>{{__('label.value_employment_contract')}}</th>
                            <th>{{__('label.duration')}}</th>
                            <th>{{__('label.job_type')}}</th>
                            <th>{{__('label.date')}}</th>
                            <th>{{__('label.created_at')}}</th>

                            <th>{{__('label.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    @include('Shared.delete')
@endsection

@section('scripts')
    @include('admin.jobConstrancts.js.js')
@endsection
