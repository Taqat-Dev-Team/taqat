@extends('layouts.admin')
@section('title')
    {{ __('label.generators') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">
                    {{ $status ? __('label.restore_generators_list') : __('label.dispaly_all_generators') }}
                </h1>
            </div>

            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_subscription_type') && !$status)
                    <a href="#" class="btn btn-success mr-1" id="add_edit">
                        <i class="fa fa-plus"></i>
                        {{ __('label.add_generator') }}
                    </a>
                @endif

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.subscribers_count') }}</th>
                            <th>{{ __('label.total_receipt') }}</th>
                            <th>{{ __('label.total_expenses') }}</th>


                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>





        @include('admin.generators.modal.add_edit')



        <div class="modal fade" id="modal-subscriptions-generators" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ __('label.generator_subscriptions') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-head-custom table-vertical-center data-table-subscriptions-generators"
                                id="data-table-subscriptions-generators">
                                <thead>
                                    <tr class="text-left">

                                        <th>{{ __('label.name') }}</th>
                                        <th>{{ __('label.mobile') }}</th>
                                        <th>{{ __('label.current_reading') }}</th>
                                        <th>{{ __('label.paid_amount') }}</th>
                                        <th>{{ __('label.remaining_amount') }}</th>


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

        <div class="modal fade" id="add-generator-subscription" tabindex="-1"
            aria-labelledby="add-generator-subscriptionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-generator-subscriptionLabel">
                            {{ __('label.add_generator_subscription') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add-generator-Subscriptions" method="POST" name="add-generator-Subscriptions"
                        action="{{ route('admin.generatorSubscriptions.store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.name') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="add_edit_name" name="name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.mobile') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="1" class="form-control" id="add_edit_mobile"
                                        name="mobile" required>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="cost">{{ __('label.killo_watt_cost') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="1" class="form-control" id="add_edit_killo_watt_cost"
                                        name="killo_watt_cost" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost">{{ __('label.initial_reading') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="0" class="form-control" id="add_edit_initial_reading"
                                        name="initial_reading" required>
                                </div>



                                <input type="hidden" class="form-control" id="add-generator-subscription_id"
                                    name="generator_id" required>

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



        <!-- Modal for importing Excel -->
        <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelModalLabel">{{ __('label.import_excel') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="importExcelForm" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.generators.importExcel') }}">
                        @csrf



                        <div class="modal-body">
                            <div class="form-group mt-3">
                                <a href="{{ asset('public/GeneratorSubscription.csv') }}" class="btn btn-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                        <path
                                            d="M8 5a.5.5 0 0 1 .5.5v5.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V5.5A.5.5 0 0 1 8 5z" />
                                        <path
                                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3-.5a.5.5 0 0 1-.5-.5V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h-2.5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    تنزيل الملف </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="excelFile">ملف</label>
                            <input type="file" class="form-control" id="excelFile" name="excel_file" required>

                            <input type="hidden" class="form-control" id="generator_id" name="generator_id" required>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i>
                                {{ __('label.submit') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <input name="status" id="status" value="{{ $status }}" type="hidden">

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




        <!-- Button to show generator expenses modal -->


        <!-- Modal: List Generator Expenses -->
        <div class="modal fade" id="generatorExpensesModal" tabindex="-1" aria-labelledby="generatorExpensesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generatorExpensesModalLabel">
                            {{ __('label.list_generator_expenses') }}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ __('label.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-head-custom table-vertical-center generator-expenses-table"
                                id="generator-expenses-table">
                                <thead>
                                    <tr class="text-left">
                                        <th>{{ __('label.title') }}</th>
                                        <th>{{ __('label.price') }}</th>

                                        <th>{{ __('label.quantity') }}</th>
                                        <th>{{ __('label.total_price') }}</th>
                                        <th>{{ __('label.cash_paid') }}</th>
                                        <th>{{ __('label.bank_paid') }}</th>
                                                    <th>{{ __('label.date') }}</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via JS/AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button to show Add Generator Expense Modal -->


        <!-- Modal: Add Generator Expense -->
        <div class="modal fade" id="addGeneratorExpenseModal" tabindex="-1"
            aria-labelledby="addGeneratorExpenseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGeneratorExpenseModalLabel">
                            {{ __('label.generator_expense') }}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ __('label.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addGeneratorExpenseForm" method="POST"
                        action="{{ route('admin.generators.storeGeneratorExpenses') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="col-lg-6 col-sm-12">
                                    <label for="expense_title">{{ __('label.title') }}</label>
                                    <input type="text" class="form-control" id="expense_title" name="title"
                                        required>

                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="date">
                                        {{ __('label.date') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group date" id="kt_datetimepicker_10"
                                            data-target-input="nearest">
                                            <input type="text" class="form-control datepicker" required
                                                 name="date" id="date"
                                                placeholder=" " data-target="#kt_datetimepicker_10" />
                                            <div class="input-group-append" data-target="#kt_datetimepicker_10"
                                                data-toggle="datetimepicker">
                                                <span class="input-group-text">
                                                    <i class="ki ki-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="expense_total_price">{{ __('label.price') }}</label>
                                    <input type="number" class="form-control" id="expense_price" name="price"
                                        min="0" required>
                                    <input type="hidden" class="form-control" id="expense_id" name="expense_id"
                                        required>

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expense_quantity">{{ __('label.quantity') }}</label>
                                    <input type="number" class="form-control" id="expense_quantity" name="quantity"
                                        min="1" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="expense_total_price">{{ __('label.total_price') }}</label>
                                    <input type="number" class="form-control" id="expense_total_price"
                                        name="total_amount" min="0" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expense_cash_paid">{{ __('label.cash_paid') }}</label>
                                    <input type="number" class="form-control" id="expense_cash_paid" name="cash_paid"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="expense_bank_paid">{{ __('label.bank_paid') }}</label>
                                    <input type="number" class="form-control" id="expense_bank_paid" name="bank_paid"
                                        required>
                                </div>
                            </div>
                            <input type="hidden" name="generator_id" id="expense_generator_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('label.submit') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('label.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Add Generator Expense -->
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.generators.js.js')
    @endsection
