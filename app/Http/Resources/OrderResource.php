<?php

namespace App\Http\Resources;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Card ID' => $this->id,
            'Status' => $this->customer_status,
            'Restaurant' => [
                'Title' => Restaurant::query()->find($this->restaurant_id)->name,
//                'Category' => Restaurant::query()->find($this->restaurant_id)->restaurantCategories[]->name
            ],
        'Foods'=>FoodOrderResource::collection($this->foods),
        ];
    }
}

