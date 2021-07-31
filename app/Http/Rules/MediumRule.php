<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class MediumRule implements Rule
{
    const MEDIUM_FROM_IP_RANGE = '162.158.0.0';
    const MEDIUM_TO_IP_RANGE = '162.159.255.255';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value)
    {
        $hostName = parse_url($value, PHP_URL_HOST);
        $ip = gethostbyname($hostName);
        $ip = ip2long($ip);

        $fromRange = ip2long(self::MEDIUM_FROM_IP_RANGE);
        $toRange = ip2long(self::MEDIUM_TO_IP_RANGE);

        return ($ip < $toRange && $ip > $fromRange) || $this->hasSpecificHeaders($value);
    }

    private function hasSpecificHeaders($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $responseHeaders = curl_exec($curl);


        return !Str::containsAll($responseHeaders, [
            "content-security-policy: frame-ancestors 'self' https://medium.com",
            "medium-fulfilled-by:",
            "medium-missing-time:"
        ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The url provided is not in the Medium IPs Range';
    }
}
