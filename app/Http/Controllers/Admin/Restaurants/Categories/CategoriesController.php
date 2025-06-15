<?php

namespace App\Http\Controllers\Admin\Restaurants\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        $data['categories'] = ProductCategory::query()->get();
        return view('admin.categories.index', $data); // Load the view for DataTable
    }

    public function getIndex(Request $request)
    {

        $category_id = $request->parentId ?? false;
        $serach=$request->serach['value']??false;
        if ($request->ajax()) {
        $query = ProductCategory::query()
        ->orderby('id', 'desc')
        ->when($category_id, function ($q) use ($category_id) {
            $q->where('parent_category_id', $category_id);
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

            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('parent_category', function ($data) {
                return $data->parentCategory?->name;
            })
            ->addColumn('logo', fn($data) => view('admin.categories.partials.coverImage', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.categories.partials.active_toggle', compact('data')))
            ->addColumn('actions', fn($data) => view('admin.categories.partials.actions', compact('data')))
            ->rawColumns(['logo', 'is_active',  'actions'])
            ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }


    public function store(CategoryRequest $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except([ 'category_id']);



        if ($request->logo) {
            $data['logo'] =$request->file('logo')->store('categories', 'public');
        }

        $cateogry= ProductCategory::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.success_full_process'),
        ]);
    }

    public  function  update(CategoryRequest $request)
    {
        $data = $request->except(['name',  'category_id']);



        $cateogry = ProductCategory::query()->where('id', $request->category_id)->first();


        if ($request->logo) {
            $data['logo'] =$request->file('logo')->store('categories', 'public');
        }

        $cateogry->update($data);

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
                'category_id' => 'required|exists:product_categories,id',
                'is_active' => 'required|boolean',
            ]);

            // Update the company's active status
            $branch = ProductCategory::find($request->category_id);
            $branch->is_active = $request->is_active;
            $branch->save();

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

    public function delete(Request $request)
    {
        try {
            $category = ProductCategory::find($request->id);
            $category->delete();

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
    public function getCategory(Request $request)
    {
        $category = ProductCategory::find($request->id);
        return response()->json([
            'success' => true,
            'category' => $category,
        ]);
    }
}
