<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getFeeAssignList(Request $request)
    {
        $fee_channel_id = $request->channel_id;
        // return $fee_channel_id;
        $channel = \App\FeeChannel::find($fee_channel_id);
        $types = \App\Fee::where('session', $channel->session)
            // ->where('active', 1)
            ->where('fee_channel_id', $fee_channel_id)
            ->get();
        // return $types;
            
        return view('tableTemplates.feeAssignListTemplate',[
            'fee_channel_id' => $fee_channel_id,
            'types' => $types,
            'session' => $channel->session,
        ]);
    }
}
