<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingGeneratorResource extends JsonResource
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
            'previous_reading'=>$this->previous_reading,
            'current_reading'=>$this->current_reading,
            'consumption_quantity'=>$this->consumption_quantity,
            'consumption_value'=>$this->consumption_value,

        ];
    }
}
