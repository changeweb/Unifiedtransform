<?php

namespace App\Http\Controllers;

use App\Book as Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('class')->where('school_id', \Auth::user()->school_id)->paginate(100);
        return view('library.books',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = \App\Myclass::where('school_id',\Auth::user()->school_id)->get();
        return view('library.add-new-book',['classes'=>$classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'book_title' => 'required',
        'book_code' => 'required',
        'book_author' => 'required',
        'book_quantity' => 'required',
        'book_rackNo' => 'required',
        'book_rowNo' => 'required',
        'book_type' => 'required',
        'book_about' => 'required',
        'book_price' => 'required',
        'class_id' => 'required',
      ]);
        $tb = new Book;
        $tb->title = $request->book_title;
        $tb->book_code = $request->book_code;
        $tb->author = $request->book_author;
        $tb->quantity = $request->book_quantity;
        $tb->rackNo = $request->book_rackNo;
        $tb->rowNo = $request->book_rowNo;
        $tb->type = $request->book_type;
        $tb->about = $request->book_about;
        $tb->price = $request->book_price;
        $tb->class_id = $request->class_id;
        $tb->school_id = \Auth::user()->school_id;
        $tb->user_id = \Auth::user()->id;
        $tb->save();
        return back()->with('status', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BookResource(Book::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tb = Book::find($id);
      $tb->title = $request->title;
      $tb->class_id = $request->class_id;
      return ($tb->save())?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Book::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
