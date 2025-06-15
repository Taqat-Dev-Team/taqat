@extends('layouts.companies')
@section('title')
    {{ __('label.edit_employee') }}
@endsection
@section('sub_page')
    |<a href="{{ route('companies.users.index') }}"> {{ __('label.employees') }}</a>
@endsection
@section('title_pages')
    |{{ __('label.edit_employee') }}
@endsection
@section('total_page')
    {{ __('label.employees_count') }}({{ $employee_count }})
@endsection
@section('content')

    <div class="card card-custom">

        <div class="card-body">

                <div class="modal-body">
                    @csrf

                    <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data" style="margin:auto">
                        <input type="hidden" value="{{$user->id}}" name="user_id">

                        @csrf

                            <div class="row">
                                <div class="col-lg-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{__('label.name')}}
                                            <span style="color: red">*</span>

                                        </label>
                                        <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                                        <div class="name error"></div>

                                    </div>
                                </div>
                                <div class="col-lg-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="email">
                                            {{__('label.email')}}
                                            <span style="color: red">*</span>

                                        </label>
                                        <input type="email" class="form-control" id="email" name="email"   value="{{$user->email}}"required>
                                        <div class="email error"></div>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="mobile">

                                            {{__('label.mobile')}}
                                            <span style="color: red">*</span>

                                        </label>
                                        <input type="tel" class="form-control" id="mobile" name="mobile"value="{{$user->mobile}}">
                                        <div class="mobile error"></div>

                                    </div>
                                </div>
                                <div class="col-lg-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="whatsapp">
                                             {{__('label.whatsapp')}}

                                            <span style="color: red">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{$user->whatsapp}}">
                                        <div class="whatsapp error"></div>

                                    </div>
                                </div>


                            </div>


                            <div class="row">

                                <div class="col-lg-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="marital_status"> {{__('label.marital_status')}}

                                            <span style="color: red">*</span>
                                        </label>
                                            <select  class="form-control" id="marital_status" name="marital_status" >
                                            <option value="">اختر</option>
                                            <option value="أعزب" @if($user->marital_status=="أعزب")selected @endif>أعزب</option>
                                            <option value="متزوج" @if($user->marital_status=="متزوج")selected @endif>متزوج</option>

                                        </select>
                                        <div class="marital_status error"></div>

                                    </div>
                                </div>





                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="specialization_id">

                                            {{ __('label.specializations') }}

                                            <span style="color: red">*</span>

                                        </label>


                                        <select class="form-control select" id="specialization_id" name="specialization_id">

                                            <option value="">{{__('label.seleted')}}</option>
                                            @foreach ($specializations as $value)

                                            <option value="{{$value->id}}"@if($value->id==$user->specialization_id) selected @endif>{{$value->title}}</option>
                                            @endforeach
                                        </select>

                                        <div class="specialization_id error"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="salary">{{__('label.sallary')}}
                                            <span style="color: red">*</span>

                                        </label>
                                        <input type="text"  class="form-control" id="sallary" name="sallary" value="{{$user->sallary}}">

                                    </div>
                                </div>



                            </div>

                            <div class="row mb-1">

                            <div class="col-lg-6  col-sm-12">
                                <label for="original_place">{{__('label.original_place')}}
                                    <span style="color: red">*</span>
                                </label>
                                <select class="form-control" id="original_place" name="original_place">
                                    <option value="">>{{__('label.seleted')}}</option>
                                    <option value="شمال غزة" @if($user->original_place=="شمال غزة") selected @endif>{{__('label.noth_gaza')}}</option>
                                    <option value="مدينة غزة" @if($user->original_place=="مدينة غزة") selected @endif>{{__('label.gaza')}}</option>
                                    <option value="الوسطى" @if($user->original_place=="الوسطى") selected @endif>{{__('label.alwasta')}}</option>
                                    <option value="خانيونس" @if($user->original_place=="خانيونس") selected @endif >{{__('label.khan_Younes')}}</option>
                                    <option value="رفح" @if($user->original_place=="رفح") selected @endif></option>
                                </select>
                                <div class="original_place error"></div>

                            </div>


                            <div class="col-lg-6  col-sm-12">
                                <label for="displacement_place">{{__('label.displacement_place')}}
                                    <span style="color: red">*</span>
                                </label>
                                <select class="form-control select" id="displacement_place" name="displacement_place">
                                    <option value="">{{__('label.seleted')}}</option>
                                    <option value="خانيونس" @if($user->displacement_place=="خانيونس") selected @endif>{{__('label.khan_Younes')}}</option>
                                    <option value="دير البلح" @if($user->displacement_place=="دير البلح") selected @endif>{{__('label.dair_Al_Balah')}}</option>
                                    <option value="الزوايدة" @if($user->displacement_place=="الزوايدة") selected @endif>{{__('label.al_Zawayda')}}</option>
                                    <option value="النصيرات" @if($user->displacement_place=="النصيرات") selected @endif>{{__('label.nuseirat')}}</option>
                                    <option value="اخرى" @if($user->displacement_place=="اخرى") selected @endif>{{__('label.other')}}</option>
                                </select>
                                <div class="displacement_place error"></div>

                            </div>
                            </div>



                            <div class="row">

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="photo">{{_('label.photo')}}
                                        </label>
                                        <input type="file"   class="form-control" accept="image/*"  id="photo" name="photo">

                                    </div>
                                </div>


                                <div class="col-lg-6 col-sm-12">

<a href="{{asset($user->photo)}}" target="_blank" >
         <img src="{{$user->photo}}" width="100px"></a>
                                </div>


                            </div>





                        <hr>
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                            aria-hidden="true"></i></span>
                    {{ __('label.submit') }}
                </button>

                <div id="spinner" style="display: none;">
                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                </div>

            </form>





        </div>
    </div>

@endsection
@section('scripts')

@include('companies.users.js.edit_create')
@endsection
