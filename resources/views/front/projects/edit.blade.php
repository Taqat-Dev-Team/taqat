@extends('layouts.front')
@section('title')
مشاريع-تعديل

@endsection

{{-- @section('style') --}}

<style>
    .image-area {
        position: relative;
        width: 200px;
        height: 200px;
    }
    .image-area img{
        max-width: 100%;
        height: auto;
    }
    .remove-image {
        display: none;
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 10em;
        padding: 2px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }
    .remove-image:hover {
        background: #E54E4E;
        padding: 3px 7px 5px;
        top: -11px;
        right: -11px;
    }
    .remove-image:active {
        background: #E54E4E;
        top: -10px;
        right: -11px;
    }

    .remove-option {
        display: none;
        position: absolute;
        top: 37px;
        right: 100px;
        border-radius: 10em;
        padding: 2px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }
    .remove-option:hover {
        background: #E54E4E;
        padding: 3px 7px 5px;
        top: 37px;
        right: 100px;
    }
    .remove-option:active {
        background: #E54E4E;
        top: 37px;
        right: 100px;
    }
</style>
{{-- @endsection --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل مشاريع     </h1>
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
                            <input type="text" name="title" class="form-control" id="title" value="{{$project->title}}"
                                 placeholder="">
                                 <input type="hidden" name="project_id" class="form-control"  value="{{$project->id}}">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="url">
                                رابط
                            </label>
                            <input type="text" name="url" class="form-control" id="url" value="{{$project->url}}"
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

                                <select class="form-control" name="project_type_id" id="project_type_id">

                                    <option value="">اختر</option>
                                    @foreach ($projectTypes as $value )

                                    <option value="{{$value->id}}" @if($project->project_type==$value->id)selected @endif>{{$value->title}}</option>
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


                                <textarea  id="description" class="form-control description" name="description">{{$project->description}}</textarea>
                                <div class="description error"></div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="vedio_url">
                                رابط الفيديو
                                </label>

                                <input type="text" name="vedio_url" class="form-control" id="vedio_url" value="{{$project->vedio_url}}"
                                placeholder="">

                                <div class="vedio_url error"></div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                                الصورة

                            </label>
                            <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">يجيب ان يكون المرفق اقل من 0.5ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">


                            <img src="{{$project->getAttachment()}}" style="width: 100px"
                                 class="img-thumbnail img-preview"  id="imagePreview" alt="">

                        </div>

                    </div>
                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="photo">
                                الصورة
                                </label>


                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                        <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                    </div>

                        </div>

                        <div class="" style="color:gray">يجيب ان يكون الصور اقل من  5 ميجا </div>







                    </div>

                    <div class=" form-group  image_remove row">
                        @if(isset($project->images))
                            @foreach($project->images as $image)
                                <div id="screen_image_all" class="col-lg-3">

                                    <div class="screen_image_attachment col-3">

                                            <?php
                                            $url=url('public/files/'.$image->photo);
                                            ?>
                                        <div class="image-area">
                                            <img style="width:200px; height:150px" src="{{$url}}" />
                                            <a class="remove-image" id="{{$image->id}}" url="{{$url}}" href="javascript:void(0)" style="display: inline;">&#215;</a>
                                        </div>
                                        <input type="hidden" value="{{$image->id}}" name="id">
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
@include('front.projects.js.edit')
@endsection
