@extends('layouts.admin')
@section('title')
المستخدمين -عرض المستخدم

@endsection


@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">المستخدم : {{$user->name}}</h1>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->

            <!--end::Dropdown-->
            <!--begin::Button-->
            <h6 class="card-label">تاريخ التسحيل : {{$user->created_at->format('Y-m-d')}}</h6>


            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        <div class="modal-body">



            <input id="user_id" type="hidden" value="{{$user->id}}">
                <div class="row">
                    <div class="col-lg-6  col-sm-12">
                        <div class="form-group">
                            <label for="name">الاسم

                            </label>
                            <input type="text" readonly class="form-control" id="name" value="{{$user->name}}"
                                name="name">
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">
                        <div class="form-group">
                            <label for="email">
                                الايميل

                            </label>
                            <input type="email" readonly class="form-control" id="email" name="email"
                                value="{{$user->email}}" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-6  col-sm-12">
                        <div class="form-group">
                            <label for="mobile">

                                رقم الجوال

                            </label>
                            <input type="tel" readonly class="form-control" id="mobile" name="mobile"
                                value="{{$user->mobile}}">
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">
                        <div class="form-group">
                            <label for="whatsapp">الواتساب
                            </label>
                            <input type="text" readonly class="form-control" id="whatsapp" name="whatsapp"
                                value="{{$user->whatsapp}}">
                        </div>
                    </div>


                </div>


                <div class="row">

                    <div class="col-lg-6  col-sm-12">
                        <div class="form-group">
                            <label for="marital_status">الحالة الاجتماعية
                            </label>
                            <input type="text" readonly class="form-control" id="whatsapp" name="marital_status"
                                value="{{$user->marital_status}}">


                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="company_name">اسم الشركة
                            </label>
                            <input type="text" readonly class="form-control" id="company_name" name="company_name"
                                value="{{$user->company_name}}">
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="job">المسمى الوظيفي

                            </label>
                            <input type="text" readonly class="form-control" id="job" name="job"
                                value="{{$user->job}}">

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="salary">الراتب اكبر من

                            </label>
                            <input type="text" readonly class="form-control" id="sallary" name="sallary"
                                value="{{$user->sallary}}">

                        </div>
                    </div>



                </div>

                <div class="row mb-1">

                    <div class="col-lg-6  col-sm-12">
                        <label for="original_place">مكان السكن الاصلي
                        </label>
                        <select disabled class="form-control" id="original_place" name="original_place">
                            <option value="">اختر</option>
                            <option value="شمال غزة" @if($user->original_place=="شمال غزة") selected @endif>شمال غزة</option>
                            <option value="مدينة غزة" @if($user->original_place=="مدينة غزة") selected @endif>مدينة غزة</option>
                            <option value="الوسطى" @if($user->original_place=="الوسطى") selected @endif>الوسطى</option>
                            <option value="خانيونس" @if($user->original_place=="خانيونس") selected @endif >خانيونس</option>
                            <option value="رفح" @if($user->original_place=="رفح") selected @endif></option>
                        </select>
                    </div>


                    <div class="col-lg-6  col-sm-12">
                        <label for="displacement_place">مكان النزوح
                        </label>
                        <select disabled class="form-control" id="displacement_place" name="displacement_place">
                            <option value="">اختر</option>
                            <option value="خانيونس" @if($user->displacement_place=="خانيونس") selected @endif>خانيونس</option>
                            <option value="دير البلح" @if($user->displacement_place=="دير البلح") selected @endif>دير البلح</option>
                            <option value="الزوايدة" @if($user->displacement_place=="الزوايدة") selected @endif>الزوايدة</option>
                            <option value="النصيرات" @if($user->displacement_place=="النصيرات") selected @endif>النصيرات</option>
                            <option value="اخرى" @if($user->displacement_place=="اخرى") selected @endif>اخرى</option>
                        </select>
                    </div>
                    </div>



                <div class="row">

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="photo">الصورة الشخصية
                                <span style="color: red">*</span>
                            </label>
                            {{-- <input type="file" class="form-control" id="photo" name="photo"> --}}



                        </div>


                        @if($user->photo)
                        <a href="{{asset('public/files/'.$user->photo)}}" target="_blank">
                            <img src="{{asset('public/files/'.$user->photo)}}" width="100px"></a>
                        @endif
                    </div>


                </div>


                <hr>




        </div>
        <h5>عرض كشف الحضور والانصراف </h5>

        <hr>
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
<script>
table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,

    searching: true,
    ajax: {
        url: "{{route('admin.users.getAttendance')}}",
        type: 'get',
        "data":function(d){
            d.user_id=$('#user_id').val();
        },

    },

    columns: [
        {data: 'date', name: 'date'},
        {data: 'login_time', name: 'login_time'},
        {data: 'logout_time', name: 'logout_time'},
        {data: 'hours', name: 'hours'},
    ],

    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
    }
});

</script>
@endsection
