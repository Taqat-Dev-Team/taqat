@extends('layouts.admin')

@section('title')
    {{ __('label.generator_expenses') }}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">
                    {{ __('label.display_all_generator_expenses') }}
                </h1>
            </div>
            <div class="card-toolbar">
                @can('add_generator_expense')
                <a href="#" class="btn btn-success" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_generator_expense') }}
                </a>
                @endcan
            </div>
        </div>

        <div class="card-body">
       

            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <label for="search_generator_id">{{ __('label.generator') }}</label>
                    <select class="form-control" name="generator_id" id="search_generator_id" data-control="select2">
                        <option value="">{{ __('label.selected') }}</option>
                        @foreach ($generators as $generator)
                            <option value="{{ $generator->id }}">{{ $generator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <label for="search_start_date">
                        {{ __('label.start_date') }}
                    </label>
                    <div class="input-group date" id="kt_datetimepicker_9" data-target-input="nearest">
                        <input type="text" class="form-control datepicker" id="search_start_date" required name="start_date"
                            placeholder=" " data-target="#kt_datetimepicker_9" />
                        <div class="input-group-append" data-target="#kt_datetimepicker_9" data-toggle="datetimepicker">
                            <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <label for="search_end_date">
                        {{ __('label.end_date') }}
                    </label>
                    <div class="input-group date" id="kt_datetimepicker_10" data-target-input="nearest">
                        <input type="text" class="form-control datepicker" id="search_end_date" required name="date"
                            placeholder=" " data-target="#kt_datetimepicker_10" />
                        <div class="input-group-append" data-target="#kt_datetimepicker_10" data-toggle="datetimepicker">
                            <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>



    {{-- Buttons --}}
    <div class="row mt-3">
        <button type="button" class="btn btn-primary mr-2" id="search_expenses">
            <i class="fa fa-search"></i> {{ __('label.search') }}
        </button>
        <a href="javascript:void(0);" class="btn btn-success" id="export_excel">
            <i class="fa fa-file-excel"></i> {{ __('label.export_excel') }}
        </a>
    </div>

    {{-- Table --}}
    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>
                <tr class="text-left">
                    <th>{{ __('label.name') }}</th>
                    <th>{{ __('label.amount') }}</th>
                    <th>{{ __('label.generator') }}</th>
                    <th>{{ __('label.date') }}</th>
                    <th class="text-center">{{ __('label.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- Data loaded by DataTable --}}
            </tbody>
        </table>
    </div>
    </div>

    {{-- Modals --}}
    @include('admin.generatorExpenses.modal.add_edit')
    @include('Shared.delete')
    </div>
@endsection

@section('scripts')
    @include('admin.generatorExpenses.js.js')
@endsection
