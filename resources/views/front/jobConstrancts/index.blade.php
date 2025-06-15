@extends('layouts.front')
@section('title')
    عقود العمل
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة عقود العمل</h1>
            </div>
            <div class="card-toolbar">

                <a href="{{ route('front.jobConstrancts.create') }}" class="btn btn-primary mr-1"> اضافة عقد عمل جديد </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th></th>
                            <th>اسم الشركة</th>
                            <th>نوع</th>
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
    @include('front.jobConstrancts.js.js')
@endsection
