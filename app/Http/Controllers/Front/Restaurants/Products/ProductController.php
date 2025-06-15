<?php

namespace App\Http\Controllers\Front\Restaurants\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data['restaurant']=Restaurant::query()->find($request->restaurant_id)??abort(404);
        $data['products'] = Product::with('restaurant')
        ->active()
            ->when($request->restaurant_id, function ($q) use ($request) {
                $q->where('restaurant_id', $request->restaurant_id);
            })->orderby('created_at', 'desc')->get();
        return view('front.restaurants.products.index',$data); // Load the view for DataTable
    }


}
