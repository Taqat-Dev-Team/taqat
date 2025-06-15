@extends('layouts.admin')
@section('title')
    {{ __('label.internet_subscription') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.dispaly_all_internet_subscription') }}</h1>
            </div>

            <div class="card-toolbar">
                @if (auth('admin')->user()->can('add_internet_subscription'))
                    <a href="#" id="open_add_subscription_Button" class="btn btn-dark mr-1 open_add_subscription"
                        data-toggle="modal" data-target="#open_add_subscription_Modal">
                        {{ __('label.new_internet_subscriptions') }}


                    </a>
                @endif
            </div>

        </div>
        <div class="card-body">

            <div class="row">


                @if (!auth()->user()->branch_id)
                    <div class="col-lg-3 col-sm-12">
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

                    <div class="col-lg-3 col-sm-12">
                        <label for="work_space_id">
                            {{ __('label.work_space') }}
                        </label>
                        <select class="form-control select2" name="work_space_id" id="serach_work_space_id">
                            <option value="">{{ __('label.select') }}</option>

                        </select>
                    </div>
                @endif

                <div class="col-lg-3 col-sm-12">
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


                <div class="col-lg-3 col-sm-12">
                    <label for="serach_status_id">
                        {{ __('label.status') }}
                    </label>
                    <select class="form-control select2" name="serach_status_id" id="serach_status_id">

                        <option value="">{{ __('label.status') }}</option>
                        <option value="1">
                            {{ __('label.active') }}
                        </option>
                        <option value="2">
                            {{ __('label.pendding') }}
                        </option>

                        <option value="3">
                            {{ __('label.available') }}
                        </option>

                        <option value="4">
                            {{ __('label.delete_subscription') }}
                        </option>
                        <option value="0">
                            {{ __('label.expired') }}
                        </option>


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
                            {{-- <th>{{ __('label.Duration_of_work') }}</th> --}}
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>


        </div>




        <div class="modal fade" id="open_add_subscription_Modal" tabindex="-1"
            aria-labelledby="open_add_subscription_ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="open_add_subscription_ModalLabel">{{ __('label.add_new_work_space') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="subscription-form" method="POST" name="subscription-form"
                            action="{{ route('admin.internetSubscriptions.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="parent_id">{{ __('label.subscription_types') }}

                                        <span class="error">*</span>

                                    </label>
                                    <select class="form-control" id="add_edit_subscription_type_id" required
                                        name="subscription_type_id" style="width: 100%">
                                        <option value="">{{ __('label.subscription_types') }}</option>
                                        @foreach ($subscriptionTypes as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="duration">{{ __('label.duration') }}</label>
                                    <input type="number" class="form-control" id="duration" name="duration" min="1"
                                        required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price">{{ __('label.price') }}</label>
                                    <input type="number" class="form-control" id="price" name="price" min="0"
                                        step="1" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="quantity">{{ __('label.quantity') }}</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        min="1">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="export_excel">{{ __('label.export_excel') }}</label>
                                    <input type="file" class="form-control" id="excel_file" name="excel_file">
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
        </div>

    </div>




    @include('admin.internetSubscriptions.modal.add_edit')
    @include('Shared.delete')
@endsection


@section('scripts')
    @include('admin.internetSubscriptions.js.js')
@endsection
