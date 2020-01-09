<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Payment::where('custormer_id', auth()->user()->id)->get();
        return view('stripe.receipts',compact('receipts'));
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
                $tb = new Payment;
                $tb->fee_id = $fee_id;
                $tb->amount = $amount;
                $tb->user_id = $request->user_id;
                $tb->receipt = $request->receipt;
                $tb->session = $request->session;
                $tb->notes = $request->notes[$fee_id];
                $tb->pay_date = $request->payment_date;
                $tb->save();
                // return $tb;
            }
        }
        
        return redirect('/user/'.\App\User::find($request->user_id)->student_code);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $id;
        $request->validate([
            'receipt' => 'required',
            'payment_date' => 'required',
            'session' => 'required',
            'amount' => 'required',
          ]);
        
        $fee = \App\Fee::where([
            'session' => $request->session,
            'fee_type_id' => $request->type,
            'fee_channel_id' => $request->channel_id,
        ])->first();


        $tb = \App\Payment::find($id);
        $tb->receipt = $request->receipt;
        $tb->pay_date = $request->payment_date;
        $tb->session = $request->session;
        $tb->amount = $request->amount;
        $tb->fee_id = $fee->id;
        $tb->save();

        // return $tb;

          return redirect('/user/'.\App\User::find($request->user_id)->student_code)->with('finance_tab', true);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
