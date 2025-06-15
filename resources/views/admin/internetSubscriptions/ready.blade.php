@extends('layouts.admin')
@section('title')
    {{ __('label.internet_subscription') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_active_internet_subscription') }}</h1>
            </div>

            <div class="card-toolbar">

            </div>

        </div>
        <div class="card-body">
            <div class="row">


                @if (!auth()->user()->branch_id)
                    <div class="col-lg-4 col-sm-12">
                        <label for="branch_id">
                            {{ __('label.branches') }}
                        </label>
                        <select class="form-control select2" name="branch_id" id="serach_branch_id">
                            <option value="">{{ __('label.select') }}</option>
                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <label for="work_space_id">
                            {{ __('label.work_space') }}
                        </label>
                        <select class="form-control select2" name="work_space_id" id="serach_work_space_id">
                            <option value="">{{ __('label.select') }}</option>

                        </select>
                    </div>
                @endif

                <div class="col-lg-4 col-sm-12">
                    <label for="serach_subscription_type_id">
                        {{ __('label.subscription_types') }}
                    </label>
                    <select class="form-control select2" name="serach_subscription_type_id"
                        id="serach_subscription_type_id">
                        <option value="">{{ __('label.subscription_types') }}</option>

                        @foreach ($subscriptionTypes as $value)
                            <option value="{{ $value->id }}">

                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="row mt-1">
                <div class="col-lg-4">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">{{ __('label.search') }}</button>
                </div>
            </div>




            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">

                            <th>{{ __('label.internet_code') }}</th>
                            <th>{{ __('label.internet_password') }}</th>
                            <th>{{ __('label.subscription_type') }}</th>
                            <th>{{ __('label.branch') }}</th>
                            <th>{{ __('label.duration') }}</th>
                            <th>{{ __('label.price') }}</th>

                            <th>{{ __('label.user_name') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>






    </div>



    <div class="modal fade" id="open_add_subscription_Modal" tabindex="-1" aria-labelledby="sendNotificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendNotificationModalLabel">تنبيه اشعار</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="send_notification" method="POST"
                        action="{{ route('admin.users.sendNotification') }}">
                        @csrf


                        <input type="hidden" id="user_id" name="user_id">

                        <h3> هل انت متاكد من ارسال اشعار تنبيه فواتير المستحقة</h3>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary" id="assignSubscription">ارسال</button>
                </div>
                </form>

            </div>
        </div>
    </div>





    @include('admin.internetSubscriptions.modal.add_edit')
    @include('Shared.delete')
@endsection


@section('scripts')
    @include('admin.internetSubscriptions.js.ready')
@endsection
