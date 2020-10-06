<?php

namespace App\Http\Controllers\Payment;

use App\Events\PaymentEvent;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\Cart\ProcessOrder;
use App\Services\PaymentService;
use App\Traits\Cart\CostAudit;
use App\Traits\Email\MailCart;
use App\Traits\General\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Rave Facade
use Illuminate\Support\Facades\DB;

class RaveController extends Controller
{
    use Uuid, MailCart, CostAudit;

    private $paymentService;
    private $cartService;

    public function __construct(PaymentService $paymentService, ProcessOrder $cartService) {
        $this->paymentService = $paymentService;
        $this->cartService = $cartService;
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
        if(!$this->costMatchWith($amount)){
            return back()->withMessage('Page Updated! Click pay not to checkout...');
        }

        $txref = $this->buildId('RaV3-', 45);

        //start local transaction payment
        $tranx = new Transaction();
        $tranx->uuid = $this->setUuid();
        $tranx->txref = $txref;
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

        $paym_id = $this->setUuid();

        $payment = new Payment();
        $payment->uuid = $paym_id;
        $payment->email = $tranx->email;
        $payment->transaction_id = $tranx->uuid;
        $payment->success = false;
        $payment->amount = $amount;
        $payment->status = 'initiated';
        $payment->save();

        $this->cartService->prepareOrder($tranx, $payment->uuid);

        //This initializes payment and redirects to the payment gateway

        $payload = $this->paymentService->formatPayload($request, $txref);

        $transaction = $this->paymentService->initiatePayment($payload);
        if ($transaction!==false) {
            // redirect to payment page so user can pay
            return redirect($transaction['data']['link']);
        }

        return redirect()->route('cart')->withErrors(['Could not contact payment! Try again']);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request){
        if (isset($request->txref)) {

            $tranx = Transaction::where('txref', $request->txref)->first();

            if(empty($tranx)){
                dd($request->txref);
                return redirect()->route('cart')->withErrors(['Could not complete transaction!']);
            }

            $payment = Payment::where('transaction_id',$tranx->uuid )->first();
            if(empty($payment)){
                dd($tranx->uuid);
                return redirect()->route('cart')->withErrors(['Could not complete transaction!']);
            }

            $response = $this->paymentService->verifyPayment($tranx->txref);

            // If user cancels the transaction or something wrong happened.
            if ($response['status'] == 'error') {
                return redirect()->route('cart')->withErrors(['Could not complete transaction!']);
            }

            if (($response['data']['chargecode'] == "00" || $response['data']['chargecode'] == "0") && ($response['data']['amount'] == $tranx->amount)){

                if ($tranx->status === strtolower('attempting')) {

                    $paymentId = $this->setUuid();

                    $amount = $tranx->amount;

                    $payload = [
                        'status' => "success",
                        'payment_id' => $payment->uuid,
                        'ends' => time(),
                        'completed' => true,
                        'details' => "Payment for ".$amount ."completed at ".date('F d, y : h:i:s', time()).". ",
                    ];

                    DB::beginTransaction();

//                    event(new PaymentSuccess($tranz->uuid, $obj));
                    DB::table('transactions')
                        ->where('uuid', $tranx->uuid)
                        ->update($payload);


                    DB::commit();

                    return redirect()->route('payment.complete', $tranx->uuid);

                }elseif ($tranx->status === strtolower('success')){

                    $payment = Payment::where('uuid', $tranx->payment_id)->first();
                    if(!empty($payment)){
                        return redirect()->route('payment.complete', $tranx->uuid);
                    }else{
                        return redirect()->route('cart')->withErrors(['Transaction not found! Please, contact us.']);
                    }
                }

            }else{
                return redirect()->route('cart')->withErrors(['Transaction not found! Please, contact us.']);
            }

            return redirect()->route('verify.callback', encrypt($tranx->txref));

        } else {
            return redirect()->route('cart')->withErrors(['Could not complete transaction!']);
        }
    }

    public function testGuz($tref){
//        $response = $this->paymentService->verifyPayment($tref);
        $response = $this->paymentService->guzzle($tref);
        $tranx = Transaction::where('txref', $tref)->first();
        $object = ['hello'=>'world'];
        event(new PaymentEvent($tranx->uuid, $object));
        return "testing event";
    }

    public function verify($encryption){

        try{
            $ref = decrypt($encryption);

            $tranx = Transaction::where('txref', $ref)->first();

            if(!empty($tranx)){
                $response = $this->paymentService->guzzle($ref);

                /**
                 * If user cancels the transaction or something wrong happened.
                 */


                if ($response['status'] == 'error') {
                    return redirect()->route('cart')->with(['error' => 'Could not complete transaction! if you have made payment, contact us with your transaction reference.']);
                }


                if (($response['data']['chargecode'] == "00" || $response['data']['chargecode'] == "0") && ($response['data']['amount'] == $tranx->amount)){

                    if ($tranx->status === strtolower('attempting')) {
                        $paymentId = $this->setUuid();

                        $amount = $tranx->amount;
//                        $tranx->update($trUpdate);
                        $obj = [
                            'status' => "success",
                            'payment_id' => $paymentId,
                            'ends' => time(),
                            'details' => "Payment for $amount completed at ".date('F d, y : h:i:s', time()).". ",
                        ];
                        DB::beginTransaction();
//
                        event(new PaymentEvent($tranx->uuid, $obj));

                        Payment::create([
                            'uuid' => $paymentId,
                            'email' => $tranx->email,
                            'success' => true,
                            'amount' => $amount,
                            'status' => 'success',
                        ]);
                        DB::commit();
//                        $payment = new Payment();
//                        $payment->uuid = $paymentId;
//                        $payment->email = $tranx->email;
//                        $payment->success = true;
//                        $payment->amount = $amount;
//                        $payment->status = 'success';
//                        $payment->save();

                        return redirect()->route('payment.complete', $tranx->uuid);

                    }elseif ($tranx->status === strtolower('success')){

                        $payment = Payment::where('uuid', $tranx->payment_id)->first();
                        if(!empty($payment)){
                            return redirect()->route('payment.complete', $tranx->uuid);
                        }else{
                            return redirect()->route('cart')->withErrors(['Transaction not found! Please, contact us.']);
                        }
                    }

                }else{
                    return redirect()->route('cart')->withErrors(['Transaction not found! Please, contact us.']);
                }
            }

            return redirect()->route('cart')->withErrors(['Transaction not found! Please, contact us.']);



        }catch (\Exception $e){
            return redirect()->route('cart')->withErrors(['Could not complete transaction! if you have made payment, contact us with your transaction reference.']);
        }
    }
}
