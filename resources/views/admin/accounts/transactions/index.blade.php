@extends('layouts.admin')
@section('title')
تقرير -الحسابات 
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة المعاملات المالية</h1>
            </div>

            <div class="card-toolbar">

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="data-table">
                    <thead>
                        <tr class="text-left">

                            <th>التاريخ</th>
                            <th>من حساب</th>
                            <th>الى حساب</th>
                            <th>المبلغ</th>
                            <th>نوع الجركة</th>


                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>



    @endsection

    @section('scripts')
        @include('admin.accounts.transactions.js.js')
    @endsection
