@extends('layouts.admin')


@section('title','شروط الاتفاقية')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">عرض كافة شروط الاتفاقية</h1>
        </div>
        @if(auth()->user()->can('add_agreement'))
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary mr-1 add_agreement">اضافة شروط اتفاقية جديدة</a>
        </div>
        @endif
    </div>
    <div class="card-body">




        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <th>{{ __('label.name') }}</th>

                        <th>{{ __('label.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('Shared.delete')
    @include('admin.agreements.Modal.add_edit')
@endsection
@section('scripts')

    @include('admin.agreements.js.scripts')
@endsection
