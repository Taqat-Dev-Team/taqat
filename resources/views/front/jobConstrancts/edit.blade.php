@extends('layouts.front')
@section('title')
    عقود عمل-تعديل

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل عقد عمل     </h1>
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
                    <input type="hidden" value="{{$jobConstrancts->id}}"  name="job_constranct_id" class="form-control" id="job_constranct_id" >

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="company_name">
                                 اسم الشركة
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="company_name" class="form-control" id="company_name" value="{{$jobConstrancts->company_name}}"
                                 placeholder="">

                            <div class="company_name error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="sallary">
                                الراتب
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0"  name="sallary" class="form-control" id="sallary" value="{{$jobConstrancts->sallary}}"
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
                                <input type="text" value="{{$jobConstrancts->date}}" class="form-control datepicker date" readonly="readonly" name="date"
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
                                <input type="text" value="{{$jobConstrancts->duration}}"  name="duration" class="form-control" id="duration" value="{{old('duration')}}"
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

                                <option value="عقد شركة"  @if($jobConstrancts->job_type=="عقد شركة") selected @endif>عقد شركة</option>
                                <option value="عقد مشروع"  @if($jobConstrancts->job_type=="عقد مشروع") selected @endif>عقد مشروع</option>

                            </select>
                             {{-- <div  --}}
                             <div class="job_type error"></div>


                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               المرفق

                            </label>
                            <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">يجيب ان يكون الصور اقل من   2 ميجا </div>

                            <div class="error photo">

                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">


                            @php
                            $attachment = $jobConstrancts->getAttachment();
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

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="note">

                                ملاحظات
                                    <span class="text-danger">*</span>
                                </label>






                                <textarea id="description" class="form-control description" name="description">{{$jobConstrancts->note}}</textarea>
                                            <div class="note error"></div>

                                 <div class="note description">


                                   </div>


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
@include('front.jobConstrancts.js.edit')
@endsection
