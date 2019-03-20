<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssuedbookController extends Controller
{
    public function index(){
      $issuedBooks = \App\Issuedbook::join('books', 'issued_books.book_code', '=', 'books.book_code')
                                    ->select('issued_books.*','books.title','books.type','users.name')
                                    ->join('users', 'issued_books.student_code', '=', 'users.student_code')
                                    ->where('issued_books.borrowed', '=', 1)
                                    ->where('issued_books.school_id', '=', \Auth::user()->school->id)
                                    ->paginate(50);
      return view('library.issued-books',['issued_books'=>$issuedBooks]);
    }

    public function create(){
      $books = \App\Book::where('school_id', \Auth::user()->school_id)
                        ->where('quantity','>',0)
                        ->get();
      return view('library.issuebooks',['books'=>$books]);
    }

    public function store(Request $request){
      $studentExists = \App\User::where('student_code',$request->student_code)->count();
      if($studentExists){
        $quantity = count($request->book_code);
        foreach ($request->book_code as $bk){
          $issueBooks = new \App\Issuedbook;
          $issueBooks->student_code = $request->student_code;
          $issueBooks->book_code = $bk;
          $issueBooks->quantity = 1;
          $issueBooks->school_id = \Auth::user()->school->id;
          $issueBooks->issue_date = $request->issue_date;
          $issueBooks->return_date = $request->return_date;
          $issueBooks->fine = 0;//$request->fine;
          $issueBooks->borrowed = 1;
          $ib[] = $issueBooks->attributesToArray();
          // $book = \App\Book::where('book_code',$bk)->first();
          // $book->quantity = $book->quantity - 1;
          // $book->save();
        }
        \DB::transaction(function () use ($ib) {
          \App\Issuedbook::insert($ib);
          \App\Book::whereIn('book_code',$request->book_code)->update([
            'quantity' => ($book->quantity - 1)
          ]);
        });
        return back()->with('status', 'Saved');
      } else {
        return back()->with('status', 'Student Does Not Exist!');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      \DB::transaction(function () use ($request) {
        $tb = \App\Issuedbook::find($request->issue_id);
        $tb->borrowed = 0;
        $tb->quantity = 0;
        $tb->save();
        $book = \App\Book::where('book_code',$request->book_code)->first();
        $book->quantity = $book->quantity + 1;
        $book->save();
      }, 5);
      
      return back()->with('status', 'Saved');
    }
}
