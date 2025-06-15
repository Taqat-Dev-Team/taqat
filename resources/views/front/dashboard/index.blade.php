@extends('layouts.front')
@section('title')
    {{ __('label.main') }}
@endsection

@section('styles')
    <style>
        /* Custom styles for the Clock In/Out section */
        #timer {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffffff;
            /* background-color: #28a745; Green background */
            border-radius: 50%;
            /* Makes it circular */
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            /* Adds a shadow effect */
        }

        .card-custom {
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            overflow: hidden;
        }

        .btn-success,
        .btn-danger {
            border-radius: 0.375rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table thead th {
            vertical-align: bottom;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 0.75rem 1.25rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        @media (max-width: 767.98px) {
            .card-header {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content-main')
@if(!auth()->user()->branch_id)
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#branchModal">
        <i class="fas fa-edit"></i>
        @if (!auth()->user()->branch_id)
            انضم لاحد فروع طاقات
        @endif
    </button>
    @endif
@endsection
@section('content')
    <div class="container my-5">


        @if (auth()->user()->status == 1)
            {{-- <div class="row">

                <!-- Clock In/Out Section -->
                <div class="col-lg-12 mb-4">
                    <div class="card card-custom shadow-sm">
                        {{-- <div class="card-header border-0 bg-light">
                            {{-- <h5 class="card-title font-weight-bold text-dark mb-0">تسجيل الحضور وانصراف</h5> --}}
            {{-- </div> --}}
            {{-- <div class="card-body pt-3 pb-0 text-center"> --}}

            {{-- @php --}}
            // $isToday =
            // auth()->user()->attendances->count() &&
            // auth()->user()->attendances->last()->date == \Carbon\Carbon::now()->format('Y-m-d') &&
            // auth()->user()->attendances->last()->logout_time === null;
            // $buttonClass = $isToday ? 'btn btn-danger clock-out' : 'btn btn-success clock-in';
            // $buttonText = $isToday ? 'تسجيل انصراف' : ' تسجيل حضور';
            // $hasUnpaidInvoices = auth()->user()->invoices()->where('status', 0)->exists(); // Check for unpaid invoices
            --}}

            {{-- // @endphp --}}
            {{-- @if ($hasUnpaidInvoices)
                                <div class="mb-4">
                                    <div class="alert alert-warning d-flex align-items-center justify-content-between"
                                        style="padding: 15px 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                        <div style="font-size: 16px; font-weight: 500; color: #856404;">
                                            <i class="fas fa-exclamation-circle"
                                                style="margin-right: 8px; font-size: 18px; color: #856404;"></i>
                                                <strong>
                                                    نرجو منكم تسديد الفواتير المستحقة في أقرب وقت ممكن<br>
                                                    إلى حساب: <span style="color: blue;">شريف نعيم</span><br>
                                                    رقم الحساب: <span style="color: green;">2102427</span><br><br>
                                                </strong>
                                        </div>
                                        <a href="{{ route('front.invoices.index') }}" class="btn btn-info"
                                            style="font-weight: 500; padding: 8px 16px; border-radius: 6px;">
                                            تسديد الآن
                                        </a>
                                    </div>
                                </div>
                            @endif --}}


            {{-- <div class="mb-4">
                                {{-- <button id="clock-in" class="btn btn-success">تسجيل  حضور</button> --}}

            {{-- <button id="timer" class="{{ $buttonClass }}"
                                    style="font-size: 14px">{{ $buttonText }}</button>

                                عدد ساعات الحضور للشهر الحالي({{ $total_hours }}) --}}
            {{-- </div> --}}
            {{-- <button id="clock-out" class="btn btn-danger" style="display: none;">Clock Out</button> --}}
            {{-- </div>
                    </div>
                </div>
            </div> --}}
        @endif
        <div class="row text-center mb-5">
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="bg-warning text-white px-4 py-3 rounded shadow-sm">
                    <label>العروض المقدمة على المشاريع</label>
                    <h5 id="count_income">({{ $offer_count }})</h5>
                </div>
            </div>


            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="bg-success text-white px-4 py-3 rounded shadow-sm">
                    <label>العروض المقدمة على الوظائف</label>
                    <h5 id="total_income">({{ $job_count }})</h5>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="bg-secondary text-white px-4 py-3 rounded shadow-sm">
                    <label>زوار الملف الشخصي</label>
                    <h5 id="max_income">({{ $vistor_profile }})</h5>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="bg-danger text-white px-4 py-3 rounded shadow-sm">
                    <label>الاجتماعات من خلال المنصة</label>
                    <h5 id="min_income">({{ $inteview_count }})</h5>
                </div>
            </div>
        </div>


        <!-- Job Listings -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">عرض قائمة الوظائف</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th class="p-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $value)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <a href="#" class="d-inline-block mr-3">
                                                <img src="{{ $value->company ? $value->company->photo : '' }}"
                                                    alt="Company Photo" class="rounded-circle"
                                                    style="object-fit: cover; width: 50px; height: 50px;">
                                            </a>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="text-muted font-size-sm">{{ $value->company ? $value->company->name : 'Unknown Company' }}</span>
                                                <a href="https://taqat-gaza.com/ar/job/{{ $value->slug }}"
                                                    class="text-dark font-weight-bolder text-hover-primary mb-1">{{ $value->title }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="https://taqat-gaza.com/ar/job/{{ $value->slug }}"
                                                class="btn btn-success btn-sm">{{ __('label.view') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Project Listings -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">عرض قائمة المشاريع</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th class="p-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $value)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <a href="#" class="d-inline-block mr-3">
                                                <img src="{{ $value->company->getphoto() }}" alt="Company Photo"
                                                    class="rounded-circle"
                                                    style="object-fit: cover; width: 50px; height: 50px;">
                                            </a>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="text-muted font-size-sm">{{ $value->company->name ?? 'Unknown Company' }}</span>
                                                <a href="{{ route('front.companyProjects.views', $value->slug) }}"
                                                    class="text-dark font-weight-bolder text-hover-primary mb-1">{{ $value->title }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('front.companyProjects.views', $value->slug) }}"
                                                class="btn btn-success btn-sm">{{ __('label.view') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Interviews -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">قائمة المقابلات الخاصة بك</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <tbody>
                                @foreach ($inteviews as $value)
                                    <tr>
                                        <td class="p-2">
                                            <a href="#"
                                                class="text-dark font-weight-bolder mb-1">{{ $value->users?->name }}</a>
                                            <div><a class="text-muted font-weight-bold"
                                                    href="#">{{ $value->company->name }}</a></div>
                                            <div><a class="text-muted font-weight-bold"
                                                    href="#">{{ $value->created_at->format('Y-m-d') }}</a></div>
                                        </td>
                                        <td class="p-2">
                                            <a href="{{ $value->zoom_url }}" class="btn btn-success btn-sm"
                                                target="_blank">{{ __('label.url_meet') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="branchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <!-- العنوان -->
                <div class="modal-header">
                    <h5 class="modal-title" id="branchModalLabel">{{__('label.Terms and Conditions for Use of the Shared Space Taqat')}}                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- المحتوى -->
                <div class="modal-body">
                    <form id="branchForm" method="post" name="branchForm">
                        @csrf


                        {{-- @php
                            $constant_settings = collect([
                                (object) [
                                    'id' => 1,
                                    'value' => 'أقر أنا المستخدم بأن جميع البيانات المدخلة صحيحة وتحت مسؤوليتي.',
                                ],
                                (object) [
                                    'id' => 2,
                                    'value' => 'أتعهد باستخدام الخدمة فقط في الأغراض المشروعة وعدم إساءة استخدامها.',
                                ],
                                (object) [
                                    'id' => 3,
                                    'value' => 'أوافق على مشاركة بياناتي مع الجهات ذات العلاقة لتقديم الخدمة.',
                                ],
                                (object) [
                                    'id' => 4,
                                    'value' =>
                                        'أفوض مؤسسة طاقات بالتواصل معي عبر البريد الإلكتروني أو الجوال عند الحاجة.',
                                ],
                                (object) [
                                    'id' => 5,
                                    'value' =>
                                        'أفهم أن خرق هذه الاتفاقية قد يؤدي إلى إلغاء الحساب أو اتخاذ إجراءات قانونية.',
                                ],
                            ]);
                        @endphp --}}
                        <!-- محتوى الاتفاقية -->
                        <div class="mb-4">
                            <ul class="list-group list-group-flush">
                                @foreach ($constant_settings as $index => $value)
                                    <li class="list-group-item">
                                        {!! app()->getLocale() == 'ar' ? $value->value : ($value->value_en ?? $value->value) !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- اختيار الفرع -->
                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms">
                                <label class="form-check-label fw-bold" for="agree_terms">
                                    {{__('label.I agree to the terms of the agreement')}}
                                </label>
                            </div>
                            <div class="text-danger agree_terms_error mt-2"></div>
                        </div>

                        <div class="mb-4 hide_section" id="branches_section" style="display: none;">
                            <div class="row">
                                @foreach (\App\Models\Branch::where('id', '!=', auth()->user()->branch_id)->get() as $key => $branch)
<div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" @if ($key == 0) checked @endif type="radio" name="branch_id" id="branch_{{ $branch->id }}" value="{{ $branch->id }}">
                                            <label class="form-check-label" for="branch_{{ $branch->id }}">
                                                {{ $branch->name }}
                                            </label>
                                        </div>
                                    </div>
@endforeach
                            </div>
                            <div class="text-danger branch_id_error mt-2"></div>
                        </div>



                    <!-- الفوتر -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary hide_section" id="saveBranch" style="display: none;">
{{__('label.submit')}}

</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('label.cancel')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            $('#agree_terms').on('change', function() {
                                                if ($(this).is(':checked')) {
                                                    $('.hide_section').slideDown();
                                                } else {
                                                    $('.hide_section').slideUp();
                                                }
                                            });

                                            // Optional: Prevent form submit if not checked
                                            $("form[name='branchForm']").on('submit', function(e) {
                                                if (!$('#agree_terms').is(':checked')) {
                                                    e.preventDefault();
                                                    $('.agree_terms_error').text('يجب الموافقة على شروط الاتفاقية');
                                                } else {
                                                    $('.agree_terms_error').text('');
                                                }
                                            });
                                        });
                                        $("form[name='branchForm']").validate({
                                            rules: {

                                                branch_id: {
                                                    required: true
                                                },

                                            },
                                            messages: {

                                                amount: {
                                                    required: "{{ __('validation.ammount_required') }}"
                                                },

                                            },
                                            submitHandler: function(form) {
                                                var $button = $(form).find('button[type="submit"]');
                                                var $spinner = $button.find('.spinner-border');

                                                // Show spinner
                                                $spinner.show();

                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });

                                                var data = new FormData(document.getElementById("branchForm"));
                                                $('#spinner').show();
                                                $('.btn-primary').attr('disabled', true);
                                                $('.hiden_icon').hide();
                                                $.ajax({
                                                    url: '{{ route('front.joinBranch.update') }}',
                                                    type: "POST",
                                                    data: data,
                                                    dataType: 'JSON',
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function(response) {
                                                        // Hide spinner
                                                        $('#spinner').hide();
                                                        $('.btn-primary').attr('disabled', false);
                                                        $('.hiden_icon').show();
                                                        $('#branchModal').modal('hide')

                                                        if (response.status) {
                                                            Swal.fire({
                                                                position: 'center',
                                                                icon: 'success',
                                                                title: response.message,
                                                                showConfirmButton: false,
                                                                timer: 1000
                                                            });

                                                        }
                                                    },
                                                    error: function(response) {
                                                        // Hide spinner
                                                        $('#spinner').hide();
                                                        $('.btn-primary').attr('disabled', false);
                                                        $('.hiden_icon').show();
                                                        response.responseJSON;
                                                        var errors = response.responseJSON.errors;
                                                        if (errors) {
                                                            var errorText = "";
                                                            $.each(errors, function(key, value) {
                                                                errorText += value + "\n";
                                                                $('.' + key).text(value);
                                                            });
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Oops...',
                                                                text: response.responseJSON['message'],
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    </script>
@endsection)
