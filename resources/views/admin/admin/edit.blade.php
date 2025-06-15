@extends('layouts.admin')
@section('title')
    {{ __('label.edit_admin_manger') }}
@endsection


@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                {{-- <h1 class="card-label">مدير النظام : {{ $admin->name }}</h1> --}}
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->
                {{-- <h6 class="card-label">تاريخ التسحيل : {{ $admin->created_at->format('Y-m-d') }}</h6> --}}


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <form class="needs-validation " id="edit_admin" name="edit_admin" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <input type="hidden" value="{{ $admin->id }}" name="id">

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="name">
                                {{ __('label.name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $admin->name }}" placeholder="">
                            @if ($errors->has('name'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                </span>
                            @endif
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-lg-6 col-sm-12">

                            <label for="email">
                                {{ __('label.email') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="email" class="form-control" id="email"
                                value="{{ $admin->email }}" placeholder="">
                            @if ($errors->has('email'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                </span>
                            @endif
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="mobile">
                                {{ __('label.mobile') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="mobile" value="{{ $admin->mobile }}" class="form-control"
                                id="mobile" aria-describedby="emailHelp" placeholder="">
                            @if ($errors->has('mobile'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
                                </span>
                            @endif
                        </div>

                        <div class="col-lg-6 col-sm-12">

                            <label for="password">
                                {{ __('label.password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password" value="" class="form-control" id="password"
                                aria-describedby="emailHelp" placeholder="">
                            <div class="invalid-feedback">
                                كلمة المرور
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                </span>
                            @endif
                        </div>




                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="branch_id">{{ __('label.branches') }} <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="branch_id" id="branch_id">
                                <option value="">{{ __('label.choose') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}" @if ($value->id == $admin->branch_id) selected @endif>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('branch_id'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('branch_id') }}</div>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="role_id">{{ __('label.roles') }} <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="role_id" id="role_id">
                                <option value="">{{ __('label.choose') }}</option>
                                @foreach ($roles as $value)
                                    <option value="{{ $value->id }}" @if ($value->id == $admin->role_id) selected @endif>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('role_id') }}</div>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="redirect_route">{{ __('label.redirect_route') }} <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="redirect_route" id="redirect_route" required>
                                <option value="">{{ __('label.choose') }}</option>
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
                                    <option value="{{ $route }}" @if ($route == $admin->redirect_route) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('redirect_route'))
                                <span class="help-block font-red-mint">
                                    <div class="alert alert-danger">{{ $errors->first('redirect_route') }}</div>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="image">
                                {{ __('label.photo') }}

                            </label>
                            <input class="form-control image" type="file" name="image" id="image"
                                onchange="readURL(this);">
                            <div class="invalid-feedback">
                                {{ __('label.photo') }}
                            </div>
                        </div>


                        <div class="w-50 text-center">


                            <img src="{{ $admin->getAttachment() }}" style="width: 100px"
                                class="img-thumbnail img-preview" id="imagePreview" alt="">

                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="banner_image">
                                {{ __('label.status') }}

                            </label>

                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" value="1" name="status"
                                        @if ($admin->status) checked="checked" @endif />
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
