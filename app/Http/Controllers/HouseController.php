<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = \Auth::user()->school;
        $houses = House::all();
        return view('school.house',
            [
                'houses'=>$houses,
                'school'=>$school,
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
            'house_name' => 'required',
            'house_code' => 'required',
          ]);
          $tb = new House;
          $tb->house_name = $request->house_name;
          $tb->house_name_ton = ($request->house_name_ton) ? $request->house_name_ton : '';
          $tb->house_abbrv = $request->house_code;
          $tb->active = 1;
          $tb->save();
          return redirect('/school/houses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tb = House::find($id);
        $tb->house_name = $request->house_name;
        $tb->house_name_ton = ($request->house_name_ton) ? $request->house_name_ton : '';
        $tb->house_abbrv = $request->house_code;
        $tb->active = $request->house_active;
        // echo($tb);
        $tb->save();
        return redirect('/school/houses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }
}
