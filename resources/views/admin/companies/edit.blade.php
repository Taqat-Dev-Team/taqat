@extends('layouts.admin')

@section('title')
    @lang('label.edit_company')
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">@lang('label.edit_company')</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation" id="my-form" name="my-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="name">
                                @lang('label.company_name')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $company->name }}" placeholder="">
                            <div class="name error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="user_name">
                                @lang('label.responsible_person')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="user_name" class="form-control" id="user_name" value="{{ $company->user_name }}" placeholder="">
                            <div class="user_name error"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="mobile">
                                @lang('label.mobile_number')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="mobile" value="{{ $company->mobile }}" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="">
                            <div class="mobile error"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="email">
                                @lang('label.email')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ $company->email }}" placeholder="">
                            <div class="email error"></div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="user_id">
                                @lang('label.employees')
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" name="user_id[]" multiple>
                                <option value="">@lang('label.selected')</option>
                                @foreach ($users as $value)
                                    <option value="{{ $value->id }}" @if(in_array($value->id, $company->users()->pluck('id')->toArray())) selected @endif>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="photo">
                                @lang('label.photo')
                            </label>
                            <input class="form-control image" type="file" name="photo" id="photo" onchange="readURL(this);" accept="image/*">
                            <div class="error photo"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <img src="{{ $company->getPhoto() }}" style="width: 100px" class="img-thumbnail img-preview" id="imagePreview" alt="">
                        </div>
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
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.companies.js.edit')
@endsection
