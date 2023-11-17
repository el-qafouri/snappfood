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
            'Cart Id' => $this->order->id,
            'Author' => auth()->user()->name,
            'Food' => $this->food->name,
            'Score'=>$this->score,
            'Content'=>$this->message,
            $this->mergeWhen(!is_null($this->answer)),['Answer'=>$this->answer],
        ];
    }
}
