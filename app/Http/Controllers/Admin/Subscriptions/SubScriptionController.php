<?php

namespace App\Http\Controllers\Admin\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class SubScriptionController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.subscriptionTypes.index');
    }

    public function getIndex(Request $request)
    {
        $subScripionTypes = SubscriptionType::query()
            ->orderby('id', 'desc');
        return datatables()->of($subScripionTypes)
            ->addColumn('action', function ($data) {
                return view('admin.subscriptionTypes.partials.actions', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function store(Request $request)
    {

        SubscriptionType::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'cost' => $request->cost
        ]);


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function update(Request $request)
    {


        $subscriptionType = SubscriptionType::query()->where('id', $request->subscription_type_id)->first();
        $subscriptionType->update([
            'name' => $request->name,
            'duration' => $request->duration,
            'cost' => $request->cost
        ]);
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }


    public function delete(Request $request)
    {
        subscriptionType::query()->where('id', $request->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
