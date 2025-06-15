@extends('layouts.admin')
@section('title')
{{__('label.contrancts')}}
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_contrancts')}}</h1>
        </div>
        <div class="card-toolbar">


        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.contrancts_count')}}</label>
                    <span id="user_count">({{$contracts_count}})</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                    <label>{{__('label.contrancts_total_sallary')}}</label>
                    <span id="presence_count">({{$contracts_total_salary}})</span>
                </div>

            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.contrancts_min_sallary')}}</label>
                    <span id="absence_count">({{$contracts_min_salary}})</span>
                </div>


            </div>
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.contrancts_max_sallary')}}</label>
                    <span id="hours_count">({{$contracts_max_salary}})</span>
                </div>

            </div>
        </div>

    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">
                    <th></th>
                    <th>{{ __('label.name') }}</th>

                    <th>{{ __('label.company_name') }}</th>
                    <th>{{ __('label.job') }}</th>

                    <th>{{ __('label.start_date') }}</th>
                    <th>{{ __('label.end_date') }}</th>
                    <th>{{__('label.duration')}}</th>

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
@include('admin.contracts.js.js')
@endsection
