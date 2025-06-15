<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name_ar,
            'flag'=>$this->image(),
            'iso' => $this->iso2,
            'phone_code' => $this->phone_code,
            'validation_phone' => $this->validation_phone,
            'place_holder' => $this->place_holder,

        ];
    }
}
