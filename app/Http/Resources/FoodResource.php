<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount ? $this->discount->discount : null,
            'final_price' => is_null($this->discount) ? $this->price : $this->price - ($this->price * ($this->discount->discount / 100))
        ];

    }
}
