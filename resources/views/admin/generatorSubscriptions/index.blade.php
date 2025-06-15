@extends('layouts.admin')
@section('title')
    {{ __('label.generator_subscriptions') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">
                    {{ $status ? __('label.dispaly_all_delete_generator_subscriptions') : __('label.dispaly_all_generator_subscriptions') }}
                </h1>
            </div>

            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_subscription_type') && !$status)
                    <a href="#" class="btn btn-success mr-1" id="add_edit">
                        <i class="fa fa-plus"></i>
                        {{ __('label.add_generator_subscription') }}
                    </a>
                @endif

                @if (!$status)
                    <a href="#" class="btn btn-danger mr-1" id="send_sms" data-toggle="modal"
                        data-target="#sendSmsModal">
                        <i class="fa fa-plane"></i>
                        {{ __('label.send_sms') }}
                    </a>

                    <!-- Modal -->
                @endif

            </div>

        </div>
        <div class="card-body">


            @if (!$status)
                <div class="row m-1">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card card-custom bg-info text-white shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">
                                    <i class="fa fa-users mr-2"></i>{{ __('label.total_subscribers') }}
                                </h5>
                                <p class="card-text display-4 font-weight-bold" id="total-subscribers"></p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card card-custom bg-primary text-white shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">
                                    <i class="fa fa-chart-bar mr-2"></i>{{ __('label.total_monthly_readings') }}
                                </h5>
                                <p class="card-text display-4 font-weight-bold" id="total-monthly-readings"></p>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card card-custom bg-danger text-white shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">
                                    <i class="fa fa-exclamation-circle mr-2"></i>{{ __('label.total_debts') }}
                                </h5>
                                <p class="card-text display-4 font-weight-bold" id="total-debts"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card card-custom bg-success text-white shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">
                                    <i class="fa fa-dollar-sign mr-2"></i>{{ __('label.total_collections') }}
                                </h5>
                                <p class="card-text display-4 font-weight-bold" id="total-collections"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card card-custom bg-warning text-white shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">
                                    <i class="fa fa-receipt mr-2"></i>اجمالي المصاريف
                                </h5>
                                <p class="card-text display-4 font-weight-bold" id="total-Expenses"></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group row m-1">
                    <div class="col-lg-6">
                        <label>{{ __('label.generator') }}</label>

                        <select id="search_generator_id" name="search_generator_id" class="form-control select2">
                            <option value="">{{ __('label.selected') }}</option>

                            @foreach ($generators as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
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
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>\

                            <th>{{ __('label.mobile') }}</th>
                            <th>{{ __('label.generator') }}</th>

                            <th>{{ __('label.current_reading') }}</th>
                            <th>{{ __('label.paid_amount') }}</th>
                            <th>{{ __('label.remaining_amount') }}</th>


                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>





        @include('admin.generatorSubscriptions.modal.add_edit')
        <input name="status" id="status" value="{{ $status }}" type="hidden">


        <div class="modal fade" id="modal-reading-generators" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ __('label.reading_generators') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-head-custom table-vertical-center data-table-reading-generators"
                                id="data-table-reading-generators">
                                <thead>
                                    <tr class="text-left">

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
                </div>
            </div>
        </div>


        <div class="modal fade" id="add-reading-generators" tabindex="-1" aria-labelledby="add-reading-generatorsLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-reading-generatorsLabel">بيانات قراءة العداد
                            <span class="error">*</ </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                    </div>
                    <form id="reading-generator" method="POST" name="reading-generator"
                        action="{{ route('admin.readingGenerators.store') }}">
                        @csrf
                        <div class="modal-body">


                            <div class="row">
                                <!-- حقل الاسم -->



                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.current_reading') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="add_edit_current_reading"
                                        name="current_reading" required>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="killo_watt_cost">سعر كيلو واط

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="killo_watt_cost"
                                        name="killo_watt_cost" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost">{{ __('label.consumption_quantity') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="0" class="form-control"
                                        id="add_edit_consumption_quantity" name="consumption_quantity" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.consumption_value') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="1" class="form-control"
                                        id="add_edit_consumption_value" name="consumption_value" required>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="send_sms">
                                        {{ __('label.send_sms') }}
                                        <span class="error">*</span>

                                    </label>
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" id="status" value="1" name="send_sms"
                                                checked="checked" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <input type="hidden" class="form-control" id="reading_generator_id"
                                    name="reading_generator_id">

                                <input type="hidden" class="form-control"
                                    id="add_edit_subscription_generator_subscription_id" name="generator_subscription_id"
                                    required>

                                <!-- حقل parent_id -->

                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.close') }}</button>
                        </div>

                        <!-- زر التأكيد -->
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modal-generator_receipts" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ __('label.list_generator_receipts') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-head-custom table-vertical-center data-table-generator_receipts"
                                id="data-table-generator_receipts">
                                <thead>
                                    <tr class="text-left">

                                        <th>{{ __('label.amount') }}</th>
                                        <th>{{ __('label.date') }}</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="add-generator_receipts" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">بيانات ستد القبض</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="generator_receipt" method="POST" name="generator_receipt"
                        action="{{ route('admin.generatorSubscriptions.generatorReceipt') }}">
                        @csrf
                        <div class="modal-body">


                            <div class="row">
                                <!-- حقل الاسم -->




                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.amount') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="add_edit_amount" name="amount"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.date') }}

                                        <span class="error">*</span>
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" value=""
                                            readonly="readonly" name="date" id="add_edit_date" placeholder="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group col-md-6">
                                        <label for="cash_paid">{{ __('label.cash_paid') }}</label>
                                        <input type="number" class="form-control" id="cash_paid"
                                            name="cash_paid" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="expense_bank_paid">{{ __('label.bank_paid') }}</label>
                                        <input type="number" class="form-control" id="bank_paid"
                                            name="bank_paid" required>
                                    </div>


                                <div class="col-lg-6 col-sm-12">
                                    <label for="branch_id">
                                        {{ __('label.send_sms') }}
                                        <span class="error">*</span>

                                    </label>
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" id="status" value="1" name="send_sms"
                                                checked="checked" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>


                                <input type="hidden" class="form-control" id="edit_receipt_id" name="receipt_id">





                                <input type="hidden" class="form-control"
                                    id="add_edit_generator_receipt_subscription_id" name="generator_subscription_id"
                                    required>

                                <!-- حقل parent_id -->

                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.close') }}</button>
                        </div>

                        <!-- زر التأكيد -->
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="sendSmsModal" tabindex="-1" role="dialog" aria-labelledby="sendSmsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendSmsModalLabel">{{ __('label.send_sms') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="sendSmsForm" method="POST"
                            action="{{ route('admin.generatorSubscriptions.sendSms') }}" name="sendSmsForm">
                            @csrf

                            <div class="form-group">
                                <label for="send_sms">
                                    {{ __('label.name') }}
                                    <span class="error">*</span>

                                </label>
                                <select class="form-control select2" name="generator_subscription_id[]" multiple
                                    style="width: 100%;">
                                    <option value="">{{ __('label.select') }}</option>

                                    @foreach ($generatorSubsriptions as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">{{ __('label.message') }}</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('label.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel"
            aria-hidden="true">
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

        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.generatorSubscriptions.js.js')
    @endsection
