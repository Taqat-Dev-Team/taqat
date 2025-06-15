@extends('layouts.front')
@section('title')
    الدورات التدريبية-اضافة

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة دورة تدريبية جديدة   </h1>
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

                            <label for="title">
                                 عنوان الدورة
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}"
                                 placeholder="">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="location">
                                مكان الدورة
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
                        <div class="col-lg-12 col-sm-12">

                            <label for="description">

                                الوصف محاور الدورة
                                    <span class="text-danger">*</span>
                                </label>






                                            <textarea id="description" class="form-control description" name="description"></textarea>
                                            <div class="description error"></div>

                                 <div class="description error">


                                   </div>


                                </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="specialty">
                                التخصص
                                    <span class="text-danger">*</span>
                                </label>

                            <input type="text" name="specialty" value="{{old('specialty')}}" class="form-control" id="specialty"
                                   aria-describedby="emailHelp" placeholder="">
                                   <div class="specialty error"></div>

                        </div>



                        <div class="col-lg-6 col-sm-12">

                            <label for="photo">
                                الصورة
                                </label>

                                <input class="form-control image" type="file" name="photo" id="photo"
                                onchange="readURL(this);" accept="image/*">

                                   <div class="" style="color:gray">يجيب ان يكون الصور اقل من  5 ميجا </div>
                                   <div class="photo error"></div>

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
@include('front.trainingCourses.js.add')
@endsection
