<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $request -> validate([
            'book_id' => 'required|exists:books,id',
            'review_content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $review = Review::create($request->all());

        // return response()->json($review);

        return new ReviewResource($review->loadMissing(['reviewer:id,username']));

    }
}
