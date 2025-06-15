@extends('layouts.front')
@section('title')
    الحركات المحفظة
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة الحركات المحفظة </h1>
            </div>
            <div class="card-toolbar">
                <!-- زر إضافة رصيد -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addBalanceModal">
                    <i class="la la-plus"></i> شحن المحفظة
                </button>
            </div>

            <!-- مودال إضافة رصيد -->

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-4">
                    <div class="card text-center shadow-sm border-primary">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="la la-wallet" style="font-size: 2.5rem; color: #007bff;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold">الرصيد الحالي</h5>
                            <p class="card-text h3 text-primary mb-0">{{ number_format($wallet_amount ?? 0, 2) }} شيكل</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">

                <div class="col-lg-4">
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

                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <label>{{ __('label.status') }}</label>
                    <select id="status_cd_id" name="status_cd_id" class="form-control select2">
                        <option value="">{{ __('label.selected') }}</option>
                        <option value="0" class="text-danger">غير مدفوع</option>
                        <option value="1" class="text-success">تم الدفع</option>
                        <option value="2" class="text-warning">قيد الانتظار</option>
                        <option value="3" class="text-muted">مرفوض</option>


                    </select>
                </div>
            </div>

            <div class="form-group row m-2">
                <div class="col-lg-4">
                    <button class="btn btn-primary submit_serach" id="submit_search"
                        type="button">{{ __('label.search') }}</button>


                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>

                        <tr class="text-left">
                            <th></th>
                            <th>المبلغ</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBalanceModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="my-form" action="{{ route('front.wallets.addBalance') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBalanceModalLabel">إضافة رصيد إلى المحفظة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="amount">المبلغ</label>
                            <input type="number" min="1" step="0.01" class="form-control" id="amount"
                                name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="attachment">صورة المرفق</label>
                            <input type="file" class="form-control-file" id="attachment" name="attachment"
                                accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" id="submit-button" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>
                            {{ __('label.submit') }}

                        </button>
                               <div id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('front.wallets.js.js')
@endsection
