@extends('layouts.restaurants')
@section('title', __('label.products'))

@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_products') }}</h1>
            </div>

            <div class="card-toolbar">

                {{-- <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_product') }}
                </a> --}}

            </div>

        </div>
        <div class="card-body">

            <div class="form-group row m-1">


                <div class="col-lg-6">
                    <label>{{ __('label.from_date') }}</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="start_date" id="start_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <label>{{ __('label.to_date') }}</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="end_date" id="end_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>












            <div class="form-group row m-2">
                <div class="col-lg-6">
                    <button class="btn btn-primary submit_serach" id="searchTable"
                        type="button">{{ __('label.search') }}</button>



                </div>

            </div>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.quantity') }}</th>
                            <th>{{ __('label.price') }}</th>

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
    @include('restaurants.reports.js.js')
@endsection
