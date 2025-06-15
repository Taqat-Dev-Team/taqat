@extends('layouts.front')
@section('title')
مشاريع-اضافة

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة مشاريع  جديدة   </h1>
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
                                 عنوان المشروع
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}"
                                 placeholder="">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="url">
                                رابط
                            </label>
                            <input type="text" name="url" class="form-control" id="url" value="{{old('url')}}"
                                   placeholder="">

                                   {{-- <div  --}}
                                   <div class="url error"></div>

                        </div>


                    </div>

                    <div class="form-group row">

                    <div class="col-lg-6 col-sm-12">
                        <label for="description">
                            نوع المشروع
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-control select2" name="project_type_id" id="project_type_id">
                                <option value="">اختر</option>

                                @foreach ($projectTypes as $value )

                                <option value="{{$value->id}}">{{$value->title}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>

                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="description">
                                الوصف
                                    <span class="text-danger">*</span>
                                </label>


                                <textarea id="description" class="form-control description" name="description"></textarea>
                                <div class="description error"></div>

                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="vedio_url">
                                رابط الفيديو
                                </label>

                                <input type="text" name="vedio_url" class="form-control" id="vedio_url" value="{{old('vedio_url')}}"
                                placeholder="">

                                <div class="vedio_url error"></div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               الصورة الرئيسية

                            </label>
                            <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">يجيب ان يكون الصور اقل من  5 ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">


                            <img src="{{asset('assets/default.png')}}" style="width: 100px"
                                 class="img-thumbnail img-preview"  id="imagePreview" alt="">

                        </div>

                    </div>

                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="photo">
                                الصورة
                                    <span class="text-danger">*</span>
                                </label>


                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                        <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                    </div>

                        </div>








                    </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>
                          {{__('label.submit')}}

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
@include('front.projects.js.add')
@endsection
