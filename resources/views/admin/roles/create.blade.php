@extends('layouts.admin')

@section('title', __('label.add_new_role'))

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{__('label.add_new_role')}}</h3>
        </div>
    </div>
    <div class="card-body">
        <form class="form form_role" id="form" action="" method="POST" name="form" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">{{__('label.name')}}</label>
                            <input type="text" id="name" class="form-control" placeholder="" value="{{ old('name') }}" name="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @foreach (config('global.permissions') as $name => $permissions)
                <hr>

                <div class="row col-lg-12">
                    <label>{{ $name }}</label>
                </div>
                <hr>
                <div class="row">
                    @foreach($permissions as $key => $value)
                    <div class="form-group col-sm-4">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $key }}"> {{ $value }}
                                <span></span>
                            </label>
                        </span>
                    </div>
                    @endforeach
                </div>
                @endforeach
                @error('categories.0')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <span><i class="fa fa-paper-plane"

                    aria-hidden="true"></i></span>
              {{__('label.submit')}}

            </button>



        <div id="spinner" style="display: none;">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.roles.js.create_update')
@endsection
