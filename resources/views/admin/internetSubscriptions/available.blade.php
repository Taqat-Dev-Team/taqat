@extends('layouts.admin')
@section('title')
    {{ __('label.internet_subscription') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_available_internet_subscription') }}</h1>
            </div>

            <div class="card-toolbar">

            </div>

        </div>
        <div class="card-body">
            <div class="row">


                @if (!auth()->user()->branch_id)
                    <div class="col-lg-4 col-sm-12">
                        <label for="branch_id">
                            {{ __('label.branches') }}
                        </label>
                        <select class="form-control select2" name="branch_id" id="serach_branch_id">
                            <option value="">{{ __('label.select') }}</option>
                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <label for="work_space_id">
                            {{ __('label.work_space') }}
                        </label>
                        <select class="form-control select2" name="work_space_id" id="serach_work_space_id">
                            <option value="">{{ __('label.select') }}</option>

                        </select>
                    </div>
                @endif

                <div class="col-lg-4 col-sm-12">
                    <label for="serach_subscription_type_id">
                        {{ __('label.subscription_types') }}
                    </label>
                    <select class="form-control select2" name="serach_subscription_type_id"
                        id="serach_subscription_type_id">
                        <option value="">{{ __('label.subscription_types') }}</option>

                        @foreach ($subscriptionTypes as $value)
                            <option value="{{ $value->id }}">

                                {{ $value->name }}
                            </option>
                        @endforeach
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

                            <th>{{ __('label.internet_code') }}</th>
                            <th>{{ __('label.internet_password') }}</th>
                            <th>{{ __('label.subscription_type') }}</th>
                            <th>{{ __('label.branch') }}</th>
                            <th>{{ __('label.duration') }}</th>
                            <th>{{ __('label.price') }}</th>

                            <th>{{ __('label.user_name') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>






    </div>







    <div class="modal fade" id="assignSubscriptionModal" tabindex="-1" aria-labelledby="assignSubscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="assignSubscriptionModalLabel">تعيين الاشتراك</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <form id="assignSubscriptionForm" method="POST" action="{{ route('admin.internetSubscriptions.assign') }}">
                    @csrf
                    <input type="hidden" id="internet_subscription_id" name="internet_subscription_id">

                    <div class="modal-body">
                        <!-- البحث عن رقم الجوال -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="serach_mobile">رقم الجوال</label>
                                <input type="text" class="form-control" id="serach_mobile" name="mobile" required>
                                <small class="text-muted">أدخل رقم الجوال للتحقق من وجود الحساب.</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <a class="btn btn-primary btn-block" id="searchUserButton">بحث</a>
                            </div>
                        </div>

                        <!-- اختيار مستخدم موجود -->
                        <div class="row" id="existingUserSection" style="display: none;">
                            <div class="form-group col-md-6">
                                <label for="existingUser">اختر المستخدم</label>
                                <select class="form-control" id="existingUser" name="user_id" style="width: 100%;">
                                    <option value="">-- اختر مستخدم --</option>
                                </select>
                            </div>
                        </div>

                        <!-- إضافة مستخدم جديد -->
                        <div id="newUserSection" style="display: none;">
                            <hr>
                            <h6>إضافة مستخدم جديد</h6>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="newUserName">الاسم</label>
                                    <input type="text" class="form-control" id="newUserName" name="name">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="newUserPhone">رقم الهاتف</label>
                                    <input type="text" class="form-control" id="newUserPhone" name="mobile">
                                </div>
                            </div>
                        </div>

                    <!-- بيانات إضافية -->
                    <div class="user-data" style="display: none;">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="add_edit_send_internet_exist">ارسال حساب انترنت</label>
                                <select class="form-control" id="add_edit_send_internet_exist" name="send_internet" style="width: 100%;">
                                    <option value="0">لا</option>

                                    <option value="1">نعم</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="add_edit_create_invoice">انشاء فاتورة الكترونية</label>
                                <select class="form-control" id="add_edit_create_invoice" name="create_invoice" style="width: 100%;">
                                    <option value="0">لا</option>

                                    <option value="1">نعم</option>
                                </select>
                            </div>
                        </div>

                        <!-- بيانات الفاتورة -->
                        <div class="row invoice_data">

                            <div class="form-group col-md-6">
                                <label for="paymentAmount_exist">المبلغ</label>

                            <input type="number" min="0" class="form-control" id="paymentAmount_exist" name="amount" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="amount_type">نوع العملة</label>
                                <select class="form-control" id="amount_type" name="amount_type" style="width: 100%;">
                                    <option value="1">دولار</option>
                                    <option value="2">شيكل</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('label.start_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" name="start_date" id="start_date" readonly required />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('label.end_date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" name="end_date" id="end_date" readonly required />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="paymentStatus_exist">الحالة</label>
                                <select class="form-control" id="paymentStatus_exist" name="status" style="width: 100%;">
                                    <option value="0">غير مدفوع</option>
                                    <option value="1">مدفوع</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>طريقة الدفع</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="paymentCash_exist" name="payment_method" value="2">
                                    <label class="form-check-label" for="paymentCash_exist">نقدا</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="paymentBank_exist" name="payment_method" value="1">
                                    <label class="form-check-label" for="paymentBank_exist">بنكي</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary" id="assignSubscription">تعيين الاشتراك</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    </div>
    @include('admin.internetSubscriptions.modal.add_edit')
    @include('Shared.delete')
@endsection


@section('scripts')
    @include('admin.internetSubscriptions.js.available')
@endsection
