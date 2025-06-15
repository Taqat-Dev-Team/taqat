<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GeneratorSubscriptions\GeneratorReceiptRequest;
use App\Http\Requests\Api\GeneratorSubscriptions\GeneratorSubscriptionRequest;
use App\Http\Resources\GeneratorSubscriptionResource;
use App\Models\GeneratorReceipt;
use App\Models\GeneratorSubscription;
use App\Traits\PaginationTrait;
use Generator;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use PaginationTrait;
    public function index(Request  $request)
    {
        $filters = $request;

        $search = $request->input('search');


        $filter_option = "&" . http_build_query($filters);
        $size = $request->get('size', 10); // Default page size of 10 if not provided
        $generatorSubscription = GeneratorSubscription::query()->orderby('id', 'desc')

            ->when($search, function ($q) use ($search) {
                $q->Where('name', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            })





            ->paginate($size);
        $response['data'] = GeneratorSubscriptionResource::collection($generatorSubscription);
        $pagination_options = $this->get_options_v2($generatorSubscription, $filter_option);
        $response = $response + $pagination_options;
        return response_api(true, 'نجاح العملية', $response, 200);
    }

    public function show($id)
    {
        $generatorSubscription = GeneratorSubscription::query()->findOrFail($id);
        return response_api(true, 'نجاح العملية', new GeneratorSubscriptionResource($generatorSubscription), 200);
    }

    public function store(GeneratorSubscriptionRequest $request)
    {
        foreach ($request->generator_subscriptions as $key => $value) {

            $photo = $value['photo']->store('generator_subscriptions', 'public');
            GeneratorSubscription::create([
                'name' => $value['name'],
                'mobile' => $value['mobile'],
                'address' => $value['address'],
                'latitude' => $value['latitude'],
                'longitude' => $value['longitude'],
                'initial_reading' => $value['initial_reading'],
                'killo_watt_cost'=> $value['killo_watt_cost'],
                'photo' => $photo,
            ]);
        }
        $response['data'] = null;
        return response_api(true, 'نجاح العملية', $response, 200);
    }

    public function storeGeneratorReceipt(GeneratorReceiptRequest $request)
    {

        foreach ($request->generator_receipts as $key => $value) {

            GeneratorReceipt::create([
                'generator_subscription_id' => $value['generator_subscription_id'],
                'amount' => $value['amount'],
                'date' => $value['date'],
            ]);
        }

        $response['data'] = null;
        return response_api(true, 'نجاح العملية', $response, 200);
    }


    public function storeReadingGenerator(Request $request)
    {
        $generatorSubscription = GeneratorSubscription::query()->findOrFail($request->id);
        // foreach ($request->generator_redings as $key => $value) {

        //     ReadingGenerato
        // }
        return response_api(true, 'نجاح العملية', null, 200);
    }
}
