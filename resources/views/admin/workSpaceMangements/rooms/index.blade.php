@extends('layouts.admin')
@section('title')
    {{ __('label.room_mangments') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_room_mangments') }}</h1>
            </div>

            <div class="card-toolbar">

                @if(auth('admin')->user()->can('add_room_mangment'))
                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_new_room') }}
                </a>

                @endif
            </div>

        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label for="branch_id">
                        {{ __('label.branches') }}
                    </label>
                    <select class="form-control select2" name="branch_id" id="serach_branch_id">
                        <option value="">{{ __('label.select') }}</option>
                        @foreach ($branches as $value)
                        <option value="{{ $value->id }}" @if($value->id ==$branch_id) selected @endif>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label for="work_space_id">
                        {{ __('label.work_space') }}
                    </label>
                    <select class="form-control select2" name="work_space_id" id="serach_work_space_id">
                        <option value="">{{ __('label.select') }}</option>

                    </select>
                </div>


                <input type="hidden" name="serach_work_space_value_id" id="serach_work_space_value_id" value="{{$work_space_id}}">







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

                            <th>{{ __('label.code') }}</th>
                            <th>{{ __('label.branches') }}</th>
                            <th>{{ __('label.work_space') }}</th>
                            <th>{{ __('label.capacity') }}</th>
                            <th>عدد مستخمين الغرفة </th>


                            <th>{{ __('label.room_administrator') }}</th>
                            <th>{{ __('label.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>



        @include('admin.workSpaceMangements.rooms.modal.add_edit')
        @include('admin.workSpaceMangements.rooms.modal.release')
        @include('admin.workSpaceMangements.rooms.modal.invoice')
        @include('admin.workSpaceMangements.rooms.modal.users')
        @include('admin.workSpaceMangements.rooms.modal.room_history')

        <div class="modal fade" id="kt_modal_internet" tabindex="-1" aria-labelledby="kt_modal_internet_Label" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_internet_Label">{{ __('label.subscription_internet') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="internet-form" method="POST" name="internet-form"
                action="{{route('admin.workSpaceManagments.rooms.subscriptionInternet')}}">
                @csrf
                <div class="modal-body">





                    <div class="row">

                    <div class="form-group col-md-6">
                        <label>{{ __('label.start_date') }}</label>
                        <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="start_date" id="add_edit_internet_start_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('label.end_date') }}</label>
                        <div class="input-group date">
                        <input type="text" class="form-control datepicker" value="" readonly="readonly"
                            name="end_date" id="add_edit_internet_end_date" placeholder="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="row">

                            <input type="hidden" class="form-control" id="add_edit_internet_room_id"
                            name="room_id" required>

                        <div class="form-group col-md-6">
                            <label for="add_edit_subscription_type_id">{{ __('label.subscription_types') }} </label>
                            <select class="form-control" id="add_edit_internet_subscription_type_id" name="subscription_type_id"
                            style="width: 100%">
                            <option value="">{{ __('label.subscription_types') }}</option>
                            @foreach ($subscriptionTypes as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                        aria-hidden="true"></i></span> تاكيد </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>

                </form>
            </div>
            </div>
        </div>


        <div class="modal fade" id="kt_modal_room" tabindex="-1" aria-labelledby="kt_modal_roomLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kt_modal_roomLabel">{{ __('label.add_room') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add-form" method="POST" name="add-form" action="{{route('admin.workSpaceManagments.rooms.AddRooms')}}">
                        @csrf
                    <div class="modal-body">



                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-12">
                                    <label for="name">{{ __('label.room_count') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="number" min="0" value="0" class="form-control" id="add_room_count" name="capacity" required>
                                </div>
                                <input type="hidden"  class="form-control" id="add_room_id" name="room_id" >




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
        <!-- Modal -->


        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.workSpaceMangements.rooms.js.js')
    @endsection
