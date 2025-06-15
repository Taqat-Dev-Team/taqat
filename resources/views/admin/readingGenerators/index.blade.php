@extends('layouts.admin')
@section('title')
    {{ __('label.generator_subscriptions') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ !$status? __('label.dispaly_all_reading_generators'):__('label.dispaly_all_delete_reading_generators') }}</h1>
            </div>

            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_generator_reading') && !$status )
                    <a href="#" class="btn btn-success mr-1" id="add_edit">
                        <i class="fa fa-plus"></i>
                        {{ __('label.add_reading_generator') }}
                    </a>
                @endif

            </div>

        </div>
        <div class="card-body">
            @if(!$status)

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom bg-info text-white shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">
                                <i class="fa fa-users mr-2"></i>{{ __('label.total_subscribers') }}
                            </h5>
                            <p class="card-text display-4 font-weight-bold" id="total-subscribers"></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom bg-danger text-white shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">
                                <i class="fa fa-exclamation-circle mr-2"></i>{{ __('label.consumption_quantity') }}
                            </h5>
                            <p class="card-text display-4 font-weight-bold" id="consumption_quantity"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom bg-success text-white shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">
                                <i class="fa fa-dollar-sign mr-2"></i>{{ __('label.consumption_value') }}
                            </h5>
                            <p class="card-text display-4 font-weight-bold" id="consumption_value"></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row m-1">
                <div class="col-lg-3">
                    <label>{{ __('label.generator') }}</label>

                    <select id="search_generator_id" name="search_generator_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>

                        @foreach ($generators as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label>{{ __('label.subscribers') }}</label>

                    <select id="search_generator_subsription_id" name="search_generator_subsription_id"
                        class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>

                        @foreach ($generator_subsriptions as $value)
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



            </div>

            <div class="form-group row m-2">
                <div class="col-lg-4">
                    <button class="btn btn-primary submit_serach" id="searchTable"
                        type="button">{{ __('label.search') }}</button>


                </div>
            </div>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table"id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.mobile') }}</th>
                            <th>{{ __('label.generator_name') }}</th>


                            <th>{{ __('label.previous_reading') }}</th>
                            <th>{{ __('label.current_reading') }}</th>
                            <th>{{ __('label.consumption_value') }}</th>
                            <th>{{ __('label.consumption_quantity') }}</th>


                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>




        <input name="status" id="status" value="{{$status}}" type="hidden"  >
        <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تأكيد الاسترجاع</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        هل أنت متأكد أنك تريد استرجاع

                        <input type="hidden" id="add_edit_restore_id" name="restore_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-success" id="confirmRestore">استرجاع</button>
                    </div>
                </div>
            </div>
        </div>





        @include('admin.readingGenerators.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.readingGenerators.js.js')
    @endsection
