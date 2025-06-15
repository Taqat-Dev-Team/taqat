<h5>تفاصيل الطلب رقم: {{ $order->id }}</h5>
<p>العميل: {{ $order->users?->name ?? '---' }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>المنتج</th>
            <th>سعر المنتج</th>

            <th>الكمية</th>
            <th>اجمالي السعر</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderDetails as $item)
            <tr>
                <td>{{ $item->products?->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total_price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
