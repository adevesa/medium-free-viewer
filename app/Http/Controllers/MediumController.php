<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class MediumController extends Controller
{

    public function index()
    {
        $url = request()->get('url');
        $resultado = Cache::get($url);
        if(!$resultado) {
            $resultado = $this->getHtml($url);
        }
        $resultado = str_replace("main.0b4c1932.js", "" , $resultado);
        return view('home', ['resultado' => $resultado]);
    }

    private function getHtml($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        Cache::put($url, $resp, Carbon::today()->addDays(5));
        return $resp;
    }
}
