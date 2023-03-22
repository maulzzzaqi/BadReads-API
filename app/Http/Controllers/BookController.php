<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookDetailResource;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $book = Book::all();
        // return response()->json($book);
        return BookResource::collection($book);
    }

    public function detail(){
        $book = Book::all();
        return BookDetailResource::collection($book);
    }

}
