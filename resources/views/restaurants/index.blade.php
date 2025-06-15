@extends('layouts.restaurants')
@section('title', __('label.home'))

@section('content')

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('إجمالي الطلبات') }}</h5>
                        <h3 class="mb-0">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('الطلبات المكتملة') }}</h5>
                        <h3 class="mb-0">{{ $completedOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-bell fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('الطلبات الجديدة') }}</h5>
                        <h3 class="mb-0">{{ $newOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-spinner fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('قيد التنفيذ') }}</h5>
                        <h3 class="mb-0">{{ $inProgressOrders }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-dark h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-dollar-sign fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('إجمالي مبالغ الطلبات') }}</h5>
                        <h3 class="mb-0">{{ number_format($totalOrderAmounts, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-secondary h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-credit-card fa-2x mr-3"></i>
                    <div>
                        <h5 class="card-title mb-1">{{ __('إجمالي دفعات المطعم') }}</h5>
                        <h3 class="mb-0">{{ number_format($totalRestaurantPayments, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

     <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-money-bill-wave mr-2"></i> {{ __('اجمالي المستحق من ادارة طاقات') }}
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h4 class="mb-2">{{ __('المبلغ المستحق') }}</h4>
                    <h2 class="text-danger mb-0">{{ number_format($difference_amount ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-bell mr-2"></i> {{ __('عرض كافة الطلبات') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-head-custom table-vertical-center order-table"
                            id="kt_advance_table_widget_1">
                            <thead>
                                <tr class="text-left">
                                    <th></th>
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.price') }}</th>
                                    <th>{{ __('label.quantity') }}</th>
                                    <th>{{ __('label.total_price') }}</th>
                                    <th>{{ __('label.date') }}</th>
                                    <th>{{ __('label.status') }}</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card for payments due to admin -->

    </div>
@endsection
@section('scripts')
<script>
      let table = $('.order-table').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true, // Improves speed by deferring the rendering of rows
            ajax: {
                url: "{{ route('restaurants.orders.getIndex') }}",
                data: function(d) {
                    d.restaurant_id = "{{ auth()->id() }}";
                },
                cache: true, // Avoid unnecessary repeated requests
            },
            columns: [{


                    data: 'logo',
                    name: 'logo',
                    orderable: true,
                    searchable: false
                },
                {




                    data: 'user_name',
                    name: 'user_name',
                    orderable: true,
                    searchable: false

                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: true,
                    searchable: false
                },

                {
                    data: 'quantity',
                    name: 'quantity',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'total_price',
                    name: 'total_price',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: false
                },


            ],
            order: [
                [1, 'asc']
            ], // Ensure proper default ordering
            language: {
                loadingRecords: "Please wait - loading...",
            },
            lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
        });

</script>
        @endsection
