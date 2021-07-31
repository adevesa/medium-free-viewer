<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

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

        return ($ip < $toRange && $ip > $fromRange);
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
