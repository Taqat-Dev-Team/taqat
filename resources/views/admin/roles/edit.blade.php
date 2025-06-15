@extends('layouts.admin')
@section('title', __('label.edit_role'))

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">

                <h3 class="card-label">{{__('label.edit_role')}}</h3>
            </div>
        </div>
        <div class="card-body">


            <form class="edit_form" id="edit_form" name="edit_form" {{--                                              action="" --}} method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1">{{__('label.name')}}
                                </label>
                                <input type="text" id="name" class="form-control" placeholder="  "
                                    value="{{ $role->name }}" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @foreach (config('global.permissions') as $name => $permissions)


                            <div class="row">
                                <div class="col-12">
                                    <hr>

                                    <label>{{ $name }}</label>
                                    <hr>

                                </div>

                                @foreach($permissions as $key => $value)
                                    @if($loop->index % 3 == 0)
                                        <div class="w-100"></div>
                                    @endif

                                    <div class="form-group col-sm-4">
                                        <span class="switch switch-icon">
                                            <label>
                                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $key }}"  {{ in_array($key, $role->permissions)? 'checked' : '' }}>
                                                {{ $value }}
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach


                            {{-- @foreach ($permissions as $key => $value)
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="checkbox" class="chk-box" name="permissions[]"
                                            value="{{ $key }}"
                                            {{ in_array($key, $role->permissions) ? 'checked' : '' }}> {{ $value }}
                                        <span></span>
                                    </label>
                                </span>
                            @endforeach --}}

                        {{-- </div> --}}
                    {{-- @endforeach --}}


                    @error('categories.0')
                        <span class="text-danger"> {{ $message }}</span>
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
