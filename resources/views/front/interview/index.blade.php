@extends('layouts.front')
@section('title')
    {{__('label.interviews')}}
@endsection



@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">عرض كافة المقابلات </h1>
        </div>
        <div class="card-toolbar">


        </div>
    </div>
    <div class="card-body">


    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">

                    <th>اسم الشركة</th>

                    <th>المسمى الوظيفي</th>

                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>رابط الزوم</th>

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
    @include('front.interview.js.js')
@endsection
