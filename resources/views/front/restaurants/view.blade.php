@extends('layouts.admin')
@section('title')
    {{ __('label.restaurants') }}
@endsection


@section('content')
    <!-- صفحة عرض المتجر والمنتجات والطلبات -->

    <div class="container">
        <!-- معلومات المتجر -->
            <div class="card card-custom shadow mb-10">
                <div class="card-body p-8">

                    <!-- معلومات المتجر -->
                    <div class="d-flex flex-column flex-md-row align-items-center mb-10">
                        <!-- الشعار -->
                        <div class="symbol symbol-140 mr-md-10 mb-5 mb-md-0">
                            <img src="{{ $restaurant->logo ?? asset('assets/media/logos/default.png') }}" alt="Logo"
                                class="rounded-circle shadow" />
                        </div>

                        <!-- تفاصيل -->
                        <div class="flex-grow-1">
                            <h2 class="font-weight-bolder text-dark mb-2">{{ $restaurant->name }}</h2>
                            <p class="text-muted font-size-lg mb-4">{{ $restaurant->description }}</p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <i class="flaticon-placeholder-1 text-primary mr-2"></i>
                                    <span class="font-weight-semibold text-dark">{{ $restaurant->address }}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <i class="flaticon2-phone text-success mr-2"></i>
                                    <span class="font-weight-semibold text-dark">{{ $restaurant->mobile }}</span>
                                </div>
                                <div class="col-md-6">
                                    <i class="flaticon2-email text-warning mr-2"></i>
                                    <span class="font-weight-semibold text-dark">{{ $restaurant->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الإحصائيات -->
                    <div class="row text-center border-top pt-6">
                        <div class="col-md-4 mb-5 mb-md-0">
                            <div class="font-size-h2 font-weight-bold text-primary">{{ number_format($totalOrders) }}</div>
                            <div class="text-muted font-size-sm mt-2">إجمالي الطلبات</div>
                        </div>

                        <div class="col-md-4">
                            <div class="font-size-h2 font-weight-bold text-danger">{{ number_format($totalProfit, 2) }}
                                .شيكل</div>
                            <div class="text-muted font-size-sm mt-2">إجمالي  الطلبات</div>
                        </div>
                    </div>

                </div>
            </div>



        <!-- تبويبات المنتجات والطلبات -->
        <div class="card card-custom shadow">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_products">📦 المنتجات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_orders">🧾 الطلبات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_payments">💰 الدفعات المالية</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <!-- تبويب المنتجات -->
                    <div class="tab-pane fade show active" id="tab_products">
                        <table class="table table-bordered table-hover table-head-custom text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>المنتج</th>
                                    <th>السعر</th>
                                    <th>الوصف</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurant->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 2) }} ريال</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            @if ($product->is_ative)
                                                <span class="label label-success">نشط </span>
                                            @else
                                                <span class="label label-danger">غير نشط</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- تبويب الطلبات -->
                    <div class="tab-pane fade" id="tab_orders">
                        <table class="table table-bordered table-hover table-head-custom text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>العميل</th>
                                    <th>المجموع</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurant->orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'مجهول' }}</td>
                                        <td>{{ number_format($order->total_amount, 2) }} ريال</td>
                                        <td>
                                            @if ($order->status_cd_id == 1)
                                                <span class="label label-success">مكتمل</span>
                                            @elseif($order->status_cd_id == 2)
                                                <span class="label label-warning">قيد التنفيذ</span>
                                            @else
                                                <span class="label label-danger">ملغي</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="tab_payments">
                        <div class="mb-3 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addPaymentModal">
                                ➕ إضافة دفعة
                            </button>
                        </div>
                <table class="table table-head-custom table-vertical-center payment_table" >

    <thead>
                        <tr class="text-left">

                            <th></th>
                            <th>{{ __('label.amount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal: إضافة دفعة -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="my-form" name="my-form"  enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPaymentModalLabel">إضافة دفعة مالية</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- مبلغ الدفعة -->
                        <div class="form-group col-md-12">
                            <label for="amount">المبلغ</label>
                            <input type="number" name="amount" class="form-control" required step="0.01">
                        </div>
      <input type="hidden" class="form-control" value="{{$restaurant->id}}" id="add_edit_restaurant_id"
                                name="restaurant_id">

                        <!-- صورة إيصال الدفع -->
                        <div class="form-group col-md-6">
                            <label for="logo" class="form-label">{{ __('label.photo') }} <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control" accept="image/jpg,jpeg,png,gif" id="logo"
                                name="logo">
                            <div class="text-danger" id="logo_error"></div>

                            <div class="mb-3">
                                <img id="add_edit_image-preview" src="#" alt="Image Preview"
                                    style="display:none; max-width: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



@section('scripts')
    @include('admin.restaurants.js.view')
@endsection
