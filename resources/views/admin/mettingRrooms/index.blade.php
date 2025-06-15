@extends('layouts.admin')
@section('title')
    {{ __('label.meetingRooms') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_metting_room') }}</h1>
            </div>

            <div class="card-toolbar">
                @if(auth('admin')->user()->can('add_metting_room'))

                <a href="#" class="btn btn-success mr-1" id="add_edit">
                    <i class="fa fa-plus"></i>
                    {{ __('label.add_metting_room') }}
                </a>
                @endif

            </div>

        </div>
        <div class="card-body">



            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="data-table">
                    <thead>
                        <tr class="text-left">
                            <th>{{ __('label.name') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.mettingRrooms.modal.add_edit')
        @include('Shared.delete')
    @endsection

    @section('scripts')
        @include('admin.mettingRrooms.js.js')
    @endsection
