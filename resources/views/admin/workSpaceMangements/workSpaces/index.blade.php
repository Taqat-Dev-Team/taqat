@extends('layouts.admin')
@section('title')
    {{ __('label.work_space') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_work_spaces') }}</h1>
            </div>

            <div class="card-toolbar">
                @if(auth('admin')->user()->can('add_work_space'))

                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_new_work_space') }}
                </a>
                @endif
            </div>

        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <label for="branch_id">
                        {{ __('label.branches') }}
                    </label>
                    <select class="form-control select2" name="branch_id" id="serach_branch_id">
                        <option value="">{{ __('label.select') }}</option>
                        @foreach ($branches as $value)
                            <option value="{{ $value->id }}" >
                                {{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>





            </div>

            <div class="row mt-1">
                <div class="col-lg-4">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">{{__('label.search')}}</button>
                </div>
            </div>


            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.branches') }}</th>
                            <th>{{ __('label.desk_count') }}</th>
                            <th>{{ __('label.room_count') }}</th>
                            <th>{{ __('label.free_chairs') }}</th>
                            <th>{{ __('label.booked_chairs') }}</th>
                            <th>{{ __('label.free_rooms') }}</th>
                            <th>{{ __('label.booked_rooms') }}</th>
                            <th>{{ __('label.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>





        @include('admin.workSpaceMangements.workSpaces.modal.add_edit')
        @include('Shared.delete')

        <div class="modal fade" id="kt_modal_desk_mangment" tabindex="-1" aria-labelledby="kt_modal_desk_mangmentLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kt_modal_desk_mangmentLabel">{{ __('label.add_new_work_space') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add-form" method="POST" name="add-form" action="{{route('admin.workSpaceManagments.workSpaces.AddDeskMangment')}}">
                        @csrf
                    <div class="modal-body">



                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.room_count') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="0" value="0" class="form-control" id="add_room_count" name="room_count" required>
                                </div>
                                <input type="hidden"  class="form-control" id="add_work_space_id" name="work_space_id" >



                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.desk_count') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number"  value="0"  class="form-control" id="add_desk_count" name="desk_count" required>
                                </div>
                            </div>






                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تاكيد </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>

                            <!-- زر التأكيد -->
                        </form>
                    </div>
                </div>
            </div>
        </div>




    @endsection

    @section('scripts')
        @include('admin.workSpaceMangements.workSpaces.js.js')
    @endsection
