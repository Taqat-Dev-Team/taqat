<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'rate'=>5.3,
            'showroomName'=>$this->showroomName,
            'aboutUs'=>$this->aboutUs,
            'line1'=>$this->line1,
            'line2'=>$this->line2,
            'city'=>$this->city?new CityResource($this->city):null,
            'country'=>$this->country?new CountryResource($this->country):null,
            'photo'=>$this->getAttachment(),
            'whatsapp'=>$this->whatsapp,
            'mobile'=>$this->mobile,
            'commercialLicenseNumber'=>$this->commercialLicenseNumber,
            'commercialLicensePhoto'=>$this->getCommercialLicensePhoto(),

            'status'=>[
                'id'=>$this->status,
                'name'=>$this->status==1?'active':'non-active',
            ],
            'isApprove'=>[
                'id'=>$this->isApprove,
                'name'=>$this->isApprove==1?'approve':'non-approve',
            ],
            'saleProfit'=>$this->geSumAddTypesPrice(1),
            'rentProfit'=>$this->geSumAddTypesPrice(2),

        ];



    }
}
