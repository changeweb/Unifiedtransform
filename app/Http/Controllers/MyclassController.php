<?php

namespace App\Http\Controllers;

use App\Myclass as Myclass;
use App\Http\Resources\ClassResource;
use Illuminate\Http\Request;

class MyclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($school_id)
     {
       return ($school_id > 0)? ClassResource::collection(Myclass::bySchool($school_id)->get()):response()->json([
         'Invalid School id: '. $school_id,
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
        //
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
        'class_number' => 'required'
      ]);
      $tb = new Myclass;
      $tb->class_number = $request->class_number;
      $tb->school_id = \Auth::user()->school_id;
      $tb->group = (!empty($request->group))?$request->group:'';
      $tb->save();
      return back()->with('status', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClassResource(Myclass::find($id));
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
      $tb = Myclass::find($id);
      $tb->class_number = $request->class_number;
      $tb->school_id = $request->school_id;
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
      return (Myclass::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
