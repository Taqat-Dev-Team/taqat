@extends('layouts.front')
@section('title')
    طلبات السحب
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة طلبات السحب</h1>
            </div>
            <div class="card-toolbar">


            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>عدد طلبات السحب</label>
                        <span id="user_count">({{ $withdraws_count }})</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>اجمالي طلبات السحب</label>
                        <span id="presence_count">({{ $total_withdraws }})</span>
                    </div>

                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>طلبات السحب المدفوعة</label>
                        <span id="absence_count">({{ $paid_withdraws }})</span>
                    </div>


                </div>
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>طلبات السحب الغير مدفوعة</label>
                        <span id="hours_count">({{ $not_paid_withdraws }})</span>
                    </div>

                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>

                        <tr class="text-left">
                            <th></th>

                            <th>رقم الطلب</th>
                            <th>ايبان</th>
                            <th>اسم البنك</th>
                            <th>رقم الحساب البنكي</th>
                            <th>الحالة </th>
                            <th>الرسالة</th>


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
    @include('front.withdraws.js.js')
@endsection
