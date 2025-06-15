@extends('layouts.admin')
@section('title','الصلاحيات')
@section('main_page',__('label.roles'))

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_roles')}} </h1>
        </div>
        <div class="card-toolbar">
            {{-- @if (auth('admin')->user()->can('create_manger')) --}}

                <div class="card-toolbar">
                    <a href="{{route('admin.roles.create')}}" class="btn btn-primary mr-1">{{__('label.add_new_role')}} </a>

        </div>
            {{-- @endif --}}
    </div>
    </div>
    <div class="card-body">

        <div class="table-responsive mt-3">

        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead class="">
                <tr>

                    <th>{{__('label.name')}}</th>

                    <th>{{__('label.actions')}}</th>
                </tr>
                </thead>
                <tbody>





                </tbody>
            </table>

        </div>
    </div>
    </div>




@endsection
@section('scripts')

    @include('admin.roles.js.js')

@endsection
