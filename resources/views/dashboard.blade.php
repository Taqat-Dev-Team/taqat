{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

@extends('layouts.master')
@section('title','الرئيسية')

@section('content')

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12 col-xxl-12">
                    <!--begin::Mixed Widget 1-->
                    <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0 position-relative overflow-hidden">
                            <!--begin::Chart-->
                            <h4>
                                ارقام الحسابات المالية
                            </h4>
                            <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->

                            <div class="card-spacer mt-n25">
                                <!--begin::Row-->


                                @foreach( auth()->user()->accounts as $value)
                                    <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                                        <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">{{$value->number .' '.$value->currency}}</a>

                                    </div>
                                    {{--                                    <div class="row m-0">--}}
{{--                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<polygon points="0 0 24 0 24 24 0 24" />--}}
{{--																		<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
{{--																		<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                            <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">{{$value->number .' '.$value->currency}}</a>--}}
{{--

  </div>--}}
{{--                                    </div>--}}

                                @endforeach
                                <!--end::Row-->
                                <!--begin::Row-->

                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>


                        <!--end::Body-->
                    </div>


                    <!--end::Mixed Widget 1-->
                </div>
            <!--end::Row-->
            <!--begin::Row-->
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>

            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h1 class="card-label">عرض كافة العمليات</h1>
                    </div>
                    <div class="card-toolbar">


                        {{--                @if(auth('admin')->user()->can('add_brands'))--}}

                        <button class="btn btn-primary font-weight-bolder add_tranaction">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>اضافة عمليةجديدة</button>
                        {{--                @endif--}}
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->


                    <table class="table table-separate table-head-custom table-checkable  data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المبلغ</th>
                            <th>العملة</th>
                            <td>رقم الحساب</td>
                            <th>نوع العملية</th>
                            <th>التاريخ</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( auth()->user()->accounts as $value)
                            @foreach($value->transactions as $val)
                                <tr>

                                <td>{{$val->id}}</td>

                                     <td>{{$val->amount}}</td>
                                    <td>{{$value->currency}}</td>
                                    <td>{{$value->number}}</td>
                                    <td>{{$val->type}}</td>
                                <td>{{$val->created_at->format('Y-m-d')}}</td>
                                </tr>

                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
        <!--end::Container-->
    </div>

    </div>
        @include('Modal.add')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <script>
        $(".add_tranaction").on("click", function () {

            $('#exampleModal').modal('show');
            $('#exampleModalLabel').text('اضافة عملية جديدة');
            let _url = "{{route('postTransaction')}}";
            $('#form').attr('action', _url);
            $('#amount').val('');
            $('#type').val('');
        });
        $("#form").validate({
            rules: {
                amount: {
                    min:0,
                    required: true,
                },
                currency:{
                    required: true,

                },
                type:{
                    required: true,

                }

            },
            messages: {
                name: "هذا الحقل مطلوب",
            },
            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData(document.getElementById("form"));


                $.ajax({
                    url: "{{route('postTransaction')}}",
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (response) {


                        if (response.status == 201) {
                            $("#exampleModal").modal('hide');


                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            location.reload();
                            setTimeout(function () {
                                    $('.data-table').DataTable().ajax.reload();
                                }
                                ,
                                2000);

                        } else {
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Oops...',
                            //     text: response.data,
                            // })
                        }
                    },
                    error: function (response) {


                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Oops...',
                        //     text: response['errors'],
                        // })
                    }
                });


            }

        });

    </script>
@endsection
