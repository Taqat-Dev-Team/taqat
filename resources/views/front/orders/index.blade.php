@extends('layouts.front')
@section('title')
    {{ __('label.restaurants') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_orders') }}</h1>
            </div>

            <div class="card-toolbar">


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

                <div class="col-md-3">
                    <div class="card text-dark bg-light mb-3 border">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">متوسط وقت التوصيل</h5>
                                <p class="card-text fs-4 avg-delivery-time">0 دقيقة</p>
                            </div>
                            <i class="fas fa-clock fa-2x text-muted opacity-50"></i>
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
                        <option value="0" class="text-danger">جديد</option>
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

                    <button class="btn btn-success" id="exportExcel" type="button">{{ __('label.export_excel') }}</button>

                </div>
            </div>




            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th></th>

                            <th>{{ __('label.restaurant_name') }}</th>
                            <th>{{ __('label.price') }}</th>
                            <th>{{ __('label.quantity') }}</th>
                            <th>{{ __('label.total_price') }}</th>
                            <th>{{ __('label.date') }}</th>
                            <th>{{ __('label.status') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        @include('front.orders.modal.view')
    @endsection

    @section('scripts')
        @include('front.orders.js.js')
    @endsection
