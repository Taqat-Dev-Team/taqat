@extends('layouts.front')
@section('title')
    المشاريع
@endsection
@section('content')

<div class="container">
    <div class="row">

        <!-- Start of the loop for project cards -->
        @forelse($projects as $project)
        <div class="col-md-6 mb-4">
            <!--begin::Card-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                            <img src="{{$project->company->getPhoto()}}" alt="image" class="img-fluid" />
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="d-flex flex-column mr-auto">
                            <!--begin: Title-->
                            <a href="#" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$project->title}}</a>
                            <span class="text-muted font-weight-bold">
                                @foreach ($project->specializations as $value )
                                {{$value->title .'  '}}
                                @endforeach
                            </span>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->

                    </div>
                    <!--end::Section-->
                    <!--begin::Content-->
                    <!--end::Content-->
                    <!--begin::Text-->
                    <p class="mb-7 mt-3">{!!$project->short_description!!}</p>
                    <!--end::Text-->
                    <!--begin::Blog-->
                    <div class="d-flex flex-wrap">
                        <!--begin: Item-->
                        <div class="mr-12 d-flex flex-column mb-7">
                            <span class="font-weight-bolder mb-4">متوسط العروض</span>
                            <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold text-dark-50">${{$project->avgOffer() ?? 0}}</span>
                            </span>
                        </div>
                        <div class="mr-12 d-flex flex-column mb-7">
                            <span class="font-weight-bolder mb-4">تكلفة المشروع</span>
                            <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold text-dark-50">${{$project->expected_budget}}</span>
                            </span>
                        </div>
                        <div class="mr-12 d-flex flex-column mb-7">
                            <span class="font-weight-bolder mb-4">حالة المشروع</span>
                            <div class="symbol-group symbol-hover">
                                {!!$project->getStatus() !!}
                            </div>
                        </div>
                    </div>
                    <!--end::Blog-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer d-flex align-items-center">
                    <div class="d-flex">
                        <div class="d-flex align-items-center mr-7">
                            <span class="svg-icon svg-icon-gray-500">
                                <!-- SVG icon here -->
                            </span>
                            <a href="#" class="font-weight-bolder text-primary ml-2">عدد العروض({{$project->countOffer()}})</a>
                        </div>
                        <div class="d-flex align-items-center mr-7">
                            <span class="svg-icon svg-icon-gray-500">
                                <!-- SVG icon here -->
                            </span>
{{--                            <a href="#" class="font-weight-bolder text-primary ml-2">عدد الرسائل (0)</a>--}}
                        </div>
                    </div>
                    <a href="{{route('front.companyProjects.views', $project->slug)}}" class="btn btn-primary btn-sm text-uppercase font-weight-bolder mt-5 mt-sm-0 mr-auto mr-sm-0 ml-sm-auto">تفاصيل المشروع</a>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        @empty
            <div class="col-md-12 mb-4">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;"> <!-- Adjust the height as needed -->
                        <h6 class="text-center">لايوجد مشاريع</h6>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        @endforelse
    </div>

    <div class="text-center"
    {{ $projects->links('vendor.pagination.bootstrap-4') }}

</div>






@endsection

@section('scripts')
<script>
    </script>
@endsection
