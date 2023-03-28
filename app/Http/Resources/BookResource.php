<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'Book Title' => $this->book_title,
            'Author' => $this->book_author,
            'Year Published' => $this->year_published,
            'reviews' => $this->whenLoaded('reviews', function(){
                return count($this->reviews);
            }),
        ];

    }
}
