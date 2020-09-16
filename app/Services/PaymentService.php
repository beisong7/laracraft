<?php

namespace App\Services;

use App\Traits\RavePayment;
use Illuminate\Http\Request;

class PaymentService
{
    use RavePayment;

    /**
     * Format the data that will be sent for payment
     *
     * @param  array  $data
     * @return array
     */
    public function formatPayload(Request $request)
    {
        $payload = [
            'customer_firstname' => $request->input('firstname'),
            'customer_lastname' => $request->input('lastname'),
            'customer_email' => $request->input('email'),
            'amount' => $request->input('amount'),
            'country' => $request->input('country'),
            'currency' => $request->input('currency'),
            'txref' => $request->input('uuid'),
            'PBFPubKey' => $this->getPublicKey(),
            'redirect_url' => $this->getRedirectUrl(),
        ];

        $payload['integrity_hash'] = $this->integrityChecksum($payload);

        return $payload;
    }

    /**
     * Initiate payment to the payment gateway
     *
     * @param  array  $payload
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function initiatePayment($payload)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUrl('/v2/hosted/pay'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the API
            die('Failed: ' . $err);
        }

        $transaction = json_decode($response, true);

        if (! $transaction['data'] && ! $transaction['data']['link']) {
            // there was an error from the API
            print_r(
                'Something went wrong: ' . $transaction['message'] . '. Please, contact us on '
                . config('app.support_email') . ' if this issue continues.'
            );
        }

        return $transaction;
    }

    /**
     * Verify payment from payment gateway using a transaction reference
     *
     * @param  string  $txref
     * @return array
     */
    public function verifyPayment($txref)
    {
        $query = [
            "SECKEY" => $this->getSecretKey(),
            "txref" => $txref
        ];

        $dataString = json_encode($query);

        $ch = curl_init($this->getUrl('/v2/verify'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        return json_decode($response, true);
    }

}