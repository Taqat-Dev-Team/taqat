@extends('layouts.front')
@section('title')
    قائمة الوظائف
@endsection
@section('content')



<!-- Container to hold the project cards in a two-column layout -->
<div class="container">
    <div class="row">
        <!-- Start of the loop for project cards -->
        @foreach($jobs as $value)
        <div class="col-md-6 mb-4">
            <!--begin::Card-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                            <img src="{{$value->company->getPhoto()}}" alt="image" class="img-fluid" />
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="d-flex flex-column mr-auto">
                            <!--begin: Title-->
                            <a href="{{route('front.jobs.views',$value->id)}}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$value->title}}</a>
                            <span class="text-muted font-weight-bold">
                                {{$value->specializations->title .'  '}}
                            </span>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar mb-auto">
                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                            </div>
                        </div>
                        <!--end::Toolbar-->
                    </div>

                    <p class="mb-7 mt-3">{!!$value->short_description!!}</p>


                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer d-flex align-items-center">
                    <div class="d-flex">
                        <div class="d-flex align-items-center mr-7">
                            <span class="svg-icon svg-icon-gray-500">
                                <!-- SVG icon here -->
                            </span>
                            <a href="#" class="font-weight-bolder text-primary ml-2">عدد العروض({{$value->applyJobCount()}})</a>
                        </div>
                        <div class="d-flex align-items-center mr-7">
                            <span class="svg-icon svg-icon-gray-500">
                                <!-- SVG icon here -->
                            </span>
                            <a href="#" class="font-weight-bolder text-primary ml-2">{!!$value->getStatus() !!}</a>
                        </div>
                    </div>
                    <a href="{{route('front.jobs.views', $value->id)}}" class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">تفاصيل المشروع</a>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        @endforeach
    </div>

    <div class="text-center"
    {{ $jobs->links('vendor.pagination.bootstrap-4') }}

</div>







@endsection


