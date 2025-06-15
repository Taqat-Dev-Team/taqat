<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity; // Ensure you have the correct namespace

class ActivityController extends Controller
{
    public function index()
    {
        return view('admin.activities.index');
    }

    public function getIndex(Request $request)
    {
        $query = Activity::query()->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addColumn('log_name', function($data) {
                return $data->log_name;
            })
            ->addColumn('description', function($data) {
                return $data->description;
            })
            ->addColumn('causer', function($data) {
                return $data->causer ? $data->causer->name : 'N/A';
            })
            ->addColumn('created_at', function($data) {
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['description'])
            ->make(true);
    }
}
