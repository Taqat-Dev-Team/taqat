@extends('layouts.front')
@section('title')
    حركات المالية-اضافة

@endsection


@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">اضافة حركة مالية جديدة   </h1>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="source">
                                 جهه التحويل
                                    <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="source" class="form-control" id="source" value="{{old('source')}}"
                                 placeholder="">

                            <div class="source error"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="date">
                                 تاريخ
                                    <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker start_at " readonly="readonly" name="date"
                                    placeholder="" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="date error"></div>
                        </div>



                    </div>

                    <div class="form-group row">

                        <div class="col-lg-6 col-sm-12">

                            <label for="amount">
                            المبلغ
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{old('amount')}}"
                                   placeholder="">

                                   <div class="amount error"></div>

                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="amout_type">
                                العملة
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control amout_type" name="amout_type" id="amout_type" required >
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($currencies as $value)
                                <option value="{{ $value->id }}">{{ $value->value }}</option>
                            @endforeach
                            </select>
                                   <div class="amout_type error"></div>

                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                               المرفق

                            </label>
                            <input class="form-control photo" type="file" accept="image/*,.pdf" name="photo" id="photo" >
                            <div class="" style="color:gray">يجب أن يكون الحجم أقل من 2 ميجا بايت</div>

                            <div class="error photo">

                            </div>
                        </div>




                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">

                            <label for="note">

                                ملاحظات
                                    <span class="text-danger">*</span>
                                </label>






                                <textarea id="description" class="form-control description" name="description"></textarea>
                                <div class="description error"></div>




                                </div>
                    </div>







                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>
                          تاكيد
                          <div class="spinner-border spinner-border-sm" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        </button>


                    </div>
            </form>

        </div>
    </div>




@endsection

@section('scripts')
@include('front.incomeMovements.js.add')
@endsection
