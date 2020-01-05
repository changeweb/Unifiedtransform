<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $fees = \App\Fee::bySchool(\Auth::user()->school_id)->get();
      return view('fees.all',['fees'=>$fees]);
    }

    public function tct_index()
    {
      $fees = \App\Fee::bySchool(\Auth::user()->school_id)->get();
      return view('fees.tct_all',['fees'=>$fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fees.create');
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
            'fee_name' => 'required|string|max:255',
        ]);
        $fee = new \App\Fee;
        $fee->fee_name = $request->fee_name;
        $fee->school_id = \Auth::user()->school_id;
        $fee->user_id = \Auth::user()->id;
        $fee->save();
        return back()->with('status', __('Saved'));
    }

    public function tct_store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'session' => 'required',
          ]);
        $fee =  \App\Fee::firstOrNew(
            [
                'school_id' => \Auth::user()->school_id,
                'fee_channel_id' => $request->channel,
                'fee_type_id' => $request->type,
                'session' => $request->session,  
            ]);
        $fee->fee_name = $request->name;
        // $fee->school_id = \Auth::user()->school_id;
        $fee->user_id = \Auth::user()->id;
        // $fee->fee_channel_id = $request->channel;
        // $fee->fee_type_id = $request->type;
        $fee->amount = $request->amount;
        // $fee->amount = $request->session;
        $fee->active = $request->active;
        $fee->save();
        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $update = [
            'school_id' => \Auth::user()->school_id,
            'fee_channel_id' => $request->channel,
            'fee_type_id' => $request->type,
            'session' => $request->session,  
            'amount' => $request->amount,
            'active' => $request->active,
        ];

        // $fee = \App\Fee::firstOrNew($update);
        // if($fee->id == $id OR !$fee->exists){
        //     \App\Fee::find($id)->update($update);
        // }

        $fee = \App\Fee::find($id);
        $fee->update($update);
        $fee->fee_name = $request->name;
        // $fee->school_id = \Auth::user()->school_id;
        $fee->user_id = \Auth::user()->id;
        // $fee->fee_channel_id = $request->channel;
        // $fee->fee_type_id = $request->type;
        // $fee->amount = $request->amount;
        // $fee->active = $request->active;

        // print($fee);
        $fee->save();
        return back()->with('status', __('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
