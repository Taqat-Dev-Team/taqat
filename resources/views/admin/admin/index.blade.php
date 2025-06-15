@extends('layouts.admin')
@section('title')
{{__('label.admin_manger')}}
@endsection
@section('main_page',__('label.admin_manger'))
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{__('label.diplay_all_admin_manger')}}</h1>
            </div>
            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_admin'))

                    <div class="card-toolbar">
                        <a href="{{route('admin.admins.create')}}" class="btn btn-primary mr-1">{{__('label.add_new_admin_manger')}} </a>

            </div>
                @endif
        </div>
        </div>
        <div class="card-body">
            <!--begin::Table-->


            <div class="table-responsive">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                    <tr class="text-left">

                        {{-- <th class="pr-0" style="width: 50px"></th> --}}
                        <th >{{__('label.name')}}</th>
                        <th >{{__('label.mobile')}}</th>
                        <th >{{__('label.email')}}</th>
                        <th >{{__('label.roles')}}</th>
                        <th >{{__('label.branches')}}</th>

                        {{-- @if (auth('admin')->user()->can('update_status_manger')) --}}

                        <th>{{__('label.status')}}</th>
                        {{-- @endif --}}
                        <th>{{__('label.actions')}}</th>
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

@include('admin.admin.js.js')

@endsection
