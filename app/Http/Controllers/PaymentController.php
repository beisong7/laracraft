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
use Illuminate\Support\Facades\DB;


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
        $payment = Payment::where('transaction_id', $tran_id)->first();
        if(empty($payment)){
            return redirect()->route('cart')->withErrors(['Unable to complete request.']);
        }

        return $this->handleOrder($tranx, $payment);

    }

    public function handleOrder($transaction, $payment){

        $cus_id = null;
        if(Auth::guard('customer')->check()){
            $cus_id = Auth::guard('customer')->user()->unid;
        }

        DB::beginTransaction();

        $booking = Booking::where('transaction_id', $transaction->uuid)->first();

        $customer = Auth::guard('customer')->user();
        $data = null;
        if(!empty($customer)){
            $data = [
                'order_id'=>$booking->unid,
                'success' => true,
                'status' => 'success',
                'client_key' => $customer->uuid,
            ];
        }else{
            $data = [
                'order_id'=>$booking->unid,
                'success' => true,
                'status' => 'success',
            ];
        }


        DB::table('payments')
            ->where('uuid', $payment->uuid)
            ->update($data);

        DB::table('transactions')
            ->where('uuid', $transaction->uuid)
            ->update([
                'cart_id'=>$booking->unid,
            ]);



        //register customer if empty
        $customer = Customer::where('email', $transaction->email)->first();

        if(empty($customer)){
//            $customer = new Customer();
//            $customer->email = $email;
//            $customer->name = $name;
//            $customer->save();
        }

        DB::commit();

        $key = "my_cart_list";
        $cartItems = session($key);

//        $cartItems = $request->session()->get($key);
        if(!empty($cartItems)){

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