<?php

namespace App\Http\Controllers\Payment;

use App\Models\Payment;
use App\Traits\General\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Rave Facade
use KingFlamez\Rave\Facades\Rave;

class RaveController extends Controller
{
    use Utility;
    public function initialize(Request $request)
    {
        //Ensure that the session still has valid items in the cart
        $cartItems = $request->session()->get('my_cart_list');
        if(empty($cartItems)){
            return back()->withErrors(['Cart Empty. Add items to cart and try again.']);
        }else{
            if(count($cartItems) < 1){
                return back()->withErrors(['Cart Empty. Add items to cart and try again.']);
            }
        }

        //store local payment
        $payment = new Payment();
        $payment->uuid = $request->input('uuid');
        $amount = $request->input('amount');
        $payment->amount =  $amount;
        $payment->success = false;
        $payment->email = $request->input('email');
        $payment->status = "Attempting";
        $payment->start = time();
        $payment->save();

        //This initializes payment and redirects to the payment gateway

        //The initialize method takes the parameter of the redirect URL
        Rave::initialize(route('callback'));
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback(Request $request)
    {
        dd($request);

        $data = Rave::verifyTransaction(request()->txref);

        dd($data);
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Comfirm that the transaction is successful
        // Confirm that the chargecode is 00 or 0
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
