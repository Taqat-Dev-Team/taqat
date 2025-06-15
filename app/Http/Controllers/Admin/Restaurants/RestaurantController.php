<?php

namespace App\Http\Controllers\Admin\Restaurants;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Restaurants\RestaurantRequest;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestorantPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RestaurantController extends Controller
{
    public function index()
    {
        $data['restaurants'] = Restaurant::with('orders')->get();
        return view('admin.restaurants.index', $data);
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? false;

        $data = Restaurant::with('orders')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->restaurant_id, function ($q) use ($request) {
                $q->where('id', $request->restaurant_id);
            })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereHas('orders', function ($query) use ($request) {
                    $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
                });
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->whereHas('orders', function ($query) use ($request) {
                    $query->where('status_cd_id', $request->status_cd_id);
                });
            })
            ->orderby('created_at', 'desc');

        $totalRestaurants = $data->count();
        $totalOrders = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->where('status_cd_id', $request->status_cd_id);
            })
            ->count();

        $totalProfit = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->status_cd_id, function ($q) use ($request) {
                $q->where('status_cd_id', $request->status_cd_id);
            })
            ->sum('total_price');

        $totalCanceled = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->where('status_cd_id', 3)
            ->count();

        $totalClients = User::query()->whereHas('orders', function ($q) use ($request) {
            $q->when($request->restaurant_id, function ($q) use ($request) {
                $q->where('restaurant_id', $request->restaurant_id);
            })
                ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
                })
                ->when($request->status_cd_id, function ($q) use ($request) {
                    $q->where('status_cd_id', $request->status_cd_id);
                });
        })->count();

        $totalCompletedOrders = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->where('status_cd_id', 1)
            ->count();

        $totalPendingOrders = Order::when($request->restaurant_id, function ($q) use ($request) {
            $q->where('restaurant_id', $request->restaurant_id);
        })
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            })
            ->where('status_cd_id', 2)
            ->count();

        $avgDeliveryTime = Order::whereNotNull('compated_time')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, compated_time)) as avg_delivery'))
            ->value('avg_delivery');

        $dataTable = DataTables::of($data)
            ->addColumn('order_count', function ($data) {
                return $data->orders->count();
            })
            ->addColumn('order_amount', function ($data) {
                return number_format($data->orders->sum('total_amount'), 2);
            })
            ->addColumn('total_sales_weekly', function ($data) {
                return number_format(
                    $data->orders->where('created_at', '>=', now()->subWeek())->sum('total_amount'),
                    2
                );
            })
            ->addColumn('total_sales', function ($data) {
                return number_format($data->orders->sum('total_amount'), 2);
            })
            ->addColumn('logo', function ($data) {
                if ($data->logo) {
                    return '<img src="' . $data->logo . '" alt="Logo" width="50" height="50">';
                }
                return 'N/A';
            })
            ->addColumn('action', function ($data) {
                return view('admin.restaurants.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'logo']);

        // هنا نعيد البيانات مع إضافة بيانات meta في الحقل 'meta'
        return $dataTable->with([
            'meta' => [
                'total_restaurants' => $totalRestaurants,
                'total_orders' => $totalOrders,
                'total_profit' => number_format($totalProfit, 2),
                'total_canceled' => $totalCanceled,
                'total_clients' => $totalClients,
                'total_completed_orders' => $totalCompletedOrders,
                'total_pending_orders' => $totalPendingOrders,
                'avg_delivery_time' => round($avgDeliveryTime),
            ]
        ])->make(true);
    }



    public function view($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $orderCount = $restaurant->orders()->count();
        $totalprice = $restaurant->orders()->sum('total_price');

        // حساب معدل الاستجابة (مثال بسيط، يمكنك تعديله حسب مشروعك)
        $responseRate = $restaurant->orders()
            ->whereNotNull('compated_time') // بافتراض وجود حقل response_time
            ->avg('compated_time');

        $responseRate = $responseRate ? round(100 - min($responseRate / 60, 100), 2) : 0;

        // إجمالي الدفعات للمطعم
        $totalRestaurantPayments = $restaurant->restorrantayment()->sum('amount');

        // الفرق بين إجمالي مبالغ الطلبات وإجمالي الدفعات
        $difference_amount = $totalprice - $totalRestaurantPayments;

        return view('admin.restaurants.view', compact(
            'restaurant',
            'orderCount',

            'responseRate',
            'totalprice',
'difference_amount',
'totalRestaurantPayments',
        ));
    }

    public function store(RestaurantRequest $request)
    {
        $logo = $request->file('logo');
        if ($logo) {
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/restaurants'), $logoName);
        } else {
            $logoName = null;
        }
        Restaurant::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'logo' => $logoName,
            'bio' => $request->bio,

        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
    public function update(RestaurantRequest $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $logo = $request->file('logo');
        if ($logo) {
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/restaurants'), $logoName);
            $restaurant->logo = $logoName;

            $restaurant->save();
        }

        $restaurant->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => $request->password ? bcrypt($request->password) : $restaurant->password,
            'bio' => $request->bio,

        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
    public function delete(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        $restaurant->delete();

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function deletePyament(Request $request)
    {
        $restaurant = RestorantPayment::find($request->id);
        $restaurant->delete();

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function payment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // حفظ الصورة في مجلد public/storage/receipts
        $imagePath = $request->file('logo')->store('receipts', 'public');

        // حفظ الدفعة في قاعدة البيانات
        RestorantPayment::create([
            'restaurant_id' => $request->restaurant_id, // تأكد من وجود العلاقة
            'admin_id' => auth('admin')->id(),
            'amount' => $request->amount,
            'status' => 0, // 0 = قيد المراجعة
            'photo' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function getPayment(Request $request)
    {

        $query = RestorantPayment::query()

            ->orderby('created_at', 'desc');

        return DataTables::of($query)
            ->addColumn('admin_name', function ($data) {

                return $data->admins?->name;
            })
            ->addColumn('logo', function ($data) {
                if ($data->photo) {
                    return '<img src="' . asset('public/storage/' . $data->photo) . '" alt="Logo" width="50" height="50">';
                }
                return 'N/A';
            })
          ->addColumn('date', function ($data) {

            return $data->created_at->format('Y-m-d');
                // return view('admin.restaurants.partials.payment_actions', compact('data'));
            })
            ->addColumn('action', function ($data) {

                return view('admin.restaurants.partials.payment_actions', compact('data'));
            })

            ->rawColumns(['action', 'logo'])->make(true);
    }

    public function updatePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // حفظ الصورة في مجلد public/storage/receipts

        $restorant =  RestorantPayment::query()->findOrFail($request->payment_id);

        $restorant->update([
            'amount' => $request->amount,
        ]);


        if ($request->logo) {
            $imagePath = $request->file('logo')->store('receipts', 'public');
            $restorant->update([
                'photo' => $imagePath,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
