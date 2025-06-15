@extends('layouts.front')
@section('title')
الخبرات العملية
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة الخبرات العملية</h1>
            </div>
            <div class="card-toolbar">

                <a href="{{ route('front.workExperiences.create') }}" class="btn btn-primary mr-1"> اضافة خبرةعملية جديدة </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>اسم المؤسسة</th>
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
    @include('front.workExperiences.js.js')
@endsection
