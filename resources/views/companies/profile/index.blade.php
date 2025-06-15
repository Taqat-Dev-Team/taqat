@extends('layouts.companies')
@section('title',__('label.profile'))
@section('sub_page', __('label.edit_profile') )

@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('label.personal_account_information')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('label.change_personal_account_information')}}</span>
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
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.name')}}
                        <span class="text-danger">*</span>
                    </label>


                    <div class="col-lg-9 col-xl-6">

                        <div class="input-group input-group-lg input-group-solid">
                            <input class="form-control form-control-lg form-control-solid" placeholder="" name="name" type="text"
                                   value="{{auth('company')->user()->name}}"/>
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.email')}}
                        <span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{auth('company')->user()->email}}" name="email" placeholder=""/>
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('label.mobile')}}
                        <span class="text-danger">*</span></label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{auth('company')->user()->mobile}}" name="mobile" placeholder="رقم الجوال"/>
                        </div>
                        @error('mobile')
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
                'name': {
                    required: true
                },
                'email': {
                    required: true,
                },
                "mobile":{
                    required: true,

                },
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
            }
            ,messages : {
                'name': {
                    required:"الرجاء ادخال الاسم"
                },
                'email':  {
                    required: "الرجاء ادخال الايميل",
                },

                'mobile':  {
                    required: "الرجاء ادخال الجوال",
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
                    url: '{{route('companies.profile.update')}}' ,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function( response ) {
                        if (response.status){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout( function(){
                                    window.location.replace('{{route("companies.profile.index")}}')
                                }
                                ,
                                2000 );
                        }else if (response.status==422){
                            jQuery.each(response.error, function(key, value){
                                $('.'+key+'_error').text(value);
                            });
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
