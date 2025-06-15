@extends('layouts.admin')
@section('title')
    {{ __('label.wallet') }}
@endsection

@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* This makes the element circular */
            overflow: hidden;
            /* Ensures content inside the circle stays within bounds */
        }

        img {
            width: 100%;
            /* Ensures the image fills the circular container */
            height: auto;
            /* Maintains aspect ratio */
            display: block;
            /* Removes any extra space below the image */
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.view_all_wallet') }}</h1>
            </div>

            <div class="card-toolbar">

            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.user_count') }}</label>
                        <span id="user_count"></span>
                    </div>
                </div>



                <div class="col-lg-6 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.total_payment') }}</label>
                        <span id="total_payment"></span>
                    </div>


                </div>

            </div>







            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <thead>

                            <tr class="text-left">
                                <th></th>
                                <th>{{ __('label.name') }}</th>
                                <th>{{ __('label.mobile') }}</th>
                                <th>{{ __('label.amount') }}</th>

                            </tr>
                        </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>



        {{-- @include('admin.wallets.modal.edit')

        @include('Shared.delete') --}}
    @endsection

    @section('scripts')
        @include('admin.wallets.js.js')
    @endsection
