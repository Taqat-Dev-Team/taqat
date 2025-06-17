@extends('layouts.front')
@section('title')
    عقود عمل-اضافة

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة عقد عمل  جديد   </h1>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="company_name">
                                 اسم الشركة
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="company_name" class="form-control" id="company_name" value="{{old('company_name')}}"
                                 placeholder="">

                            <div class="company_name error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="sallary">
                                الراتب
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0" name="sallary" class="form-control" id="sallary" value="{{old('sallary')}}"
                                   placeholder="">

                                   {{-- <div  --}}
                                   <div class="sallary error"></div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="date">
                                 تاريخ العقد
                                    <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker start_at " readonly="readonly" name="date"
                                    placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="date error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">


                                <label for="duration">
                                    مدة العقد
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="duration" class="form-control" id="duration" value="{{old('duration')}}"
                                       placeholder="">
                                       <div class="duration error"></div>



                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="job_type">
                                نوع العقد
                                <span class="text-danger">*</span>

                             </label>


                             <select class="form-control" name="job_type" id="job_type">
                                <option value="">اختر</option>

                                <option value="عقد شركة">عقد شركة</option>
                                <option value="عقد مشروع">عقد مشروع</option>

                            </select>
                             {{-- <div  --}}
                             <div class="sallary error"></div>


                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               المرفق

                            </label>
                            <input class="form-control photo" type="file" accept="image/*,application/pdf" name="photo" id="photo">
                            <div class="" style="color:gray">يجيب ان يكون المرفق اقل من  2 ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="note">

                                ملاحظات
                                    <span class="text-danger">*</span>
                                </label>






                                <textarea id="description" class="form-control" name="description"></textarea>
                                <div class="description error"></div>




                                </div>
                    </div>







                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>
                          تاكيد

                          <div class="spinner-border spinner-border-sm" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        </button>


                    </div>
            </form>

        </div>
    </div>




@endsection

@section('scripts')
@include('front.jobConstrancts.js.add')
@endsection
