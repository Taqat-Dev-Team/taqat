@extends('layouts.admin')
@section('title')
    المستخدمين -عرض المستخدم

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">المستخدم : {{$user->name}}</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->
                <h6 class="card-label">تاريخ التسحيل : {{$user->created_at->format('Y-m-d')}}</h6>


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="modal-body">
                @csrf

                <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data" style="margin:auto">
                    <input type="hidden" value="{{$user->id}}" name="user_id">

                    @csrf

                        <div class="row">
                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="name">الاسم

                                    </label>
                                    <input type="text" readonly class="form-control" id="name" value="{{$user->name}}" name="name">
                                </div>
                            </div>
                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="email">
                                        الايميل

                                    </label>
                                    <input type="email" readonly class="form-control" id="email" name="email"   value="{{$user->email}}"required>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">

                                        رقم الجوال

                                    </label>
                                    <input type="tel" readonly class="form-control" id="mobile" name="mobile"value="{{$user->mobile}}">
                                </div>
                            </div>
                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="whatsapp">الواتساب
                                    </label>
                                    <input type="text"readonly  class="form-control" id="whatsapp" name="whatsapp" value="{{$user->whatsapp}}">
                                </div>
                            </div>


                        </div>


                        <div class="row">

                            <div class="col-lg-6  col-sm-12">
                                <div class="form-group">
                                    <label for="marital_status">الحالة الاجتماعية
                                    </label>
                                    <input type="text"readonly  class="form-control" id="whatsapp" name="marital_status" value="{{$user->marital_status}}">


                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company_name">اسم الشركة
                                    </label>
                                    <input type="text" readonly class="form-control" id="company_name" name="company_name" value="{{$user->company_name}}">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="job">المسمى الوظيفي

                                    </label>
                                    <input type="text" readonly class="form-control" id="job" name="job" value="{{$user->company_name}}" >

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="salary">الراتب اكبر من

                                    </label>
                                    <input type="text"  readonly class="form-control" id="sallary" name="sallary" value="{{$user->sallary}}">

                                </div>
                            </div>



                        </div>




                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="photo">الصورة الشخصية
                                        <span style="color: red">*</span>
                                    </label>
                                    {{-- <input type="file"   class="form-control"  id="photo" name="photo"> --}}



                                </div>
                                </br>


                                @if($user->photo)
<a href="{{asset('public/files/'.$user->photo)}}" target="_blank"             >
                       <img src="{{asset('public/files/'.$user->photo)}}" width="100px"></a>
                       @endif
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="job">المرفقات
                                        <span style="color: red">*</span>

                                    </label>

                                    {{-- <input type="file" multiple  class="form-control" id="attachment" name="attachment[]"> --}}

                                </div>
                            </div>








                        </div>



                        <div class="row">


                            @foreach ($user->attachments as $item)
                            <div class="col-lg-3 col-sm-12 m-1">
                                <a href="{{asset('public/files/'.$item->file)}}" target="_blank"         >
                                <img src="{{asset('public/files/'.$item->file)}}" width="100px">

                                </a>
                            </div>

                            @endforeach








                        </di

        </div>
    </div>
@endsection

