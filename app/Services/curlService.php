<?php

namespace App\Services;

class curlService implements curlServiceContract
{
    public function getHtml(string $url): string
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $contentResponse = curl_exec($curl);
        curl_close($curl);

        return $contentResponse;
    }
}
