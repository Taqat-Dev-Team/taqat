@extends('layouts.front')
@section('title')
الحركات المالية
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة الحركات المالية</h1>
            </div>

            <div class="card-toolbar">

                <a href="{{ route('front.incomeMovements.create') }}" class="btn btn-primary mr-1"> اضافة حركة مالية جديدة </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->

            <div class="row">
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>عدد الحركات</label>
                        <span id="count_income">({{$count_income}})</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>اجمالي الحركات</label>
                        <span id="total_income">({{$total_income}})</span>
                    </div>

                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>اعلى حركة مالية</label>
                        <span id="max_income">({{$max_income}})</span>
                    </div>


                </div>
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>أقل حركة مالية</label>
                        <span id="min_income">({{$min_income}})</span>
                    </div>

                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th></th>
                            <th>المصدر</th>
                            <th>الملبغ</th>
                            <th>التاريخ</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    @include('Shared.delete')
@endsection

@section('scripts')
    @include('front.incomeMovements.js.js')
@endsection
