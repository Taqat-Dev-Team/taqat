@extends('layouts.front')
@section('title')
    شهادات علمية-اضافة
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة شهادات علمية جديدة </h1>
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
                                عنوان
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ old('title') }}" placeholder="">

                            <div class="title error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="country">
                                الدولة
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="country" class="form-control" id="country"
                                value="{{ old('country') }}" placeholder="">

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

                            <input type="text" name="specialization" value="{{ old('specialization') }}"
                                class="form-control" id="specialization" aria-describedby="emailHelp" placeholder="">
                            <div class="specialization error"></div>

                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="university">
                                الجامعة
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="university" value="{{ old('university') }}" class="form-control"
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

                            <input type="text" name="college" class="form-control" id="college" <div
                                class="college error">
                        </div>





                    <div class="col-lg-6 col-sm-12">

                        <label for="graduation_year">
                            سنة
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" id="graduation_year" name="graduation_year" class="form-control" min="1900" max="2100" step="1" value="2023">

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
                        <div class="" style="color:gray">يجيب ان يكون المرفق اقل من 5 ميجا </div>

                        <div class="error photo">

                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-12">


                        <img src="{{asset('assets/default.png')}}" style="width: 100px"
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
    @include('front.scientificCertificates.js.add')
@endsection
