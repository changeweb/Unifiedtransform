<?php

namespace App\Http\Controllers;

use App\Routine as Routine;
use App\Http\Resources\RoutineResource;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($class_id)
     {
       return ($class_id > 0)? RoutineResource::collection(Routine::where('class_id', $class_id)->get()):response()->json([
         'Invalid Class id: '. $class_id,
         404
       ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $files = Routine::where('school_id',\Auth::user()->school_id)->where('active',1)->get();
      return view('routines.create',['files'=>$files]);
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
        'file_path' => 'required|string|max:255',
        'title' => 'required|string|max:255',
      ]);
      $tb = new Routine;
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
        return new RoutineResource(Routine::find($id));
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
      $tb = Routine::find($id);
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
      return (Routine::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
