<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Fee;

class CashierController extends Controller
{
    public function index(){
        $fees_fields = Fee::bySchool(auth()->user()->school_id)->get();
        return view('stripe.payment', compact('fees_fields'));
    }

    public function store(Request $request){
        $stripeToken = $request->stripeToken;
        $amount = intval($request->amount * 100);
        $chargeField = $request->charge_field;
        $user = auth()->user();
        if($user->stripe_id == NULL){
            //manually create a new Customer instance with Stripe
            $user->createAsStripeCustomer($stripeToken);
        }
        try {
            $transaction = $user->charge($amount);
            $payment = new Payment;
            $payment->payment_id = $transaction->id;
            $payment->payment_status = 1;
            $payment->amount = $request->amount;
            $payment->custormer_id = auth()->user()->id;
            $payment->charge_for = $chargeField;
            $payment->save();
        } catch (\Exception $e) {
            return back()->with(['error'=>true,'status'=>__('Payment Unsuccessful')]);
        }
        // Return back
        return back()->with('status',__('Payment Successful'));
    }
}
