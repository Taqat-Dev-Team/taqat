@extends('layouts.companies')
@section('title')
{{__('label.employees')}}
@endsection
@section('add_elements')
<a href="{{route('companies.users.create')}}" class="btn btn-light-primary font-weight-bold ml-2">{{__('label.add_new_employee')}}</a>
@endsection


@section('sub_page')
|{{__('label.display_all_employees')}}
@endsection
@section('total_page')
{{__('label.employees_count')}}(ُ{{$employee_count}})
@endsection
@section('content')
    <div class="card card-custom">

        <div class="card-body">
            <!--begin::Table-->




            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                    <tr class="text-left">
                        <th ></th>

                        <th >{{__('label.name')}}</th>
                        <th >{{__('label.email')}}</th>
                        <th>{{__('label.company_name')}}</th>
                        <th >{{__('label.specialization')}}</th>
                        <th >{{__('label.displacement_place')}}</th>
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

@include('companies.users.js.js')

@endsection
