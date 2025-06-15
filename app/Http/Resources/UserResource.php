<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nane'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'photo'=>$this->getAttachment(),
            'provider'=>$this->provider,
            'providerId'=>$this->providerId,
            'vendor'=>$this->vendor?new VendorResource($this->vendor):null,
            'userType'=>[
                'id'=>$this->userType,
                'name'=>$this->userType==1?'user':'vendor',
            ]
        ];
    }
}
