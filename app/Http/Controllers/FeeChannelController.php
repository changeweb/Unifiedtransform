<?php

namespace App\Http\Controllers;

use App\FeeChannel;
use Illuminate\Http\Request;

class FeeChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fee_channel = FeeChannel::orderBy('session','desc')
            ->orderBy('name','asc')
            ->get();
        return view('finance.fee_channel',
        [
            'fee_channels' => $fee_channel,
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
            'session' => 'required',
          ]);
        $tb = new FeeChannel;
        $tb->name = $request->name;
        $tb->active = $request->active;
        $tb->notes = ($request->notes)? $request->notes : '';
        $tb->session = $request->session;
        $tb->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeeChannel  $feeChannel
     * @return \Illuminate\Http\Response
     */
    public function show(FeeChannel $feeChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeeChannel  $feeChannel
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeChannel $feeChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeeChannel  $feeChannel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeChannel $feeChannel)
    {
        $request->validate([
            'name' => 'required',
            'session' => 'required',
          ]);

        $feeChannel->name = $request->name;
        $feeChannel->active = $request->active;
        $feeChannel->notes = ($request->notes)? $request->notes : '';
        $feeChannel->session = $request->session;
        $feeChannel->save();

        return back()->with('status', __('Updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeeChannel  $feeChannel
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeChannel $feeChannel)
    {
        //
    }
}
