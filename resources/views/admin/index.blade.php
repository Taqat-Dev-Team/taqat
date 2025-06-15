@extends('layouts.admin')

@section('title','لوحة الرئيسية')
@section('content')

    {{--    <div class="m-portlet">--}}
    {{--        <div class="m-portlet__body  m-portlet__body--no-padding">--}}
    {{--            <div class="row m-row--no-padding m-row--col-separator-xl">--}}

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">الاحصائيات العامة</h1>
            </div>
            <div>



            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3">
                    <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                        <h6>المستخدمين</h6>
                        <label>{{$data['user_count']}}</label>
                    </div>

                </div>
                <div class="col-lg-3">

                    <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                        <h6>الدول  </h6>
                        <label>{{\App\Models\Country::count()}}</label>
                    </div>
                </div>
                <div class="col-lg-3">


                    <div class="col bg-light-success px-6 py-8 rounded-xl mb-7">
                        <h6>المدن</h6>
                        <label>{{\App\Models\City::count()}}</label>
                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="col bg-light-warning px-6 py-8 rounded-xl mb-7">
                        <h6>الاهتمامات</h6>
                        <label>{{\App\Models\Interest::count()}}</label>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3">


                    <div class="col bg-primary px-6 py-8 rounded-xl mb-7">
                        <h6>الوظائف</h6>
                        <label>{{\App\Models\Profession::count()}}</label>
                    </div>
                </div>
                <div class="col-lg-3">


                    <div class="col bg-danger px-6 py-8 rounded-xl mb-7">
                        <h6>المؤسسات</h6>
                        <label>{{\App\Models\Institution::count()}}</label>


                    </div>
                </div>


            </div>

        </div>

    </div>

                <div class="card card-custom">
                    <div class="card-header flex-wrap">
                        <div class="card-title">
                            <h1 class="card-label">عرض كافة المستخدمين</h1>
                        </div>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Table-->

                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                                <thead>
                                <tr class="text-left">

                                    <th >الاسم</th>
                                    <th >الايميل</th>
                                    <th>العمليات</th>
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

    <script src="{{asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>






@include('admin.users.js.js')



@endsection







