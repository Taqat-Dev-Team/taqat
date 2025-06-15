@extends('layouts.front')
@section('title', __('label.products'))

@section('content')
    <div class="card card-custom">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('label.dispaly_all_products') }}


            </h3>

            <h5> رصيد محفظتي هو :{{ auth()->user()->wallet?->balance ?? 0 }} شيكل</h5>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center" id="product_table">
                    <thead class="thead-light">
                        <tr>
                            <th></th>

                            <th>الاسم</th>
                            <th>السعر</th>
                            <th style="width: 120px;">الكمية</th>
                            <th style="width: 150px;">اجمالي السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="restaurant_id" value="{{ $restaurant->id }}">
                        @forelse ($products as $product)
                            <tr data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                                <td>
                                    <img data-category_id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-logo="{{ $product->logo ? asset('public/files/' . $product->logo) : asset('images/default.png') }}"
                                        data-is_active="{{ $product->is_active }}" class="img-thumbnail shadow-sm"
                                        src="{{ $product->logo ? asset('public/files/' . $product->logo) : asset('images/default.png') }}"
                                        alt="{{ $product->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid #eee;" />
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <span class="badge badge-light-primary font-weight-bold">
                                        {{ $product->price }}شيكل
                                    </span>
                                </td>
                                <td>
                                    <input type="number" min="0" value="0"
                                        class="form-control quantity-input text-center" />
                                </td>
                                <td>
                                    <span class="total-price badge badge-info font-weight-bold">
                                        0 شيكل
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">{{ __('label.no_products_found') }}</td>
                            </tr>
                        @endforelse

                        {{-- صف الإجماليات وزر الإرسال --}}
                        <tr style="background-color: #f0f8ff;">
                            <td>
                                < <td colspan="2" class="text-end font-weight-bold">
                            </td>
                            <td colspan="1" class="text-end font-weight-bold">
                                <span class="text-primary">إجمالي الكمية:</span>
                                <span id="total_quantity" class="badge bg-info text-white fs-6 px-3 py-2">0</span>

                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="text-primary mb-1">السعر الإجمالي:</span>
                                    <span id="total_price" class="badge bg-success text-white fs-6 px-3 py-2">0.00
                                        شيكل</span>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm add-to-order w-100">
                                    <i class="fas fa-cart-plus"></i> اتمام الطلب
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('Shared.delete')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');

            function updateRowTotal(row) {
                const price = parseFloat(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                const total = price * quantity;
                row.querySelector('.total-price').textContent = `${total.toFixed(2)} شيكل`;
            }

            function updateGlobalTotals() {
                let totalQuantity = 0;
                let totalPrice = 0;

                document.querySelectorAll('#product_table tbody tr[data-id]').forEach(row => {
                    const price = parseFloat(row.dataset.price);
                    const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                    totalQuantity += quantity;
                    totalPrice += price * quantity;
                });

                document.getElementById('total_quantity').textContent = totalQuantity;
                document.getElementById('total_price').textContent =
                    `${totalPrice.toFixed(2)} شيكل`;
            }

            quantityInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    const row = this.closest('tr');
                    updateRowTotal(row);
                    updateGlobalTotals();
                });

                updateRowTotal(input.closest('tr'));
            });

            updateGlobalTotals();

            // زر الإرسال النهائي (تجميع جميع المنتجات دفعة واحدة)
            document.querySelector('.add-to-order').addEventListener('click', function() {

                const button = this;
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> جاري الإرسال...';

                const rows = document.querySelectorAll('#product_table tbody tr[data-id]');
                const products = [];
                let total_price = 0;

                rows.forEach(row => {
                    const productId = row.dataset.id;
                    const price = parseFloat(row.dataset.price);
                    const quantity = parseInt(row.querySelector('.quantity-input').value);

                    if (quantity && quantity > 0) {
                        const total = price * quantity;
                        products.push({
                            id: productId,
                            quantity: quantity,
                            price: price,
                            total_price: total
                        });
                        total_price += total;
                    }
                });

                if (products.length === 0) {
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-cart-plus"></i> اتمام الطلب';

                    Swal.fire({
                        icon: 'warning',
                        title: 'لم يتم تحدديد الكمية ',
                        text: 'يجب اختيار منتج واحد على الأقل',
                    });
                    return;
                }

                fetch("{{ route('front.orders.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            products: products,
                            'restaurant_id': document.getElementById('restaurant_id').value,
                            'total_price': total_price
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم حفظ الطلب',
                                text: data.message ||
                                    'تم تنفيد الطلب بنجاح',
                            });
                            setTimeout(() => {
                                window.location.href = "{{ route('front.orders.index') }}";
                            }, 2000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'هناك خطأ',
                                text: data.message || 'يرجى المحاولة لاحقا',
                            });

                            button.disabled = false;
                            button.innerHTML = '<i class="fas fa-cart-plus"></i> اتمام الطلب';

                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'هناك خطأ',
                            text: error.message || 'يرجى المحاولة لاحقا',
                        });
                    });
            });
        });
    </script>
@endsection
