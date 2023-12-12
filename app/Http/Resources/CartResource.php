<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            "id"=> $this->id,
            "restaurant"=> [
                "title"=> $this->restaurant->restaurant_name,
            ],
            "foods"=> [ $this->foods->map(function ($food){
                return [
                    "id"=> $food->id,
                "title"=> $food->name,
                "count"=> $food->pivot->count,
                "price"=> $food->price,
            ];
            })],
            "created_at"=> Carbon::parse($this->created_at)->format('H:i'),
            "updated_at"=> Carbon::parse($this->updated_at)->format('H:i'),

        ];


    }
}
