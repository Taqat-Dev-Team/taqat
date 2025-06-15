@extends('layouts.admin')
@section('title')
    {{ __('label.add_user') }}
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.add_user') }}</h1>
            </div>
            <div class="card-toolbar">
                <!-- Additional toolbar options if needed -->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="my-form" name="my-form" action="{{ route('admin.users.store') }}"
                method="POST" enctype="multipart/form-data" style="margin:auto">

                @csrf

                <div class="row">
                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="name">{{ __('label.name') }} <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                name="name" required>
                            <div id="name_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="email">{{ __('label.email') }} <span style="color: red">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required>
                            <div id="email_error" class="text-danger"></div>
                        </div>

                    </div>
                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="mobile">{{ __('label.mobile') }} <span style="color: red">*</span></label>
                            <input type="tel" class="form-control" id="mobile" name="mobile"
                                value="{{ old('mobile') }}" required>
                            <div id="mobile_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">


                        <div class="form-group">
                            <label for="whatsapp">{{ __('label.whatsapp') }} <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" required
                                value="{{ old('whatsapp') }}">
                            <div id="whatsapp_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">


                        <div class="form-group">
                            <label for="user_type_id">{{ __('label.user_type') }} <span style="color: red">*</span></label>
                            <select class="form-control select2" id="user_type_id" name="user_type_cd_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($userTypes as $value)
                                    <option value="{{ $value->id }}" @if (old('user_type_cd_id') == $value->id) selected @endif>
                                        {{ $value->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12" id="specialization_box">


                        <div class="form-group" >
                            <label for="specialization_id">{{ __('label.specializations') }} <span
                                    style="color: red">*</span></label>
                            <select class="form-control select2" id="job" name="specialization_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($specializations as $value)
                                    <option value="{{ $value->id }}" @if (old('specialization_id') == $value->id) selected @endif>
                                        {{ $value->title }}</option>
                                @endforeach
                            </select>
                            <div id="specialization_id_error" class="text-danger"></div>
                        </div>
                    </div>

                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="password">{{ __('label.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div id="password_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12"  id="initial_reading_box">


                        <div class="form-group">
                            <label for="initial_reading">{{ __('label.initial_reading') }} <span
                                    style="color: red">*</span></label>
                            <input type="number" class="form-control" id="initial_reading" name="initial_reading"
                                value="{{ old('initial_reading', 0) }}" required>
                            <div id="initial_reading_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12"  id="attendance_box">


                        <div class="form-group">
                            <label for="workplace_attendance">{{ __('label.workplace_attendance') }}</label>
                            <select class="form-control" id="workplace_attendance" name="workplace_attendance" required>
                                <option value="">{{ __('label.selected') }}</option>
                                <option value="full_time" @if (old('workplace_attendance') == 'full_time') selected @endif>
                                    {{ __('label.full_time') }}</option>
                                <option value="part_time" @if (old('workplace_attendance') == 'part_time') selected @endif>
                                    {{ __('label.part_time') }}</option>
                            </select>
                            <div id="workplace_attendance_error" class="text-danger"></div>
                        </div>
                    </div>

                    <div class="col-lg-6  col-sm-12" id="university_box">

                        <div class="form-group" >
                            <label for="university_cd_id">{{ __('label.university') }} <span
                                    style="color: red">*</span></label>
                            <select class="form-control" id="university_cd_id" name="university_cd_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($universities as $value)
                                    <option value="{{ $value->id }}" @if (old('university_cd_id') == $value->id) selected @endif>
                                        {{ $value->value }}</option>
                                @endforeach
                            </select>
                            <div id="university_cd_id_error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">


                        <div class="form-group">
                            <label for="original_place">{{ __('label.original_place') }} <span
                                    style="color: red">*</span></label>
                            <select class="form-control" id="original_place" name="original_place" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach (['شمال غزة', 'مدينة غزة', 'الوسطى', 'خانيونس', 'رفح'] as $place)
                                    <option value="{{ $place }}" @if (old('original_place') == $place) selected @endif>
                                        {{ __('label.' . Str::snake($place)) }}</option>
                                @endforeach
                            </select>
                            <div id="original_place_error" class="text-danger"></div>
                        </div>

                    </div>
                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="status">{{ __('label.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="0" @if (old('status') == 0) selected @endif>
                                    {{ __('label.account_disabled') }}</option>
                                <option value="1" @if (old('status') == 1) selected @endif>
                                    {{ __('label.user_in_incubator') }}</option>
                                <option value="3" @if (old('status') == 3) selected @endif>
                                    {{ __('label.user_out_incubator') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6  col-sm-12">


                        <div class="form-group" id="branch_div">
                            <label for="branch_id">{{ __('label.branches') }}</label>
                            <select class="form-control" id="branch_id" name="branch_id">
                                <option value="">{{ __('label.seleted') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}" @if (old('branch_id') == $value->id) selected @endif>
                                        {{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div id="branch_id_error" class="text-danger"></div>
                        </div>

                    </div>
                    <div class="col-lg-6  col-sm-12">

                        <div class="form-group">
                            <label for="photo">{{ __('label.photo') }}</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            <div id="photo_error" class="text-danger"></div>
                        </div>
                    </div>
                </div>


                <hr>
                <button type="submit" class="btn btn-primary"><span>
                        <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                        </i>
                        <span id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </span>
                        {{ __('label.submit') }}


                </button>



            </form>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    @include('admin.users.js.edit_create')
@endsection
