<?php

namespace App\Traits;

/*
 * This trait manages some Rave's payment methods and variables
*/
use Illuminate\Support\Str;

trait RavePayment
{
    /**
     * Create integrity checksum
     *
     * @param  string  $data
     * @return string
     */
    public function  integrityChecksum($data)
    {
        // The keys in step 1 above are sorted by their ASCII value
        ksort($data);

        // The payload is rearranged and the values concatenated in the order of the sorted keys.
        $hashedPayload = '';

        foreach ($data as $key => $value) {
            $hashedPayload .= $value;
        }

        // This creates a the full string to be hashed:
        $completeHash = $hashedPayload.$this->getSecretKey();

        // Generate the sha256 hash of the concatenated strings
        return hash('sha256', $completeHash);
    }

    /**
     * Get Rave's country of payment based on the currency being used for the payment
     *
     * @param  string  $currency
     */
    public function getCountry($currency)
    {
        switch ($currency) {
            case 'KES':
                $country = 'KE';
                break;
            case 'GHS':
                $country = 'GH';
                break;
            case 'ZAR':
                $country = 'ZA';
                break;
            case 'TZS':
                $country = 'TZ';
                break;
            default:
                $country = 'NG';
                break;
        }

        return $country;
    }

    /**
     * Get the the rave's resource URL, then attach the endpoint a request
     * is to be made to and return a full url for the request
     *
     * @param  string  $endpoint
     * @return string
     */
    public function getUrl($endpoint = null)
    {
        // Remove multiple forward slashes at the beginning of the endpoint
        $endpoint = preg_replace('/(\/+)/', '/', $endpoint);
        // Ensure there is at least one forward slash at the beginning of the endpoint
        $endpoint = substr($endpoint, 0, 1) !== '/' ? '/'.$endpoint : $endpoint;
        // Sanitize the endpoint
        $endpoint = filter_var($endpoint, FILTER_SANITIZE_URL);

        return config('services.rave.resource_url') . $endpoint;
    }

    /**
     * Return rave's public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return config('services.rave.public');
    }

    /**
     * Return rave's secret key
     *
     * @return string
     */
    protected function getSecretKey()
    {
        return config('services.rave.secret');
    }

    /**
     * Return rave's secret key
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
//        return config('services.rave.callback');
        return route('callback');
    }

    /**
     * Generate a random transaction reference number for the payment
     *
     * @param  string  $prefix
     * @return string
     */
    public function generateRef($prefix = null)
    {
        return $prefix . str_replace('-', '', (string)Str::uuid());
    }
}