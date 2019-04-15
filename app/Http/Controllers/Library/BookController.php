<?php

namespace App\Http\Controllers\Library;

use App\Book;
use App\Myclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Library\BookRequest;

class BookController extends Controller
{
    public function index() {
        $books = Book::bySchool(auth()->user()->school_id)->paginate();

        return view('library.books.index', compact('books'));
    }

    public function show(Book $book) {
        return view('library.books.show', compact('book'));
    }

    public function create() {
        $classes = Myclass::where('school_id', auth()->user()->school_id)->get();

        return view('library.books.create', compact('classes'));
    }

    public function store(BookRequest $request) {
        $book = Book::create([
            'title'     => $request->title,
            'book_code' => $request->book_code,
            'author'    => $request->author,
            'quantity'  => $request->quantity,
            'rackNo'    => $request->rackNo,
            'rowNo'     => $request->rowNo,
            'type'      => $request->type,
            'about'     => $request->about,
            'class_id'  => $request->class_id,
            'school_id' => auth()->user()->school_id,
            'user_id'   => auth()->user()->id
        ]);

        return redirect()->route('library.books.show', $book->id);
    }
}
