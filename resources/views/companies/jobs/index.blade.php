@extends('layouts.companies')
@section('title')
{{__('label.jobs')}}
@endsection

@section('add_elements')
<a href="{{route('companies.jobs.create')}}" class="btn btn-light-primary font-weight-bold ml-2">{{__('label.add_new_job')}}
</a>
@endsection


@section('sub_page')
|{{__('label.display_all_jobs')}}
@endsection
@section('total_page')
{{__('label.jobs_count')}}({{$job_count}})
@endsection

@section('content')


<div class="row" >
    <div class="col col-12 col-lg-12">


    <div class="card card-custom">

        <div class="card-body">
            <!--begin::Table-->
            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                    <tr class="text-left">
                        <th >{{__('label.title')}}</th>
                        <th style="display: none;" >{{__('label.title')}}</th>
                        <th >{{__('label.count_apply_requests')}}</th>
                        <th>{{__('label.status')}}</th>
                        <th>{{__('label.proccess')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>



        <input type="hidden" id="slug" value="{{$slug}}">
    </div>
</div>

    @include('Shared.delete')




@endsection

@section('scripts')
    @include('companies.jobs.js.js')
@endsection
