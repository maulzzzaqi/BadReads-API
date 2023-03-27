<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'review' => $this->review_content,
            // 'user' => $this->user_id,
            'user' => $this->whenLoaded('reviewer'),
            'created_at' => date_format($this->created_at, "m/d/y h:i:s"),
        ];

    }
}
