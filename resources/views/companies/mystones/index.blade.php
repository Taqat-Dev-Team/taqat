@extends('layouts.companies')
@section('title')
    {{__('label.mystone')}}
@endsection

@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_payments')}}</h1>
        </div>
        <div class="card-toolbar">


        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_count')}}</label>
                    <span id="user_count">({{$mystone_count}})</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                    <label>{{__('label.mystone_amount')}}</label>
                    <span id="presence_count">({{$mystone_amount}})</span>
                </div>

            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_payment')}}</label>
                    <span id="absence_count">({{$mystone_payment}})</span>
                </div>


            </div>
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_no_payment')}}</label>
                    <span id="hours_count">({{$mystone_no_payment}})</span>
                </div>

            </div>
        </div>

    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">

                    <th>{{ __('label.title') }}</th>
                    <th>{{ __('label.project_title') }}</th>
                    <th>{{ __('label.amount') }}</th>
                    <th>{{ __('label.date') }}</th>
                    <th>{{ __('label.status') }}</th>
                    <th>{{ __('label.actions') }}</th>

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
    @include('companies.mystones.js.js')
@endsection
