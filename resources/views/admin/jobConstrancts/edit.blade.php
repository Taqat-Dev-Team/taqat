@extends('layouts.admin')
@section('title')
    {{__('label.edit_job_constrancts')}}

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">    {{__('label.edit_data_job_constrancts')}}                </h1>
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
                    <input type="hidden" value="{{$jobContract->id}}"  name="job_contract_id" class="form-control" id="job_constranct_id" >

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="company_name">
                                 {{__('label.company_name')}}
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="company_name" class="form-control" id="company_name" value="{{$jobContract->company_name}}"
                                 placeholder="">

                            <div class="company_name error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="sallary">
                                {{__('label.sallary')}}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0"  name="sallary" class="form-control" id="sallary" value="{{$jobContract->sallary}}"
                                   placeholder="">

                                   {{-- <div  --}}
                                   <div class="sallary error"></div>

                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="date">
                                 {{__('label.date')}}
                                    <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" value="{{$jobContract->date}}" class="form-control datepicker date" readonly="readonly" name="date"
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
                                    {{__('label.duration')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" value="{{$jobContract->duration}}"  name="duration" class="form-control" id="duration"
                                       placeholder="">
                                       <div class="duration error"></div>



                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="job_type">
                                {{__('label.job_type')}}
                                <span class="text-danger">*</span>

                             </label>


                             <select class="form-control" name="job_type" id="job_type">
                                <option value="">{{__('label.seleted')}}</option>

                                <option value="عقد شركة"  @if($jobContract->job_type=="عقد شركة") selected @endif>{{__('label.company_contract')}}</option>
                                <option value="عقد مشروع"  @if($jobContract->job_type=="عقد مشروع") selected @endif>{{__('label.project_contract')}}</option>

                            </select>
                             <div class="job_type error"></div>


                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               {{__('label.attachments')}}

                            </label>
                            <input class="form-control photo" type="file" accept="image/*,.pdf" name="photo" id="photo" >
                            <div class="" style="color:gray">{{__('label.It_must_be_less_than_2MB_in_size')}}</div>

                            <div class="error photo">

                            </div>
                        </div>

                        @php
                        $attachment = $jobContract->getAttachment();
                        $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                        <img src="{{$attachment}}" style="width: 100px" class="img-thumbnail img-preview" id="imagePreview" alt="">
                    @elseif(in_array($extension, ['pdf']))

                        <a href="{{$attachment}}" target="_blank">
                            <i class="fa fa-file-pdf" style="font-size: 100px; color: red;"></i>
                        </a>
                        @else

                        <img src="{{asset('assets/default.png')}}" style="width: 100px" class="img-thumbnail img-preview" id="imagePreview" alt="">


                    @endif



                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="note">

                                {{__('label.note')}}
                                    <span class="text-danger">*</span>
                                </label>






                                <textarea id="description" class="form-control description" name="description">{{$jobContract->note}}</textarea>
                                            <div class="note error"></div>

                                 <div class="note description">


                                   </div>


                                </div>
                    </div>







                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">

                            <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                            </i>
                            <span id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </span>
                        {{ __('label.submit') }}

                        </button>


                    </div>
            </form>

        </div>
    </div>




@endsection

@section('scripts')
@include('admin.jobConstrancts.js.edit')
@endsection
