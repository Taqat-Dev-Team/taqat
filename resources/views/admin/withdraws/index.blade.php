@extends('layouts.admin')
@section('title')
    طلبات السحب
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.display_all_withdraws') }}</h1>
            </div>
            <div class="card-toolbar">


            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.withdraws_count') }}</label>
                        <span id="user_count">({{ $withdraws_count }})</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                        <label>{{ __('label.total_withdraws') }}</label>
                        <span id="presence_count">({{ $total_withdraws }})</span>
                    </div>

                </div>

                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.paid_withdraws') }}</label>
                        <span id="absence_count">({{ $paid_withdraws }})</span>
                    </div>


                </div>
                <div class="col-lg-3 col-sm6">
                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                        <label>{{ __('label.not_paid_withdraws') }}</label>
                        <span id="hours_count">({{ $not_paid_withdraws }})</span>
                    </div>

                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>

                        <tr class="text-left">
                            <th></th>
                            <th>{{ __('label.user_name') }}</th>
                            <th>{{ __('label.withdrow_transaction') }}</th>
                            <th>{{ __('label.iban') }}</th>
                            <th>{{ __('label.bank_name') }}</th>
                            <th>{{ __('label.account_number') }}</th>

                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.message') }}</th>

                            <th>{{ __('label.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title" id="exampleModalLabel"></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="my-form" name="my-form" method="POST">
                        @csrf
                        <input type="hidden" value="" name="withdraw_id" id="withdraw_id">

                        <div class="form-group">
                            <label for="status">
                                {{ __('label.status') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="status" id="status" style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>
                                <option value="2">{{ __('label.completed') }}</option>
                                <option value="3">{{ __('label.reject') }}</option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="photo">
                                   الصورة الرئيسية

                                </label>
                                <input class="form-control photo" type="file" accept="image/*" name="photo" id="photo" onchange="readURL(this);" >

                                <div class="error photo">

                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12">


                                <img src="{{asset('assets/default.png')}}" style="width: 100px"
                                     class="img-thumbnail img-preview"  id="imagePreview" alt="">

                            </div>

                        </div>


                        <div class="form-group">
                            <label for="message">{{ __('label.message') }}</label>
                            <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                        </div>


                    </div>

                <div class="modal-footer row">
                    <div class="col-log-6">

                        <button type="submit" class="btn btn-primary" >{{__('label.submit')}} </button>
                    </div>
                    <div class="col-log-6">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('label.cancel')}}</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.withdraws.js.js')
@endsection
