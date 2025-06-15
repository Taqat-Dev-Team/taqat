@extends('layouts.admin')
@section('title')
{{__('label.jobs')}}
@endsection



@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_jobs')}}</h1>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <div class="card-body">
            <!--begin::Table-->




            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                    <tr class="text-left">

                        <th >{{__('label.title')}}</th>
                        <th >{{__('label.company_name')}}</th>

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
    @include('admin.jobs.js.js')
@endsection
