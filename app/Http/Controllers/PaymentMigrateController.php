<?php

namespace App\Http\Controllers;

use App\PaymentMigrate;
use Illuminate\Http\Request;

class PaymentMigrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // return $request;
        $request->validate([
            'receipt' => 'required',
            'payment_date' => 'required',
        ]);
        if(count($request->payment)){
            foreach($request->payment as $fee_id => $amount){
                $tb = new PaymentMigrate;
                $tb->tct_id = $request->user_id;
                $tb->amount = $amount;
                $tb->receipt_num = $request->receipt;
                $tb->year = $request->session;
                $tb->pay_notes = $request->notes[$fee_id];
                $tb->pay_date = $request->payment_date;
                $tb->fee_type = $request->typePaid;
                $tb->save();
                // return $tb;
            }
        }
        
        return redirect('/user/'.$request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMigrate  $paymentMigrate
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMigrate $paymentMigrate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentMigrate  $paymentMigrate
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMigrate $paymentMigrate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMigrate  $paymentMigrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;

        $request->validate([
            'receipt' => 'required',
            'payment_date' => 'required',
            'session' => 'required',
            'amount' => 'required',
          ]);
        $tb = \App\PaymentMigrate::find($id);
        $tb->tct_id = $request->user_id;
        $tb->receipt_num = $request->receipt;
        $tb->pay_date = $request->payment_date;
        $tb->fee_type = $request->type;
        $tb->year = $request->session;
        $tb->amount = $request->amount;
        // return $tb;
        $tb->save();
        return redirect('/user/'.$request->user_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMigrate  $paymentMigrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMigrate $paymentMigrate)
    {
        //
    }
}
