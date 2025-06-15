@extends('layouts.admin')
@section('title')
    {{ __('label.add_new_admin_manger') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.admin_manger_data') }} </h1>
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
            <form class="needs-validation " id="my-form" name="my-form" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="name">
                                {{ __('label.name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}" placeholder="">
                            <div class="alert alert-danger name_error" style="display: none"></div>

                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="email">
                                {{ __('label.email') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="email" class="form-control" id="email"
                                value="{{ old('email') }}" placeholder="">

                            <div class="alert alert-danger email_error" style="display: none"></div>

                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="mobile">
                                {{ __('label.mobile') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                id="mobile" aria-describedby="emailHelp" placeholder="">
                            <div class="alert alert-danger phone_error" style="display: none"></div>

                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="password">
                                {{ __('label.password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password" value="" class="form-control" id="password"
                                aria-describedby="emailHelp" placeholder="">
                            <div class="alert alert-danger password_error" style="display: none"></div>

                        </div>




                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="branch_id">{{ __('label.branches') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" name="branch_id" id="branch_id">
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger branch_error" style="display: none"></div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="role_id">{{ __('label.roles') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" name="role_id" id="role_id">
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($roles as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger role_id_error" style="display: none"></div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="redirect_route">
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" name="redirect_route" id="redirect_route" required>
                                @php
                                    $routes = [
                                        'home' => 'لوحة التحكم',
                                        'users.index' => 'قائمة المستخدمين',
                                        'users.veririfcation' => 'قائمة المستخدمين قيد الفحص',
                                        'branches.index' => 'قائمة الفروع',
                                        'roles.index' => 'قائمة الصلاحيات',
                                        'companies.index' => 'قائمة الشركات',
                                        'expenses.index' => 'قائمة المصاريف التشغيلية',
                                        'wallet_movements.index' => 'بيانات حركات المحفظة',
                                        'agreements.index' => 'قائمة اتفاقية الاستخدام',
                                        'projects.index' => 'قائمة المشاريع',
                                        'jobs.index' => 'قائمة الوظائف',
                                        'attendances.index' => 'قائمة الحضور والانصراف',
                                        'chats.index' => 'مقابلات الدردشات',
                                        'reports.attendances' => 'تقرير الحضور',
                                        'reports.user_attendances' => 'تقرير الحضور حسب المستخدم',
                                        'logs.index' => 'سجل الحضور والانصراف',
                                        'user_branches.index' => 'طلبات التحاق بالفروع',
                                        'invoices.index' => 'فواتير',
                                        'reports.index' => 'تقارير',
                                        'subscription_types.index' => 'اشتراكات نوع',
                                        'internet_subscriptions.index' => 'اشتراكات الانترنت',
                                        'work_spaces.index' => 'مساحات العمل',
                                        'services.index' => 'الخدمات',
                                        'desk_managements.index' => 'ادارة المكاتب',
                                        'room_managements.index' => 'ادارة الغرفة',
                                        'tree.index' => 'ادارة الحسابات -الشجرة',
                                        'account_users.index' => 'ادارة الحسابات-المستخدمين',
                                        'tranactions_report.index' => 'تقرير المعاملات المحاسبية',
                                        'assets.index' => 'ادارة الحسابات-الاصول',
                                        'equities.index' => 'ادارة الحسابات-حقوق الملكية',
                                        'liabilities.index' => 'التزامات-ادارة الحسابات',
                                        'account_expenses.index' => 'المصاريف-ادارة الحسابات',
                                        'interviews.index' => 'مقابلات العمل',
                                        'withdraws.index' => 'طلبات السحب',
                                        'activities.index' => 'عرض الانشطة مدراء النظام',
                                        'generator_subscriptions.index' => 'ادارة اشتراكات المولد',
                                        'generators.index' => 'قائمة المولدات',
                                        'generator_readings.index' => 'قراءات اشتراكات المولد',
                                        'generator_receipts.index' => 'سندات القبض',
                                        'restaurants.index' => 'ادارة مطاعم',
                                        'categories.index' => 'تصنيفات المنتجات-ادارة مطاعم',
                                        'products.index' => 'منتجات-ادارة مطاعم',
                                        'orders.index' => 'ادارة الطلبات-ادارة مطاعم',
                                    ];
                                @endphp
                                @foreach ($routes as $route => $name)
                                    <option value="{{ $route }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger redirect_route_error" style="display: none"></div>
                        </div>
                    </div>



                <div class="form-group row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="banner_image">
                            {{ __('label.photo') }}

                        </label>
                        <input class="form-control image" type="file" accept="image/*" name="image" id="banner_image"
                            onchange="readURL(this);">
                        <div class="invalid-feedback">
                            {{ __('label.photo') }}
                        </div>
                    </div>


                    <div class="w-50 text-center">


                        <img src="{{ asset('assets/default.png') }}" style="width: 100px"
                            class="img-thumbnail img-preview" id="imagePreview" alt="">

                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="status">
                            {{ __('label.status') }}


                        </label>

                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="status" value="1" name="status"
                                    checked="checked" />
                                <span></span>
                            </label>
                        </span>


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
    @include('admin.admin.js.edit_create')
@endsection
