@extends('layouts.admin')
@section('title')
    {{ __('label.desk_mangments') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_desk_mangment') }}</h1>
            </div>

            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_desk_mangment'))
                    <a href="#" class="btn btn-success mr-1" id="add_edit">
                        <i class="fa fa-plus"></i>
                        {{ __('label.add_new_desk_mangment') }}
                    </a>
                @endif
            </div>

        </div>
        <div class="card-body">

            <div class="row">


                <div class="col-lg-6 col-sm-12">
                    <label for="branch_id">
                        {{ __('label.branches') }}
                    </label>
                    <select class="form-control select2" name="branch_id" id="serach_branch_id">
                        <option value="">{{ __('label.select') }}</option>
                        @foreach ($branches as $value)
                            <option value="{{ $value->id }}" @if ($value->id == $branch_id) selected @endif>
                                {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="serach_work_space_value_id" id="serach_work_space_value_id"
                    value="{{ $work_space_id }}">
                <div class="col-lg-6 col-sm-12">
                    <label for="work_space_id">
                        {{ __('label.work_space') }}
                    </label>
                    <select class="form-control select2" name="work_space_id" id="serach_work_space_id">
                        <option value="">{{ __('label.select') }}</option>

                    </select>
                </div>

            </div>

            <div class="row mt-1">
                <div class="col-lg-4">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">{{ __('label.search') }}</button>
                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th></th>
                            <th>{{ __('label.users') }}</th>
                            <th>{{ __('label.code') }}</th>
                            <th>{{ __('label.branches') }}</th>
                            <th>{{ __('label.work_space') }}</th>
                            <th>{{ __('label.invoice_not_paid') }}</th>
                            <th>{{ __('label.internet_code') }}</th>
                            <th>{{ __('label.internet_password') }}</th>
                            <th>{{ __('label.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


        </div>


        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel">{{ __('label.invoices') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-custom gutter-b">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">{{ __('label.invoices') }}</span>
                                    <span
                                        class="text-muted mt-3 font-weight-bold font-size-sm">{{ __('label.view_all_invoices') }}
                                    </span>
                                </h3>
                            </div>
                            <div class="card-body py-2">
                                <div class="row">
                                    <div class="col-lg-6 col-sm6">
                                        <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                            <label>{{ __('label.total_invoice') }}</label>
                                            <span id="total_invoice"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm6">
                                        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                            <label>{{ __('label.total_payment') }}</label>
                                            <span id="total_payment"></span>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-head-custom table-vertical-center invoice_table"
                                    id="invoice_table">
                                    <thead>
                                        <tr class="text-left">
                                            <th></th>
                                            <th>{{ __('label.name') }}</th>
                                            <th>{{ __('label.amount') }}</th>
                                            <th>{{ __('label.status') }}</th>
                                            <th>{{ __('label.created_at') }}</th>
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
        </div>





        @include('admin.workSpaceMangements.deskMangments.modal.add_edit')
        @include('admin.workSpaceMangements.deskMangments.modal.release')
        @include('admin.workSpaceMangements.deskMangments.modal.desk_history')
        @include('admin.workSpaceMangements.deskMangments.modal.add_invoice')


        @include('admin.workSpaceMangements.deskMangments.modal.internet')

        <div class="modal fade" id="open_add_subscription_Modal" tabindex="-1"
            aria-labelledby="sendNotificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendNotificationModalLabel">تنبيه اشعار</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="send_notification" method="POST"
                            action="{{ route('admin.users.sendNotification') }}">
                            @csrf


                            <input type="hidden" id="user_id" name="user_id">

                            <h6>  هل انت متاكد من ارسال اشعار تنبيه للمطالبة بالفواتير المستحقة</h6>


                     </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary" id="assignSubscription">ارسال</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.workSpaceMangements.deskMangments.js.js')
    @endsection
