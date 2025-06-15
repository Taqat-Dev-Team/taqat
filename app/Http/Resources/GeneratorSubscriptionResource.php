<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneratorSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $generatorReceipt = $this->generatorReceipt()->sum('amount');
        $readingGenerator = $this->readingGenerator()->sum('consumption_value');
        $remaining_amount = $readingGenerator - $generatorReceipt;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'remaining_amount'=> $remaining_amount,
            'paid_amount'=>$generatorReceipt,
            'photo' => $this->getPhoto(),
            'reading_generator' =>ReadingGeneratorResource::collection($this->readingGenerator),
            'generator_receipt' => GeneratorReceiptResource::collection($this->generatorReceipt),

        ];
    }
}
