<?php

namespace App\Http\Controllers\Restaurants\Reports;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;

class ReportController extends Controller
{
    public function index()
    {
        return view('restaurants.reports.index');
    }

    public function getIndex(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
// dd($startDate, $endDate);
        $query = Product::select(
            'products.id',
            'products.name',
            DB::raw('SUM(order_details.quantity) as total_sold'),
            DB::raw('SUM( order_details.total_price) as total_cost')
        )
            ->join('order_details', 'order_details.product_id', '=', 'products.id')
            ->when($startDate, function ($q) use ($startDate) {
            $q->where('order_details.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
            $q->where('order_details.created_at', '<=', $endDate);
            })
            ->groupBy('products.id', 'products.name');

        return datatables()->of($query)->make(true);
    }



}
