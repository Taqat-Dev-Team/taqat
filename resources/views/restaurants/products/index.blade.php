@extends('layouts.restaurants')
@section('title', __('label.products'))

@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{ __('label.dispaly_all_products') }}</h1>
        </div>

        <div class="card-toolbar">

            <a href="#" class="btn btn-success mr-1" id="add_edit">
                <i class="fa fa-plus"></i>
                {{ __('label.add_product') }}
            </a>

        </div>

    </div>
    <div class="card-body">



        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <th></th>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.order_count') }}</th>
                        <th>{{ __('label.status') }}</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>




    @include('Shared.delete')

    @include('restaurants.products.Model.view')

    @include('restaurants.products.Model.create_update')
@endsection

@section('scripts')
    @include('restaurants.products.js.js')
@endsection
