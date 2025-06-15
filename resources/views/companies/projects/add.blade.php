@extends('layouts.companies')
@section('title')
    {{__('label.add_new_project')}}
@endsection
@section('sub_page')
|<a href="{{route('companies.projects.index')}}">{{__('label.projects')}}</a>
@endsection
@section('title_pages')
|{{__('label.add_new_project')}}
@endsection
@section('total_page')
{{__('label.projects_count')}}({{$project_count}})
@endsection

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
                                value="{{ old('title') }}" placeholder="">

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
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
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


                            <textarea id="description" class="form-control" name="description"></textarea>
                            <div class="description error"></div>

                        </div>
                    </div>



                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="received_required">
                                {{__('label.received_required')}}
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="received_required" class="form-control received_required" name="received_required"></textarea>
                            <div class="received_required error"></div>

                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-lg-6 col-sm-12">
                            <label for="expected_budget">
                                {{__('label.expected_budget')}} $

                                 <span class="text-danger">*</span>
                            </label>

                            <select class="form-control select" name="expected_budget" id="expected_budget">
                                <option value="">اختر</option>

                                <option value="50-200">50-200</option>
                                <option value="200-500">200-500</option>
                                <option value="500-800">300-500</option>
                                <option value="800-1100">800-1100</option>
                                <option value="1100-1400">1100-1400</option>

                            </select>
                            <div class="expected_budget error"></div>

                        </div>
                        <div class="col-lg-6  col-sm-12">

                            <div class="form-group">


                                {{__('label.skills')}}
                                <span class="text-danger">*</span>

                                <input placeholder=""
                                    class="form-control form-control-lg form-control-solid" name="skills" value=""
                                    id="kt_tagify_5" />



                                    <div class="skills error"></div>



                            </div>
                        </div>
                    </div>

                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">
                            <label for="similar_example">
                                {{__('label.similar_example')}}
                            </label>

                            <textarea class="form-control" id="similar_example" name="similar_example"></textarea>

                        </div>

                        <div class="similar_example error"></div>

                    </div>






                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="attacment">
                                {{__('label.attachments')}}

                            </label>


                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                <div class="dz-message">{{__('label.can_upload_multi_attachment')}}</div>
                            </div>

                        </div>








                    </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
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
    @include('companies.projects.js.add')
@endsection
