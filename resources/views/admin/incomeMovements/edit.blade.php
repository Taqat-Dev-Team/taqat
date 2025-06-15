@extends('layouts.admin')
@section('title')
{{__('label.edit_income_movements')}}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{__('label.edit_income_movements')}}</h1>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation" id="my-form" name="my-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="source">

                              {{__('label.source')}}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="source" class="form-control" id="source" value="{{$incomeMovement->source}}" placeholder="">
                            <div class="company_name error"></div>
                        </div>
                        <input type="hidden" name="income_movement_id" class="form-control" id="income_movement_id" value="{{$incomeMovement->id}}" placeholder="">


                        <div class="col-lg-6 col-sm-12">
                            <label for="date">
                                {{__('label.date')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group date">
                                <input type="text" value="{{$incomeMovement->date}}" class="form-control datepicker start_at" readonly="readonly" name="date" placeholder="" />
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
                                {{__('label.amount')}}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{$incomeMovement->amount}}" placeholder="">
                            <div class="amount error"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="amout_type">

                                العملة
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control amout_type" name="amout_type" id="amout_type" required >
                                <option value="">اختر</option>

                                <option value="1" @if($incomeMovement->amount_type==1) selected @endif>دولار</option>
                                <option value="2"  @if($incomeMovement->amount_type==2) selected @endif>شيكل</option>
                            </select>
                                   <div class="amout_type error"></div>

                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                                {{__('label.attachments')}}
                            </label>
                            <input class="form-control photo" type="file" accept="image/*,.pdf" name="photo" id="photo" onchange="readURL(this);" >
                            <div class="" style="color:gray">{{__('label.attachments')}}</div>
                            <div class="error photo"></div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div id="attachment-preview">
                                @php
                                    $attachment = $incomeMovement->getAttachment();
                                    $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                                @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                <img src="{{$attachment}}" style="width: 100px" class="img-thumbnail img-preview" id="imagePreview" alt="">
                            @elseif(in_array($extension, ['pdf']))

                                <a href="{{$attachment}}" target="_blank">
                                    <i class="fa fa-file-pdf" style="font-size: 100px; color: red;"></i>
                                </a>
                                @else

                                <img src="{{asset('assets/default.png')}}" style="width: 100px" class="img-thumbnail img-preview" id="imagePreview" alt="">


                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-sm-12">
                            <label for="note">
                                {{__('label.note')}}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea id="description" class="form-control description" name="description">{{$incomeMovement->note}}</textarea>
                            <div class="description error"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                            </i>
                            <span id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </span>
                        {{ __('label.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@include('admin.incomeMovements.js.edit')
@endsection
