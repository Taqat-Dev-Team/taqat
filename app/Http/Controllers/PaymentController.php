<?php

namespace App\Http\Controllers;

use App\Services\CrosspayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $crosspayService;

    public function __construct(CrosspayService $crosspayService)
    {
        $this->crosspayService = $crosspayService;
    }

    public function createInvoice(Request $request)
    {
        $data = [
            'api_data' => '82e4b4fd3a16ad99229af9911ce8e6d2',
            'invoice_id' => '1',
            'apiKey' => $this->crosspayService->apiKey,
            'total' => 1,
            'currency' => 'USD',
            'inv_details' => json_encode([
                'inv_items' => [
                    [
                        'name' => 'Shoping from store',
                        'quntity' => '1.00',
                        'unitPrice' => 1,
                        'totalPrice' => 1,
                        'currency' => 'USD',
                    ]
                ],
                'inv_info' => [
                    ['row_title' => 'Vat', 'row_value' => '0'],
                    ['row_title' => 'Delevery', 'row_value' => '0'],
                    ['row_title' => 'Promo Code', 'row_value' => 0],
                    ['row_title' => 'Discounts', 'row_value' => 0],
                ],
                'user' => ['userName' => 'ghassan']
            ]),
            'return_url' => 'https://web.whatsapp.com/',
            'email' => 'gssan1018@gmail.com',
            'mobile' => '00970567711720',
            'name' => 'ghassan'
        ];

        $response = $this->crosspayService->createInvoice($data);

        // Handle the response
        return response()->json($response);
    }

}
