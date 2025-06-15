@extends('layouts.admin')
@section('title')
    {{__('label.interviews')}}
@endsection



@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_interview')}}</h1>
        </div>
        <div class="card-toolbar">


        </div>
    </div>
    <div class="card-body">


    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">

                    <th>{{ __('label.name') }}</th>
                    <th>{{ __('label.compnay_name') }}</th>

                    <th>{{ __('label.jobs') }}</th>

                    <th>{{ __('label.date') }}</th>
                    <th>{{ __('label.time') }}</th>
                    <th>{{ __('label.zoom_url') }}</th>

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
    @include('admin.interview.js.js')
@endsection
