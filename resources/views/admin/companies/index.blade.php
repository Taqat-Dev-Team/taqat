@extends('layouts.admin')
@section('title')
{{__('label.companies')}}
@endsection
@section('style')

        <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
        .circle {
        width: 150px;
        height: 150px;
        border-radius: 50%; /* This makes the element circular */
        overflow: hidden; /* Ensures content inside the circle stays within bounds */
    }
    img {
        width: 100%; /* Ensures the image fills the circular container */
        height: auto; /* Maintains aspect ratio */
        display: block; /* Removes any extra space below the image */
    }
    </style>
        @endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{__('label.display_all_companies')}}</h1>
            </div>
            <div class="card-toolbar">

                <a href="{{route('admin.companies.create')}}" class="btn btn-primary mr-1"> {{__('label.add_new_companies')}} </a>

            </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->






            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                    <tr class="text-left">
                        <th ></th>

                        <th >{{__('label.name')}}</th>
                        <th >{{__('label.email')}}</th>
                        <th>{{__('label.responsible_person')}}</th>
                        <th>{{__('label.user_count')}}</th>
                        <th>{{__('label.proccess')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>




    @include('Shared.delete')
@endsection

@section('scripts')

@include('admin.companies.js.js')

@endsection
