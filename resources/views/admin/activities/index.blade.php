@extends('layouts.admin')
@section('title')
    {{__('label.activities')}}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">   {{__('label.display_all_activities')}}</h1>
            </div>
            <div class="card-toolbar">


            </div>
        </div>
        <div class="card-body">


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>

                        <tr class="text-left">
                            <th>{{__('label.activite_name')}}</th>
                            <th>{{__('label.description')}}</th>
                            <th>{{__('label.transaction_port')}}</th>
                            <th>{{__('label.date')}}</th>

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
    @include('admin.activities.js.js')
@endsection
