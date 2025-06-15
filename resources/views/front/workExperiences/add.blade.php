@extends('layouts.front')
@section('title')
خبرات عملية-اضافة

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة  خبرات عملية  جديدة   </h1>
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
                                 اسم المؤسسة
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="company_name" class="form-control" id="title" value="{{old('company_name')}}"
                                 placeholder="">

                            <div class="company_name error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="location">
                                مكان المؤسسة
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="location" class="form-control" id="location" value="{{old('location')}}"
                                   placeholder="">

                                   {{-- <div  --}}
                                   <div class="location error"></div>

                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="start_date">
                                 من تاريخ
                                    <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker start_at" readonly="readonly" name="start_date"
                                    placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="start_date error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="end_date">
                                الى تاريخ
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker start_at" readonly="readonly" name="end_date"
                                    placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>

                                   {{-- <div  --}}
                                   <div class="location error"></div>

                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="job">
                                المسمى الوظيفي
                                    <span class="text-danger">*</span>
                                </label>

                            <input type="text" name="job" value="{{old('job')}}" class="form-control" id="job"
                                   aria-describedby="emailHelp" placeholder="">
                                   <div class="job error"></div>

                        </div>
















                    </div>


                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="tasks">
                                المهام الموكلة
                                    <span class="text-danger">*</span>
                                </label>






                                            <textarea id="description" class="form-control description" name="description"></textarea>
                                            <div class="description error"></div>

                                 <div class="tasks error">


                                   </div>


                                </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               الصورة

                            </label>
                            <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">يجيب ان يكون المرفق اقل من   5 ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">


                            <img src="{{asset('assets/default.png')}}" style="width: 100px"
                                 class="img-thumbnail img-preview"  id="imagePreview" alt="">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>
                          تاكيد

                        </button>
                        <div id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </div>

                    </div>
            </form>

        </div>
    </div>




@endsection

@section('scripts')
@include('front.workExperiences.js.add')
@endsection
