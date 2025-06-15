@extends('layouts.front')
@section('title')
    {{ __('label.restaurants') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_restaurants') }}</h1>
            </div>

            <div class="card-toolbar">

            </div>

        </div>
        <div class="card-body">







            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th></th>

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.mobile') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    @endsection

    @section('scripts')
        @include('front.restaurants.js.js')
    @endsection
