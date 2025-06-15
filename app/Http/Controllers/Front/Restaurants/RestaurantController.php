<?php

namespace App\Http\Controllers\Front\Restaurants;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RestaurantController extends Controller
{

      public function index()
    {
        return view('front.restaurants.index');
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









        $dataTable = DataTables::of($data)
            ->addColumn('order_count', function ($data) {
                return $data->orders->count();
            })


            ->addColumn('logo', function ($data) {
                if ($data->logo) {
                    return '<img src="' . $data->logo . '" alt="Logo" width="50" height="50">';
                }
                return 'N/A';
            })
            ->addColumn('action', function ($data) {
                return view('front.restaurants.partials.actions', compact('data'));
            })
            ->rawColumns(['action', 'logo']);

        // هنا نعيد البيانات مع إضافة بيانات meta في الحقل 'meta'
        return $dataTable->make(true);
    }





}
