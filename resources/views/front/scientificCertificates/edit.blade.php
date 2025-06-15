@extends('layouts.front')
@section('title')
    شهادات علمية-تعديل
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">تعديل شهادات علمية  </h1>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf

                    <input type="hidden" name="scientific_certificate_id" class="form-control" value="{{$scientific_certificate->id }}" id="college">

                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="title">
                                عنوان
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{$scientific_certificate->title }}" placeholder="">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="country">
                                الدولة
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="country" class="form-control" id="country"
                            value="{{$scientific_certificate->country }}" placeholder="">

                            {{-- <div  --}}
                            <div class="country error"></div>

                        </div>


                    </div>


                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="specialization">
                                التخصص
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="specialization" value="{{$scientific_certificate->specialization }}"
                                class="form-control" id="specialization" aria-describedby="emailHelp" placeholder="">
                            <div class="specialization error"></div>

                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="university">
                                الجامعة
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="university" value="{{$scientific_certificate->university }}" class="form-control"
                                id="university" aria-describedby="emailHelp" placeholder="">
                            <div class="university error"></div>

                        </div>



                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="college">
                                كلية
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="college" class="form-control" value="{{$scientific_certificate->college }}" id="college">
                             <div class="college error"></div>
                        </div>





                        <div class="col-lg-6 col-sm-12">

                            <label for="graduation_year">
                                سنة
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="graduation_year" value="{{$scientific_certificate->graduation_year}}" name="graduation_year" class="form-control" min="1900" max="2100" step="1" value="2023">

                            <div class="graduation_year error"></div>

                        </div>


                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="photo">
                           الصورة
                            <span class="text-danger">*</span>

                        </label>
                        <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >
                        <div class="" style="color:gray">يجيب ان يكون المرفق اقل من  5 ميجا </div>

                        <div class="error photo">

                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-12">


                        <img src="{{$scientific_certificate->getPhoto()}}" style="width: 100px"
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
    @include('front.scientificCertificates.js.edit')
@endsection
