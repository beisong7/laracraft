<?php

namespace App\Http\Controllers;

// use PDF;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\TransactionService;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $paymentService;
    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

    /**
     * User attempts to make payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function attempt(Request $request){
        $payload = $this->paymentService->formatPayload($request);

        if ($transaction = $this->paymentService->initiatePayment($payload)) {
            // redirect to payment page so user can pay
            return redirect($transaction['data']['link']);
        }

        return back()->withErrors(['Could not initiate payment!']);
    }

    /**
     * Verify if user's payment was successful
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function verify(Request $request){
        if (isset($request->txref)) {
            $transaction = $this->transactionService->getTransaction($request->txref);

            $response = $this->paymentService->verifyPayment($transaction->txref);

            // If user cancels the transaction or something wrong happened.
            if ($response['status'] == 'error') {
                return redirect()->route('payment.failed')->with(['error' => 'Could not complete transaction!']);
            }

            if (
                ($response['data']['chargecode'] == "00" || $response['data']['chargecode'] == "0") &&
                ($response['data']['amount'] == $transaction->amount)  &&
                ($response['data']['currency'] == $transaction->currency)
            ) {
                if (is_null($transaction->completed_at) || $transaction->status == 'attempted') {
                    \DB::beginTransaction();
                    event(new PaymentSuccessful($response, $transaction->plan_id));
                    \DB::commit();
                }

                return redirect()->route('payment.success', $transaction->txref)->with(['success' => 'Payment Completed!']);

            } else {
                return redirect()->route('payment.failed')->with(['error' => 'Transaction not found! Please, contact us.']);
            }

        } else {
            return redirect()->route('payment.failed')->with(['error' => 'No reference supplied!']);
        }

    }

    /**
     * Display a transaction failed page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function failed(Request $request)
    {
        if (! $request->session()->has('error')) {
            return redirect()->route('plans.index');
        }

        return view('payments.failed');
    }

    /**
     * Display a transaction success page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $txref
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request, $txref)
    {
        $payment = $this->paymentService->getRecord($txref);

        return view('payments.success', compact('payment'));
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