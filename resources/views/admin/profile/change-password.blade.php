@extends('layouts.admin')
@section('title',__('label.change_password'))
@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('label.personal_account_information')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('label.change_password')}}</span>
            </div>
            <div class="card-toolbar">


            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->

        <form id="form" class="form" action="" method="post">
            @csrf
            <div class="card-body">
                <!--begin::Heading-->

                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.current_password')}}
                        <span class="text-danger">*</span>
                    </label>


                    <div class="col-lg-9 col-xl-6">

                        <div class="input-group input-group-lg input-group-solid">
                            <input class="form-control form-control-lg form-control-solid" placeholder="" name="current_password" type="password"
                            />
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.new_password')}}
                        <span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="password" id="password" class="form-control form-control-lg form-control-solid"
                                  name="password" placeholder=" "/>
                        </div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.confirm_password')}}
                        <span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="password" class="form-control form-control-lg form-control-solid"  name="password_confirm" placeholder="تاكيد كلمة المرور"/>
                        </div>
                        @error('password_confirm')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <button type="submit" class="btn btn-success mr-2 mb-3" style="float: left">{{__('label.submit')}}<span><i
                            class="fas fa-check-circle"></i></span></button>
            </div>

        </form>
        <!--end::Form-->
    </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <script>
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'current_password': {
                    required: true
                },
                'password': {
                    required: true,
                    minlength: 5,

                },
                "password_confirm":{
                    required: true,
                    minlength: 5,
                    equalTo: "#password"

                },
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
            }
            ,messages : {
                'current_password': {
                    required:"{{__('vaildation.current_password_required')}}"
                },
                'password':  {
                    required: "{{__('vaildation.password_required')}}",

                },

                'password_confirm':  {
                    required: "{{__('vaildation.password_confirm_required')}}",

                },
            }
            ,                submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // var my_form=$('#my-form');
                var data= new FormData(document.getElementById("form"));

                $('#send_form').html('Sending..');
                $.ajax({
                    url: '{{route('admin.profile.changePasswordProfile')}}' ,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function( response ) {
                        if (response.status==201){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout( function(){
                                    window.location.replace('{{route("admin.profile.changePassword")}}')
                                }
                                ,
                                2000 );
                        }else if (response.status==422){
                            // jQuery.each(response.error, function(key, value){
                            //     $('.'+key+'_error').text(value);
                            //
                            // });
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
                        }else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response,
                            })
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response,
                        })
                    }
                });


            }

        });
    </script>

@endsection
