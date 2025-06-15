<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {

        $data['currencies'] = Constant::query()->where('key', 'currency')->whereNotNull('parent_id')->get();
        return view('admin.services.index',  $data);
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? null;
        $orderColumnIndex = $request->order[0]['column'] ?? 0;
        $orderDirection = $request->order[0]['dir'] ?? 'desc';
        $orderColumn = $request->columns[$orderColumnIndex]['data'] ?? 'id';

        $services = Service::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy($orderColumn, $orderDirection);

        return datatables()->of($services)
            ->addColumn('action', function ($data) {
                return view('admin.services.partials.actions', compact('data'));
            })
            ->addColumn('amount', function ($data) {
                return $data->amount . ' ' . ($data->currencyCd?->value);
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function store(Request $request)
    {

        Service::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'currency_cd_id' => $request->currency_cd_id,
        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {


        $subscriptionType = Service::query()->where('id', $request->service_id)->first();
        $subscriptionType->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'currency_cd_id' => $request->currency_cd_id,
            'is_monthly'=>$request->is_monthly,

        ]);
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        Service::query()->where('id', $request->id)->delete();

        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
