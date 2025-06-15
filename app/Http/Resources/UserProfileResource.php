<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'token'=>$this->plainTextToken??$request->bearerToken(),
            'nane'=>$this->name,
            'mobile'=>$this->mobile,
            'email'=>$this->email,


        ];
    }
}
