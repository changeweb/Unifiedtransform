<?php

namespace App\Http\Controllers\Library;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index() {
        $books = Book::where('school_id', auth()->user()->school_id)->paginate();

        return view('library.books.index', compact('books'));
    }

    public function show(Book $book) {
        return view('library.books.show', compact('book'));
    }
}
