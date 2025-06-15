@extends('layouts.admin')
@section('title')
    {{ __('label.equities') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_equities') }}</h1>
            </div>

            <div class="card-toolbar">
                @if(auth('admin')->user()->can('add_equity'))

                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_new_equities') }}
                </a>
                @endif

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.parent') }}</th>
                            <th>{{ __('label.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>





        @include('admin.accounts.equities.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.accounts.equities.js.js')
    @endsection
