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
        return BookResource::collection($book->loadMissing('reviews'));
    }

    public function detail($id){
        $book = Book::with('reviews:id,user_id,review_content')->findOrFail($id);
        return new BookDetailResource($book);
    }

    public function search(Request $request){
        $searchQuery = $request->input('query');

        $books = Book::where('book_title', 'like', '%'.$searchQuery.'%')
                    ->orWhere('book_author', 'like', '%'.$searchQuery.'%')
                    ->get();
        
        if ($books->isEmpty()){
            return response()->json([
                'error' => 'No books found', 404
            ]);
        }

        return response()->json($books);

    }

    public function addBook(Request $request){
        $request -> validate([
            'book_title' => 'required',
            'book_synopsis' => 'required',
            'book_author' => 'required',
            'year_published' => 'required',
            'isbn' => 'required',
        ]);

        $book = Book::create($request->all());
        return new BookDetailResource($book);

    }

    public function update(Request $request, $id){
        $request -> validate([
            'book_title' => 'required',
            'book_synopsis' => 'required',
            'book_author' => 'required',
            'year_published' => 'required',
            'isbn' => 'required',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());
        return new BookDetailResource($book);

    }

    public function delete($id){
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book data deleted!',
        ]);

    }

}
