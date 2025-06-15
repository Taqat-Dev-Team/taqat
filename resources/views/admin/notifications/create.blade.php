@extends('layouts.admin')
@section('title')
ارسال اشعار Sms
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">ارسال اشعار Sms</h1>
        </div>
    </div>
    <div class="card-body">
        <form id="my-form" method="post" action="{{ route('admin.notifications.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="add_edit_type" class="form-label">نوع الاشعار</label>
                    <select class="form-select form-control-solid select2" id="add_edit_type" style="width: 100%" data-control="select2" name="type">
                        <option value="" {{ old('type') == '' ? 'selected' : '' }}>اختر النوع</option>
                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>عام</option>
                        <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>فروع</option>
                        <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>مستخدمين</option>

                    </select>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 branch_block" style="display: none">
                    <label for="add_edit_branch_id " class="form-label">الفروع</label>
                    <select class="form-select form-control-solid select2" id="add_edit_branch_id" style="width: 100%" data-control="select2" name="branch_id[]" multiple>
                        <option value="" {{ old('type') == '' ? 'selected' : '' }}>اختر </option>
                        @foreach ($branches as $value )

                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 user_block" style="display: none">
                    <label for="add_edit_branch_id" class="form-label">المستخدمين</label>
                    <select class="form-select form-control-solid select2" id="add_edit_user_id" style="width: 100%" data-control="select2" name="user_id[]" multiple>
                        <option value="" {{ old('type') == '' ? 'selected' : '' }}>اختر </option>

                    </select>
                    @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="row mb-4">
                <div class="col-md-12" >

                <label for="message" class="form-label">الوصف</label>
                <textarea class="form-control form-control-solid" name="message">{{ old('body') }}</textarea>
                @error('body')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" form="my-form">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i> تاكيد
                    </button>
                    <span id="spinner" style="display: none;">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

    @endsection
    @section('scripts')
    @include('admin.notifications.js.js')
    @endsection
