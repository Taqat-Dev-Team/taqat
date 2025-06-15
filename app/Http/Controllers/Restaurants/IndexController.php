<?php

namespace App\Http\Controllers\Restaurants;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RestorantPayment;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // إجمالي الطلبات
        $totalOrders = Order::query()->where('restaurant_id', auth('restaurant')->id())->count();

        // إجمالي الطلبات المكتملة
        $completedOrders = Order::query()->where('restaurant_id', auth('restaurant')->id())->where('status_cd_id', 1)->count();

        // إجمالي الطلبات الجديدة
        $newOrders = Order::query()->where('restaurant_id', auth('restaurant')->id())->where('status_cd_id', 0)->count();

        // الطلبات قيد التنفيذ
        $inProgressOrders = Order::query()->where('restaurant_id', auth('restaurant')->id())->where('status_cd_id', 2)->count();

        // إجمالي مبالغ الطلبات
        $totalOrderAmounts = Order::query()->where('restaurant_id', auth('restaurant')->id())->sum('total_price');

        // إجمالي الدفعات للمطعم
        $totalRestaurantPayments = RestorantPayment::where('restaurant_id', auth('restaurant')->id())->sum('amount');

        // الفرق بين إجمالي مبالغ الطلبات وإجمالي الدفعات
        $difference_amount = $totalOrderAmounts - $totalRestaurantPayments;

        return view('restaurants.index', [
            'totalOrders' => $totalOrders,
            'completedOrders' => $completedOrders,
            'newOrders' => $newOrders,
            'inProgressOrders' => $inProgressOrders,
            'totalOrderAmounts' => $totalOrderAmounts,
            'totalRestaurantPayments' => $totalRestaurantPayments,
            'difference_amount'=>$difference_amount
        ]);
    }
}
