@extends('layouts.admin')
@section('title')
    {{ __('label.restaurants') }}
@endsection


@section('content')
<!-- صفحة عرض المتجر والمنتجات والطلبات -->

<div class="container">
    <!-- معلومات المتجر -->
    <div class="container">
        <div class="card card-custom shadow mb-10">
          <div class="card-body p-8">

            <!-- معلومات المتجر -->
            <div class="d-flex flex-column flex-md-row align-items-center mb-10">
              <!-- الشعار -->
              <div class="symbol symbol-140 mr-md-10 mb-5 mb-md-0">
                <img src="{{ $restaurant->logo ?? asset('assets/media/logos/default.png') }}" alt="Logo" class="rounded-circle shadow" />
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
              <div class="col-md-4 mb-5 mb-md-0">
                <div class="font-size-h2 font-weight-bold text-success">{{ $responseRate }}%</div>
                <div class="text-muted font-size-sm mt-2">معدل الاستجابة</div>
              </div>
              <div class="col-md-4">
                <div class="font-size-h2 font-weight-bold text-danger">{{ number_format($totalProfit, 2) }} .شيكل</div>
                <div class="text-muted font-size-sm mt-2">إجمالي الربح</div>
              </div>
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
                @foreach($restaurant->products as $product)
                <tr>
                  <td>{{ $product->name }}</td>
                  <td>{{ number_format($product->price, 2) }} ريال</td>
                  <td>{{ $product->description }}</td>
                  <td>
                    @if($product->available)
                      <span class="label label-success">متوفر</span>
                    @else
                      <span class="label label-danger">غير متوفر</span>
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
                @foreach($restaurant->orders as $order)
                <tr>
                  <td>#{{ $order->id }}</td>
                  <td>{{ $order->user->name ?? 'مجهول' }}</td>
                  <td>{{ number_format($order->total_amount, 2) }} ريال</td>
                  <td>
                    @if($order->status_cd_id == 1)
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

        </div>
      </div>
    </div>
  </div>

  @endsection



        @section('scripts')
        @include('admin.restaurants.js.js')
    @endsection
