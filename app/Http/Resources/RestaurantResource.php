<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return
            [
                'id' => $this->id,
                'title' => $this->restaurant_name,
                'categories' => $this->categories ? $this->categories->pluck('name') : [],
                'works_time' => $this->schedules->map(function ($schedule) {
                    return [
                        'day' => $schedule->day,
                        'open_time' => Carbon::parse($schedule->open_time)->format('H:i'),
                        'close_time' => Carbon::parse($schedule->close_time)->format('H:i'),
                    ];
                }),
            ];


    }
}
