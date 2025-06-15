@extends('layouts.front')
@section('title')
الرئيسية
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">عرض بيانات الحضور والانصراف</h1>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <div class="card-body">

        <div class="row">
        

            <div class="col-lg-4 col-sm6">
                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                    <label>عدد الحضور</label>
                    <span id="presence_count">{{$presence_count}}</span>
                </div>

            </div>


            <div class="col-lg-4 col-sm6">
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                    <label>عدد ساعات العمل</label>
                    <span id="hours_count">{{$hours_count}}</span>
                </div>

            </div>
        </div>

    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">
                      <th>تاريخ</th>
                    <th>موعد الحضور</th>
                    <th>موعد الانصراف</th>
                    <th>مدة الدوام بالساعات</th>

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
@include('front.attendances.js.js')
@endsection
