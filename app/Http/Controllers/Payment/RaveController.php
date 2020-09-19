<?php

namespace App\Http\Controllers\Payment;

use App\Models\Payment;
use App\Models\Transaction;
use App\Services\PaymentService;
use App\Traits\Email\MailCart;
use App\Traits\General\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Rave Facade
use Illuminate\Support\Facades\Auth;
use KingFlamez\Rave\Facades\Rave;

class RaveController extends Controller
{
    use Uuid, MailCart;

    private $paymentService;

    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

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

        $amount = $request->input('amount');
        //start local transaction payment
        $tranx = new Transaction();
        $tranx->uuid = $this->setUuid();
        $tranx->txref = $request->input('uuid');
        $tranx->first_name = $request->input('firstname');
        $tranx->last_name = $request->input('lastname');
        $tranx->email = $request->input('email');
        $tranx->phone = $request->input('phone');
        $tranx->value = $amount;
        $tranx->amount = $amount;
        $tranx->status = 'attempting';
        $tranx->completed = false;
        $tranx->start = time();
        $tranx->details = "Started payment for $amount at ".date('F d, y : h:i:s', time()). " | ";
        $tranx->save();

        //This initializes payment and redirects to the payment gateway

        $payload = $this->paymentService->formatPayload($request);

        if ($transaction = $this->paymentService->initiatePayment($payload)) {
            // redirect to payment page so user can pay
            return redirect($transaction['data']['link']);
        }

        return back()->withErrors(['Could not initiate payment!']);

        //The initialize method takes the parameter of the redirect URL
        // Rave::initialize(route('callback'));
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback(Request $request){
        if (isset($request->txref)) {

            $tranx = Transaction::where('txref', $request->txref)->first();

            if(empty($tranx)){
                return redirect()->route('cart')->with(['error' => 'Could not complete transaction!']);
            }
            $response = $this->paymentService->verifyPayment($tranx->txref);

            // If user cancels the transaction or something wrong happened.
            if ($response['status'] == 'error') {
                return redirect()->route('cart')->with(['error' => 'Could not complete transaction!']);
            }
//
            if (($response['data']['chargecode'] == "00" || $response['data']['chargecode'] == "0") && ($response['data']['amount'] == $tranx->amount)){

                if ($tranx->status === strtolower('attempting')) {
                    $paymentId = $this->setUuid();

                    $amount = $tranx->amount;
                    $tranx->status = "success";
                    $tranx->payment_id = $paymentId;
                    $tranx->ends = time();
                    $tranx->details = "Payment for $amount completed at ".date('F d, y : h:i:s', time()).". ";
                    $tranx->update();

                    $payment = new Payment();
                    $payment->uuid = $paymentId;
                    $payment->email = $tranx->email;
                    $payment->success = true;
                    $payment->amount = $amount;
                    $payment->status = 'success';
                    $payment->save();

                    return redirect()->route('payment.complete', $tranx->uuid);

                }

                if($tranx->status === strtolower('success')){
                    $payment = Payment::where('uuid', $tranx->payment_id)->first();
                    if(!empty($payment)){
                        return redirect()->route('payment.complete', $tranx->uuid);
                    }else{
                        return redirect()->route('cart')->with(['error' => 'Transaction not found! Please, contact us.']);
                    }
                }

                return redirect()->route('cart')->with(['error' => 'Transaction not found! Please, contact us.']);

            }else{
                return redirect()->route('cart')->with(['error' => 'Transaction not found! Please, contact us.']);
            }

        } else {
//            return redirect()->route('payment.failed')->with(['error' => 'No reference supplied!']);
        }
    }

    public function oldCallback(Request $request)
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
