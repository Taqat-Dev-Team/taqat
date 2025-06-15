@extends('layouts.front')
@section('title')
    {{ __('label.services') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_services') }}</h1>
            </div>

            <div class="card-toolbar">

                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_service') }}
                </a>

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="data-table">
                    <thead>
                        <tr class="text-left">
                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.quantity') }}</th>
                            <th>{{ __('label.amount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        @include('front.services.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('front.services.js.js')
    @endsection
