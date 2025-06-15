<?php

namespace App\Http\Controllers\Restaurants\Orders;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data['status']=$request->status;
        return view('restaurants.orders.index',$data);
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

        $totalClients = User::whereHas('orders', function ($q) use ($request) {
            $q->when($request->restaurant_id, function ($q2) use ($request) {
                $q2->where('restaurant_id', $request->restaurant_id);
            })
                ->when($request->start_date && $request->end_date, function ($q2) use ($request) {

                    $start = \Carbon\Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
                    $end = \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                    $q2->whereBetween('created_at', [$start, $end]);
                })
                ->when($request->status_cd_id, function ($q2) use ($request) {
                    $q2->where('status_cd_id', $request->status_cd_id);
                });
        })->count();


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

               ->addColumn('user_name', $this->getUserNameColumn())



            ->addColumn('status', function ($data) {
                return $data->getStatus(); // أو استبدلها باسم الحالة من جدول مرجعي
            })
            ->addColumn('date', function ($data) {
                return $data->created_at->format('Y-m-d H:i');
            })
            ->addColumn('logo', $this->getPhotoColumn())


            ->addColumn('action', function ($data) {
                return view('restaurants.orders.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'logo', 'status', 'user_name']);

        return $dataTable->with([
            'meta' => [
                'order_count' => $order_count,
                'total_price' => number_format($total_price, 2),

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


    public function update(Request $request)
    {

        $order = Order::query()->where('id', $request->order_id)->first();

        $order->update([
            'status_cd_id' => $request->status_cd_id,
        ]);
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['restaurant_id', 'start_date', 'end_date', 'status_cd_id']);

        return Excel::download(new OrdersExport($filters), 'orders.xlsx');
    }

    private function getUserNameColumn(): \Closure
    {
        return function ($order) {
            $user = $order->users;
            $branchName = $user->deskMangment?->branches?->name;
            $branchName = $branchName ? "اسم الفرع: $branchName" : '';

            if ($user->rooms()->exists()) {
                $room = $user->rooms()->orderby('created_at', 'desc')->first();
                $deskCode = $room?->code ?? '';
                $deskInfo = ($deskCode) ? "غرفة: $deskCode" : '';
            }
            if ($user->userRooms()->exists()) {
                $userRoom = $user->userRooms()->orderBy('created_at', 'desc')->first();
                $deskCode = optional($userRoom?->rooms)->code ?? '';

                // $deskCode = optional($user->userRooms()->rooms()->orderBy('created_at', 'desc')->first())->code ?? '';

                $deskInfo = ($deskCode) ? "غرفة: $deskCode" : '';
            } elseif ($user->deskMangment()->exists()) {
                $deskCode = $user->deskMangment?->code ?? '';
                $deskInfo = $deskCode ? "رقم المقعد:$deskCode" : '';
            } else {
                $deskInfo = '';
            }
            // Add verification icon if user is verified
            return '<a href="#" class="text-dark-30 font-weight-bolder text-hover-primary mb-1 font-size-lg">'
                . e($user->name) . '</a>'
                . '<div><a class="text-muted font-weight-bold text-hover-primary" href="#">'
                . e($user->mobile) . '</a></div>'


                . '<div class="text-muted">' . e($branchName) . '</div>'

                . '<div class="text-muted">' . e($deskInfo) . '</div>';

        };
    }
}
