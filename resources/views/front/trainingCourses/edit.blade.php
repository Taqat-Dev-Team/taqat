@extends('layouts.front')
@section('title')
    الدورات التدريبية-تعديل
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل دورة تدريبية  </h1>
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
                            <input type="hidden" name="training_course_id" class="form-control"
                                value="{{ $trainingCourse->id }}">
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ $trainingCourse->title }}" placeholder="">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="location">
                                مكان الدورة
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="location" class="form-control" id="location"
                                value="{{ $trainingCourse->location }}" placeholder="">

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
                                <input type="text" value="{{ $trainingCourse->start_date }}"
                                    class="form-control datepicker start_at" readonly="readonly" name="start_date"
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
                                <input type="text" value="{{ $trainingCourse->start_date }}"
                                    class="form-control datepicker start_at" readonly="readonly" name="end_date"
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

                            <label for="specialty">
                                التخصص
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="specialty" value="{{ $trainingCourse->specialty }}"
                                class="form-control" id="specialty" <div class="specialty error">
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="description">

                                    <span class="text-danger">*</span>
                                </label>






                                            <textarea id="description" class="form-control description" name="description">{{ $trainingCourse->description }}</textarea>
                                            <div class="description error"></div>

                                 <div class="description error">


                                   </div>


                                </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                                الصورة

                            </label>
                            <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">يجيب ان يكون الصور اقل من  5 ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">


                            <img src="{{$trainingCourse->getPhoto()}}" style="width: 100px"
                                 class="img-thumbnail img-preview"  id="imagePreview" alt="">

                        </div>

                    </div>

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
    @include('front.trainingCourses.js.edit')
@endsection
