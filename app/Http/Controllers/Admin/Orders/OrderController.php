<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{


    public function index()
    {
        $data['restaurants'] = Restaurant::all();
        return view('admin.orders.index', $data);
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? false;

        $data = Order::with('restaurants')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('restaurants', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($request->restaurant_id, function ($q) use ($request) {
                $q->where('restaurant_id', $request->restaurant_id);
            })
                ->when($request->user_id, function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->where('status_cd_id', $request->status_cd_id);
            })
            ->orderby('created_at', 'desc');

        $order_count = (clone $data)->count();

        $total_price = (clone $data)->sum('total_price');

        $totalCanceled = (clone $data)->where('status_cd_id', 3)->count();

        $totalClients = User::count();

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
            ->rawColumns(['action', 'logo','status']);

        return $dataTable->with([
            'meta' => [
                'order_count'=>$order_count ,
                'total_orders' => $total_price,
            ]
        ])->make(true);
    }

    private function getPhotoColumn(): \Closure
    {
        return function ($data) {
            return '<a href="' . route('admin.users.views', $data->user_id) . '">'
                . '<img src="' . $data->users?->getPhoto() . '" class="circle" '
                . 'style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">'
                . '</a>';
        };
    }
public function show(Request $request)
{
    $id = $request->order_id; // تأكد أن الـ ID يصلك من Ajax

    $order = Order::with(['orderDetails', 'users'])->findOrFail($id);

    $html = view('admin.orders.partials.view', compact('order'))->render();

    return response()->json(['html' => $html]);
}

  public  function  delete(Request $request){

        Order::query()->findOrFail($request->id)->delete();
        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);

    }
public function exportExcel(Request $request)
{
    $filters = $request->only(['restaurant_id', 'start_date', 'end_date', 'status_cd_id']);

    return Excel::download(new OrdersExport($filters), 'orders.xlsx');
}
}
