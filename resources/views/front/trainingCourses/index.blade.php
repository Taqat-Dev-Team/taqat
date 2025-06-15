@extends('layouts.front')
@section('title')
    الدورات التدريبية
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة الدورات التدريبية</h1>
            </div>
            <div class="card-toolbar">

                <a href="{{ route('front.trainingCourses.create') }}" class="btn btn-primary mr-1"> اضافة دورة تدريبية جديد </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>عنوان الدورة</th>
                            <th>التخصص</th>
                            <th>المكان</th>
                            <th>من تاريخ</th>
                            <th>الى تاريخ</th>
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
    @include('front.trainingCourses.js.js')
@endsection
