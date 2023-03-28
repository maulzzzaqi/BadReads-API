<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDetailResource extends JsonResource
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
            'Book Title' => $this->book_title,
            'Synopsis' => $this->book_synopsis,
            'Author' => $this->book_author,
            'Year Published' => $this->year_published,
            'isbn' => $this->isbn,
            'reviews' => $this->whenLoaded('reviews', function(){
                return count($this->reviews);
            }),
            'review' => $this->whenLoaded('reviews', function(){
                return collect($this->reviews)->each(function($review){
                    $review->reviews;
                    return $review;
                });
            }),
        ];
    }
}
