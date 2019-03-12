<?php

namespace App\Http\Controllers;

use App\Syllabus as Syllabus;
use App\Http\Resources\SyllabusResource;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
      //return view('syllabus.course-syllabus');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $files = Syllabus::where('school_id',\Auth::user()->school_id)->where('active',1)->get();
      return view('syllabus.course-syllabus',['files'=>$files]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tb = new Syllabus;
      $tb->file_path = $request->file_path;
      $tb->title = $request->title;
      $tb->active = 1;
      $tb->school_id = \Auth::user()->school_id;
      $tb->user_id = \Auth::user()->id;
      $tb->save();
      return back()->with('status', 'Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SyllabusResource(Syllabus::find($id));
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
    public function update($id)
    {
      $tb = Syllabus::find($id);
      $tb->active = 0;
      $tb->save();
      return back()->with('status','File removed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Syllabus::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
