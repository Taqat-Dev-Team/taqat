<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user'=>$this->users?new UserResource($this->users):null,
            'vendor'=>$this->vendors?new UserResource($this->vendors):null,
            'product'=>$this->products?new ProductResource($this->products):null,
            'price'=>$this->price,
            'taxPrice'=>$this->taxPrice,
            'totalPrice'=>$this->totalPrice,
            'drivingLicenseNo'=>$this->drivingLicenseNo,
            'IDNumber'=>$this->IDNumber,
            'mobile'=>$this->mobile,
            'rentalFormDate'=>$this->rentalFormDate,
            'rentalFormTime'=>$this->rentalFormTime,
            'rentalUntilDate'=>$this->rentalUntilDate,
            'rentalUntilTime'=>$this->rentalUntilTime,
            'location'=>$this->location,
            'paymentMethod'=>$this->paymentMethod?new PaymentMethodResource($this->paymentMethod):null,
            'status'=>$this->getStatus(),


        ];
    }
}
