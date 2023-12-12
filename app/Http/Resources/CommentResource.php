<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'author' => [
                'name' => $this->user->name,
            ],
            'food' => $this->order->foods->map(fn($food) => $food->name),
            'created_at' => $this->created_at->toDateTimeString(),
            'score' => $this->score,
            'content' => $this->message,
        ];

    }
}
