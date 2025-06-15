<?php

// app/Services/CrosspayService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CrosspayService
{
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->apiKey = '3097bc-0f7124-6accca-8e58c5-aff36a'
        // $this->apiSecret = '';
    }

    public function createInvoice($data)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post('https://crosspayonline.com/api/createInvoiceByAccount', $data);

        return $response->json();
    }
}
