<?php

namespace App\Http\Controllers\Admin\Restaurants\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Restaurants\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        $data['categories'] = ProductCategory::query()->get();
        $data['restaurants'] = Restaurant::query()->get();
        return view('admin.products.index', $data); // Load the view for DataTable
    }

    public function getIndex(Request $request)
    {

        $category_id = $request->parentId ?? false;
        $serach=$request->serach['value']??false;
        if ($request->ajax()) {
        $query = Product::query()
        ->orderby('id', 'desc')
        ->when($category_id, function ($q) use ($category_id) {
            $q->where('category_id', $category_id);
        })
        ->when($serach, function ($q) use ($serach) {
            $q->where('name','like','%'. $serach.'%');
        });

        if ($request->has('order')) {
            $columnIndex = $request->input('order.0.column'); // Get the index of the column to sort
            $direction = $request->input('order.0.dir'); // Get the sort direction (asc or desc)
            $columns = ['id', 'name', 'is_active']; // List of sortable columns

            // Validate and apply the sort
            if (isset($columns[$columnIndex])) {
                $query->orderBy($columns[$columnIndex], $direction);
            }
        }





        return DataTables::of($query)

            ->addColumn('order_count', function ($data) {
                return $data->order()->count();
            })

            ->addColumn('restaurant_name', function ($data) {
                return $data->restaurant?->name;
            })
            ->addColumn('logo', fn($data) => view('admin.products.partials.coverImage', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.products.partials.active_toggle', compact('data')))
            ->addColumn('actions', fn($data) => view('admin.products.partials.actions', compact('data')))
            ->rawColumns(['logo', 'is_active',  'actions'])
            ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }


    public function store(ProductRequest $request)
    {
        // Exclude the non-standard name fields from the request data


        $data = $request->except(['product_id']);

        if ($request->logo) {
            $data['logo'] =upload($request->logo);
        }

         Product::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public  function  update(ProductRequest $request)
    {



        $product = Product::query()->where('id', $request->product_id)->first();

        $data = $request->except(['product_id']);

        if ($request->logo) {
            $data['logo'] =upload($request->logo);
        }

        $product->update($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }




    public function updateStatus(Request $request)
    {
        try {


            $request->validate([
                'product_id' => 'required|exists:products,id',
                'is_active' => 'required|boolean',
            ]);

            // Update the company's active status
            $product = Product::find($request->product_id);
            $product->is_active = $request->is_active;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => __('label.success_full_process'),
            ]);
        } catch (\Exception $exception) {
            return $exception;
            return response()->json([
                'success' => false,
                'message' => __('messages.process_fail'),
            ]);
        }

    }
    public function delete(Request $request)
    {
        try {
            $product = Product::find($request->id);

            // Check for related order details before deleting
            if ($product->order()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يمكن حذف المنتج لأنه مرتبط بطلبات سابقة.',
                ], 400);
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => __('label.success_full_process'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('messages.process_fail'),
            ]);
        }
    }
}
