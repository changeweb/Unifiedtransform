<?php

namespace App\Http\Controllers\Library;

use App\Book;
use App\Myclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Library\BookRequest;

class BookController extends Controller
{
    public function __construct()
    {
        view()->share('types', [
           __('Academic'),
           __('Magazine'),
           __('Story'),
           __('Other')
        ]);
    }

    public function index() {
        $books = Book::bySchool(auth()->user()->school_id)->paginate();

        return view('library.books.index', compact('books'));
    }

    public function show(Book $book) {
        return view('library.books.show', compact('book'));
    }

    public function edit(Book $book) {
        $classes = Myclass::bySchool(auth()->user()->school_id)->get();

        return view('library.books.edit', compact('book', 'classes'));
    }

    public function create() {
        $classes = Myclass::bySchool(auth()->user()->school_id)->get();

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
            'price'     => $request->price,
            'img_path'  => $request->img_path,
            'class_id'  => $request->class_id,
            'school_id' => auth()->user()->school_id,
            'user_id'   => auth()->user()->id
        ]);

        return redirect()->route('library.books.show', $book->id);
    }

    public function update(BookRequest $request, $book)
    {
        Book::where('id', $book)->update($request->except('_method', '_token'));

        return redirect()->route('library.books.index')->with('status', __('Book has been updated correctly'));
    }
}
