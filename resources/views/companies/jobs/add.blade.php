@extends('layouts.companies')
@section('title')
{{__('label.add_new_job')}}
@endsection
@section('sub_page')
|<a href="{{route('companies.projects.index')}}">{{__('label.jobs')}}</a>
@endsection
@section('title_pages')
|{{__('label.add_new_job')}}
@endsection
@section('total_page')
{{__('jobs_count')}}({{$job_count}})
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

                            <select class="form-control select" name="specialization_id" id="specialization_id" >
                                <option value="">{{__('label.seleted')}}</option>

                                @foreach ($specializations as $value)
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="duration">
                                {{__('label.duration')}} ({{__('label.months')}})
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="duration" class="form-control" id="duration"
                                value="{{ old('duration') }}" placeholder="">

                            <div class="duration error"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <label for="permanent_type">
                                {{__('label.permanent_type')}}
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-control select" name="permanent_type" id="permanent_type" >
                                <option value="">اختر</option>
                                <option value="دوام كامل">{{__('label.full_time')}}</option>
                                <option value="دوام جزئي">{{__('label.part_time')}}</option>



                            </select>
                        </div>


                    </div>

                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="description">
                                {{__('label.description')}}
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="description" class="form-control description " name="description"></textarea>
                            <div class="description error"></div>

                        </div>
                    </div>



                    <div class="form-group row">


                        <div class="col-lg-12 col-sm-12">

                            <label for="job_requirements">
                                {{__('label.job_requirements')}}
                                <span class="text-danger">*</span>
                            </label>


                            <textarea id="job_requirements" class="form-control job_requirements  " name="job_requirements"></textarea>
                            <div class="job_requirements error"></div>

                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-lg-6 col-sm-12">
                            <label for="sallary">
                                {{__('label.sallary')}}

                            </label>


                            <input class="form-control" type="number" min="0"  name="sallary" id="sallary">
                        </div>
                        <div class="col-lg-6  col-sm-12">

                            <div class="form-group">


                                <label class="required">{{__('label.skills')}}</label>
                                <span class="text-danger">*</span>

                                <input placeholder=""
                                    class="form-control form-control-lg form-control-solid" name="skills" value="{{auth()->user()->skills}}"
                                    id="kt_tagify_5" />



                                <span class="error-msg" id="skills-error"></span>



                            </div>
                        </div>
                    </div>














                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>
                            {{__('label.submit')}}
                            <div id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </div>
                        </button>


                    </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    @include('companies.jobs.js.add')
@endsection
