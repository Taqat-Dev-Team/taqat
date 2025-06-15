@extends('layouts.admin')


@section('title',__('label.branches'))
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{ __('label.display_all_branchs') }}</h1>
        </div>
        @if(auth()->user()->can('create_branch'))
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary mr-1 add_branchs">{{__('label.add_branch')}}</a>
        </div>
        @endif
    </div>
    <div class="card-body">




        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <th>{{ __('label.name') }}</th>
                        <th style="display: none;">{{ __('label.name') }}</th>
                        <th >{{ __('label.contrancts_total_sallary') }}</th>
                        <th >{{ __('label.total_income') }} </th>
                        <th>{{__('label.max_capacity')}}</th>
                        <th>{{__('label.registered_count')}}</th>


                        <th>{{ __('label.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('Shared.delete')
    @include('admin.branchs.Modal.add_edit')
@endsection
@section('scripts')

    @include('admin.branchs.js.scripts')
@endsection
