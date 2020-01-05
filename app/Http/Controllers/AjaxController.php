<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getFeeAssignList(Request $request)
    {
        // return 'SDFSDFSDFSDFSDF';
        

        $fee_channel_id = $request->fee_id;
        // return $fee_channel_id;
        $types = \App\Fee::where('session', now()->year)
            ->where('active', 1)
            ->where('fee_channel_id', $fee_channel_id)
            ->get();
        // return $types;
            
        return view('tableTemplates.feeAssignListTemplate',[
            'fee_channel_id' => $fee_channel_id,
            'types' => $types,
        ]);
    }
}
