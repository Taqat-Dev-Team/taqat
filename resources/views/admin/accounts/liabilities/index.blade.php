@extends('layouts.admin')
@section('title')
    {{ __('label.liabilities') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_liabilities') }}</h1>
            </div>

            <div class="card-toolbar">

                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_new_liabilities') }}
                </a>

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.parent') }}</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>





        @include('admin.accounts.liabilities.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.accounts.liabilities.js.js')
    @endsection
