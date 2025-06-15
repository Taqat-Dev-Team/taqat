<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'user'=>$this->user?new UserResource($this->user):null,
            'category'=>new CategoryResource($this->category),
            'title'=>$this->title,
            'description'=>$this->description,
            'price'=>$this->price,
            'salePrice'=>$this->salePrice,
            'discountPercentage'=>$this->discountPercentage,
            'priceDay'=>$this->priceDay,
            'priceMonth'=>$this->priceMonth,
            'priceYear'=>$this->priceYear,
            'photo'=>$this->getAttachment(),
            'gearBox'=>$this->gearBox?$this->gearBox->name:null,
            'carType'=>$this->carType?$this->carType->name:null,
            'numberDoor'=>$this->numberDoor,
            'numberPassenger'=>$this->numberPassenger,
            'carModel'=>$this->carModel,
            'carYear'=>$this->carYear,
            'carMileage'=>$this->carMileage,
            'tankSize'=>$this->tankSize,
            'fuelType'=>$this->fuelTypes?$this->fuelTypes->name:'',
            'contactInformationName'=>$this->contactInformationName,
            'contactInformationMobile'=>$this->contactInformationMobile,
            'productColors'=>$this->productColors?ProductColorResource::collection($this->productColors):[],
            'productImages'=>$this->productImages?ProductImageResource::collection($this->productImages):[],
            'adsType'=>$this->adsTypeId,
            'days'=>$this->days,
            'weeks'=>$this->weeks,
            'months'=>$this->months,
            'formDate'=>$this->formDate,
            'formHour'=>$this->formHour,
            'unitDate'=>$this->unitDate,
            'unitHour'=>$this->unitHour,
            'palletNumber'=>$this->palletNumber,
            'rentalTerms'=>$this->rentalTerms,

        ];
    }
}
