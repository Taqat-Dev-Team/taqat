<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Order::query();

        if (!empty($this->filters['restaurant_id'])) {
            $query->where('restaurant_id', $this->filters['restaurant_id']);
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        if (!empty($this->filters['status_cd_id'])) {
            $query->where('status_cd_id', $this->filters['status_cd_id']);
        }

        // اختياريًا: حدد الأعمدة التي تريد تصديرها فقط
        return $query->get()->map(function ($order) {
            return [
                'user_name' => $order->users->name,
                'restaurant_name' => $order->restaurants->name,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'total_price' => $order->total_price,
                'date' => $order->created_at,
                'status' => $order->getStatus(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Restaurant Name',
            'Price',
            'Quantity',
            'Total Price',
            'Date',
            'Status',
        ];
    }
}
