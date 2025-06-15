@extends('layouts.companies')
@section('title')
    {{__('label.edit_project')}}
@endsection
@section('sub_page')
|<a href="{{route('companies.projects.index')}}">{{__('label.projects')}}</a>
@endsection
@section('title_pages')
|{{__('label.edit_project')}}
@endsection
@section('total_page')
{{__('label.projects_count')}}({{$project_count}})
@endsection
<style>
            .rating {
            direction: rtl; /* If you want right-to-left layout */
            font-size: 2em;
            display: flex;
        }

        .star {
            cursor: pointer;
            color: #ccc; /* Unselected star color */
        }

        .star.selected,
        .star.hover,
        .star.hover ~ .star {
            color: gold; /* Selected star color */
        }

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

        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="title">
                                {{__('label.title')}}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{$project->title}}" placeholder="">
                                <input type="hidden" name="project_id" class="form-control" id="project_id"
                                value="{{$project->id}}" placeholder="">


                            <div class="title error"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <label for="specialization_id">
                                {{__('label.specializations')}}
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-control select" name="specialization_id" id="specialization_id" multiple>
                                <option value="">{{__('label.selected')}}</option>

                                @foreach ($specializations as $value)
                                    <option value="{{ $value->id }}" @if(in_array($value->id,$project->specializations()->pluck('specialization_id')->toArray())) selected @endif>{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>


                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="description">
                                {{__('label.description')}}

                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="description" class="form-control ckeditor" name="description">{{$project->description}}</textarea>
                            <div class="description error"></div>

                        </div>
                    </div>



                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="received_required">
                                {{__('label.received_required')}}
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="received_required" class="form-control received_required ckeditor " name="received_required">{{$project->received_required}}</textarea>
                            <div class="received_required error"></div>

                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-lg-6 col-sm-12">
                            <label for="expected_budget">
                                {{__('label.expected_budget')}}
                                ($)

                                 <span class="text-danger">*</span>
                            </label>

                            <select class="form-control select" name="expected_budget" id="expected_budget">
                                <option value="">اختر</option>

                                <option value="50-200" @if($project->expected_budget=="50-200") selected @endif>50-200</option>
                                <option value="200-500" @if($project->expected_budget=="200-500") selected @endif>200-500</option>
                                <option value="500-800" @if($project->expected_budget=="500-800") selected @endif>300-500</option>
                                <option value="800-1100" @if($project->expected_budget=="800-1100") selected @endif>800-1100</option>
                                <option value="1100-1400" @if($project->expected_budget=="1100-1400") selected @endif>1100-1400</option>

                            </select>
                        </div>
                        <div class="col-lg-6  col-sm-12">

                            <div class="form-group">


                                <label class="required">{{__('label.skills')}}</label>
                                <span class="text-danger">*</span>

                                <input placeholder=""
                                    class="form-control form-control-lg form-control-solid" name="skills" value="{{$project->skills}}"
                                    id="kt_tagify_5" />



                                <span class="error-msg" id="skills-error"></span>



                            </div>
                        </div>
                    </div>

                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">
                            <label for="expected_budget">
                                {{__('label.similar_example')}}
                            </label>

                            <textarea class="form-control" id="similar_example" name="similar_example">{{$project->similar_example}}</textarea>

                        </div>

                    </div>






                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="photo">
                                {{__('label.attachments')}}
                            </label>


                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                <div class="dz-message">{{__('label.can_upload_multi_attachment')}}</div>
                            </div>

                        </div>





                        <div class="form-group image_remove row p-1">
                            @if(isset($project->attachments))
                                @foreach($project->attachments as $file)
                                <div id="screen_image_all " class="col-3">

                                    <div class="screen_image_attachment col-3">

                                            <?php
                                            $url=url($file->attachment);
                                            ?>
                                        <div class="image-area">
                                            <img style="width:200px; height:150px" src="{{$url}}" />
                                            <a class="remove-image" id="{{$file->id}}" url="{{$url}}" href="javascript:void(0)" style="display: inline;">&#215;</a>
                                        </div>
                                        <input type="hidden" value="{{$file->id}}" name="id">
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>






                    </div>



                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">
<label for="status">
                            {{__('label.status')}}
                        </label>

                        <select class="form-control select status" name="status" id="status" >
                            <option value="1" @if($project->status==1) selected @endif> قيد الانتظار</option>
                            <option value="2" @if($project->status==2) selected @endif>مرحلة التنفيد</option>
                            <option value="3" @if($project->status==3) selected @endif> مرحلة التسليم والانهاء</option>
                            <option value="4" @if($project->status==4) selected @endif> الغاء المشروع</option>
                        </select>
                    </div>

                    </div>
                    <div class="form-group row reason_block" style="display: none;">


                        <div class="col-lg-12 col-sm-12">

                            <label for="reason">
                                السبب الغاء المشروع
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="reason" class="form-control" name="reason">{{$project->reason}}</textarea>
                            <div class="description error"></div>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>
                            تاكيد

                        </button>


                    </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    @include('companies.projects.js.edit')
@endsection
