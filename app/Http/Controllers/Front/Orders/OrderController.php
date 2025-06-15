<?php

namespace App\Http\Controllers\Front\Orders;

use App\Events\NewOrderReceived;
use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //

    public function index()
    {
        $data['restaurants'] = Restaurant::all();

        return view('front.orders.index', $data);
    }
    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? false;

        $data = Order::with('restaurants')
            ->where('user_id', auth()->id())
            ->when($search, function ($q) use ($search) {
                $q->whereHas('restaurants', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($search, function ($q) use ($search) {
                $q->whereHas('restaurants', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($request->restaurant_id, function ($q) use ($request) {
                $q->where('restaurant_id', $request->restaurant_id);
            })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->where('status_cd_id', $request->status_cd_id);
            })
            ->orderby('created_at', 'desc');

        $totalOrders = (clone $data)->count();

        $totalProfit = (clone $data)->sum('total_price');

        $totalCanceled = (clone $data)->where('status_cd_id', 3)->count();


        $totalCompletedOrders = (clone $data)->where('status_cd_id', 1)->count();

        $totalPendingOrders = (clone $data)->where('status_cd_id', 2)->count();

        $avgDeliveryTime = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->where('status_cd_id', $request->status_cd_id);
            })
            ->whereNotNull('compated_time')
            ->value(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, compated_time))'));

        $dataTable = DataTables::of($data)
            ->addColumn('restaurant_name', function ($data) {
                return optional($data->restaurants)->name;
            })

            ->addColumn('user_name', function ($data) {
                return optional($data->users)->name;
            })

            ->addColumn('status', function ($data) {
                return $data->getStatus(); // أو استبدلها باسم الحالة من جدول مرجعي
            })
            ->addColumn('date', function ($data) {
                return $data->created_at->format('Y-m-d H:i');
            })
            ->addColumn('logo', $this->getPhotoColumn())


            ->addColumn('action', function ($data) {
                return view('admin.orders.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'logo', 'status']);

        return $dataTable->with([
            'meta' => [
                'total_orders' => $totalOrders,
                'total_profit' => number_format($totalProfit, 2),
                'total_canceled' => $totalCanceled,
                'total_completed_orders' => $totalCompletedOrders,
                'total_pending_orders' => $totalPendingOrders,
                'avg_delivery_time' => round($avgDeliveryTime),
            ]
        ])->make(true);
    }


    public function store(Request $request)
    {
        $total_price = 0;
        $quantity = 0;
        $userWallet = wallet::where('user_id', auth()->id())->first();

        foreach ($request->products as $product) {

            $products = Product::query()->find($product['id']);
            $quantity +=abs(intval($product['quantity']));
            $total_price += abs($products->price * $product['quantity']);
        }

        if (!$userWallet || $userWallet->balance < $total_price) {
            return response()->json(['success' => false, 'message' => 'رصيد غير كافي']);
        }

        $userWallet->balance -= $total_price;
        $userWallet->save();


        $order = Order::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'total_price' =>   $total_price,
            'price' => $request->total_price,
            'status_cd_id' => 0,
            'quantity' => $quantity,

        ]);

        foreach ($request->products as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'total_price' => $product['total_price'],
            ]);
        }
        $new_order = Order::with('users')->find($order->id);
        event(new NewOrderReceived($new_order));

        return response()->json(['success' => true, 'data' => $order]);
    }
    public function show(Request $request)
    {
        $id = $request->order_id; // تأكد أن الـ ID يصلك من Ajax

        $order = Order::with(['orderDetails', 'users'])->findOrFail($id);

        $html = view('front.orders.partials.view', compact('order'))->render();

        return response()->json(['html' => $html]);
    }
    private function getPhotoColumn(): \Closure
    {
        return function ($data) {
            return '<a href="#">'
                . '<img src="' . $data->restaurants?->logo . '" class="circle" '
                . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                . '</a>';
        };
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['restaurant_id', 'start_date', 'end_date', 'status_cd_id']);

        return Excel::download(new OrdersExport($filters), 'orders.xlsx');
    }
}
