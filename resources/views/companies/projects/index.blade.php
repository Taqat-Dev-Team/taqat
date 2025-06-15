@extends('layouts.companies')
@section('title')
    {{__('label.projects')}}
@endsection

@section('add_elements')
<a href="{{route('companies.projects.create')}}" class="btn btn-light-primary font-weight-bold ml-2">{{__('label.add_new_project')}}</a>
@endsection


@section('sub_page')
|{{__('label.display_all_projects')}}
@endsection
@section('total_page')
{{__('label.projects_count')}}({{$project_count}})
@endsection

@section('content')

<div class="row">
    @forelse ($projects as $project)
    <div class="col-lg-6 col-md-6 col-sm-12 projects" data-id="{{$project->id}}">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Section-->
                <div class="d-flex align-items-center">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                        <img src="{{$project->company->getPhoto()}}" alt="image" />
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column mr-auto">
                        <!--begin: Title-->
                        <a href="{{route('companies.projects.views',$project->id)}}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$project->title}}</a>
                        <span class="text-muted font-weight-bold">
                            @foreach ($project->specializations as $value )
                            {{$value->title .'  '}}
                            @endforeach
                        </span>
                        <!--end::Title-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar mb-auto">
                        <a href="https://taqat-gaza.com/ar/project/{{$project->slug}}" target="_blak" class="btn btn-success">{{__('label.show_project')}}</a>
                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-item">
                                        <a href="{{route('companies.projects.edit',$project->id)}}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-pen"></i>
                                            </span>
                                            <span class="navi-text">{{__('label.edit')}}</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="{{route('companies.projects.views',$project->id)}}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon-eye"></i>
                                            </span>
                                            <span class="navi-text">{{__('label.show')}}</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link delete" id="{{$project->id}}" name_delete="{{$project->title}}" data-id="{{$project->id}}">
                                            <span class="navi-icon">
                                                <i class="flaticon-delete"></i>
                                            </span>
                                            <span class="navi-text">{{__('label.delete')}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Section-->
                <!--begin::Content-->
                <!--end::Content-->
                <!--begin::Text-->
                <p class="mb-7 mt-3">{!!$project->short_description!!}</p>
                <!--end::Text-->
                <!--begin::Blog-->
                <div class="d-flex flex-wrap">
                    <!--begin::Item-->
                    <div class="mr-12 d-flex flex-column mb-7">
                        <span class="font-weight-bolder mb-4">{{__('label.avg_offers')}}</span>
                        <span class="font-weight-bolder font-size-h5 pt-1">
                            <span class="font-weight-bold text-dark-50">${{$project->avgOffer()??0}}</span>
                        </span>
                    </div>
                    <div class="mr-12 d-flex flex-column mb-7">
                        <span class="font-weight-bolder mb-4">{{__('label.cost')}}</span>
                        <span class="font-weight-bolder font-size-h5 pt-1">
                            <span class="font-weight-bold text-dark-50">${{ $project->cost ?? 0}}</span>
                        </span>
                    </div>
                    <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                        <span class="font-weight-bolder mb-4">{{__('label.project_impelmention')}}</span>
                        <div class="symbol-group symbol-hover">
                            {{$project->users ? $project->users->name : '-'}}
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                        <span class="font-weight-bolder mb-4">{{__('label.status')}}</span>
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
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Bullet-list.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
                                    <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <a href="#" class="font-weight-bolder text-primary ml-2">{{__('label.offers_count')}}({{$project->countOffer()}})</a>
                    </div>
                    <div class="d-flex align-items-center mr-7">
                        {{-- <span class="svg-icon svg-icon-gray-500">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Time.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M13.5,11.5 L13.5,6 C13.5,5.44771525 13.9477153,5 14.5,5 C15.0522847,5 15.5,5.44771525 15.5,6 L15.5,11.5 L20,11.5 C20.5522847,11.5 21,11.9477153 21,12.5 C21,13.0522847 20.5522847,13.5 20,13.5 L15.5,13.5 L15.5,19 C15.5,19.5522847 15.0522847,20 14.5,20 C13.9477153,20 13.5,19.5522847 13.5,19 L13.5,13.5 L9,13.5 C8.44771525,13.5 8,13.0522847 8,12.5 C8,11.9477153 8.44771525,11.5 9,11.5 L13.5,11.5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        {{-- <a href="#" class="font-weight-bolder text-primary ml-2">{{__('label.start_date')}} {{$project->start_date}}</a> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        {{-- <span class="svg-icon svg-icon-gray-500">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Time.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M13.5,11.5 L13.5,6 C13.5,5.44771525 13.9477153,5 14.5,5 C15.0522847,5 15.5,5.44771525 15.5,6 L15.5,11.5 L20,11.5 C20.5522847,11.5 21,11.9477153 21,12.5 C21,13.0522847 20.5522847,13.5 20,13.5 L15.5,13.5 L15.5,19 C15.5,19.5522847 15.0522847,20 14.5,20 C13.9477153,20 13.5,19.5522847 13.5,19 L13.5,13.5 L9,13.5 C8.44771525,13.5 8,13.0522847 8,12.5 C8,11.9477153 8.44771525,11.5 9,11.5 L13.5,11.5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        {{-- <a href="#" class="font-weight-bolder text-primary ml-2">{{__('label.end_date')}} {{$project->end_date}}</a> --}}
                    </div>
                </div>
                <!--end::Footer-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    @empty
        <div class="col-12 text-center">
            <p>{{__('label.no_projects')}}</p>
        </div>
    @endforelse
</div>





    @include('Shared.delete')
@endsection

@section('scripts')
    @include('companies.projects.js.js')
@endsection
