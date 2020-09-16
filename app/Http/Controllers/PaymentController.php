<?php

namespace App\Http\Controllers;

// use PDF;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Transaction;
use App\Traits\Email\MailCart;
use App\Traits\General\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    use Uuid, MailCart;
    public function finTran(Request $request, $tran_id){
        //find the transaction,
        $tranx = Transaction::where('uuid', $tran_id)->first();
        if(empty($tranx)){
           return redirect()->route('cart')->withErrors(['Unable to complete request.']);
        }

        //find the associated payment
        $payment = Payment::where('uuid', $tranx->payment_id)->first();
        if(empty($payment)){
            return redirect()->route('cart')->withErrors(['Unable to complete request.']);
        }

        return $this->handleOrder($tranx, $payment);

    }

    public function handleOrder($transaction, $payment){

        $name = $transaction->first_name." ".$transaction->last_name;
        $phone = $transaction->phone;
        $email = $transaction->email;

        $booking = new Booking();
        $booking->seen = false;
        $booking->handled = false;
        $booking->replied = false;
        $booking->email = $email;

        if(Auth::guard('customer')->check()){
            $booking->customer_id = Auth::guard('customer')->user()->uuid;
        }

        $booking->phone = $phone;
        $booking->name = $name;
        $booking->uuid = "BK-".$this->setUuid();
        $booking->save();

        $payment->order_id = $booking->uuid;
        $payment->update();

        $transaction->cart_id = $booking->uuid;
        $transaction->update();


        //register customer if empty
        $customer = Customer::where('email', $email)->first();

        if(empty($customer)){
//            $customer = new Customer();
//            $customer->email = $email;
//            $customer->name = $name;
//            $customer->save();
        }

        $key = "my_cart_list";
        $cartItems = session($key);

//        $cartItems = $request->session()->get($key);
        if(!empty($cartItems)){
            if(count($cartItems)>0){
                foreach ($cartItems as $item){
                    $cart = new Cart();
                    $cart->book_uuid = $booking->uuid;
                    $cart->product_id = $item['uuid'];
                    $cart->qty = $item['qty'];
                    $cart->price = $item['price'];
                    $cart->total_price = $item['total_price'];
                    $cart->save();
                }
            }

            //unload the session
            session()->forget($key);

            //send email to email if exists
            if(!empty($email)){

                $this->sendOrderMail($email, $booking);
//                    $this->productOrderMail($email, $booking);
            }

            $authCustomer = Auth::guard('customer')->user();
            if(!empty($authCustomer)){
                return redirect()->route('cart')->withMessage('Your order has been completed successfully. Check your email for details.');
            }else{
                return redirect()->route('cart')->withMessage('Your order has been completed successfully. Check your email for details.');
            }

//            try{
//
//
//
//
//            }catch (\Exception $e){
//                return back()->withErrors(['errors'=>"Unable to complete. Error - ".$e->getMessage().". Contact us on ".env('SITE_EMAIL')."."]);
//            }
        }

        return redirect()->route('cart')->withErrors(['Your cart might me empty. Contact us if you just made a payment.']);

    }

    /**
     * Print payment receipt
     *
     * @param  string  $txref
     * @return \Illuminate\Http\Response
     */
    /*public function printReceipt($txref)
    {
        $payment = $this->paymentService->getRecord($txref);
        $pdf = PDF::loadView('emails.transactionals.payment_receipt', compact('payment'));
        $fileName =  str_slug(strtolower(config('app.name') . ' receipt ' . time())) . '.pdf';
        return $pdf->download($fileName);
    }*/

}