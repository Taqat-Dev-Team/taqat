@extends('layouts.admin')
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
                @if (auth('admin')->user()->can('add_restaurant'))
                    <a href="#" class="btn btn-success mr-1" id="add_edit">
                        <i class="fa fa-plus"></i>
                        {{ __('label.add_restaurant') }}
                    </a>
                @endif

            </div>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <!-- عدد المطاعم -->
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">عدد المطاعم</h5>
                                <p class="card-text fs-4 total-restaurants">0</p>
                            </div>
                            <i class="fas fa-store fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- إجمالي الطلبات -->
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">إجمالي الطلبات</h5>
                                <p class="card-text fs-4 total-orders">0</p>
                            </div>
                            <i class="fas fa-receipt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- إجمالي الأرباح -->
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">إجمالي الطلبات </h5>
                                <p class="card-text fs-4 total-profit">0  </p>
                            </div>
                            <i class="fas fa-dollar-sign fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- الطلبات الملغاة -->
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">الطلبات الملغاة</h5>
                                <p class="card-text fs-4 total-canceled">0</p>
                            </div>
                            <i class="fas fa-ban fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>

            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">عدد العملاء</h5>
                            <p class="card-text fs-4 total-clients">0</p>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">الطلبات المكتملة</h5>
                            <p class="card-text fs-4 total-completed-orders">0</p>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">الطلبات الجارية</h5>
                            <p class="card-text fs-4 total-pending-orders">0</p>
                        </div>
                        <i class="fas fa-spinner fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>




            </div>

            <div class="form-group row m-1">
                <div class="col-lg-3">
                    <label>{{ __('label.restaurants') }}</label>

                    <select id="user_id" name="restaurant_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="0">{{ __('label.selected') }}</option>

                        @foreach ($restaurants as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-3">
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

                <div class="col-lg-3">
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
                <div class="col-lg-3">
                    <label>{{ __('label.status') }}</label>
                    <select id="status_cd_id" name="status_cd_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="0" class="text-danger">مرحلة الانتظار</option>
                        <option value="1" class="text-success">مكتمل</option>
                        <option value="2" class="text-warning">قيد التنفيد</option>
                        <option value="3" class="text-muted">ملغي</option>


                    </select>
                </div>
            </div>












            <div class="form-group row m-2">
                <div class="col-lg-4">
                    <button class="btn btn-primary submit_serach" id="searchTable"
                        type="button">{{ __('label.search') }}</button>


                </div>
            </div>




            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th></th>

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.mobile') }}</th>
                            <th>{{ __('label.order_count') }}</th>
                            <th>{{ __('label.order_amount') }}</th>
                            <th>{{ __('label.total_sales_weekly') }}</th>
                            <th>{{ __('label.total_sales') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.restaurants.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.restaurants.js.js')
    @endsection
