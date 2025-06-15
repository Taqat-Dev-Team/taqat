@extends('layouts.front')
@section('title')
الشهادات العلمية
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة الشهادات العلمية</h1>
            </div>
            <div class="card-toolbar">

                <a href="{{ route('front.scientificCerificates.create') }}" class="btn btn-primary mr-1"> اضافة شهادة جديدة </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>عنوان </th>
                            <th>التخصص</th>
                            <th>المكان</th>
                            <th>تاريخ التخرج</th>
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
    @include('front.scientificCertificates.js.js')
@endsection
