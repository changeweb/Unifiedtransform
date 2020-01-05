<?php

namespace App\Http\Controllers;

use App\FeeType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fee_types = FeeType::all();
        return view('finance.fee_type',
        [
            'fee_types'=>$fee_types,
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
            'name' => 'required',
          ]);
        $tb = new FeeType;
        $tb->name = $request->name;
        $tb->active = $request->active;
        $tb->notes = ($request->notes)? $request->notes : '';
        $tb->save();

        return redirect('/fees/fee_type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function show(FeeType $feeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeType $feeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeType $feeType)
    {
        $request->validate([
            'name' => 'required',
          ]);

        $feeType->name = $request->name;
        $feeType->active = $request->active;
        $feeType->notes = ($request->notes)? $request->notes : '';
        $feeType->save();

        return redirect('/fees/fee_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeType $feeType)
    {
        //
    }
}
